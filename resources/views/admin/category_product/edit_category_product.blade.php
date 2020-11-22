@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật thương hiệu sản phẩm
                        </header>
                        <div class="panel-body">
                        @foreach($edit_category_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" value="{{$edit_value->category_name}}" onkeyup="ChangeToSlug();" name="category_name" class="form-control" id="slug" >
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" value="{{$edit_value->slug_category_product}}" name="slug_category_product" class="form-control" id="convert_slug" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Mô tả danh mục</label>
                                    <textarea style="resize: none" row="8" class="form-control" name="category_desc" id="ckeditor1" placeholder="Mô tả danh mục">{{$edit_value->category_desc}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Từ khóa danh mục</label>
                                    <textarea style="resize: none" row="8" class="form-control" name="category_product_keywords" id="ckeditor2" placeholder="Mô tả danh mục">{{$edit_value->meta_keywords}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Thuộc danh mục</label>
                                    <select name="category_parent" class="form-control input-sm m-bot15">
                                        <option value = "0">------Danh mục cha------</option>
                                        <!-- @foreach($category as $key => $val)
                                            @foreach($category as $key => $val2)
                                                @if($val2->category_parent == $val->category_id)
                                                    <option {{$val2->category_id == $edit_value->category_id ? 'selected' : ''}} value="{{$val2->category_id}}">---{{$val2->category_name}}</option>
                                                @endif
                                            @endforeach
                                        @endforeach -->
                                        @foreach($category as $key => $val)
                                        <option value="{{$val->category_id}}">{{$val->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Tình trạng bán ra</label>
                                    <input type="text" value="{{$edit_value->category_producer}}" class="form-control" name="category_product_producer" id="exampleInputPassword1" placeholder="Tình trạng bán ra">
                                </div>
                                <button type="submit" name="update_category_product" class="btn btn-info">Cập nhật</button>
                            </form>
                            </div>
                        @endforeach
                        </div>
                    </section>

            </div>
@endsection