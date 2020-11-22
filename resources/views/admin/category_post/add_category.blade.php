@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm danh mục bài viết
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
                                <form role="form" action="{{URL::to('/save-category-post')}}" method="post">
                                {{csrf_field()}}
                               <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text"  class="form-control" data-validation="length" data-validation-length="min3" data-validation-error-msg="Vui lòng điền ít nhất 3 ký tự" onkeyup="ChangeToSlug();" name="cate_post_name"  id="slug" placeholder="danh mục" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="cate_post_slug" class="form-control" id="convert_slug" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Mô tả danh mục</label>
                                    <textarea style="resize: none" row="8" class="form-control" name="cate_post_desc" id="ckeditor1" placeholder="Mô tả danh mục">
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Hiển thị</label>
                                    <select name="cate_post_status" class="form-control input-sm m-bot15">
                                        <option value="0">Hiển thị danh mục</option>
                                        <option value="1">Ẩn danh mục</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_post_cate" class="btn btn-info">Thêm danh mục</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection