<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Auth;
use App\Category;
use App\CatePost;
use App\Banner;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryPost extends Controller
{
	public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login-auth')->send();
        }
    }

    public function add_category_post(){
        $this->AuthLogin();
        return view('admin.category_post.add_category');
    }

	public function save_category_post(Request $request){
        $this->AuthLogin();
        $data = $request->all();

        $category_post = new CatePost();
        $category_post->cate_post_name = $data['cate_post_name']; 
        $category_post->cate_post_slug = $data['cate_post_slug']; 
        $category_post->cate_post_status = $data['cate_post_status']; 
        $category_post->cate_post_desc = $data['cate_post_desc']; 

        $category_post->save();
        Session::put('message','Thêm danh mục bài viêt thành công');
        return Redirect()->back();
        
    }

    public function all_category_post(){
        $this->AuthLogin();

        $category_post = CatePost::orderby('cate_post_id','DESC')->get();

        return view('admin.category_post.list_category')->with(compact('category_post'));
    }

    public function danh_muc_bai_viet($cate_post_slug){

    }

    public function edit_category_post($category_post_id){
        $this->AuthLogin();

       	$category_post = CatePost::find($category_post_id);

        return view('admin.category_post.edit_category')->with(compact('category_post'));
    }

    public function update_category_post(Request $request,$category_post_id){
        $this->AuthLogin();
        $data = $request->all();

        $category_post = CatePost::find($category_post_id);

        $category_post->cate_post_name = $data['cate_post_name']; 
        $category_post->cate_post_slug = $data['cate_post_slug']; 
        $category_post->cate_post_status = $data['cate_post_status']; 
        $category_post->cate_post_desc = $data['cate_post_desc']; 
        $category_post->save();

        Session::put('message','Cập nhật thành công');
        return Redirect('all-category-post');
    }

    public function delete_category_post($category_post_id){
        $this->AuthLogin();
        $category_post = CatePost::find($category_post_id);
        $category_post->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('all-category-post');
    }
}
