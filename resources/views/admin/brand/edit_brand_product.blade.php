@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật thương hiệu
                        </header>
                        <div class="panel-body">
                        <?php
	                    $message = Session::get('message');
	                    if($message){
		                echo $message;
		                Session::put('message',NULL);
	                    }
	                    ?>
                        @foreach($edit_brand_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">*Tên thương hiệu</label>
                                    <input type="text" value="{{$edit_value->brand_name}}" class="form-control" name="brand_product_name" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Mô tả</label>
                                    <input type="text" value="{{$edit_value->brand_desc}}" class="form-control" name="brand_product_desc" id="exampleInputPassword1" placeholder="Mô tả">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Tình trạng đánh giá</label>
                                    <select name="brand_product_status" value="{{$edit_value->brand_status}}" class="form-control input-sm m-bot15">
                                    <option>Tốt</option>
                                    <option>Trung Bình</option>
                                    <option>Kém</option>
                                    </select>
                                </div>
                                <button type="submit" name="update_brand_product" class="btn btn-info">Cập nhật</button>
                            </form>
                            </div>
                        @endforeach
                        </div>
                    </section>

            </div>
@endsection