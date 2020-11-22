@extends('layout')
@section('content')
					<div class="category-tab"><!--category-tab-->
						<h2 class="title text-center">Danh mục sản phẩm</h2>
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								@php
									$i=0;
								@endphp
								@foreach( $category as $key => $cate_tab)
									@php
										$i++;
									@endphp
								<li class="tabs_pro {{$i==1 ? 'active' : ''}}" data-id="{{$cate_tab->category_id}}"><a href="#tshirt" data-toggle="tab">{{$cate_tab->category_name}}</a></li>
								@endforeach
							</ul>
						</div>
						<div id="tabs_product"></div>
						
					</div><!--/category-tab-->
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Sản phẩm mới</h2>

						@foreach($all_product as $key => $product)
						
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<form>	
												@csrf
											<input type="hidden" id="wishlist_productid{{$product->product_id}}" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                                            <input type="hidden" id="wishlist_productname{{$product->product_id}}"value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                                            <input type="hidden" id="wishlist_productprice{{$product->product_id}}" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">


											<a id="wishlist_producturl{{$product->product_id}}" href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
												<img id="wishlist_productimage{{$product->product_id}}" src="{{URL::to('/public/uploads/product/'.$product->product_image)}}" width="90px" height = "200px"alt="" />
												<h2>{{number_format($product->product_price).' VNĐ'}} </h2>
												<h4>{{$product->product_name}}</h4>
												<h5 style="color: brown">Số lượng: {{$product->product_quantity}}</h5>
											</form>
											</a>
											<style type="text/css">
												.xemnhanh{
													background: #F5F5ED;
													border: 0 none;
													border-radius: 0;
													color: #696763;
													text-decoration-color: white;
													font-family: 'Roboto', sans-serif;
													font-size: 15px;
													margin-bottom: 25px;
												}

												.xemnhanh:hover{
													color: white;
													background-color: orange;
												}
											</style>
											<button type="button" class="btn btn-default add-to-cart" data-id="{{$product->product_id}}"name="add-to-cart">Thêm vào giỏ hàng</button>
											<input type="button" data-toggle= "modal" data-target="#xemnhanh" data-id_product="{{$product->product_id}}" class="btn btn-default xemnhanh" name="add-to-cart" value="Xem nhanh"></input>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<style type="text/css">
											.button_wishlist{
												border:none;
												outline: none;
												color: #B3AFA8;
												background: #ffff;
											}
											.button_wishlist:focus{
												border:none;
												outline: none;
												color: #B3AFA8;
											}
											.button_wishlist span:hover{
												color: #FE980F;
											}
										</style>
										@if(Session::get('customer_id'))
										<li><a href="#">
											<i class="fa fa-plus-square">
												<button class="button_wishlist" id="{{$product->product_id}}" onclick="add_wishlist(this.id);"><span>Yêu thích</span></button>
											</i>
										</a></li>
										@endif
										<li><a href="#"><i class="fa fa-plus-square"></i>So sánh </a></li>
									</ul>
								</div>
							</div>
						</div>
						@endforeach
					</div><!--features_items-->
					<ul style="margin: 10px 0; margin-left: 320px"class="pagination pagination-sm m-t-none m-b-none">
                       {!!$all_product->links()!!}
                      </ul>

					<!-- Modal -->
						<div class="modal fade" id="xemnhanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-lg" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title product_quickview_title" id="">
						        	<span id="product_quickview_title"></span>
						        </h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						      	<style type="text/css">
						      		span#product_quickview_content img{
						      			width: 100%;
						      		}

						      		@media screen and (min-width: 768px){
						      			.modal-dialog {
						      				width: 700px;
						      			}
						      			.modal-sm{
						      				width: 350px;
						      			}
						      		} 

						      		@media screen and (min-width: 992px){
						      			.modal-lg {
						      				width: 1200px;
						      			}
						      		}

						      	</style>
						        <div class="row">
						        	<div class="col-md-5">
						        		<span id="product_quickview_image"></span>
						        		<span id="product_quickview_gallery"></span>
						        	</div>
						        	<form>
						        		@csrf
						        		<div id="product_quickview_value"></div>
						        	<div class="col-md-7">
						        		<h2><span id="product_quickview_title"></span></h2>
										<p>Mã ID: <span id="product_quickview_id"></span></p>

										<p style="font-size: 20px; color: brown;font-weight: bold">Giá sản phẩm:<span id="product_quickview_price"></span><p>
										<label>Số lượng:</label>
										<input name="qty" type="number" min="1" value="1" />
									<h4 style="color: brown;font-size: 20px;font-weight: bold">Mô tả sản phẩm</h4>
									<hr>
									<p><span id="product_quickview_desc"></span></p>
									<p><span id="product_quickview_content"></span></p>
									
									<button style="margin-bottom: 20px"type="button" class="btn btn-warning add-to-cart-quickview" data-id_product="{{$product->product_id}}" name="add-to-cart-quickview">Mua ngay</button>
						        	</div>
						        </form>
						        </div>
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-primary" data-dismiss="modal">Đóng</button>
						        <button type="button" class="btn btn-primary">Đi tới sản phẩm</button>
						      </div>
						    </div>
						  </div>
						</div>

					
            
                    <div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm gợi ý</h2>					
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
									@foreach($relate_product as $key => $relate)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<a href="{{URL::to('/chi-tiet-san-pham/'.$relate->product_id)}}">
													<img src="{{URL::to('/public/uploads/product/'.$relate->product_image)}}" width="90px" height = "200px" alt="" /></a>
													<h2>{{number_format($relate->product_price).' VNĐ'}} </h2>
													<p>{{$relate->product_name}}</p>
													<button type="button" class="btn btn-default add-to-cart" data-id="{{$product->product_id}}"name="add-to-cart">Thêm vào giỏ hàng</button>
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
													<a href="{{URL::to('/chi-tiet-san-pham/'.$relate2->product_id)}}">
													<img src="{{URL::to('/public/uploads/product/'.$relate2->product_image)}}" width="90px" height = "200px" alt="" /></a>
													<h2>{{number_format($relate2->product_price).' VNĐ'}} </h2>
													<p>{{$relate2->product_name}}</p>
													<button type="button" class="btn btn-default add-to-cart" data-id="{{$product->product_id}}"name="add-to-cart">Thêm vào giỏ hàng</button>
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
@endsection