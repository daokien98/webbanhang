@extends('layout')
@section('content')
	<div class="row">  
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">PHẢN HỒI CHO CHÚNG TÔI</h2>
	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form >
				    		@csrf
				            <div class="form-group col-md-6">
				                <input type="text" name="contact_name" class="form-control contact_name" required="required" placeholder="Họ tên">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="contact_email" class="form-control contact_email" required="required" placeholder="Địa chỉ email">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="contact_subject" class="form-control contact_subject" required="required" placeholder="Chủ đề">
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="contact_message" id="message" required="required" class="form-control contact_message" rows="8" placeholder="Nhập tin nhắn ở đây"></textarea>
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="button" name="submit" class="btn btn-primary pull-right contact_send" value="Gửi">
				            </div>
				        </form>
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