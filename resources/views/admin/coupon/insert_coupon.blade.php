@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm mã giảm giá
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
                                <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="post">
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">*Tên mã giảm giá(Loại mã)</label>
                                    <input type="text" class="form-control" name="coupon_name" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Mã giảm giá</label>
                                    <input type="text" class="form-control" name="coupon_code" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Số lượng</label>
                                    <input type="text" class="form-control" name="coupon_time" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Tính năng</label>
                                    <select name="coupon_condition" class="form-control input-sm m-bot15">
                                        <option value="0">----Chọn---</option>
                                        <option value="1">Giảm theo phần trăm</option>
                                        <option value="2">Giảm theo tiền</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Số % hoặc số tiền giảm</label>
                                    <input type="text" class="form-control" name="coupon_number" id="exampleInputEmail1" >
                                </div>
                                
                                <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã giảm giá</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection