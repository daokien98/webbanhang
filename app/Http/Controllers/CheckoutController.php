<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Cart;
use App\City;
use App\Province;
use App\Wards;
use App\Feeship;
use App\Shipping;
use App\Order;
use App\Customer;
use App\OrderDetails;
use App\Banner;
use App\CatePost;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login-auth')->send();
        }
    }
    public function confirm_order(Request $request){
        $data = $request->all();
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_note = $data['shipping_note'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();

        $shipping_id = $shipping->shipping_id;
        $checkout_code = substr(md5(microtime()),rand(0,26),5);
        $order = new Order();
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->created_at = $today;
        $order->order_date = $order_date;
        $order->save();


        if(Session::get('cart')==true){
            foreach (Session::get('cart') as $key => $cart) {        
                $order_details = new OrderDetails();
                $order_details->order_code = $checkout_code;
                // bên Cart Controller
                $order_details->product_id = $cart['product_id']; 
                $order_details->product_name = $cart['product_name']; 
                $order_details->product_price = $cart['product_price']; 
                $order_details->product_sales_quantity = $cart['product_qty']; 
                $order_details->product_coupon = $data['order_coupon']; 
                $order_details->product_fee = $data['order_fee'];
                $order_details->save(); 
            }

        }
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('cart');
    }
    
    public function select_delivery_home(Request $request){
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
    public function calculate_fee(Request $request){
        $data = $request->all();
        if ($data['matp']){
            $feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                     foreach ($feeship as $key => $fee) {
                Session::put('fee',$fee->fee_feeship);
                Session::save();
                }
            }else{
                Session::put('fee',20000);
                Session::save();
                }  
            }
        }
    }
    public function del_fee(){
        Session::forget('fee');
        return redirect()->back();
    }
    public function login_checkout(Request $request){
        $category_post = CatePost::orderby('cate_post_id','DESC')->get();

    	$product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $banner = Banner::orderby('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $category_by_id = DB::table('tbl_customer')->get();
        foreach($category_by_id as $key => $val){
            //SEO
                $meta_desc = $val->meta_desc;
                $meta_keywords = $val->meta_keywords;
                $meta_title = 'Đăng nhập';
                $url_canonical = $request->url();
            //-SEO
        }

    	return view('pages.checkout.login_checkout')->with('category',$product_cate,)->with('brand',$product_brand)->with('category_by_id',$category_by_id)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('banner',$banner)->with('category_post',$category_post);

    }

    public function add_customer(Request $request){
    	$data = array();
    	$data['customer_name'] = $request->customer_name;
    	// $data['customer_phone'] = $request->customer_phone;
    	$data['customer_email'] = $request->customer_email;
    	$data['customer_password'] = md5($request->customer_password);

    	$customer_id = DB::table('tbl_customer')->insertGetId($data);

    	Session::put('customer_id',$customer_id);//sinh ra phiên giao dịch
    	Session::put('customer_name',$request->customer_name);

        if(Session::get('cart')){
            return Redirect::to('/checkout');
        }
    	else return Redirect::to('/trang-chu');
    }

    public function checkout(Request $request){
    	$product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $banner = Banner::orderby('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $category_post = CatePost::orderby('cate_post_id','DESC')->get();

        $category_by_id = DB::table('tbl_customer')->get();
        $city = City::orderby('matp','ASC')->get();
        foreach($category_by_id as $key => $val){
            //SEO
                $meta_desc = $val->meta_desc;
                $meta_keywords = $val->meta_keywords;
                $meta_title = 'Thông tin gửi hàng';
                $url_canonical = $request->url();
            //-SEO
        }


    	return view('pages.checkout.show_checkout')->with('category',$product_cate,)->with('brand',$product_brand)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('city',$city)->with('banner',$banner)->with('category_post',$category_post);
    }

    public function save_checkout_customer(Request $request){
    	$data = array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_note'] = $request->shipping_note;
    	$data['shipping_address'] = $request->shipping_address;

    	$shipping_id = DB::table('tbl_shipping')->insertGetId($data);

    	Session::put('shipping_id',$shipping_id);//sinh ra phiên giao dịch

    	return Redirect::to('/payment');
    }

    public function payment(Request $request){
        $product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $category_by_id = DB::table('tbl_customer')->get();
        $banner = Banner::orderby('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        foreach($category_by_id as $key => $val){
            //SEO
                $meta_desc = $val->meta_desc;
                $meta_keywords = $val->meta_keywords;
                $meta_title = 'Thanh toán';
                $url_canonical = $request->url();
            //-SEO
        }

        return view('pages.checkout.payment')->with('category',$product_cate,)->with('brand',$product_brand)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('banner',$banner);
    }

    public function logout_checkout(){
    	Session::flush();
    	return Redirect::to('/login-checkout');
    }

    public function login_customer(Request $request){
    	$email = $request->email_account;
    	$password = md5($request->password_account);

    	$result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
    	$cart = Session::get('cart');
    	if($result && $cart){
    		Session::put('customer_id',$result->customer_id);//sinh ra phiên giao dịch	
    		return Redirect::to('/checkout');
        }elseif($result && $cart == NULL){
            Session::put('customer_id',$result->customer_id);
            return Redirect::to('/trang-chu');
        }else{
    		return Redirect::to('/login-checkout');
    	}
  
    }

    public function order_place(Request $request){
        //insert to payment
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert to order    
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('customer_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //inser to order_details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if($data['payment_method']==1){
            echo"Thanh toán bằng thẻ ATM";
        }elseif($data['payment_method'] == 2){
            Cart::destroy();
            $product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

            $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

            return view('pages.checkout.handcash')->with('category',$product_cate,)->with('brand',$product_brand);;
        }else{
            echo"Thanh toán ví điện tử";
        }
        

        return Redirect::to('/payment');
    }

    public function manage_order(){
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->select('tbl_order.*','tbl_customer.customer_name')
        ->orderby('tbl_order.order_id','desc')->get();
       
        $manage_order = view('admin.manage_order')->with('all_order',$all_order);

        return view('admin_layout')->with('admin.manage_order',$manage_order);
    }

    public function view_order($orderId){
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_order_details.*')
        ->first();
       
        $manager_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);

        return view('admin_layout')->with('admin.view_order',$manager_order_by_id   );

    }

    public function infor_order(Request $request){
        $product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $banner = Banner::orderby('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $category_post = CatePost::orderby('cate_post_id','DESC')->get();

        $category_by_id = DB::table('tbl_customer')->get();
        $city = City::orderby('matp','ASC')->get();
        foreach($category_by_id as $key => $val){
            //SEO
                $meta_desc = $val->meta_desc;
                $meta_keywords = $val->meta_keywords;
                $meta_title = 'Thông tin gửi hàng';
                $url_canonical = $request->url();
            //-SEO
        }
        $customer_id = Session::get('customer_id');
        $info_customer = Customer::where('customer_id',$customer_id)->get();

        return view('pages.checkout.infor_order')->with('category',$product_cate,)->with('brand',$product_brand)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('city',$city)->with('banner',$banner)->with('category_post',$category_post)->with('info_customer',$info_customer);
    }
}
