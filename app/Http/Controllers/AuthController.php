<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\Roles;
use Auth;
class AuthController extends Controller
{
    public function register_auth(){
    	return view('admin.custom_auth.register');
    }

    public function register(Request $request){
    	$this->validation($request);
    	$data = $request->all();

    	$admin = new Admin();
    	$admin->admin_name = $data['admin_name'];
    	$admin->admin_email = $data['admin_email'];
    	$admin->admin_phone = $data['admin_phone'];
    	$admin->admin_password = md5($data['admin_password']);
    	$admin->save();

    	return redirect('/register-auth')->with('message','Đăng ký thành công! Vui lòng chờ chấp thuận');
    }
    public function login_auth(){

    	return view('admin.custom_auth.login_auth');
    }
    public function login(Request $request){
   //  	return $this->validate($request,[
			// 'admin_email' => 'required|max:255',
			// 'admin_password' => 'required|max:20'
   //  	]);
    	// $data = $request->all();
    	if(Auth::attempt(['admin_email'=>$request->admin_email, 'admin_password'=>$request->admin_password])){
    		return redirect('/dashboard');
    	}else{
    		return redirect('login-auth')->with('message','Lỗi đăng nhập!');
    	}
    }
    public function validation($request){ // hàm kiểm tra các trường thêm vào 
    	return $this->validate($request,[
    		'admin_name' => 'required|max:255',
			'admin_email' => 'required|max:255',
			'admin_phone' => 'required|max:12',
			'admin_password' => 'required|max:20',
    	]);
    }

    public function logout_auth(){
        Auth::logout();
        return redirect('/login-auth')->with('message','Đăng xuất thành công!');
    }
}
