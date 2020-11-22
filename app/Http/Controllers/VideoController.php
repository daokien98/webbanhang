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
use App\Video;

class VideoController extends Controller
{
    public function AuthLogin(){
        $admin_id = Auth::id();
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('login-auth')->send();
        }
    }

    public function video(){
    	return view('admin.video.list_video');
    }
    
	public function insert_video(Request $request){
	    	$data = $request->all();
	    	$video = new Video();

	    	$video->video_title = $data['video_title'];
	    	$video->video_slug = $data['video_slug'];
	    	$video->video_link = $data['video_link'];
	    	$video->video_desc = $data['video_desc'];

	    	$video->save();
	    	
	}
    public function select_video(Request $request){

    	$video = Video::orderby('video_id','DESC')->get();
    	$video_count = $video->count();
    	$output = '<form>
        		'.csrf_field().'
        						<table class="table table-striped b-t b-light">
							        <thead>
							          <tr>
							            <th>STT</th>
							            <th>Tên video</th>
							            <th>Đường dẫn</th>
							            <th>Mô tả video</th>
							            <th>Xem trước</th>
							            <th style="width:30px;">Quản lý</th>
							          </tr>
							        </thead>
							        <tbody>';
        if($video_count>0){
        	$i=0;
        	foreach ($video as $key => $vid) {
        		$i++;
        		$output .='
        		
			        <tr>
			            <td>'.$i.'</td>
			            <td>'.$vid->video_title.'</td>
			            <td>'.$vid->video_link.'</td>
			            <td>'.$vid->video_desc.'</td>
			            <td><button type="button" data-toggle="modal" data-target="#video_modal" class="btn btn-sm btn-success">Xem video</button></td>
			            <td><button class="btn btn-sm btn-danger">Xóa video</button></td>
			        </tr>
                ';
        	}
        }else{
        	$output .='<tr class="info">
                                        <td colspan="4">Chưa có video nào</td>
                                      </tr>';
        }
        $output .='</tbody>
        		</table>
        	</form>';
        echo $output;
    }


}
