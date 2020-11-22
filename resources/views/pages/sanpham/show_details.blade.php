@extends('layout')
@section('content')
@foreach($product_details as $key => $value)

<div class="product-details">
	<style type="text/css">
		.lSSlideOuter .lSPager.lSGallery img {
		    display: block;
		    height: 120px;
		    max-width: 100%;
		}
		li.active {
		    border: 2px solid #FE980F;
		}
	</style>
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="{{url('/trang-chu')}}">Trang chủ</a></li>
				    <li class="breadcrumb-item"><a href="{{url('/danh-muc/'.$cate_slug)}}">{{$pro_cate}}</a></li>
				    <li class="breadcrumb-item active" aria-current="page">{{$meta_title}}</li>
				  </ol>
				</nav>	
			<div class="col-sm-5">
				<ul id="imageGallery">
							  <!--thumb:ảnh nhỏ
							  src: ảnh lớn khi click -->
					@foreach($gallery_product as $key => $gal)
						<li data-thumb="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" data-src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}">
							<img width="100%" alt="{{$gal->gallery_image}}"src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}" />
						</li>	
					@endforeach
				</ul>
			</div>
						
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<form>
								@csrf
								<input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                                <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                                <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                                <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$value->product_id}}">

								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{($value->product_name)}}</h2>
								<p>Mã ID: {{($value->product_id)}}</p>
								<img src="images/product-details/rating.png" alt="" />
								
								
								<span>
									<span>{{number_format($value->product_price).' VNĐ'}}</span>
									<label>Số lượng:</label>
									<input name="qty" type="number" min="1" value="1" />
									<input name="productid_hidden" type="hidden" value="{{($value->product_id)}}" />
								</span>
								</form>
									
									
								<button style="margin-bottom: 20px"type="button" class="btn btn-warning details-add-to-cart" data-id_details="{{$value->product_id}}"name="details-add-to-cart">Thêm vào giỏ hàng</button>
								<p><b>Tình trạng:</b> {{($value->product_status)}}</p>
								<p><b>Số lượng còn lại:</b> {{($value->product_quantity)}}</p>
								<p><b>Danh mục:</b> {{($value->category_name)}}</p>
								<p><b>Thương hiệu:</b> {{($value->brand_name)}}</p>
								<p><b>Mô tả:</b> {!!$value->product_content!!}</p>
								<!-- <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a> -->
								<style type="text/css">
									a.tags_style{
										margin: 3px 2px;
										border: 1px solid;
										height: auto;
										background-color: #5bc0de;
										color: white;
										padding: 3px;
										border-radius: 5px;

									}

									a.tags_style:hover{
										background: black;
									}
								</style>
								<fieldset>
									<legend>Tags</legend>
									<p><i class="fa fa-tag"></i>
										@php
											$tags = $value->product_tags;
											$tags = explode(",",$tags);
										@endphp
											@foreach($tags as $tag)
												<a href="{{url('/tag/'.Str::slug($tag))}}" class="tags_style">{{$tag}}</a>
											@endforeach 
									</p>
								</fieldset>
							
							</div><!--/product-information-->

						</div>

					</div>

				<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li ><a href="#details" data-toggle="tab">Mô tả</a></li>
								<!-- <li><a href="#companyprofile" data-toggle="tab">Hồ sơ công ty</a></li> -->
								<li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane " id="details">
								<p>{!!$value->product_content!!}</p>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
							
							</div>
							
							
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>Admin</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>15:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>16.11.2020</a></li>
									</ul>
									<style type="text/css">
										.style_comment{
											border: 1px solid #ddd; 
											border-radius: 10px;
											background-color: #F0F0E9;
										}
									</style>
									<form>
										@csrf
										 <input type="hidden" class="comment_product_id" name="comment_product_id" value="{{$value->product_id}}">
										<div id="comment_show"></div>
									</form>
									<br>
									<p><b>Viết đánh giá của bạn</b></p>
									<ul class="list-inline" title="Average Rating">
										@for($count=1;$count<=5;$count++)
											@php
												if($count<=$rating){
													$color = 'color:#ffcc00;';
												}else{
													$color = 'color:#ccc;';
												}
											@endphp
										<li title="star_rating"
											id="{{$value->product_id}}-{{$count}}"
											data-index = "{{$count}}"
											data-product_id="{{$value->product_id}}"
											data-rating="{{$rating}}"
											class="rating"

											style="cursor: pointer; {{$color}}; font-size: 30px">&#9733;
										</li>
										@endfor
									</ul>
									<form action="#">
										@csrf
										<span>
											<input style="width: 100%; margin-left: 0px; font-weight: bold;"type="text" class="comment_name" placeholder="Nickname"/>
										</span>
										<textarea name="comment" class="comment_content" placeholder="Nội dung"></textarea>
										<b>Đánh giá sao: </b> <img src="images/product-details/rating.png" alt="" />
										<button type="button" class="btn btn-default pull-right send-comment">
											Gửi bình luận
										</button>
										<div id="notify_comment"></div>
									</form>
								</div>
							</div>
							
						</div>
					</div>
@endforeach
									 <div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm gợi ý</h2>					
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
									@foreach($relate_product1 as $key => $relate)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{URL::to('/public/uploads/product/'.$relate->product_image)}}" width="90px" height = "200px" alt="" />
													<h2>{{number_format($relate->product_price).' VNĐ'}} </h2>
													<p>{{$relate->product_name}}</p>
													<button type="button" class="btn btn-default add-to-cart" data-id="{{$relate->product_id}}"name="add-to-cart">Thêm vào giỏ hàng</button>
												</div>											
											</div>		
										</div>
									</div>
									@endforeach
								</div>

								<div class="item">
									@foreach($relate_product2 as $key => $relate2)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{URL::to('/public/uploads/product/'.$relate2->product_image)}}" width="90px" height = "200px" alt="" />
													<h2>{{number_format($relate2->product_price).' VNĐ'}} </h2>
													<p>{{$relate2->product_name}}</p>
													<button type="button" class="btn btn-default add-to-cart" data-id="{{$relate2->product_id}}"name="add-to-cart">Thêm vào giỏ hàng</button>
												</div>											
											</div>		
										</div>
									</div>
									@endforeach
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					<div class="fb-comments" data-href="{{$url_canonical}}" data-numposts="20" data-width=""></div>
					<div style="margin-left: 580px; margin-top:-500px"class="fb-page" data-href="https://www.facebook.com/V%E1%BA%ADt-Li%E1%BB%87u-X%C3%A2y-D%E1%BB%B1ng-Th%C6%B0%C6%A1ng-M%E1%BA%A1i-Ph%C6%B0%C6%A1ng-Anh-107052621202935" data-tabs="message" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/V%E1%BA%ADt-Li%E1%BB%87u-X%C3%A2y-D%E1%BB%B1ng-Th%C6%B0%C6%A1ng-M%E1%BA%A1i-Ph%C6%B0%C6%A1ng-Anh-107052621202935" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/V%E1%BA%ADt-Li%E1%BB%87u-X%C3%A2y-D%E1%BB%B1ng-Th%C6%B0%C6%A1ng-M%E1%BA%A1i-Ph%C6%B0%C6%A1ng-Anh-107052621202935">Vật Liệu Xây Dựng &amp; Thương Mại Phương Anh</a></blockquote></div>
					<div id="fb-root"></div>

					

					
     
@endsection