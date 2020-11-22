@extends('layout')
@section('content')

<div class="features_items">
	<h2 style="margin:0px; position: inherit; font-size: 21px"class="title text-center">{{$meta_title}}</h2>		
		<div class="product-image-wrapper">
			@foreach($post as $key => $p)
				<div class="single-products" style="margin:10px 0; padding:5px 0">
					{!!$p->post_content!!}
				</div>
				<div class="clearfix"></div>
			@endforeach
		</div>
		<div class="fb-comments" data-href="{{$url_canonical}}" data-numposts="20" data-width="100%"></div>
</div>
     <div class="recommended_items">
						<h2 class="title text-center">Tin tức liên quan</h2>					
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<!-- <div class="item active"> -->
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											@foreach($related as $key => $post_relate)
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{URL::to('/public/uploads/post/'.$post_relate->post_image)}}" width="90px" height = "200px" alt="" />
													<p style="padding:2px; margin:10px 0">{{($post_relate->post_title)}} </p>
													<a href="{{url('/bai-viet/'.$post_relate->post_slug)}}">Đọc tiếp</a>	
												</div>
											</div>
											@endforeach
										</div>
									</div>
									
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>

@endsection