@extends('layout')
@section('content')

<div class="features_items">
						<h2 class="title text-center">{{$meta_title}}</h2>		
							<div class="product-image-wrapper">
								@foreach($post as $key => $p)
								<div class="single-products" style="margin:10px 0; padding:5px 0">
										<div class="text-center">
											@csrf
												<img style="float: left; width: 30%; padding:5px; height: 180px"src="{{URL::to('/public/uploads/post/'.$p->post_image)}}" width="90px" height = "200px"alt="{{$p->post_slug}}" />
												<h4 style="color: #000; padding:5px;">{{$p->post_title}}</h4>
												<p>{!!$p->post_desc!!}</p>
										<div class="text-right">
											<a style="color: #000"href="{{url('/bai-viet/'.$p->post_slug)}}" class="btn btn-warning btn-sm">Đọc tiếp </a>	
										</div>
								</div>
								<div class="clearfix"></div>
								@endforeach
							</div>
					<ul style="margin: 10px 0; margin-left: 320px"class="pagination pagination-sm m-t-none m-b-none">
                       {!!$post->links()!!}
                    </ul>
                 
@endsection