@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Đổi mật khẩu admin
                        </header>
                        <div class="panel-body">
                        <?php
	                    $message = Session::get('message');
	                    if($message){
		                echo $message;
		                Session::put('message',NULL);
	                    }
	                    ?>
                        @foreach($edit_user as $key => $edit_user)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-user/'.$edit_user->admin_id)}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">*Email</label>
                                    <input type="text" value="{{$edit_user->admin_email}}" class="form-control" name="admin_email" id="exampleInputEmail1" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Old Password</label>
                                    <input type="text" class="form-control" name="old_pass" id="exampleInputPassword1" placeholder="Mật khẩu cũ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*New Password</label>
                                    <input type="text" class="form-control" name="admin_password" id="exampleInputPassword1" placeholder="Mật khẩu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Tên</label>
                                    <input type="text" value="{{$edit_user->admin_name}}" class="form-control" name="admin_name" id="exampleInputPassword1" placeholder="Tên">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Số điện thoại</label>
                                    <input type="text" value="{{$edit_user->admin_phone}}" class="form-control" name="admin_phone" id="exampleInputPassword1" placeholder="Số điện thoại">
                                </div>
                                <button type="submit" name="update_user" class="btn btn-info">Cập nhật</button>
                            </form>
                            </div>
                        @endforeach
                        </div>
                    </section>

            </div>
@endsection