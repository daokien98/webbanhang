@extends('layout')
@section('content')

<div class="features_items"><!--features_items-->
						<!--like-->
						<div>
						<div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
						<!--share-->
						<div class="fb-share-button" data-href="http://cnt57dh.kien/laravel/trang-chu"data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
						@foreach($category_name as $key => $name)
						</div>
						<h2 class="title text-center">{{$name->category_name}}</h2>
						@endforeach
						<div class="row">
							<div class="col-md-4">
								<label for="amount">Lọc theo</label>
								<form>
									@csrf
									<select name="sort" id="sort" class="form-control">
										<option value="{{Request::url()}}?sort_by=none">--Lọc--</option>
										<option value="{{Request::url()}}?sort_by=tang_dan">--Giá thấp nhất--</option>
										<option value="{{Request::url()}}?sort_by=giam_dan">--Giá cao nhất--</option>
										<option value="{{Request::url()}}?sort_by=kytu_az">--A đến Z--</option>
										<option value="{{Request::url()}}?sort_by=kytu_za">--Z đến A--</option>
									</select>
								</form>
							</div>
							<div class="col-md-4">	 
								<label for="amount">Lọc giá</label>
								<form>
									<div id="slider-range" style="margin-top: 10px"></div>
									<input type="text" id="amount" readonly style="border: 0; color: #f6931f; font-weight: bold;">
									<input type="hidden" name="start_price" id="start_price">
									<input type="hidden" name="end_price" id="end_price">
									<input style="margin-left: 300px; margin-top: -70px"type="submit" name="filter_price" value="Lọc giá" class="btn btn-sm btn-success">
								</form>	
							</div>
							</div>
						<br><br>
						@foreach($category_by_id as $key => $cate)
						<a href="{{URL::to('/chi-tiet-san-pham/'.$cate->product_id)}}">
						<div class="col-sm-4">
							<div class="single-products">
										<div class="productinfo text-center">
											<form>	
												@csrf
											<input type="hidden" value="{{$cate->product_id}}" class="cart_product_id_{{$cate->product_id}}">
                                            <input type="hidden" value="{{$cate->product_name}}" class="cart_product_name_{{$cate->product_id}}">
                                            <input type="hidden" value="{{$cate->product_image}}" class="cart_product_image_{{$cate->product_id}}">
                                            <input type="hidden" value="{{$cate->product_price}}" class="cart_product_price_{{$cate->product_id}}">
                                            <input type="hidden" value="1" class="cart_product_qty_{{$cate->product_id}}">


											<a href="{{URL::to('/chi-tiet-san-pham/'.$cate->product_id)}}">
												<img src="{{URL::to('/public/uploads/product/'.$cate->product_image)}}" width="90px" height = "200px"alt="" />
												<h2>{{number_format($cate->product_price).' VNĐ'}} </h2>
												<p>{{$cate->product_name}}</p>
											</form>
											</a>
											<button type="button" class="btn btn-default add-to-cart" data-id="{{$cate->product_id}}"name="add-to-cart">Thêm vào giỏ hàng</button>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Ưa thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>So sánh </a></li>
									</ul>
								</div>
							</div>
							@endforeach
						</div>
						<ul style="margin: 10px 0; margin-left: 320px"class="pagination pagination-sm m-t-none m-b-none">
                       {!!$category_by_id->links()!!}
                      </ul>
						<div class="fb-comments" data-href="{{$url_canonical}}" data-numposts="20" data-width=""></div>
					<div style="margin-left: 580px; margin-top:-100px"class="fb-page" data-href="https://www.facebook.com/V%E1%BA%ADt-Li%E1%BB%87u-X%C3%A2y-D%E1%BB%B1ng-Th%C6%B0%C6%A1ng-M%E1%BA%A1i-Ph%C6%B0%C6%A1ng-Anh-107052621202935" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/V%E1%BA%ADt-Li%E1%BB%87u-X%C3%A2y-D%E1%BB%B1ng-Th%C6%B0%C6%A1ng-M%E1%BA%A1i-Ph%C6%B0%C6%A1ng-Anh-107052621202935" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/V%E1%BA%ADt-Li%E1%BB%87u-X%C3%A2y-D%E1%BB%B1ng-Th%C6%B0%C6%A1ng-M%E1%BA%A1i-Ph%C6%B0%C6%A1ng-Anh-107052621202935">Vật Liệu Xây Dựng &amp; Thương Mại Phương Anh</a></blockquote></div>

						
					</div><!--features_items-->
					
					<script type="text/javascript">
		$(document).ready(function(){
			$('.addd-to-cart').click(function(){
				var id=$(this).data('idd');
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
                      success:function(data){
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
@endsection