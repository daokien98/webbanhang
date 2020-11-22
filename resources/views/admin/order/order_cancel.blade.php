@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Đơn hàng bị hủy bỏ
                        </header>
                        <div class="panel-body">
                        <?php
                            $message = Session::get('message');
                            if($message){
                              echo '<span class="text-alert">'.$message.'</span>';
                              Session::put('message',NULL);
                           }
                        ?>
                        @foreach($order as $key => $ord)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-cancel-order/'.$ord->order_id)}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ID đơn hàng</label>
                                    <input type="text" disabled data-validation="length" data-validation-length="min10" data-validation-error-msg="Vui lòng điền ít nhất 10 ký tự" class="form-control" name="order_id" value="{{$ord->order_id}}">
                                </div>
                               <div class="form-group">
                                    <label for="exampleInputEmail1">Mã đơn hàng</label>
                                    <input type="text" disabled data-validation="length" data-validation-length="min10" data-validation-error-msg="Vui lòng điền ít nhất 10 ký tự" class="form-control" name="order_code" value="{{$ord->order_code}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã khách hàng</label>
                                    <input type="text" disabled data-validation="length" data-validation-length="min10" data-validation-error-msg="Vui lòng điền ít nhất 10 ký tự" class="form-control" name="customer_id" value="{{$ord->customer_id}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã shipping</label>
                                    <input type="text" disabled data-validation="length" data-validation-length="min10" data-validation-error-msg="Vui lòng điền ít nhất 10 ký tự" class="form-control" name="shipping_id" value="{{$ord->shipping_id}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày đặt hàng</label>
                                    <input type="text" disabled name="post_slug" class="form-control" id="order_code" value="{{$ord->created_at}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tình trạng đơn hàng(1:Đơn hàng mới/ 2: Đang xử lý/ 3: Đơn bị hủy bỏ)</label>
                                    <input type="text" disabled name="post_slug" class="form-control" id="order_status" value="{{$ord->order_status}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Lý do hủy đơn</label>
                                    <textarea style="resize: none" row="8" class="form-control" name="cancel_reason" id="ckeditor">
                                    </textarea>
                                </div>
                              @endforeach
                                <button type="submit" name="add_post_cate" class="btn btn-info">Xác nhận</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection