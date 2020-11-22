@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Nhập thêm kho hàng
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                            @foreach($product as $key => $pro)
                                <form role="form" action="{{URL::to('/update-depot/'.$pro->product_id)}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input disabled type="text" class="form-control" name="product_name" id="exampleInputPassword1" value="{{$pro->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình ảnh</label>
                                    <img style= "float: right; padding: 5px 10px; margin-right: 
                                    435px;" src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" width="190">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số lượng trong kho</label>
                                    <input disabled type="text" data-validation="number"data-validation-error-msg="Vui lòng điền số lượng" class="form-control" name="product_quantity" id="exampleInputPassword1" value="{{$pro->product_quantity}}">
                                </div>
                                @endforeach
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Số lượng nhập kho</label>
                                    <input type="text" data-validation="number"data-validation-error-msg="Vui lòng điền số lượng" class="form-control" name="product_depot" id="exampleInputPassword1" value="">
                                </div>
                                <button type="submit" name="add_category_product" class="btn btn-info add_depot">Nhập hàng</button>
                            </form>
                            </div>
                        </div>
                    </section>

            </div>
@endsection