<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Admin;
use App\Roles;

class UserController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login-auth')->send();
        }
    }

    public function users(){
        $this->AuthLogin();
    	$admin = Admin::with('roles')->orderBy('admin_id','DESC')->get(); //5 dữ liệu/trang
    	return view('admin.user.all_users')->with(compact('admin'));
    } 

    public function assign_roles(Request $request){
        $this->AuthLogin();
    	if(Auth::id()==$request->admin_id){
    		return redirect()->back()->with('message','Không thể phân quyền tài khoản này!');
    	}
    	$data = $request->all();
    	$user = Admin::where('admin_email',$data['admin_email'])->first();
    	$user->roles()->detach();
    	if($request->administrator_role){
    		$user->roles()->attach(Roles::where('name','administrator')->first());
    	}
    	if($request->manager_role){
    		$user->roles()->attach(Roles::where('name','manager')->first());
    	}
    	if($request->editor_role){
    		$user->roles()->attach(Roles::where('name','editor')->first());
    	}
    	if($request->accountant_role){
    		$user->roles()->attach(Roles::where('name','accountant')->first());
    	}
    	if($request->shipper_role){
    		$user->roles()->attach(Roles::where('name','shipper')->first());
    	}

        return redirect()->back()->with('message','Phân quyền tài khoản thành công!');	
    }

    public function add_users(){
        $this->AuthLogin();
    	return view('admin.user.add_users');
    }

    public function store_users(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        
        $admin->roles()->attach(Roles::where('name','user')->first());
        $admin->save();
        Session::put('message','Thêm users thành công');
        return Redirect::to('users');
    }

    public function delete_user_roles($admin_id){
        $this->AuthLogin();
    	if(Auth::id()==$admin_id){
    		return redirect()->back()->with('message','Không thể xóa tài khoản này!');
    	}
    	$admin = Admin::find($admin_id);
    	if($admin){
    		$admin->roles()->detach();
    		$admin->delete();
    	}
    	return redirect()->back()->with('message','Xóa tài khoản thành công!');
    }
}
