@extends('layout')
@section('content')
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Đăng nhập</h2>
						<form action="{{URL::to('/login-customer')}}" method="POST">
							{{ csrf_field()}}
							<input type="text" data-validation="email" data-validation-error-msg="Vui lòng điền đúng định dạng email"  name="email_account" placeholder="Email" />
							<input type="password" data-validation="require"data-validation-error-msg="Mật khẩu không được để trống"  name="password_account" placeholder="Mật khẩu" />
							<span>
								<input type="checkbox" class="checkbox"> 
								Ghi nhớ phiên đăng nhập
							</span>
							<button type="submit" class="btn btn-default">Đăng nhập</button>
							<a href="{{URL::to('/login-facebook')}}"><img style="width: 33px; height: 33px; margin-left: 130px; margin-top: -52px"src="{{asset('public/frontend/images/face.png')}}"></a>	
							<a href="{{URL::to('/login-google')}}"><img style="width: 38px; height: 48px; margin-left: 20px; margin-top: -52px"src="{{asset('public/frontend/images/gmail.png')}}"></a>					
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">Hoặc</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng ký tài khoản!</h2>
						<form action="{{URL::to('/add-customer')}}" method="POST">
								{{ csrf_field() }}
							<input type="text" name="customer_name" placeholder="Họ và tên"/>
							<input type="email" data-validation="email" data-validation-error-msg="Vui lòng điền đúng định dạng email"name="customer_email" placeholder="Email"/>
							<input type="password" name="customer_password" placeholder="Mật khẩu"/>
							<input type="password" name="customer_password" placeholder="Nhập lại mật khẩu"/>
							<button type="submit" class="btn btn-default">Đăng ký</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection