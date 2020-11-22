 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--SEO-->
    <meta name="description" content="{{$meta_desc}}">
    <meta name="keyword" content="{{$meta_keywords}}">
    <meta name="robots" content="INDEX,FOLLOW"/>
    <link rel="canonical" href="{{$url_canonical}}">
    <meta name="author" content="">
    <link rel="icon" type="image/x-icon" href="">
   		<meta property="og:image" content="{{asset('public/frontend/images/banner.jpg')}}">
    	<meta property="og:site_name" content="http://localhost/laravel">
    	<meta property="og:description" content="{{$meta_desc}}">
    	<meta property="og:title" content="{{$meta_title}}">
    	<meta property="og:url" content="{{$url_canonical}}">
    	<meta property="og:type" content="website">
    <!--SEO-->
	<title>{{$meta_title}}</title>
	<style>
	body {
	background-color: rgba(255, 255, 255, 0.9);
	} 
	</style>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">

	<link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('public/frontend/images/logo.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i style="color: red" class="fa fa-phone"></i> 0332630303</a></li>
								<li><a href="#"><i style="color: red" class="fa fa-envelope"></i>  phuonganh.xaydung@gmail.com</a></li>
								
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="https://www.facebook.com/profile.php?id=100014845359568"><i style="color: blue" class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i style="color: lightblue" class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i style="color: green" class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i style="color: red" class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i style="color: red" class="fa fa-youtube"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{URL::to('/')}}"><img src="{{asset('public/frontend/images/logo.png')}}" alt=""  width=200px height=200px/></a>

						</div>
						<div class="btn-group pull-right">
							
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<br/>
							<ul class="nav navbar-nav">
								<!-- <li><a href="{{URL::to('/dashboard')}}"><i style="color: orange" class="fa fa-user"></i> Quản trị viên</a></li> -->
								<li><a href="#"><i style="color: orange" class="fa fa-star"></i> Ưa Thích</a></li>
								<?php
									$customer_id = Session::get('customer_id');
									$shipping_id = Session::get('shipping_id');
									if($customer_id != NULL && $shipping_id == NULL){
								?>
										<li><a href="{{URL::to('/checkout')}}"><i style="color: orange" class="fa fa-crosshairs"></i> Thanh toán </a></li>		
								<?php
									}elseif (($customer_id != NULL && $shipping_id != NULL)){
								?>
										<li><a href="{{URL::to('/payment')}}"><i style="color: orange" class=" fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
									}else{
								?>
										<li><a href="{{URL::to('/login-checkout')}}"><i style="color: orange" class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php
									}
								?>
								<li><a href="{{URL::to('/gio-hang')}}"><i style="color: orange" class="fa fa-shopping-cart"></i> Giỏ Hàng</a></li>
								<?php
									$customer_id = Session::get('customer_id');
									$name = Session::get('customer_name');
									$cart = Session::get('cart');
									if($customer_id != NULL){
								?>		
										<li class="dropdown" style="margin-top: -3px">
								            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
								            	<img style="height: 32px" alt="" width="30px"src="{{asset('public/backend/images/kien.jpg')}}">
								                <span class="username" style="color: orange">
								    				@php
								    					echo $name;
								    				@endphp
												</span>
								                <b class="caret"></b>
								            </a>
								           
								            <ul class="dropdown-menu extended logout">
									            <li><a href="{{URL::to('/information')}}"><i class="fa fa-star"></i> Thông tin cá nhân</a></li>
									            <li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng của bạn</a></li>
								                <li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-key"></i> Đăng Xuất</a></li>
								            </ul>
								        </li>		
								<?php
									}else{
								?>		
										<li><a href="{{URL::to('/login-checkout')}}"><i style="color: orange" class="fa fa-lock"></i> Đăng nhập</a></li>
										</span>
								<?php
									}
								?>
								<!-- <?php
									$customer_id = Session::get('customer_id');
									$name = Session::get('customer_name');
									if($customer_id != NULL){
								?>		
										<?php
										if($name){
										echo $name;
										}
										?>
										</span>
										<li><a href="{{URL::to('/logout-checkout')}}"><i style="color: orange" class="fa fa-lock"></i>Đăng xuất</a> </li>		
								<?php
									}else{
								?>		
										<li><a href="{{URL::to('/login-checkout')}}"><i style="color: orange" class="fa fa-lock"></i> Đăng nhập</a></li>
										</span>
								<?php
									}
								?> -->
										
							</ul>
						</div>
						<h3 style="margin-top: 90px; font-weight: bold ;color: chocolate; font-size: 38px; margin-left: -130px; font-family: sans-serif; text-shadow: 5px 2px 4px grey">CÔNG TY CỔ PHẦN XÂY DỰNG PHƯƠNG ANH</h3>

					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-8">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trang-chu')}}" class="active">Trang Chủ</a></li>
								<li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
										@foreach($category as $key => $danhmuc)
											<li><a href="{{URL::to('/danh-muc/'.$danhmuc->slug_category_product)}}">{{$danhmuc->category_name}}</a></li>  
										@endforeach
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
										@foreach($category_post as $key => $danhmucbaiviet)
											<li><a href="{{URL::to('/danh-muc-bai-viet/'.$danhmucbaiviet->cate_post_slug)}}">{{$danhmucbaiviet->cate_post_name}}</a></li>  
										@endforeach
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Giỏ hàng<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
										<li><a href="{{URL::to('/gio-hang')}}">Giỏ Hàng</a></li> 
										<li><a href="{{URL::to('/login-checkout')}}">Thông tin đơn hàng</a></li> 
                                    </ul>
                                </li> 
								<li><a href="{{URL::to('/lien-he')}}">Liên Hệ</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-4">
						<form id="form_tk" action="{{URL::to('/tim-kiem')}}" autocomplete="off" method="POST"> 
							{{ csrf_field() }}
						
						<div class="search_box pull-right">
							<input style="font-weight: bold"type="text" id="keywords" name="keyword_submit" placeholder="Tìm kiếm sản phẩm">
							
							<a href="#" style="color: orange; padding: 10px 10px" onclick="document.getElementById('form_tk').submit()" name="search_items" class="fa fa-search" value="Tìm"></a>
							<div id="search_ajax"></div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							@php
								$i = 0;
							@endphp
							@foreach($banner as $key => $ban)
								@php
									$i++;
								@endphp
								<div class="item {{$i==1 ?'active': ''}}">
									<div class="col-sm-14"> <!-- col-sm-6 -->
										<img src="{{asset('public/uploads/banner/'.$ban->banner_image)}}"
										class="girl img-responsive" style="height:400px; width: 950px"alt="{{$ban->banner_desc}}">
									</div>
									
								</div>
							@endforeach
							
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Danh mục sản phẩm</h2>
						<div class="panel-group category-products" id="accordian">
							<!--category-products-->
							
							<!-- <div class="panel panel-default">
								
								<div class="panel-heading">
									<h4 class="panel-title">@foreach($category as $key => $cate)	
									<a href="{{URL::to('/danh-muc/'.$cate->slug_category_product)}}"></a>				
									
											<span class="badge pull-right"></span>{{$cate->category_name}}
										
									</h4>@endforeach
								</div>

								
							</div> -->
							<div class="panel panel-default">
								<div class="panel-heading">
									@foreach ($category as $key => $cate)
									<h4 class="panel-title"><a href="{{url('/danh-muc/'.$cate->slug_category_product)}}"><span class="pull-right"></span>{{$cate->category_name}}</a><br>
									</h4><br>
									
									@endforeach
								</div>
							</div>
							
						</div><!--/category-products-->
					
						<div class="brands_products"><!--brands_products-->
							<h2>Thương hiệu sản phẩm</h2>
							<div class="brands-name">
								
								<ul class="nav nav-pills nav-stacked">
									@foreach($brand as $key => $brand)
									<li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}"><span class="pull-right"></span>{{$brand->brand_name}}</a></li>
									@endforeach
								</ul>
							</div>
						</div><!--/brand products-->
						@if(Session::get('customer_id'))
						<div class="brands_products"><!--wishlist-->
							<h2>Sản phẩm yêu thích</h2>
							<div class="brands-name">
								<div id="row_wishlist" class="row"></div>
							</div>
						</div><!--/wishlist-->
						@endif
					<!-- Flashsale -->	
					<a href="#" data-toggle="modal" data-target="#video_modal"><img src="{{asset('public/frontend/images/sales.jpg')}}" alt="" height="450" width="270px" style="padding: 25px 0" /></a>
					<a href="#" data-toggle="modal" data-target="#video_modal1"><img src="{{asset('public/frontend/images/sale-newyear.png')}}" alt="" height="550" width="270px" style="padding: 25px 0" /></a>
					<!-- Modal -->
				      <div class="modal fade" id="video_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				        <div class="modal-dialog" role="document">
				          <div class="modal-content" style="background-color: lightblue">
				            <div class="modal-header" >
				              <h5 class="modal-title text-center"  id="exampleModalLabel">FLASH SALES</h5>
				              <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				                <span aria-hidden="true">&times;</span>
				              </button> -->
				            </div>
				            <div class="modal-body" >
				              <div><h2 style="color: red">SỰ KIỆN SIÊU GIẢM GIÁ</h2></div>
				              <h4 class="text-center">Mời bạn nhập mã code để được giảm tối đa 200.000 VNĐ</h4>

				              <div class="text-center"><iframe src="https://giphy.com/embed/hSihGn5Ou3S2ktRy2W" width="50%" height="100%" frameBorder="0" class="giphy-embed"></iframe></div>
				              <li class="text-center" style="list-style: none">KG352H2 - GIẢM 10%
				              </li>
				              <li class="text-center" style="list-style: none">H23VK67 - GIẢM 200.000 VNĐ
				              </li>
				            </div>
				            <div class="modal-footer">
				              <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
				            </div>
				          </div>
				        </div>
				      </div>
				     <!-- Modal --> 

					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					@yield('content')
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>Công ty Cổ phần Xây dựng</span> - PHƯƠNG ANH</h2>
							<p>Sự lựa chọn của bạn xây dựng uy tín của chúng tôi!</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-5">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3728.266185645196!2d106.71440781458521!3d20.861318598849994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a7ace96914f53%3A0xf6adcf519b6de943!2zNDE1IMSQxrDhu51uZyDEkMOgIE7hurVuZywgxJDDtG5nIEjhuqNpIDEsIEjhuqNpIEFuLCBI4bqjaSBQaMOybmcsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1604292500855!5m2!1svi!2s" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
						</div>
						
						<div class="col-sm-3" style=" margin-left: 200px; padding:3px 0px">
							<div class="single-widget">
								<h2 class="text-center">LIÊN KẾT</h2>
								<div class="text-center">
									<a href="#" style="color: orange; font-weight: bold;font-size: 12px; ">GIỚI THIỆU</a><br><br>
									<a href="#" style="color: orange; font-weight: bold;font-size: 12px; ">TÔN LỢP MÁI</a><br><br>
									<a href="#" style="color: orange; font-weight: bold;font-size: 12px; ">ỐNG BÊ TÔNG</a><br>
									<div class="social-networks text-center" style="padding: 27px 35px; margin-left: 30px;" >
	    					
							<ul>
								<li>
									<a href="#"><i style="color: blue; margin-left: 4px"class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i style="color: lightblue"class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#" ><i style="color: red"class="fa fa-google-plus"></i></a>
								</li>
								<li>
									<a href="#"><i style="color: red"class="fa fa-youtube"></i></a>
								</li>
							</ul>
	    				</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="single-widget">
							<h2>THẮC MẮC XIN GỬI VỀ</h2>
							<form action="https://accounts.google.com/ServiceLogin/signinchooser?service=mail&passive=true&rm=false&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&ss=1&scc=1&ltmpl=default&ltmplcache=2&emr=1&osid=1&flowName=GlifWebSignIn&flowEntry=ServiceLogin" class="searchform">
								<!--<input type="text" placeholder="Your email address" />-->
								<button type="submit" class="btn btn-default"><i class="fa fa-comment"></i>	Gửi Email cho chúng tôi</button>
								<p>Mọi ý kiến đóng góp xin gửi về hòm thư<br /> của chúng tôi <a href="#">phuonganhxaydung@gmail.com</a></li></p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		

		<style>
			.searchform .btn-default {
				color : white;
			}

			.searchform .btn-default:hover {
				background-color : gray;
			}
		</style>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2020 Coporotions</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="https://www.facebook.com/kiendao2810">CNT57DH</a></span></p>
				</div>
				
			</div>
		</div>
		
	</footer><!--/Footer-->
	

	
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
    <script src="{{asset('public/frontend/js/prettify.js')}}"></script>
    <script src="{{asset('public/frontend/js/simple.money.format.js')}}"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">
	    $.validate({});
	</script>
	<div id="fb-root"></div>
	<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v8.0" nonce="pyMMNekE"></script>
	<script type="text/javascript">
			  $(document).ready(function(){
			    $( "#slider-range" ).slider({
			      range: true,
			      min: {{$min_price_range}},
			      max: {{$max_price_range}},
			      values: [ {{$min_price}}, {{$max_price}} ],
			      step: 1000,
			      slide: function( event, ui ) {
			        $( "#amount" ).val(ui.values[ 0 ] + " đ" + " - " + ui.values[ 1 ] + " đ");
			        $("#start_price").val(ui.values[0]);
			        $("#end_price").val(ui.values[1]);
			      }
			    });
			    $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) +
			      " đ" + " - " + $( "#slider-range" ).slider( "values", 1 )+ " đ" );
			  });
	</script>
	<!--Slider range -->
	<!-- <script type="text/javascript">
		$(document).ready(function(){
			$("#slider-range").slider({
				orientation:"horizontal",
				range : true,
				values: [17,67],

				slide:function(event,ui){
					$("#amount").val("đ" + ui.values[0] + " - đ" +ui.values[1]);
					$("#start_price").val(ui.values[0]);
					$("#end_price").val(ui.values[1]);
				}
			});
			$("#amount").val("đ" +$("#slider-range").slider("values",0) + " - đ" +$("slider-range").slider("values",1));
		});
	</script> -->
	<!-- Click Sort -->
	<script type="text/javascript">
		$(document).ready(function(){
			$('#sort').on('change',function(){
				var url =  $(this).val();
				if(url){
					window.location = url;
				}
				return false;
			});
		});
	</script>
	<!-- Wishlist-->
	<script type="text/javascript">
		function view(){
			if(localStorage.getItem('data')!=null){
				var data = JSON.parse(localStorage.getItem('data'));

				data.reverse();
				document.getElementById('row_wishlist').style.overflow = 'scroll';
				document.getElementById('row_wishlist').style.height = '200px';
				for(i = 0 ; i<data.length; i++){
					var name = data[i].name;
					var price = data[i].price;
					var image = data[i].image;
					var url = data[i].url;
					$("#row_wishlist").append('<div class="row" style="margin:10px 0"><div class="col-md-4"><img src="'+image+'" width="100%"></div><div class="col-md-8 info_wishlist"><p>'+name+'</p><p style="color:#FE980F">'+price+' VNĐ</p><a href="'+url+'">Xem</a></div></div>');
				}
			}
		}
		view();

		// thêm vào localStorage
		function add_wishlist(clicked_id){
			var id = clicked_id;
			var name = document.getElementById('wishlist_productname'+id).value;
			var price = document.getElementById('wishlist_productprice'+id).value;
			var image = document.getElementById('wishlist_productimage'+id).src;
			var url = document.getElementById('wishlist_producturl'+id).href;

			var newItem = {
				'url' :url,
				'id' :id,
				'name' :name,
				'price' :price,
				'image' :image
			}

			if(localStorage.getItem('data')==null){
				localStorage.setItem('data','[]');
			}

			var old_data = JSON.parse(localStorage.getItem('data'));
			// kiểm tra yêu thích trùng
			var matches = $.grep(old_data, function(obj){
				return obj.id == id;
			});
			if(matches.length){
				alert('Sản phẩm này đã được thêm vào danh sách!');
			}else{
				old_data.push(newItem);
				$("#row_wishlist").append('<div class="row" style="margin:10px 0"><div class="col-md-4"><img src="'+newItem.image+'" width="100%"></div><div class="col-md-8 info_wishlist"><p>'+newItem.name+'</p><p style="color:#FE980F">'+newItem.price+' VNĐ</p><a href="'+newItem.url+'"></a></div></div>');
			}
			localStorage.setItem('data',JSON.stringify(old_data));
		}
	</script>
	<!-- Tab Product -->
	<script type="text/javascript">
		$(document).ready(function(){
			var cate_id = $('.tabs_pro').data('id');
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: '{{url('/product-tabs')}}',
		        method: 'POST',
		        data:{cate_id:cate_id,_token:_token},
		        success:function(data){
		           	$('#tabs_product').html(data);
		        }
			});	

			$('.tabs_pro').click(function(){
				var cate_id = $(this).data('id');
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: '{{url('/product-tabs')}}',
		            method: 'POST',
		            data:{cate_id:cate_id,_token:_token},
		            success:function(data){
		            	$('#tabs_product').html(data);
		            }
				});
			});

			
	});
	</script>
	<!-- Contact -->
	<script type="text/javascript">
		$('.contact_send').click(function(){
				var contact_name = $('.contact_name').val();
				var contact_email = $('.contact_email').val();
				var contact_subject = $('.contact_subject').val();
				var contact_message = $('.contact_message').val();
				var _token = $('input[name="_token"]').val();

				swal({
					    title: "Bạn có chắc muốn gửi phản hồi?",
					    text: "Hành động này sẽ không thể hoàn tác",
					    type: "warning",
					    showCancelButton: true,
					    confirmButtonText: 'Xác nhận',
					    cancelButtonText: "Hủy bỏ",
					    closeOnConfirm: false,
					    closeOnCancel: false
					 },
					 function(isConfirm){
					   if (isConfirm){
						$.ajax({
							url: '{{url('/insert-contact')}}',
		                    method: 'POST',
		                    data:{contact_name:contact_name,contact_email:contact_email,contact_subject:contact_subject,contact_message:contact_message,_token:_token},
		                      success:function(){
		                    	swal("Phản hồi", "Phản hồi thành công!", "success");
		                    	location.reload();
		                    }
		                    
						});			    
					}else{
					      swal("Hủy bỏ", "Đã hủy bỏ phản hồi", "error");
					    }
					 });
				

			});
	</script>
	<!-- Rating  -->
	<script type="text/javascript">
		// remove màu vàng 
		function remove_background(product_id){
			for(var count= 1; count<=5;count++){
				$('#'+product_id+'-'+count).css('color','#ccc');
			}
		}
		// Hover chuột rating 
		$(document).on('mouseenter','.rating',function(){
			var index = $(this).data("index");//số sao
			var product_id = $(this).data('product_id');

			remove_background(product_id);
			for(var count= 1; count<=index;count++){
				$('#'+product_id+'-'+count).css('color','#ffcc00');
			}

		});
		// Nhả chuột không rate
		$(document).on('mouseleave','.rating',function(){
			var index = $(this).data("index");//số sao
			var product_id = $(this).data('product_id');
			var rating = $(this).data("rating");
			remove_background(product_id);
			for(var count= 1; count<=rating;count++){
				$('#'+product_id+'-'+count).css('color','#ffcc00');
			}
		});
		// Click rating
		$(document).on('click','.rating',function(){
			var index = $(this).data("index");//số sao
			var product_id = $(this).data('product_id');
			var _token = $('input[name="_token"]').val();
			$.ajax({
					url: '{{url('/insert-rating')}}',
                    method: 'POST',
                    data: {index:index,product_id:product_id,_token:_token},
                      success:function(data){
                    	swal("Đánh giá", "Đánh giá sản phẩm thành công", "success");
						location.reload();
                    }
				});
		});
	</script>
	<!-- Comment  -->
	<script type="text/javascript">
		$(document).ready(function(){
			load_comment();
			function load_comment(){
				var product_id = $('.comment_product_id').val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: '{{url('/load-comment')}}',
                    method: 'POST',
                    data:{product_id:product_id,_token:_token},
                      success:function(data){
                    	  $('#comment_show').html(data);
                    }
				});
			}
			$('.send-comment').click(function(){
				var product_id = $('.comment_product_id').val();
				var comment_name = $('.comment_name').val();
				var comment_content = $('.comment_content').val();
				var _token = $('input[name="_token"]').val();

				swal({
					    title: "Bạn có chắc muốn bình luận?",
					    text: "Hành động này sẽ không thể hoàn tác",
					    type: "warning",
					    showCancelButton: true,
					    confirmButtonText: 'Xác nhận',
					    cancelButtonText: "Hủy bỏ",
					    closeOnConfirm: false,
					    closeOnCancel: false
					 },
					 function(isConfirm){
					   if (isConfirm){
						$.ajax({
							url: '{{url('/send-comment')}}',
		                    method: 'POST',
		                    data:{product_id:product_id,comment_name:comment_name,comment_content:comment_content,_token:_token},
		                      success:function(){
		                    	swal("Bình luận", "Bình luận thành công, đang chờ duyệt!", "success");
		                    	load_comment();
		                    	location.reload();
		                    }
		                    
						});			    
					}else{
					      swal("Hủy bỏ", "Đã hủy bỏ bình luận", "error");
					    }
					 });
				

			});
		});
	</script>
	<!-- Xem nhanh  -->
	<script type="text/javascript">
		$('.xemnhanh').click(function(){
			var product_id = $(this).data('id_product');
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url: "{{url('/quickview')}}",
				method: "POST",
				dataType: "JSON",
				data: {product_id:product_id, _token:_token},		
				success:function(data){
					$('#product_quickview_title').html(data.product_name);
					$('#product_quickview_id').html(data.product_id);
					$('#product_quickview_price').html(data.product_price);
					$('#product_quickview_image').html(data.product_image);
					$('#product_quickview_gallery').html(data.product_gallery);
					$('#product_quickview_desc').html(data.product_desc);
					$('#product_quickview_content').html(data.product_content);
					$('#product_quickview_value').html(data.product_quickview_value);
					
				}
			});
		});
	</script>
	<!-- Tìm kiếm  -->
	<script type="text/javascript">
		$('#keywords').keyup(function(){
			var query = $(this).val();
			if(query!=''){
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: '{{url('/autocomplete-ajax')}}',
                    method: 'POST',
                    data:{query:query,_token:_token},
                      success:function(data){
                    	  $('#search_ajax').fadeIn();
                    	   $('#search_ajax').html(data);
                    }
				});
			}else{
				$('#search_ajax').fadeOut();
			}
		});
		$(document).on('click','.li_search_ajax',function(){
			$('#keywords').val($(this).text());
			$('#search_ajax').fadeOut();
		});
	</script>
	<!-- Galery hình ảnh  -->
	<script type="text/javascript">
		  $(document).ready(function() {
		    $('#imageGallery').lightSlider({
		        gallery:true,
		        item:1,
		        loop:true,
		        thumbItem:3,
		        slideMargin:0,
		        enableDrag: false,
		        currentPagerPosition:'left',
		        onSliderLoad: function(el) {
		            el.lightGallery({
		                selector: '#imageGallery .lslide'
		            });
		        }   
		    });  
		  });
	</script>
	<script type="text/javascript">
			$('.send_order').click(function(){
				swal({
					    title: "Bạn có chắc muốn đặt hàng?",
					    text: "Hành động này sẽ không thể hoàn tác",
					    type: "warning",
					    showCancelButton: true,
					    confirmButtonText: 'Xác nhận',
					    cancelButtonText: "Hủy bỏ",
					    closeOnConfirm: false,
					    closeOnCancel: false
					 },
					 function(isConfirm){
					 	var shipping_email = $('.shipping_email').val();
						var shipping_name = $('.shipping_name').val();
						var shipping_address = $('.shipping_address').val();
						var shipping_phone = $('.shipping_phone').val();
						var shipping_note = $('.shipping_note').val();
						var shipping_method = $('.payment_select').val();
						var order_fee = $('.order_fee').val();
						var order_coupon = $('.order_coupon').val();
						var _token = $('input[name="_token"]').val();
					  	if (isConfirm && shipping_note!= '' && shipping_email!= '' && shipping_name!='' && shipping_address!= ''){
						$.ajax({
							url: '{{url('/confirm-order')}}',
		                    method: 'POST',
		                    data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_note:shipping_note,shipping_method:shipping_method,order_fee:order_fee,order_coupon:order_coupon,_token:_token},
		                      success:function(){
		                    	swal("Đơn hàng", "Đơn hàng đã được xác nhận", "success");
		                    }
		                    
						});
						window.setTimeout(function(){
							window.location.href = "{{url('/trang-chu')}}";
						},3000); //3 giây reload trang					    
					}else{
					      swal("Hủy bỏ", "Đơn hàng đã hủy bỏ!", "error");
					    }
					 });

				});
	</script>
	<!--Them gio hang trang xem nhanh-->
	<script type="text/javascript">
		$(document).ready(function(){
			$('.add-to-cart-quickview').click(function(){
				var id=$(this).data('id_product');
				var cart_product_id = $('.cart_product_id_' + id).val();
				var cart_product_name = $('.cart_product_name_' + id).val();
				var cart_product_image = $('.cart_product_image_' + id).val();
				var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_qty = $('.cart_product_qty_' + id).val();
				var _token = $('input[name="_token"]').val();

				if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
					alert('Làm ơn điền số lượng nhỏ hơn '+cart_product_quantity);
				}else{
					$.ajax({
						url: '{{url('/add-cart-ajax')}}',
	                    method: 'POST',
	                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
	                      success:function(){
	                    	  swal({
	                                title: "Đã thêm vào giỏ hàng",
	                                text: "Bạn có thể mua tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
	                                showCancelButton: true,
	                                cancelButtonText: "Xem tiếp",
	                                confirmButtonClass: "btn-success",
	                                confirmButtonText: "Đi đến giỏ hàng",
	                                closeOnConfirm: false
	                            },
	                            function() {
	                                window.location.href = "{{url('/gio-hang')}}";
	                            });

	                    }
					});
				}
			});
		});
	</script>
	<!--Them gio hang trang chu-->
	<script type="text/javascript">
			$('.add-to-cart').click(function(){
				var id=$(this).data('id');
				var cart_product_id = $('.cart_product_id_' + id).val();
				var cart_product_name = $('.cart_product_name_' + id).val();
				var cart_product_image = $('.cart_product_image_' + id).val();
				var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_qty = $('.cart_product_qty_' + id).val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
                      success:function(){
                    	  swal({
                                title: "Đã thêm vào giỏ hàng",
                                text: "Bạn có thể mua tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/gio-hang')}}";
                            });

                    }
				});
			});
	</script>
	<!--Them gio hang trang category-->
	<script type="text/javascript">
		$(document).ready(function(){
			$('.cate-add-to-cart').click(function(){
				var id=$(this).data('id_cate');
				var cart_product_id = $('.cart_product_id_' + id).val();
				var cart_product_name = $('.cart_product_name_' + id).val();
				var cart_product_image = $('.cart_product_image_' + id).val();
				var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_qty = $('.cart_product_qty_' + id).val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
                      success:function(){
                    	  swal({
                                title: "Đã thêm vào giỏ hàng",
                                text: "Bạn có thể mua tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/gio-hang')}}";
                            });

                    }
				});
			});
		});
	</script>

	<!--Them gio hang trang brand-->
	<script type="text/javascript">
		$(document).ready(function(){
			$('.brand-add-to-cart').click(function(){
				var id=$(this).data('id_brand');
				var cart_product_id = $('.cart_product_id_' + id).val();
				var cart_product_name = $('.cart_product_name_' + id).val();
				var cart_product_image = $('.cart_product_image_' + id).val();
				var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_qty = $('.cart_product_qty_' + id).val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
                      success:function(){
                    	  swal({
                                title: "Đã thêm vào giỏ hàng",
                                text: "Bạn có thể mua tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/gio-hang')}}";
                            });

                    }
				});
			});
		});
	</script>

	<!--Them gio hang trang details-->
	<script type="text/javascript">
		$(document).ready(function(){
			$('.details-add-to-cart').click(function(){
				var id=$(this).data('id_details');
				var cart_product_id = $('.cart_product_id_' + id).val();
				var cart_product_name = $('.cart_product_name_' + id).val();
				var cart_product_image = $('.cart_product_image_' + id).val();
				var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_qty = $('.cart_product_qty_' + id).val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
                      success:function(){
                    	  swal({
                                title: "Đã thêm vào giỏ hàng",
                                text: "Bạn có thể mua tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                showCancelButton: true,
                                cancelButtonText: "Xem tiếp",
                                confirmButtonClass: "btn-success",
                                confirmButtonText: "Đi đến giỏ hàng",
                                closeOnConfirm: false
                            },
                            function() {
                                window.location.href = "{{url('/gio-hang')}}";
                            });

                    }
				});
			});
		});
	</script>

	<script type="text/javascript">
			$('.choose').on('change',function(){
			    var action = $(this).attr('id');
			    var ma_id = $(this).val();
			    var _token = $('input[name="_token"]').val();
			    var result = '';
			        if(action == 'city'){
			            result = 'province';
			        }else{
			                result = 'wards';
			            }
			        $.ajax({
			            url: '{{url('/select-delivery-home')}}',
			            method: 'POST',
			            data : {action:action,ma_id:ma_id,_token:_token},
			            success:function(data){
			                $('#'+result).html(data);
			            }
			    });
			 });
		
	</script>
	<script type="text/javascript">
			$('.calculate_delivery').click(function(){
				var matp = $('.city').val();
				var maqh = $('.province').val();
				var xaid = $('.wards').val();
				var _token = $('input[name="_token"]').val();
				if(matp == '' && maqh == '' && xaid == ''){
					alert('Làm ơn chọn đầy đủ thông tin địa chỉ');
				}else{
					$.ajax({
				        url: '{{url('/calculate-fee')}}',
				        method: 'POST',
				        data : {matp:matp,maqh:maqh,xaid:xaid,_token:_token},
				        success:function(){
				            swal("Phí vận chuyển", "Xác nhận phí vận chuyển", "success");
				            location.reload();
			        	}
			    	});
				}
				
			});
	</script>
	<!-- Zalo-->
	<script src="https://sp.zalo.me/plugins/sdk.js"></script>
	<div style="margin-bottom: 20px; margin-right: 100px "class="zalo-chat-widget" data-oaid="579745863508352884" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="300" data-height="450"></div>
      <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v8.0'
          });
        };

        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>

      <!-- Your Chat Plugin code -->
      <div class="fb-customerchat"
        attribution=setup_tool
        page_id="107052621202935"
  theme_color="#ff7e29"
  logged_in_greeting="Xin chào các bạn!"
  logged_out_greeting="Xin chào các bạn!">
      </div>

</body>
</html>