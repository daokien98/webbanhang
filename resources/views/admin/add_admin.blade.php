@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm admin Website
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
                                <form role="form" action="{{URL::to('/save-user')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">*Email admin</label>
                                    <input type="text" class="form-control" name="admin_email" id="exampleInputEmail1" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Mật khẩu</label>
                                    <input type="text" class="form-control" name="admin_password" id="exampleInputPassword1" placeholder="Mật khẩu"/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Tên admin</label>
                                    <input type="text" class="form-control" name="admin_name" id="exampleInputPassword1" placeholder="Mật khẩu"/>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Số điện thoại</label>
                                    <input type="text" class="form-control" name="admin_phone" id="exampleInputPassword1" placeholder="Mật khẩu"/>
                                </div>
                                <button type="submit" name="add_admin" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection