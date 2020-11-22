<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Province;
use App\Wards;
use App\Feeship;
use App\Shipping;
use App\Order;
use App\OrderDetails;
use App\Customer;
use App\Coupon;
use Auth;
use App\Product;
use Session;
use Illuminate\Support\Facades\Redirect;
use PDF;

session_start();

class DeliveryController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login-auth')->send();
        }
    }

    public function delivery(Request $request){
    	$city = City::orderby('type','ASC')->orderby('name_city','ASC')->get();
    	return view('admin.delivery.add_delivery')->with(compact('city'));
    } 
    public function select_delivery(Request $request){
    	$data = $request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action'] == "city"){
    			$select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    				$output .= '<option>---Chọn Quận/Huyện---</option>';
    			foreach ($select_province as $key => $province){
    			$output .= '<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
    			}
    		}else{
    			$select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    				$output .= '<option>---Chọn Xã/Phường---</option>';
    			foreach ($select_wards as $key => $ward){
    			$output .= '<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
    			}
    		}
    	}
    	echo $output;
    }

    public function insert_delivery(Request $request){
    	$data = $request->all();
    	$fee_ship = new Feeship();
    	$fee_ship->fee_matp = $data['city'];
    	$fee_ship->fee_maqh = $data['province'];
    	$fee_ship->fee_xaid = $data['wards'];
    	$fee_ship->fee_feeship = $data['fee_ship'];
    	$fee_ship->save();
    }

    public function select_feeship(Request $request){
    	$feeship = Feeship::orderby('fee_id','DESC')->get();
    	$output = '';
    	$output .= '<div class= "table-responsive">
    					<table class="table table-bordered">
    						<thread>
    							<tr>
    								<th>Tên thành phố</th>
    								<th>Tên quận huyện</th>
    								<th>Tên xã phường</th>
    								<th>Phí vận chuyển</th>
    							</tr>
    						</thread>
    						<tbody>
    						';
    						foreach($feeship as $key => $fee){
    							$output .= '
    							<tr>
    								<td>'.$fee->city->name_city.'</td>
    								<td>'.$fee->province->name_quanhuyen.'</td>
    								<td>'.$fee->wards->name_xaphuong.'</td>
    								<td contenteditable data-feeship_id= "'.$fee->fee_id.'" class="fee_feeship_edit">'.number_format($fee->fee_feeship,0,',','.').'</td>
    							<tr>
    							';
    						}
    						$output .= '
    						</tbody>
    					</table>
    				</div>
    				';
    				echo $output;
    }

    public function update_delivery(Request $request){
    	$data = $request->all();
    	$fee_ship = Feeship::find($data['feeship_id']);
    	$fee_value = rtrim($data['fee_value'],'.');
    	$fee_ship->fee_feeship = $fee_value;
    	$fee_ship->save();
    }

    public function print_cancel_order($pro_id){
        $this->AuthLogin();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order($pro_id));
        return $pdf->stream();
    }

    public function print_order($pro_id){
        $this->AuthLogin();
        $order_details = OrderDetails::with('product')->where('order_code',$pro_id)->get();
        $order = Order::where('order_code',$pro_id)->get(); 
        foreach ($order as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        $order_details_product = OrderDetails::with('product')->where('order_code',$pro_id)->get();

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
        <h4 style="margin-top:-70px; margin-left:480px">PHIẾU HỦY ĐƠN HÀNG</h4>
        <label style="margin-left:540px">------&#9733------</label>
        <label style="float:right; margin-right:98px">Số ....</label>

        <form style="font-size : 13px">
            <br><b style="width:100px">Địa chỉ: 415 Đà Nẵng, Đông Hải, Hải An, Hải Phòng</b><br> 
            <b style="margin-left:60px">Điện thoại: (0225)2858397</b><br> 
        </form>

        <br><br>
        <form style="float:left">
            Người nhận hàng: '.$shipping->shipping_name.'<br>
            Số Điện Thoại: '.$shipping->shipping_phone.'<br>
            Địa chỉ: '.$shipping->shipping_address.'<br>
        </form>
        <form style="float: right">
            Email: '.$shipping->shipping_email.'<br>
            Ghi chú: '.$shipping->shipping_note.'<br>
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

        <br><br><br><br><br>
        <div class="table-responsive">
          <table class="table table-striped table-styling b-t b-light">
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
        <p style="font-weight: bold;">Lý do hủy đơn hàng'.$ord->cancel_reason.'</p>';      
        $output .='
        <br>
        <p style="float:right; margin-top:-20px">Ngày.....tháng.....năm.....</p>
        <br>
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
                <th >Thủ kho</th>
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

        return $output;
    }

}
