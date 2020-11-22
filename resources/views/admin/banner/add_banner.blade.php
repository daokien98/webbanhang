@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm banner
                        </header>
                        <div class="panel-body">
                        <?php
                            $message = Session::get('message');
                            if($message){
                            echo $message;
                            Session::put('message',NULL);
                        }
                        ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/insert-banner')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">*Tên banner</label>
                                    <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Vui lòng điền ít nhất 3 ký tự" class="form-control" name="banner_name" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Hình ảnh</label>
                                    <input type="file" class="form-control" name="banner_image" id="exampleInputPassword1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Mô tả banner</label>
                                    <textarea style="resize: none" row="8" class="form-control" name="banner_desc" id="ckeditor1" placeholder="Mô tả">
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Hiển thị</label>
                                    <select name="banner_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn banner</option>
                                        <option value="1">Hiển thị banner</option>
                                    </select>
                                </div>
                            
                                <button type="submit" name="add_banner" class="btn btn-info">Thêm banner</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection