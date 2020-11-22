  @extends('layout')
@section('content')

<div class="features_items"><!--features_items-->
						<!--like-->
						<div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" data-action="like" data-size="small" data-share="false"></div>
						<!--sharre-->
						<div class="fb-share-button" data-href="http://localhost/laravel/trang-chu" data-layout="button_count" data-size="small"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
						@foreach($category_name as $key => $name)
						
						<h2 class="title text-center">{{$name->category_name}}</h2>

						@endforeach
						@foreach($category_by_id as $key => $product)
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
                                            
											<img src="{{URL::to('/public/uploads/product/'.$product->product_image)}}" width="100px" height = "300px"alt="" />
											<h2>{{number_format($product->product_price).' VNĐ'}} </h2>
											<p>{{$product->product_name}}</p></a>
								</form>
											<button type="button" class="btn btn-default cate-add-to-cart" data-id_cate="{{$product->product_id}}"name="cate-add-to-cart">Thêm vào giỏ hàng</button>
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

						@endforeach
					
					</div><!--features_items-->
					<div class="fb-comments" data-href="{{$url_canonical}}" data-numposts="20" data-width=""></div>
					<div style="margin-left: 580px; margin-top:-500px"class="fb-page" data-href="https://www.facebook.com/Laugh-For-Life-102109191520182" data-tabs="message" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Laugh-For-Life-102109191520182" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Laugh-For-Life-102109191520182">Laugh For Life</a></blockquote></div>
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