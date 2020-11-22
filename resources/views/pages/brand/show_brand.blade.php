@extends('layout')
@section('content')

<div class="features_items"><!--features_items-->
						@foreach($brand_name as $key => $name)
						
						<h2 class="title text-center">{{$name->brand_name}}</h2>

						@endforeach

						@foreach($brand_by_id as $key => $product)
						<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<form>	
								@csrf
								<div class="single-products">
										<div class="productinfo text-center">
											<input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                                            <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">

											<img src="{{URL::to('/public/uploads/product/'.$product->product_image)}}" width="100px" height = "200px"alt="" />
											<h2>{{number_format($product->product_price).' VNĐ'}} </h2>
											<p>{{$product->product_name}}</p>
								</form>
											<button type="button" class="btn btn-default brand-add-to-cart" data-id_brand="{{$product->product_id}}"name="brand-add-to-cart">Thêm vào giỏ hàng</button>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Ưa thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>So sánh </a></li>
									</ul>
								</div>
							</div>

						</div>
					</a>
						@endforeach
					</div><!--features_items-->
					<div class="fb-comments" data-href="{{$url_canonical}}" data-numposts="20" data-width=""></div>
					<div style="margin-left: 580px; margin-top:-100px"class="fb-page" data-href="https://www.facebook.com/V%E1%BA%ADt-Li%E1%BB%87u-X%C3%A2y-D%E1%BB%B1ng-Th%C6%B0%C6%A1ng-M%E1%BA%A1i-Ph%C6%B0%C6%A1ng-Anh-107052621202935" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/V%E1%BA%ADt-Li%E1%BB%87u-X%C3%A2y-D%E1%BB%B1ng-Th%C6%B0%C6%A1ng-M%E1%BA%A1i-Ph%C6%B0%C6%A1ng-Anh-107052621202935" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/V%E1%BA%ADt-Li%E1%BB%87u-X%C3%A2y-D%E1%BB%B1ng-Th%C6%B0%C6%A1ng-M%E1%BA%A1i-Ph%C6%B0%C6%A1ng-Anh-107052621202935">Vật Liệu Xây Dựng &amp; Thương Mại Phương Anh</a></blockquote></div>
@endsection