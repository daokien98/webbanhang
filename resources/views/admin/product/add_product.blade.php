@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">*Tên sản phẩm</label>
                                    <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Vui lòng điền ít nhất 3 ký tự" class="form-control" name="product_name" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Số lượng</label>
                                    <input type="text" data-validation="number"data-validation-error-msg="Vui lòng điền số lượng" class="form-control" name="product_quantity" id="exampleInputPassword1" placeholder="Số lượng mặt hàng">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Giá bán</label>
                                    <input type="text" data-validation="length" data-validation-length="min15"data-validation-error-msg="Vui lòng điền số tiền" class="form-control price_format3" name="product_price" id="exampleInputPassword1" placeholder="Giá bán sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Giá gốc</label>
                                    <input type="text" data-validation="length" data-validation-length="min15" data-validation-error-msg="Vui lòng điền số tiền" class="form-control price_format4" name="product_cost" id="exampleInputPassword1" placeholder="Giá bán sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Hình ảnh</label>
                                    <input type="file" class="form-control" name="product_image" id="exampleInputPassword1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Tình trạng</label>
                                    <input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Vui lòng điền ít nhất 3 ký tự" class="form-control" name="product_status" id="exampleInputPassword1" placeholder="Tình trạng">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Mô tả</label>
                                    <textarea style="resize: none" row="8" class="form-control" name="product_content" id="ckeditor1" placeholder="Mô tả">
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Đơn vị tính</label>
                                    <input type="text" data-validation="length" data-validation-length="min1" data-validation-error-msg="Vui lòng điền ít nhất 1 ký tự" class="form-control" name="product_note" id="exampleInputPassword1" placeholder="Đơn vị tính">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Tags sản phẩm</label>
                                    <input type="text" data-role ="tagsinput" data-validation="length" data-validation-length="min3" data-validation-error-msg="Vui lòng điền ít nhất 3 ký tự" class="form-control" name="product_tags">
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
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
            <script type="text/javascript">
                $('.price_format3').simpleMoneyFormat();
                $('.price_format4').simpleMoneyFormat();
            </script>
@endsection