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
use App\Category;
use App\Brand;
use App\Rating;
use App\DepotDetails;
use File;
use PDF;
use Illuminate\Support\Facades\Redirect;
session_start();


class ProductController extends Controller
{

    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login-auth')->send();
        }
    }

    public function add_product(){
        $this->AuthLogin();
        $product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        return view('admin.product.add_product')->with('product_cate',$product_cate)->with('product_brand',$product_brand);
    }

    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderby('tbl_product.product_id','desc')->get();
        $product_by_id = Product::orderby('product_id','ASC')->get();
        $count = $product_by_id->count();
        $manager_product = view('admin.product.all_product')->with('all_product',$all_product)->with('count',$count);
        return view('admin_layout')->with('admin.product.all_product',$manager_product);
    }

    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        //format tiền
        $product_price = filter_var($request->product_price, FILTER_SANITIZE_NUMBER_INT);
        $product_cost = filter_var($request->product_cost, FILTER_SANITIZE_NUMBER_INT);

        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        $data['product_content'] = $request->product_content;
        $data['product_note'] = $request->product_note;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_cost'] = $request->product_cost;
        $data['product_sold'] = '0';
        $data['product_tags'] =  $request->product_tags;

        $get_image = $request->file('product_image');
        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); 
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            File::copy($path.$new_image,$path_gallery.$new_image);
            $data['product_image'] = $new_image;         
        }
        $pro_id = DB::table('tbl_product')->insertGetId($data);
        
        $gallery = new Gallery();
        $gallery->gallery_name = $new_image;
        $gallery->gallery_image = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();
        Session::put('message','Thêm thành công');
        return Redirect::to('add-product');
        
    }

    public function edit_product($product_id){
        $this->AuthLogin();
        $product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.product.edit_product')->with('edit_product',$edit_product)->with('product_cate',$product_cate)->with('product_brand',$product_brand);
        return view('admin_layout')->with('admin.product.edit_product',$manager_product);
    }

    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_price'] = $request->product_price;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_status'] = $request->product_status;
        $data['product_content'] = $request->product_content;
        $data['product_note'] = $request->product_note;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_cost'] = $request->product_cost;
        $data['product_sold'] = '0';
        $data['product_tags'] =  $request->product_tags;

        $get_image = $request->file('product_image');
        if($get_image){
            $new_image = rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật thành công');
            return Redirect::to('all-product');
        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật thành công');
        return Redirect::to('all-product');
    }

    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('all-product');
    }
    //end admin fuction

    public function details_product(Request $request,$product_id){
        $category_post = CatePost::orderby('cate_post_id','DESC')->get();

        $category_by_id = DB::table('tbl_product')->join('tbl_category_product','tbl_product.category_id','=','tbl_category_product.category_id')->where('tbl_product.product_id',$product_id)->get();
            
        
        $product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $banner = Banner::orderby('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();
       
       foreach($details_product as $key => $value){
            $category_id = $value->category_id;
            $product_id = $value->product_id;
            $pro_cate = $value->category_name;
            $cate_slug = $value->slug_category_product;
            
            //SEO
                $meta_desc = $value->product_name;
                $meta_keywords = $value->product_name;
                $meta_title = $value->product_name;
                $url_canonical = $request->url();
            //-SEO
       }
    //Rating
    $rating = Rating::where('product_id',$product_id)->avg('rating');
    $rating = round($rating);//làm tròn sao


    //Gallery
    $gallery_product  = Gallery::where('product_id',$product_id)->get();
    //san pham tuong tu 
     $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();

    $relate_product1 =  Product::orderby('product_id','DESC')->take(3)->get();
    $relate_product2 =  Product::orderby('product_id','ASC')->take(3)->get();
    // $relate_product2 =  Product::where('category_id',6)->take(3)->get();
    //update view
    $product_view = Product::where('product_id',$product_id)->first();
    $product_view->product_views = $product_view->product_views + 1;
    $product_view->save();

    return view('pages.sanpham.show_details')->with('category',$product_cate)->with('brand',$product_brand)->with('product_details',$details_product)->with('relate',$related_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('banner',$banner)->with('category_post',$category_post)->with('gallery_product',$gallery_product)->with('relate_product2',$relate_product2)->with('relate_product1',$relate_product1)->with('pro_cate',$pro_cate)->with('cate_slug',$cate_slug)->with('rating',$rating);
    }


    //DEPOT
    public function view_depot(Request $request){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')->orderby('tbl_product.product_id','desc')->get();
        $product_by_id = Product::orderby('product_id','ASC')->get();
        $count = $product_by_id->count();

        $manager_product = view('admin.depot.view_depot')->with('all_product',$all_product)->with('count',$count);
        return view('admin_layout')->with('admin.depot.view_depot',$manager_product);
    }

    public function import_depot(Request $request, $product_id){
        $this->AuthLogin();
        $product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $product = DB::table('tbl_product')->where('product_id',$product_id)->get();

        return view('admin.depot.add_depot')->with(compact('product','product_cate','product_brand'));
    }

    public function update_depot(Request $request, $product_id){
        $this->AuthLogin();
        // $data = array();
        // $data['product_sold'] = '0';

        // DB::table('tbl_product')->where('product_id',$product_id)->update($data);

        $data = $request->all();
        $product = Product::find($product_id);
        $product->product_depot = $data['product_depot']; 
        $product->product_quantity += $product->product_depot;

        $depot = new DepotDetails;
        $depot->product_id = $product_id;
        $depot->depot_quantity = $data['product_depot']; 
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $product->product_depot_time = now();
        $depot->created_at = now();

        $product->save();
        $depot->save();
        Session::put('message','Cập nhật thành công');
        return Redirect::to('view-depot');
    }

    public function print_depot($product_id){
        $this->AuthLogin();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($product_id));
        return $pdf->stream();
    }

    public function print_order_convert($product_id){
        $this->AuthLogin();
        // $product = Product::with('brand','category')->where('product_id',$product_id)->get();
        $product = Product::where('product_id',$product_id)->first();  
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
        <h4 style="margin-top:-70px; margin-left:510px">PHIẾU NHẬP KHO</h4>
        <label style="margin-left:550px">------&#9733------</label>
        <label style="float:right; margin-right:80px">Số ....</label>

        <form style="font-size : 13px">
            <br><b style="width:100px">Địa chỉ: 415 Đà Nẵng, Đông Hải, Hải An, Hải Phòng</b><br> 
            <b style="margin-left:60px">Điện thoại: (0225)2858397</b><br> 
        </form>
        <br>
        <form style="float:left">
            <span>Tên nhà cung cấp:......................................................................................................<span>
            <span>Số Điện Thoại:............................................................................................................</span>
            <span>Địa chỉ:.......................................................................................................................</span>
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
                <th >Tên sản phẩm</th>
                <th >Hình ảnh</th>
                <th >Đơn giá</th>
                <th >Mô tả sản phẩm</th>
                <th >Số lượng còn</th>
                <th >Số lượng nhập</th>
              </tr>
            </thead>
            <tbody>';
        $output .= '
                <tr>
                    <td >'.$product->product_name.'</td>
                    <td ><img class="img-thumbnail" width="150" src="'.url('public/uploads/product/'.$product->product_image).'"></td>
                    <td >'.$product->product_price.'</td>
                    <td >'.$product->product_content.'</td>
                    <td >'.$product->product_quantity.'</td>
                    <td >'.$product->product_depot.'</td>
                    
                </tr>';

        $output .='
            </tbody>
          </table>
        </div>

        <br><br><br>
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
                <th >Giám đốc</th>
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
    public function tag(Request $request, $product_tag){
        $this->AuthLogin();
        $category_post = CatePost::orderby('cate_post_id','DESC')->get();
                   
        $product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
        $banner = Banner::orderby('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        
        $tag = str_replace("-"," ",$product_tag);
        $pro_tag = Product::where('product_name','LIKE','%'.$tag.'%')->orwhere('product_tags','LIKE','%'.$tag.'%')->get();
       

        $meta_desc = $product_tag;
        $meta_keywords = $product_tag;
        $meta_title = 'Kết quả tìm kiếm';
        $url_canonical = $request->url();




        return view('pages.sanpham.tag')->with('category',$product_cate)->with('brand',$product_brand)->with('category_post',$category_post)->with('banner',$banner)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('product_tag',$product_tag)->with('pro_tag',$pro_tag);
    }

    public function quickview(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);

        $gallery = Gallery::where('product_id',$product_id)->get();
        $output['product_gallery'] = '';
        foreach ($gallery as $key => $gal) {
            $output['product_gallery'] .= '<p><img width="100%" src="public/uploads/gallery/'.$gal->gallery_image.'"></p>'; 
        }
        $output['product_name'] = $product->product_name;
        $output['product_id'] = $product->product_id;
        $output['product_desc'] = $product->product_desc;
        $output['product_content'] = $product->product_content;
        $output['product_price'] = number_format($product->product_price,0,',','.').'VNĐ';
        $output['product_image'] = '<p><img width="100%" src="public/uploads/product/'.$product->product_image.'"></p>';

        $output['product_quickview_value'] = '
        <input type="hidden" value="'.$product->product_id.'" class="cart_product_id_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_image.'" class="cart_product_name_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_name.'" class="cart_product_image_'.$product->product_id.'">
        <input type="hidden" value="'.$product->product_price.'" class="cart_product_price_'.$product->product_id.'">
        <input type="hidden" value="1" class="cart_product_qty_'.$product->product_id.'">';
        echo json_encode($output);
    }

    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id',$product_id)->where('comment_parent_comment','=',0)->where('comment_status',0)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->orderby('comment_id','DESC')->get();
        $output = '';
        foreach ($comment as $key => $comm) {
            $output .='
            <div class="row style_comment" style="height: 90px;">
                <div class="col-md-2">                
                    <img width="75%" style="margin-top:5px" src="'.url('/public/frontend/images/avatar.jpg').'" class="img img-responsive img-thumbnail">
                </div>
                <div class="col-md-10">
                    <p style="color: blue">'.$comm->comment_name.'</p>
                    <p style="color: green">'.$comm->comment_date.'</p>
                    <p>'.$comm->comment.'</p>
                </div>
            </div>
            <p></p>
            ';
        foreach ($comment_rep as $key => $comm_reply) {
            if($comm_reply->comment_parent_comment==$comm->comment_id){
                $output.='
            <div class="row style_comment" style="margin: 5px 40px; background: bisque; height:50px">
                <div class="col-md-2">                
                    <img width="50%" style="margin-top:3px" src="'.url('/public/frontend/images/admin.png').'" class="img img-responsive img-thumbnail">
                </div>
                <div class="col-md-10">
                    <p style="color: green">Admin</p>
                    <p style="color: black">'.$comm_reply->comment.'</p>
                </div>
            </div>
            <p></p>';
            }
        }
    }
    echo $output;
    }

    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;

        $comment = new Comment();
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_product_id = $product_id;
        $comment->comment_status = 1;
        $comment->comment_parent_comment = 0;
        $comment->save();
    }

    public function list_comment(Request $request){
        $this->AuthLogin();
        $comment = Comment::with('product')->where('comment_parent_comment','=',0)->orderby('comment_status','DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->orderby('comment_id','DESC')->get();
        return view('admin.comment.list_comment')->with(compact('comment','comment_rep'));
    }

    public function allow_comment(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }

    public function reply_comment(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 0;
        $comment->comment_name = 'Phương Anh Xây Dựng';
        $comment->save();
    }
    public function delete_admin_comment(Request $request, $comment_id){
        $this->AuthLogin();
        $comment = Comment::where('comment_id',$comment_id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect()->back();
    }

    public function insert_rating(Request $request){
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }
}
