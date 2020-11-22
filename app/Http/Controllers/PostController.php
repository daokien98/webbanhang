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
use App\Post;
use Illuminate\Support\Facades\Redirect;
session_start();

class PostController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login-auth')->send();
        }
    }

    public function add_post(){
        $this->AuthLogin();
        $cate_post = CatePost::orderby('cate_post_id','DESC')->get();
        return view('admin.post.add_post')->with(compact('cate_post'));
    }

	public function save_post(Request $request){
        $this->AuthLogin();
        $data = $request->all();
        $post = new Post();

        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->post_status = $data['post_status'];
        $post->cate_post_id = $data['cate_post_id'];

        $get_image = $request->file('post_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post',$new_image);
            $post->post_image = $new_image;
            $post->save();
            Session::put('message','Thêm bài viết thành công');
            return Redirect()->back();
        }else{
            Session::put('message','Làm ơn thêm hình ảnh vào bài viết!!!');
            return Redirect()->back();
        }
       
        
    }

    public function all_post(){
        $this->AuthLogin();

        //kèm theo hàm cate_post trong model 
        $all_post = Post::with('cate_post')->orderby('post_id','DESC')->paginate(3);
        $post = Post::orderby('post_id','DESC')->get();
        $count = $post->count();
        return view('admin.post.list_post')->with(compact('all_post','count'));
    }

 //    public function danh_muc_bai_viet($cate_post_slug){

 //    }

    public function edit_post($post_id){
        $this->AuthLogin();

       	$post = Post::find($post_id);
        $cate_post = CatePost::orderby('cate_post_id')->get();
        return view('admin.post.edit_post')->with(compact('post','cate_post'));
    }

    public function update_post(Request $request,$post_id){
        $this->AuthLogin();
        $data = $request->all();
        $post = Post::find($post_id);

        $post->post_title = $data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->post_meta_keywords = $data['post_meta_keywords'];
        $post->post_meta_desc = $data['post_meta_desc'];
        $post->post_status = $data['post_status'];
        $post->cate_post_id = $data['cate_post_id'];

        $get_image = $request->file('post_image');
        if($get_image){
            // xóa hình ảnh cũ
            $post_image_old =  $post->post_image;
            $path = 'public/uploads/post/'.$post_image_old;
            unlink($path);

            //cập nhật ảnh mới
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/post',$new_image);
            $post->post_image = $new_image;
           
        }

        $post->save();
        Session::put('message','Cập nhật bài viết thành công');
        return Redirect::to('/all-post');
    }

    public function delete_post($post_id){
        $this->AuthLogin();

        $post = Post::find($post_id);
        $post_image = $post->post_image;
       
        if($post_image){ 
            $path = 'public/uploads/post/'.$post_image;
            unlink($path);
        }
        $post->delete();
        Session::put('message','Xóa bài viết thành công');
        return Redirect()->back();
    }

    public function danh_muc_bai_viet(Request $request,$post_slug){
        $banner = Banner::orderby('banner_id','DESC')->where('banner_status','1')->take(4)->get();

        $product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $catepost = CatePost::where('cate_post_slug',$post_slug)->take(1)->get();

        $category_post = CatePost::orderby('cate_post_id','DESC')->get();
        foreach($catepost as $key => $cate){
            //SEO
                $meta_desc = $cate->cate_post_desc;
                $meta_keywords = $cate->cate_post_slug;
                $meta_title = $cate->cate_post_name;
                $cate_id = $cate->cate_post_id;
                $url_canonical = $request->url();
            //-SEO
        }
        $post = Post::with('cate_post')->where('post_status',0)->where('cate_post_id',$cate_id)->paginate(5);

        return view('pages.baiviet.danhmucbaiviet')->with('category',$product_cate,)->with('brand',$product_brand)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('post',$post)->with('category_post',$category_post)->with('banner',$banner);
    }

    public function bai_viet(Request $request, $post_slug){
        $banner = Banner::orderby('banner_id','DESC')->where('banner_status','1')->take(4)->get();

        $product_cate = DB::table('tbl_category_product')->orderby('category_id','desc')->get();

        $product_brand = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        $catepost = CatePost::where('cate_post_slug',$post_slug)->take(1)->get();

        $category_post = CatePost::orderby('cate_post_id','DESC')->get();

        $post = Post::with('cate_post')->where('post_status',0)->where('post_slug',$post_slug)->take(1)->get();

        foreach($post as $key => $p){
            //SEO
                $meta_desc = $p->post_desc;
                $meta_keywords = $p->post_slug;
                $meta_title = $p->post_title;
                $cate_id = $p->cate_post_id;
                $url_canonical = $request->url();
                $post_id = $p->post_id; 
            //-SEO
        }
        
        $related = Post::with('cate_post')->where('post_status',0)->where('cate_post_id',$cate_id)->whereNotIn('post_slug',[$post_slug])->take(3)->get();
        //update view
        $post_view = Post::where('post_id',$post_id)->first();
        $post_view->post_views = $post_view->post_views+1;
        $post_view->save();

        return view('pages.baiviet.baiviet')->with('category',$product_cate,)->with('brand',$product_brand)->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('post',$post)->with('banner',$banner)->with('category_post',$category_post)->with('related',$related);
    }
}
