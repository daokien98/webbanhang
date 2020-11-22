<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Social; //sử dụng model Social
use Socialite; //sử dụng Socialite
use Auth;
use App\Order;
use App\Product;
use App\Customer;
use App\Login; //sử dụng model Login
use App\CustomerFacebook; //model CustomerFacebook

session_start();


class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login-auth')->send();
        }
    }

    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(){
        $this->AuthLogin();
        //thống kê số đơn hàng
        $order = Order::orderby('order_id','DESC')->get();
        $order_count = $order->count();
        //thống kê đơn hàng đã xử lý
        $order_process = Order::where('order_status','2')->get();
        $order_done = $order_process->count();
        //Thống kê doanh thu
        $order_sales_by_id = Order::where('order_status','2')->orderby('order_id','DESC')->get();
        $sum = 0;
        foreach ($order_sales_by_id as $key => $value) {
            $order_sales = $value->total_order;
            $sum += $order_sales;
        }
        $pr_qty = 0;
        $product = Product::orderby('product_id','ASC')->get();
        foreach ($product as $key => $pr) {
            $quantity = $pr->product_quantity;
            $pr_qty += $quantity;
        }

        $customer = Customer::orderby('customer_id','ASC')->get()->count();
        return view('admin.dashboard')->with(compact('order_count','order_done','sum','pr_qty','customer'));
    }

    public function dashboard(Request $request){
        $data = $request->all();
        $order = Order::orderby('order_id','DESC')->get();
        $order_count = $order->count();
        $admin_email = $data['admin_email'];
        $admin_password = md5($data['admin_password']);
        $login = Login::where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();    
        if($login){
            $login_count = $login->count();
            if($login_count>0) {
                Session::put('admin_name', $login->admin_name);
                Session::put('admin_id', $login->admin_id);
                return Redirect::to('/dashboard');
                
            }
            
        }else{
                Session::put('message','Tên tài khoản hoặc mật khẩu không đúng!');
                return Redirect::to('/admin');
        }
        // $admin_email = $request->admin_email;
        // $admin_password = md5($request->admin_password);

        // $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        // if($result) {
        //     Session::put('admin_name', $result->admin_name);
        //     Session::put('admin_id', $result->admin_id);
        //     return Redirect::to('/dashboard');
        // }
        // else{
        //     Session::put('message','Tên tài khoản hoặc mật khẩu không đúng!');
        //     return Redirect::to('/admin');
        // }
    }
    public function logout(){
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/admin');
    }

    public function add_user(){
        return view('admin.add_admin');
    }

    public function save_user(Request $request){
        $data = array();
        $data['admin_email'] = $request->admin_email;
        $data['admin_password'] = md5($request->admin_password);
        $data['admin_name'] = $request->admin_name;
        $data['admin_phone'] = $request->admin_phone;

        DB::table('tbl_admin')->insert($data);
        Session::put('message','Thêm thành công');
        return Redirect::to('admin');
    }

    public function all_user(){
        $admin_id = Session::get('admin_id');
        $all_user = DB::table('tbl_admin')->where('admin_id',$admin_id)->get();
        $manager_user = view('admin.all_admin')->with('all_user',$all_user);
        return view('admin_layout')->with('admin.all_admin',$manager_user);
    }

    public function edit_user($admin_id){
        $edit_user = DB::table('tbl_admin')->where('admin_id',$admin_id)->get();
        $manager_user = view('admin.edit_admin')->with('edit_user',$edit_user);
        return view('admin_layout')->with('admin.edit_admin',$manager_user);
    }

    public function update_user(Request $request,$admin_id){
        $data = array();
        $data['admin_email'] = $request->admin_email;
        $old_pass = md5($request->old_pass);
        $data['admin_password'] = md5($request->admin_password);
        $data['admin_name'] = $request->admin_name;
        $data['admin_phone'] = $request->admin_phone;

        $result = DB::table('tbl_admin')->where('admin_id',$admin_id)->get('admin_password');
        
        $a = substr($result, 20, -3);
        
        if ( strcasecmp( $old_pass, $a ) == 0 ){
            DB::table('tbl_admin')->where('admin_id',$admin_id)->update($data);
            Session::put('message','Đổi mật khẩu thành công');
            return Redirect::to('all-user');
        }
        else 
            Session::put('message','Sai mật khẩu ban đầu');
            return Redirect::to("edit-user"."/".$admin_id); 
        
    }

    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = CustomerFacebook::where('customer_id',$account->user)->first();
            Session::put('customer_name',$account_name->customer_name);
            Session::put('customer_id',$account_name->customer_id);
            return redirect('/trang-chu')->with('message', 'Đăng nhập thành công');
        }else{

            $hieu = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook',
                
            ]);

            $orang = CustomerFacebook::where('customer_email',$provider->getEmail())->first();

            if(!$orang){
                $orang = CustomerFacebook::create([
                    'customer_name' => $provider->getName(),
                    'customer_email' => $provider->getEmail(),
                    'customer_password' => '',
                    'meta_desc' => '',
                    'meta_keywords' => '',
                    'customer_phone' => '',
                    

                ]);
            }
            $hieu->login()->associate($orang);
            $hieu->save();

            $account_name = CustomerFacebook::where('customer_id',$account->user)->first();

            Session::put('customer_name',$account_name->customer_name);
             Session::put('customer_id',$account_name->customer_id);
            return redirect('/trang-chu')->with('message', 'Đăng nhập thành công');
        } 
    }


    public function login_google(){
        return Socialite::driver('google')->redirect();
    }
    public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user(); 
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');
        $account_name = CustomerFacebook::where('customer_id',$authUser->user)->first();
        Session::put('customer_name',$account_name->customer_name);
        Session::put('customer_id',$account_name->customer_id);
        return redirect('/trang-chu')->with('message', 'Đăng nhập Admin thành công');
      
       
    }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){

            return $authUser;
        }
      
        $hieu = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

        $orang = CustomerFacebook::where('customer_email',$users->email)->first();

            if(!$orang){
                $orang = CustomerFacebook::create([
                    'customer_name' => $users->name,
                    'customer_email' => $users->email,

                    'customer_password' => '',
                    'meta_desc' => '',
                    'meta_keywords' => '',
                    'customer_phone' => '',
                ]);
            }
        $hieu->login()->associate($orang);
        $hieu->save();

        $account_name = CustomerFacebook::where('customer_id',$authUser->user)->first();
        Session::put('customer_name',$account_name->customer_name);
        Session::put('customer_id',$account_name->customer_id);
        return redirect('/trang-chu')->with('message', 'Đăng nhập Admin thành công');


    }

    
}
