@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm
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
                            @foreach($edit_product as $key => $pro)
                                <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">*Tên sản phẩm</label>
                                    <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Vui lòng điền ít nhất 3 ký tự" class="form-control" name="product_name" id="exampleInputEmail1" value="{{$pro->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Số lượng</label>
                                    <input type="text" data-validation="number"data-validation-error-msg="Vui lòng điền số lượng" class="form-control" name="product_quantity" id="exampleInputPassword1" value="{{$pro->product_quantity}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Giá bán</label>
                                    <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Vui lòng điền giá tiền" class="form-control price_format1" name="product_price" id="exampleInputPassword1" value="{{$pro->product_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Giá gốc</label>
                                    <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Vui lòng điền giá tiền" class="form-control price_format2" name="product_cost" id="exampleInputPassword1" value="{{$pro->product_cost}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Hình ảnh</label>
                                    <input type="file" class="form-control" name="product_image" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" width="120">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Tình trạng</label>
                                    <input type="text" class="form-control" name="product_status" id="exampleInputPassword1" value="{{$pro->product_status}}">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">*Mô tả</label>
                                    <textarea style="resize: none" row="8" class="form-control" name="product_content" id="ckeditor1" value="{{$pro->product_content}}">{{$pro->product_content}}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Tags sản phẩm</label>
                                    <input type="text" data-role ="tagsinput" data-validation="length" data-validation-length="min3" data-validation-error-msg="Vui lòng điền ít nhất 3 ký tự" class="form-control" name="product_tags" value="{{$pro->product_tags}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Đơn vị tính</label>
                                    <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng điền ít nhất 3 ký tự" class="form-control" name="product_note" id="exampleInputPassword1" value="{{$pro->product_note}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Danh mục</label>
                                    <select name="category_id" class="form-control input-sm m-bot15">
                                    @foreach($product_cate as $key => $cate)
                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Thương hiệu</label>
                                    <!-- <input type="text" class="form-control" name="brand_id" id="exampleInputPassword1" placeholder="Thương hiệu"> -->
                                    <select name="brand_id" class="form-control input-sm m-bot15">
                                    @foreach($product_brand as $key => $brand)
                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @endforeach
                                    <option value="Không">Không</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_category_product" class="btn btn-info">Cập nhật</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
            <script type="text/javascript">
                $('.price_format1').simpleMoneyFormat();
                $('.price_format2').simpleMoneyFormat();
            </script>
@endsection