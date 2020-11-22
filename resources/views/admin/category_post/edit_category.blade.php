@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật danh mục bài viết
                        </header>
                        <div class="panel-body">
                        
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-category-post/'.$category_post->cate_post_id)}}" method="post">
                                {{csrf_field()}}
                               <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text"  class="form-control" value="{{$category_post->cate_post_name}}" onkeyup="ChangeToSlug();" name="cate_post_name"  id="slug" placeholder="danh mục" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="cate_post_slug" value="{{$category_post->cate_post_slug}}" class="form-control" id="convert_slug" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Mô tả danh mục</label>
                                    <textarea style="resize: none" row="8" class="form-control"  name="cate_post_desc" id="ckeditor1" placeholder="Mô tả danh mục">{{$category_post->cate_post_desc}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Hiển thị</label>
                                    <select name="cate_post_status" class="form-control input-sm m-bot15">
                                        @if($category_post->cate_post_status == 0 ) 
                                        <option selected value="0">Hiển thị danh mục</option>
                                        <option value="1">Ẩn danh mục</option>
                                        @else
                                        <option value="0">Hiển thị danh mục</option>
                                        <option selected value="1">Ẩn danh mục</option>
                                        @endif
                                    </select>
                                </div>
                                <button type="submit" name="add_post_cate" class="btn btn-info">Cập nhật danh mục</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection