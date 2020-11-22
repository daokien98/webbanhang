<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Mail;
use App\Product;
use App\Banner;
use App\CatePost;
use App\Contact;
use App\Category;
use App\Customer;
use Analytics;
use Spatie\Analytics\Period;
session_start();


class HomeController extends Controller
{

    public function index(Request $request){
        //category-post
        $category_post = CatePost::orderby('cate_post_id','DESC')->get();
        //banner
        $banner = Banner::orderby('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        //SEO
            $meta_desc = "Chuyên cung cấp vật liệu xây dựng, Bán vật liệu xây dựng";
            $meta_keywords = "vật liệu xây dựng, Phương Anh,gạch ngói, xi măng, bê tông";
            $meta_title = "Công ty TNHH Vật liệu xây dựng Phương Anh";
            $url_canonical = $request->url();
        //-SEO
    	$product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();


        $all_product = DB::table('tbl_product')->orderby('product_id','desc')->orderby(DB::raw('RAND()'))->paginate(6); 

        $relate_product =  Product::orderby('product_id','DESC')->take(3)->get();
        $relate_product2 =  Product::orderby('product_id','ASC')->take(3)->get();
        $cus = Session::get('customer_id');
        $cus_info = Customer::where('customer_id',$cus)->get();
        
        return view('pages.home')->with('category',$product_cate,)->with('brand',$product_brand)->with('all_product',$all_product)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('banner',$banner)->with('category_post',$category_post)->with('relate_product',$relate_product)->with('relate_product2',$relate_product2,'cus_info',$cus_info);//1
       
        // return view('pages.home')->with(compact('product_cate','product_brand','all_product'));//2
    }

    public function search(Request $request){

    	$keyword = $request->keyword_submit;

    	$product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $category_post = CatePost::orderby('cate_post_id','DESC')->get();
        $banner = Banner::orderby('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keyword.'%')->get();
        $category_by_id = DB::table('tbl_product')->get();

        foreach($category_by_id as $key => $val){
            //SEO
                $meta_desc = $val->product_id;
                $meta_keywords = $val->product_name;
                $meta_title = $keyword;
                $url_canonical = $request->url();
            //-SEO
        }
        $relate_product =  Product::orderby('product_id','DESC')->take(3)->get();
        $relate_product2 =  Product::orderby('product_id','ASC')->take(3)->get();

        return view('pages.sanpham.search')->with('category',$product_cate,)->with('brand',$product_brand)->with('search_product',$search_product)->with('category_by_id',$category_by_id)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('keyword',$keyword)->with('banner',$banner)->with('category_post',$category_post)->with('relate_product',$relate_product)->with('relate_product2',$relate_product2);
    }

    public function send_mail(){
        //send mail
            $to_name = 'Công ty Cổ phần Xây dựng Phương Anh';
            $to_email = 'ka.daokien@gmail.com';//send to this email

            $data = array("name"=>"Mail từ tài khoản Khách hàng","body"=>"Mail về vấn đề hàng hóa"); //body of mail.blade.php

            Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
                    $message->to($to_email)->subject('Kiểm tra gửi mail');//send this mail with subject
                    $message->from($to_email,$to_name);//send from this mail
                });
            return redirect('/')->with('message','');
    }

    public function autocomplete_ajax(Request $request){
        $data = $request->all();

        if($data['query']){
            $product = Product::where('product_name','LIKE','%'.$data['query'].'%')->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:relative">'
            ;
            foreach ($product as $key => $value) {
                $output .= '<li class="li_search_ajax"><a href="#">'.$value->product_name.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function lien_he(Request $request){
        $category_post = CatePost::orderby('cate_post_id','DESC')->get();
        //banner
        $banner = Banner::orderby('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        //SEO
            $meta_desc = "Chuyên cung cấp vật liệu xây dựng, Bán vật liệu xây dựng";
            $meta_keywords = "vật liệu xây dựng, Phương Anh,gạch ngói, xi măng, bê tông";
            $meta_title = "Công ty TNHH Vật liệu xây dựng Phương Anh";
            $url_canonical = $request->url();
        //-SEO
        $product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        return view('pages.contact.lienhe')->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('banner',$banner)->with('category_post',$category_post)->with('category',$product_cate)->with('brand',$product_brand);//1

    }

    public function insert_contact(Request $request){
        $data = $request->all();
        $contact = new Contact();
        $contact->contact_name = $data['contact_name'];
        $contact->contact_email = $data['contact_email'];
        $contact->contact_subject = $data['contact_subject'];
        $contact->contact_message = $data['contact_message'];

        $contact->save();
       
    }

    public function information(Request $request){
        $category_post = CatePost::orderby('cate_post_id','DESC')->get();
        //banner
        $banner = Banner::orderby('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        //SEO
            $meta_desc = "Thông tin cá nhân";
            $meta_keywords = "Thông tin cá nhân";
            $meta_title = "Thông tin cá nhân";
            $url_canonical = $request->url();
        //-SEO
        $product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $customer_id = Session::get('customer_id');

        $info = Customer::where('customer_id',$customer_id)->get();
        return view('pages.customers.information')->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('banner',$banner)->with('category_post',$category_post)->with('category',$product_cate)->with('brand',$product_brand)->with('info',$info);
    }

    public function update_information(Request $request, $customer_id){
        $category_post = CatePost::orderby('cate_post_id','DESC')->get();
        //banner
        $banner = Banner::orderby('banner_id','DESC')->where('banner_status','1')->take(4)->get();
        //SEO
            $meta_desc = "Sửa thông tin cá nhân";
            $meta_keywords = "Thông tin cá nhân";
            $meta_title = "Sửa thông tin cá nhân";
            $url_canonical = $request->url();
        //-SEO
        $product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $customer_id = Session::get('customer_id');

        $info = Customer::where('customer_id',$customer_id)->get();
        return view('pages.customers.edit_information')->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('banner',$banner)->with('category_post',$category_post)->with('category',$product_cate)->with('brand',$product_brand)->with('info',$info);
    }

    public function save_information(Request $request, $customer_id){
        $data = $request->all();

        $information = Customer::find($customer_id);
        $information->customer_name = $data['customer_name'];
        $information->customer_email = $data['customer_email'];
        $information->customer_phone = $data['customer_phone'];
        $information->customer_address = $data['customer_address'];

        $information->save();
        return Redirect::to('information');
    }
}
