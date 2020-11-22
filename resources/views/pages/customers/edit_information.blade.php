@extends('layout')
@section('content')
	<div class="row">  
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">THÔNG TIN CÁ NHÂN</h2>
	    				<div class="status alert alert-success" style="display: none"></div>@foreach($info as $key => $val)
				    	<form method="POST" action="{{url('/save-information/'.$val->customer_id)}}">
				    		@csrf
				    		
				            <div class="form-group col-md-6">
				                <input type="text" name="customer_name" class="form-control contact_name" required="required" value="{{$val->customer_name}}">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="customer_email" class="form-control contact_email" required="required" value="{{$val->customer_email}}">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="customer_phone" class="form-control contact_subject" required="required" value="{{$val->customer_phone}}">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="customer_address" id="message" required="required" class="form-control contact_message" rows="8">{{$val->customer_address}}</textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right customer_send" value="Lưu lại">
				            </div>
				        </form>
				        @endforeach
	    			</div>
	    		</div>
	    		<div class="col-sm-4">
	    			<div class="contact-info">
	    				<h2 class="title text-center">Thông tin liên hệ</h2>
	    				<address>
	    					<p>Công ty Cổ phần Xây dựng Phương Anh</p>
							<p>Địa chỉ: Đà Nẵng - Minh Đức - Thủy Nguyên - Hải Phòng</p>
							<p>Hải Phòng Việt Nam</p>
							<p>Số điện thoại: 0332630303</p>
							<p>Fanpage: facebook.com/phuonganh</p>
							<p>Email: phuonganhxaydung@gmail.com</p>
	    				</address>
	    				<div class="social-networks">
	    					<h2 class="title text-center">Mạng xã hội</h2>
							<ul>
								<li>
									<a href="#"><i style="color: blue" class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i style="color: lightblue" class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i style="color: red" class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i style="color: red" class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
	    			</div>
    			</div> 		
	    	</div>

	    	
@endsection