<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Auth;
use App\Category;
use App\Banner;
use App\CatePost;
use App\Product;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{

    // Function admin page
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login-auth')->send();
        }
    }
    public function product_tabs(Request $request){
        $data = $request->all();
        $output = '';
        $product = Product::where('category_id',$data['cate_id'])->orderby('product_id','ASC')->get();
        $product_count = $product->count();

        if($product_count>0){
            $output .= '<div class="tab-content">
                            <div class="tab-pane fade active in" id="tshirt" >
                                ';
                                foreach ($product as $key => $pro) {
                                     $output .= '<div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                <img width="90px" height = "120px" src="'.url('public/uploads/product/'.$pro->product_image).'" alt="'.$pro->product_name.'" />
                                                <h2>'.number_format($pro->product_price).' VNĐ</h2>
                                                <p>'.$pro->product_name.'</p>
                                                <a href="'.url('/chi-tiet-san-pham/'.$pro->product_id).'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Xem chi tiết</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>';
                                }
           

            $output .='     </div>  
                        </div>';
        }else{
            $output .='<div class="tab-content">
                            <div class="tab-pane fade active in" id="tshirt" >
                                <div class="col-sm-12">
                                    <p>Chưa có sản phẩm</p>
                                </div>
                            </div>
                        </div>';
        }
        echo $output;
    }
    public function add_category_product(){
        $this->AuthLogin();
        $category = Category::where('category_parent',0)->orderby('category_id','DESC')->get();
        return view('admin.category_product.add_category_product')->with(compact('category'));
    }

    public function all_category_product(){
        $this->AuthLogin();
        $category_product = Category::where('category_parent',0)->orderby('category_id','DESC')->get();
        $all_category_product = DB::table('tbl_category_product')->orderby('category_parent','DESC')->get();
        $count = $category_product->count();
        $manager_category_product = view('admin.category_product.all_category_product')->with('all_category_product',$all_category_product)->with('category_product',$category_product)->with('count',$count);
        return view('admin_layout')->with('admin.category_product.all_category_product',$manager_category_product);
    }

    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_desc'] = $request->category_desc;
        $data['category_producer'] = $request->category_product_producer;
        $data['slug_category_product'] = $request->slug_category_product;
        $data['category_parent'] = $request->category_parent;
        $data['meta_keywords'] = $request->category_product_keywords;

        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm thành công');
        return Redirect::to('all-category-product');
        
    }

    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $category = Category::orderby('category_id','DESC')->get();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.category_product.edit_category_product')->with('edit_category_product',$edit_category_product)->with('category',$category);
        return view('admin_layout')->with('admin.category_product.edit_category_product',$manager_category_product);
    }

    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_producer'] = $request->category_product_producer;
        $data['category_desc'] = $request->category_desc;
        $data['category_parent'] = $request->category_parent;
        $data['slug_category_product'] = $request->slug_category_product;
        $data['meta_keywords'] = $request->category_product_keywords;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật thành công');
        return Redirect::to('all-category-product');
    }

    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('all-category-product');
    }
    // End function admin pages

    public function show_category_home(Request $request,$slug_category_product){
        $category_post = CatePost::orderby('cate_post_id','DESC')->get();

        $product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $banner = Banner::orderby('banner_id','DESC')->where('banner_status','1')->take(4)->get();
       
        // $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_category_product.slug_category_product',$slug_category_product)->get();

        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.slug_category_product',$slug_category_product)->limit(1)->get();
        foreach($category_name as $key => $val){
                //seo 
                $meta_desc = $val->category_desc; 
                $meta_keywords = $val->meta_keywords;
                $meta_title = $val->category_name;
                $url_canonical = $request->url();
                //--seo
                }
        $category_by_slug = Category::where('slug_category_product',$slug_category_product)->get();
        //Lọc
        $min_price = Product::min('product_price');
        $max_price = Product::max('product_price');
        $min_price_range = $min_price - 10000;
        $max_price_range = $max_price + 100000;

        foreach ($category_by_slug as $key => $cate) {
            $category_id = $cate->category_id; 
        }
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by=='tang_dan'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_price','ASC')->paginate(6)->appends(request()->query());//thêm y/c đường dẫn nếu sang trang
            }elseif($sort_by=='giam_dan'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_price','DESC')->paginate(6)->appends(request()->query());
            }elseif($sort_by=='kytu_az'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_name','ASC')->paginate(6)->appends(request()->query());
            }elseif($sort_by=='kytu_za'){
                $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_name','DESC')->paginate(6)->appends(request()->query());
            }
        }elseif (isset($_GET['start_price']) && $_GET['end_price']) {
                $min_price = $_GET['start_price'];
                $max_price = $_GET['end_price'];

                $category_by_id = Product::with('category')->where('category_id',$category_id)->whereBetween('product_price',[$min_price,$max_price])->orderby('product_id','ASC')->paginate(6);
        }else{
            $category_by_id = Product::with('category')->where('category_id',$category_id)->orderBy('product_id','DESC')->paginate(6);
        }
        //        
        // $category_by_id = DB::table('tbl_category_product')->join('tbl_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_category_product.slug_category_product',$slug_category_product)->paginate(6);
        return view('pages.category.show_category')->with('category',$product_cate)->with('brand',$product_brand)->with('category_by_id',$category_by_id)->with('category_name',$category_name)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('banner',$banner)->with('category_post',$category_post)->with('min_price',$min_price)->with('max_price',$max_price)->with('min_price_range',$min_price_range)->with('max_price_range',$max_price_range);
    }


}
