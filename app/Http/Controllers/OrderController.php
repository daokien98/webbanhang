<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feeship;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use App\Customer;
use App\Coupon;
use Auth;
use App\Product;
use App\Statistic;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use PDF;

session_start();
class OrderController extends Controller
{
	public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login-auth')->send();
        }
    }

	public  function update_qty(Request $request){
		$this->AuthLogin();
		$data = $request->all();
		$order_details = OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
		$order_details->product_sales_quantity = $data['order_qty'];
		$order_details->save();
	}
	public function update_order_qty(Request $request){
		$this->AuthLogin();
		//update order
		$data = $request->all();
		// $data lấy bên script admin_layout;
		$order = Order::find($data['order_id']);
		$order->order_status = $data['order_status'];
		$order->save();
        //order_date
        $order_date = $order->order_date;
        $statistic = Statistic::where('order_date',$order_date)->get();
        if($statistic){
            $statistic_count = $statistic->count();
        }else{
            $statistic_count = 0;
        }
		if($order->order_status==2){
            //bảng statistic
            $total_orders = 0;
            $sales = 0;
            $profit = 0;
            $quantity_sales = 0;

			foreach ($data['order_product_id'] as $key => $product_id) {
				$product = Product::find($product_id); //tim so luong dua theo product_id
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;
                $product_price = $product->product_price;
                $product_cost = $product->product_cost;
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

				foreach ($data['quantity'] as $key2 => $qty) {
					if($key == $key2){
						$pro_remain = $product_quantity - $qty;
						$product->product_quantity = $pro_remain;
						$product->product_sold = $product_sold + $qty;
						$product->save();
                        //update bảng statistic
                        $quantity_sales += $qty;
                        $total_orders += 1;
                        $sales += $product_price*$qty;
                        $profit = $sales-($product_cost*$qty);    
					}
				}
			}
            //update Statistic
            if($statistic_count>0){
                $statistic_update = Statistic::where('order_date',$order_date)->first();
                $statistic_update->sales = $statistic_update->sales + $sales;
                $statistic_update->profit = $statistic_update->profit + $profit;
                $statistic_update->quantity = $statistic_update->quantity + $quantity_sales;
                $statistic_update->total_order = $statistic_update->total_order + $total_orders;
            }else{
                $statistic_new = new Statistic();
                $statistic_new->order_date = $order_date;
                $statistic_new->profit = $profit;
                $statistic_new->sales = $sales;
                $statistic_new->quantity = $quantity_sales;
                $statistic_new->total_order = $total_orders;
                $statistic_new->save();
            }
		}elseif($order->order_status!=2 && $order->order_status!=3){
			foreach ($data['order_product_id'] as $key => $product_id) {
				$product = Product::find($product_id); 
				$product_quantity = $product->product_quantity;
				$product_sold = $product->product_sold;
				foreach ($data['quantity'] as $key2 => $qty) {
					if($key == $key2){
						$pro_remain = $product_quantity + $qty;
						$product->product_quantity = $pro_remain;
						$product->product_sold = $product_sold + $qty;
						$product->save();
					}
				}
			}
		}
	}
    public function manage_order(){
    	$this->AuthLogin();
    	$order = Order::orderby('created_at','DESC')->get();
    	if(request()->date_from && request()->date_to){
    		$order = Order::whereBetween('created_at',[request()->date_from,request()->date_to])->get();
    	}
    	return view('admin.order.manage_order')->with(compact('order'));
    }
    public function order_date(){
    	$this->AuthLogin();
    	$order_date = Order::orderby('created_at','DESC')->get();
    	if(request()->date_from && request()->date_to){
    		$order_date = Order::whereBetween('created_at',[request()->date_from,request()->date_to])->get();
    	}
    	return view('admin.order.order_date')->with(compact('order_date'));
    }

    public function view_order($order_code){
    	$this->AuthLogin();
    	$order_details = OrderDetails::where('order_code',$order_code)->get();
    	$order = Order::where('order_code',$order_code)->get();	

    	$order_get = Order::where('order_code',$order_code)->first();	
    	foreach ($order as $key => $ord) {
    		$customer_id = $ord->customer_id;
    		$shipping_id = $ord->shipping_id;
    		$order_status = $ord->order_status;
    	}
    	$customer = Customer::where('customer_id',$customer_id)->first();
    	$shipping = Shipping::where('shipping_id',$shipping_id)->first();
    	//belongsTo
    	$order_details_product = OrderDetails::with('product')->where('order_code',$order_code)->get();
    	foreach ($order_details_product as $key => $order_d) {
     		$product_coupon = $order_d->product_coupon;

    	}

    	
    	if($product_coupon!="No"){
    		$coupon = Coupon::where('coupon_code',$product_coupon)->first();
    		$coupon_condition = $coupon->coupon_condition;
    		$coupon_number = $coupon->coupon_number;
    	}else{
    		$coupon_condition = 2;
    		$coupon_number = 0;
    	}


    	return view('admin.order.view_order')->with(compact('order_details','customer','shipping','order_details','coupon_condition','coupon_number','order','order_status','order_get'));

    }
    public function print_order($checkout_code){
    	$this->AuthLogin();
    	$pdf = \App::make('dompdf.wrapper');
    	$pdf->loadHTML($this->print_order_convert($checkout_code));
    	return $pdf->stream();
    }

    public function print_order_convert($checkout_code){
    	$this->AuthLogin();
    	$order_details = OrderDetails::with('product')->where('order_code',$checkout_code)->get();
    	$order = Order::where('order_code',$checkout_code)->get();	
    	foreach ($order as $key => $ord) {
    		$customer_id = $ord->customer_id;
    		$shipping_id = $ord->shipping_id;
    	}
    	$customer = Customer::where('customer_id',$customer_id)->first();
    	$shipping = Shipping::where('shipping_id',$shipping_id)->first();
    	$order_details_product = OrderDetails::with('product')->where('order_code',$checkout_code)->get();

    	foreach ($order_details_product as $key => $order_d) {
     		$product_coupon = $order_d->product_coupon;
    	}
    	
    	if($product_coupon!="No"){
    		$coupon = Coupon::where('coupon_code',$product_coupon)->first();
    		$coupon_condition = $coupon->coupon_condition;
    		$coupon_number = $coupon->coupon_number;
    		if($coupon_condition==1){
    			$coupon_echo = $coupon_number.'%'; 
    		}else{
    			$coupon_echo = number_format($coupon_number,0,',','.').'đ'; 
    		}
    	}else{
    		$coupon_condition = 2;
    		$coupon_number = 0;
    		$coupon_echo = '0đ';
    	}

    	$output = '';
    	$output.= 
    	'<style>
    		body{
    			font-family : DejaVu Sans;
    		}
    		.table-styling th{
    			border: 1px solid #000;
    		}
    		.table-styling tr td{
    			border: 1px solid #000;
    		}
    	}
    	</style>
    	<h3 style="width:300px;margin-left:10px"><center>Công ty Cổ phần Xây dựng Phương Anh</center></h3>
    	<h4 style="margin-top:-70px; margin-left:500px">HÓA ĐƠN ĐẶT HÀNG</h4>
    	<label style="margin-left:550px">------&#9733------</label>
    	<label style="float:right; margin-right:80px">Số ....</label>

    	<form style="font-size : 13px">
    	 	<br><b style="width:100px">Địa chỉ: 415 Đà Nẵng, Đông Hải, Hải An, Hải Phòng</b><br> 
    		<b style="margin-left:60px">Điện thoại: (0225)2858397</b><br> 
    	</form>

    	<br><br>
    	<form style="float:left">
    	Người đặt hàng: '.$customer->customer_name.'<br>
    	Số Điện Thoại: '.$customer->customer_phone.'<br>
    	Email: '.$customer->customer_email.'<br>
    	</form>';

	   	$output .='
	     
	   	<style>
	   		table tr td th{
	   			border: 1px solid black;
	   		}
	   		table{
	   			border-collapse: collapse;
	   			width: 100%;
	   		}
	   		td{
	   			text-align: center;
	   		}
	   	</style>
	   	<form style="float:right">
    	Tên người nhận: '.$shipping->shipping_name.'<br>
    	Số điện thoại: '.$shipping->shipping_phone.'<br>
    	Địa chỉ: '.$shipping->shipping_address.'<br>
    	</form><br>';

	   	$output .='
	   	<br><br><br><br>

	    <div class="table-responsive">
	      <table style="width:100%" class="table table-striped table-styling b-t b-light">
	        <thead>
	          <tr>
	          	<th>Số thứ tự</th>
	            <th>Tên sản phẩm</th>
	            <th>Số lượng</th>
	            <th>Mã giảm giá</th>
	            <th>Phí ship</th>
	            <th>Đơn giá</th>
	            <th>Thành tiền</th>
	          </tr>
	        </thead>
	        <tbody>';
	        $i = 0;
	        $total = 0;
	        foreach ($order_details_product as $key => $product) {    
	        	$i++;  
	        	$subtotal =  $product->product_price*$product->product_sales_quantity;
	        	$total+=$subtotal;
	        	if($product->product_coupon!='No'){
	        		$product_coupon = $product->product_coupon;
	        	}else{
	        		$product_coupon = 'Không';
	        	}
	    $output .= '
	    		<tr>
	    			<td>'.$i.'</td>
	    			<td>'.$product->product_name.'</td>
	    			<td>'.$product->product_sales_quantity.'</td>
	    			<td>'.$product_coupon.'</td>
	    			<td>'.number_format($product->product_fee,0,',','.').'đ'.'</td>
	    			<td>'.number_format($product->product_price,0,',','.').'đ'.'</td>
	    			<td>'.number_format($subtotal,0,',','.').'đ'.'</td>
	    		</tr>';
	    	}
		    	if($coupon_condition==1){
		        	$total_after_coupon = ($total*$coupon_number)/100;
	                $total_coupon = $total - $total_after_coupon ; 
		        }else{
	                $total_coupon = $total - $coupon_number ;
		        }
	   	$output .='
	        </tbody>
	      </table>
	    </div>
                <b style="float: left">Tổng cộng: '.number_format($total_coupon + $product->product_fee,0,',','.').'đ'.'</b>
	    <br><br><br>
	    <p style="margin-left:500px; margin-top:-10px">Ngày.....tháng.....năm.....</p>
	    <div class="table-responsive">
	      <table style="width:100%" class="table table-striped table-border b-t b-light">
            <style>
                .table-border{
                border: none;
            }
            </style>
	        <thead>
	          <tr>
	            <th width=100px>Kế toán</th>
                <th >Người giao hàng</th>
                <th >Khách hàng</th>
	          </tr>
	          <tr>
                <th style="font-size=10px; font-weight:2px;" width="200px">(Ký ghi rõ họ tên)</th>
	          	<th style="font-size=10px; font-weight:2px;" width="200px">(Ký ghi rõ họ tên)</th>
                <th style="font-size=10px; font-weight:2px;" width="200px">(Ký ghi rõ họ tên)</th>
	          </tr>
	        </thead>
	        <tbody>';
	   	$output .='
	        </tbody>
	      </table>
	    </div>'
	    ;
	    $total_order = number_format($total_coupon + $product->product_fee,0,',','.');
    	return $output;

    }

    public function cancel_order($order_code){
    	$this->AuthLogin();
    	$order_details = OrderDetails::where('order_code',$order_code)->get();
    	$order = Order::where('order_code',$order_code)->get();	
    	$order_get = Order::where('order_code',$order_code)->first();	
    	foreach ($order as $key => $ord) {
    		$customer_id = $ord->customer_id;
    		$shipping_id = $ord->shipping_id;
    		$order_status = $ord->order_status;
    	}
    	
    	$customer = Customer::where('customer_id',$customer_id)->first();
    	$shipping = Shipping::where('shipping_id',$shipping_id)->first();
    	//belongsTo
    	$order_details_product = OrderDetails::with('product')->where('order_code',$order_code)->get();


    	return view('admin.order.order_cancel')->with(compact('order_details','customer','shipping','order_details','order','order_status','order_get'));
    }

    public function update_cancel_order(Request $request, $order_id){
    	$this->AuthLogin();
    	$data = $request->all();
        $order = Order::find($order_id);

       
        $order->cancel_reason = $data['cancel_reason']; 

        $order->save();
        Session::put('message','Cập nhật lý do hủy đơn thành công');
        return Redirect::to('list-order-cancel');

    }

    public function list_order_cancel(){
    	$this->AuthLogin();
    	$order = Order::where('order_status','=',3)->paginate(3);

    	return view('admin.order.list_order_cancel')->with(compact('order'));
    }

    public function update_sales_order(Request $request, $order_id){
    	$this->AuthLogin();
    	$data = $request->all();
        $order = Order::find($order_id);

        $order->total_order = $data['total_order']; 
        
        $order->save();
        // Session::put('message','Xác nhận số tiền thành công');
        return Redirect::to('manage-order');
    }
}
