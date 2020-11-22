<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
use App\Banner;
use App\CatePost;
use App\Gallery;
use App\Product;
use App\Comment;
use App\Post;
use App\Customer;
use App\Category;
use App\Brand;
use App\Rating;
use App\Order;
use App\Statistic;
use App\Visitors;
use Carbon\Carbon;
use File;
use PDF;
use Illuminate\Support\Facades\Redirect;


class ReportController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login-auth')->send();
        }
    }

    public function overall_report(Request $request){
        $this->AuthLogin();
        //lấy địa chỉ ip
        $user_ip_address = $request->ip();

        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $oneyear = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        //đếm theo ngày, tháng, năm 
        $visitor_last_month = Visitors::where('date_visitor',[$early_last_month,$end_last_month])->get();
        $visitor_last_month_count = $visitor_last_month->count();
        $visitor_this_month = Visitors::where('date_visitor',$early_this_month)->get();
        $visitor_this_month_count = $visitor_this_month->count();
        $visitor_of_year = Visitors::where('date_visitor',[$oneyear,$now])->get();
        $visitor_of_year_count = $visitor_of_year->count();
        $visitors = Visitors::all();
        $all_visitors_count = $visitors->count();

        // đếm khách truy cập dựa theo ip
        $visitors_current = Visitors::where('ip_address',$user_ip_address)->get();
        $visitors_count = $visitors_current->count();
        // kiểm tra trùng
        if($visitors_count<1){
            $visitor = new Visitors();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }

        //total 
        $product = Product::all()->count();
        $customer = Customer::all()->count();
        $order = Order::all()->count();
        $post = Post::all()->count();
        //views
        $post_views = Post::orderby('post_views','DESC')->take(20)->get();
        $product_views = Product::orderby('product_views','DESC')->take(20)->get();

        return view('admin.report.overall_report')->with(compact('visitors_count','all_visitors_count','visitor_last_month_count','visitor_of_year_count','visitor_this_month_count','product','customer','order','post','post_views','product_views'));
    }

    public function order_report(){
        $this->AuthLogin();
        $order = Order::orderby('order_status','ASC')->get();

        // Tình trạng đơn hàng
        $order_new = Order::where('order_status',1)->get()->count();
        $order_accept = Order::where('order_status',2)->get()->count();
        $order_cancel = Order::where('order_status',3)->get()->count();
        $order_new_percent = $order_new/($order_new+$order_accept+$order_cancel)/100;
        $order_accept_percent = $order_accept/($order_new+$order_accept+$order_cancel)/100;
        $order_cancel_percent = $order_cancel/($order_new+$order_accept+$order_cancel)/100;

        //Số lượng theo tháng
        $order_accept_september = Order::where('order_status',2)->whereMonth('created_at','=','09')->count();
        $order_cancel_september = Order::where('order_status',3)->whereMonth('created_at','=','09')->count();
        $order_accept_october = Order::where('order_status',2)->whereMonth('created_at','=','10')->count();
        $order_cancel_october = Order::where('order_status',3)->whereMonth('created_at','=','10')->count();
        $order_accept_november = Order::where('order_status',2)->whereMonth('created_at','=','11')->count();
        $order_cancel_november = Order::where('order_status',3)->whereMonth('created_at','=','11')->count();

        return view('admin.report.order_report')->with(compact('order','order_new','order_accept','order_cancel','order_new_percent','order_accept_percent','order_cancel_percent','order_accept_september','order_cancel_september','order_accept_october','order_cancel_october','order_accept_november','order_cancel_november'));
    }
    public function product_report(){
    	$this->AuthLogin();
    	$product = Product::orderby('category_id','ASC')->get();
        
        // tính tổng sản phẩm mỗi danh mục
        $category = DB::table("tbl_product")->select("tbl_product.category_id","tbl_category_product.category_name", DB::raw("COUNT(tbl_product.product_sold) as count"))->join("tbl_category_product","tbl_category_product.category_id","=","tbl_product.category_id")->groupBy("tbl_product.category_id","tbl_category_product.category_name")->get();
        $da = 0;
        $ximang =0;
        $thep = 0;
        $gach = 0;
        $betong = 0;
        $ton = 0;
        foreach ($product as $key => $val) {
            if($val->category_id==16){
                $da+=$val->product_sold;
            }
            elseif($val->category_id==2){
                $thep+=$val->product_sold;
            }
            elseif($val->category_id==3){
                $ximang+=$val->product_sold;
            }
            elseif($val->category_id==4){
                $gach+=$val->product_sold;
            }
            elseif($val->category_id==5){
                $betong+=$val->product_sold;
            }
            elseif($val->category_id==6){
                $ton+=$val->product_sold;
            }
        }
        
    	return view('admin.report.product_report')->with(compact('product','category','da','thep','ximang','gach','betong','ton'));
    }

    public function income_report(){
        $this->AuthLogin();
        return view('admin.report.income_report');
    }

    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Statistic::whereBetween('order_date',[$from_date,$to_date])->orderby('order_date','ASC')->get();

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function days_order(){
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString(); 

        $get = Statistic::whereBetween('order_date',[$sub30days,$now])->orderby('order_date','ASC')->get();

         foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function filter_for(Request $request){
        $data = $request->all();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $dauT9 = Carbon::now('Asia/Ho_Chi_Minh')->subMonth(2)->startOfMonth()->toDateString();
        $cuoiT9 = Carbon::now('Asia/Ho_Chi_Minh')->subMonth(2)->endOfMonth()->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString(); 
        if($data['filter_value']=='7ngay'){
            $get = Statistic::whereBetween('order_date',[$sub7days,$now])->orderby('order_date','ASC')->get();
        }elseif($data['filter_value']=='thangtruoc'){
            $get = Statistic::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderby('order_date','ASC')->get();
        }elseif($data['filter_value']=='thangnay'){
            $get = Statistic::whereBetween('order_date',[$dauthangnay,$now])->orderby('order_date','ASC')->get();
        }elseif($data['filter_value']=='thang9'){
            $get = Statistic::whereBetween('order_date',[$dauT9,$cuoiT9])->orderby('order_date','ASC')->get();
        }else{
            $get = Statistic::whereBetween('order_date',[$sub365days,$now])->orderby('order_date','ASC')->get();
        }
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
}
