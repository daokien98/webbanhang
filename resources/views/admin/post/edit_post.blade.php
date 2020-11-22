@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Chỉnh sửa bài viết
                        </header>
                        <div class="panel-body">
                        <?php
	                    $message = Session::get('message');
	                    if($message){
		                echo '<span class="text-alert">'.$message.'</span>';
		                Session::put('message',NULL);
	                    }
	                    ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-post/'.$post->post_id)}}" method="post" enctype='multipart/form-data'>
                                {{csrf_field()}}
                               <div class="form-group">
                                    <label for="exampleInputEmail1">Tên bài viết</label>
                                    <input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Vui lòng điền ít nhất 10 ký tự" class="form-control" onkeyup="ChangeToSlug();" name="post_title" id="slug" value="{{$post->post_title}}" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="post_slug" class="form-control" id="convert_slug" value="{{$post->post_slug}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Tóm tắt bài viết</label>
                                    <textarea style="resize: none" row="8" class="form-control" name="post_desc" id="ckeditor1">{{$post->post_desc}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Nội dung bài viết</label>
                                    <textarea style="resize: none" row="8" class="form-control" name="post_content" id="ckeditor" >{{$post->post_content}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Từ khóa meta</label>
                                    <textarea style="resize: none" row="8" class="form-control" name="post_meta_keywords" id="ckeditor1">{{$post->post_meta_keywords}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Nội dung meta</label>
                                    <textarea style="resize: none" row="8" class="form-control" name="post_meta_desc" id="ckeditor1">{{$post->post_meta_desc}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Hình ảnh bài viết</label>
                                    <input type="file" class="form-control" name="post_image" id="exampleInputPassword1">
                                    <img src="{{asset('public/uploads/post/'.$post->post_image)}}" width="120">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Danh mục bài viết</label>
                                    <select name="cate_post_id" class="form-control input-sm m-bot15">
                                        @foreach($cate_post as $key => $cate)
                                        <option {{$post->cate_post_id==$cate->cate_post_id ? 'selected' : ''}} value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Hiển thị</label>
                                    <select name="post_status" class="form-control input-sm m-bot15">
                                        @if($post->post_status==0)
                                        <option selected value="0">Hiển thị </option>
                                        <option value="1">Ẩn</option>
                                        @else
                                        <option value="0">Hiển thị </option>
                                        <option selected value="1">Ẩn</option>
                                        @endif
                                    </select>
                                </div>
                                <button type="submit" name="update_post" class="btn btn-info">Cập nhật bài viết</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection