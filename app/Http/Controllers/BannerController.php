<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use App\Banner;
use Illuminate\Support\Facades\Redirect;
session_start();

class BannerController extends Controller
{
	public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login-auth')->send();
        }
    }

    public function manage_banner(){
        $this->AuthLogin();
    	$all_banner = Banner::orderby('banner_id','DESC')->get();
        $count = $all_banner->count();
    	return view('admin.banner.list_banner')->with(compact('all_banner','count'));

    }

    public function add_banner(){
        $this->AuthLogin();
    	return view('admin.banner.add_banner');
    }
    public function unactive_banner($banner_id){
    	$this->AuthLogin();
    	DB::table('tbl_banner')->where('banner_id',$banner_id)->update(['banner_status'=>0]);
    	Session::put('message','Không kích hoạt banner thành công');
        return Redirect::to('manage-banner');
    }

    public function active_banner($banner_id){
    	$this->AuthLogin();
    	DB::table('tbl_banner')->where('banner_id',$banner_id)->update(['banner_status'=>1]);
    	Session::put('message','Kích hoạt banner thành công');
        return Redirect::to('manage-banner');   
    }

    public function insert_banner(Request $request){
    	$data = $request->all();
    	$this->AuthLogin();
        

        $get_image = $request->file('banner_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/banner',$new_image);

            $banner = new Banner();
            $banner->banner_name = $data['banner_name'];
            $banner->banner_image = $new_image;
            $banner->banner_status = $data['banner_status'];
            $banner->banner_desc = $data['banner_desc'];
            $banner->save();

            Session::put('message','Thêm thành công');
            return Redirect::to('add-banner');
        }else{
        	Session::put('message','Làm ơn thêm banner');
        	return Redirect::to('add-banner');
        }

    }
    public function delete_banner($banner_id){
        $this->AuthLogin();
        Banner::where('banner_id',$banner_id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('manage-banner');
    }
}
