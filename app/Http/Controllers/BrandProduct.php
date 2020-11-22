<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Brand;
use Auth;
use App\Banner;
use App\CatePost;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProduct extends Controller
{

     public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login-auth')->send();
        }
    }

    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.brand.add_brand_product');
    }

    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product = Brand::orderBy('brand_id','DESC')->get();
        $count = $all_brand_product->count();
        //$all_brand_product = Brand::all();
        // $all_brand_product = DB::table('tbl_brand')->get();
        $manager_brand_product = view('admin.brand.all_brand_product')->with('all_brand_product',$all_brand_product)->with('count',$count);
        return view('admin_layout')->with('admin.brand.all_brand_product',$manager_brand_product);
    }

    public function save_brand_product(Request $request){
        $this->AuthLogin();
        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_desc'] = $request->brand_product_desc;
        // $data['brand_status'] = $request->brand_product_status;

        // DB::table('tbl_brand')->insert($data);

        $data = $request->all();
        $brand = new Brand();
        $brand->brand_name = $data['brand_product_name']; 
        $brand->brand_desc = $data['brand_product_desc']; 
        $brand->brand_status = $data['brand_product_status']; 
        $brand->save();
        Session::put('message','Thêm thành công');
        return Redirect::to('add-brand-product');
        
    }

    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();
        // $edit_brand_product = DB::table('tbl_brand')->where('brand_id',$brand_product_id)->get();
        $edit_brand_product = Brand::where('brand_id',$brand_product_id)->get();
        $manager_brand_product = view('admin.brand.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.brand.edit_brand_product',$manager_brand_product);
    }

    public function update_brand_product(Request $request,$brand_product_id){
        $this->AuthLogin();
        // $data = array();
        // $data['brand_name'] = $request->brand_product_name;
        // $data['brand_desc'] = $request->brand_product_desc;
        // $data['brand_status'] = $request->brand_product_status;
        // DB::table('tbl_brand')->where('brand_id',$brand_product_id)->update($data);
        $data = $request->all();
        $brand = Brand::find($brand_product_id);
        $brand->brand_name = $data['brand_product_name']; 
        $brand->brand_desc = $data['brand_product_desc']; 
        $brand->brand_status = $data['brand_product_status']; 
        $brand->save();
        Session::put('message','Cập nhật thành công');
        return Redirect::to('all-brand-product');
    }

    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('all-brand-product');
    }
    // end function admin pages

    public function show_brand_home(Request $request, $brand_id){
        $category_post = CatePost::orderby('cate_post_id','DESC')->get();

        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.brand_id',$brand_id)->get();
        foreach($category_by_id as $key => $val){
            //SEO
                $meta_desc = $val->category_desc;
                $meta_keywords = $val->meta_keywords;
                $meta_title = $val->category_name;
                $url_canonical = $request->url();
            //-SEO
        }

        $product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $banner = Banner::orderby('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $brand_by_id = DB::table('tbl_product')->join('tbl_brand','tbl_product.brand_id','=','tbl_brand.brand_id')->where('tbl_product.brand_id',$brand_id)->get();

        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id',$brand_id)->limit(1)->get();

        return view('pages.brand.show_brand')->with('category',$product_cate,)->with('brand',$product_brand)->with('brand_by_id',$brand_by_id)->with('brand_name',$brand_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('banner',$banner)->with('category_post',$category_post);
    }
}
