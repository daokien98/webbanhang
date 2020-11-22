@extends('layout')
@section('content')
		<section id="cart_items">
			<div class="breadcrumbs">
				  <ol class="breadcrumb">

				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
			</div>
			@if(session()->has('message'))
				<div class="alert alert-success">
					{{ session()->get('message')}}
				</div>
				@elseif(session()->has('error'))
				<div class="alert alert-damager">
					{{ session()->get('error')}}
				</div>
			@endif
			<div class="table-responsive cart_info">
				<form action="{{URL::to('/update-cart')}}" method="POST">
					@csrf
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Tên sản phẩm</td>
							<td class="price">Đơn giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Thành tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						@if(Session::get('cart')==true)
						@php
							$total = 0;
						@endphp

						@foreach(Session::get('cart') as $key => $cart)
							@php
								$subtotal = $cart['product_price']*$cart['product_qty'];
								$total += $subtotal;
							@endphp

						<tr>
							<td class="cart_product">
								<img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width = "90" alt="{{$cart['product_name']}}" />
							</td>
							
							<td class="cart_description">
								<h4><a href=""></a></h4>
								<p>{{$cart['product_name']}}</p>
							</td>
							
							<td class="cart_price">
								<p>{{number_format($cart['product_price'],0,',','.')}} đ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									
									
										{{ csrf_field() }}
									<input class="cart_quantity" type="number" name="cart_qty[{{$cart['session_id']}}]" min="1"value="{{$cart['product_qty']}}" style="width: 50px">

									
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									{{number_format($subtotal,0,',','.')}} đ
								</p>
							</td>
							<td class="cart_delete">
								<a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" class="cart_quantity_delete" href="{{URL::to('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
						<tr>
							<td>
								<!-- <td> -->
									<div class="total_area" >
									<ul>
										<li>Tổng tiền: <span>{{number_format($total,0,',','.')}} đ</span></li>
										<li>Thuế <span>{{(Cart::tax()).' đ'}}</span></li>
										@if(Session::get('coupon'))
										<li>
												@foreach(Session::get('coupon') as $key =>$cou)
													@if($cou['coupon_condition']==1)
														Mã giảm giá:
														<span>{{$cou['coupon_number']}}%
															@php
																$total_coupon = ($total*$cou['coupon_number'])/100;
																echo '<li>Tổng tiền giảm: <span>'.number_format($total_coupon,0,',','.').' đ</span></li>';
															@endphp
														</span>
														<li>Thành tiền: <span>{{number_format($total-$total_coupon,0,',','.')}} đ</span></li>
													@elseif($cou['coupon_condition']==2)
														Mã giảm giá:
														<span>{{number_format($cou['coupon_number'],0,',','.')}} đ
															@php
																$total_coupon = $cou['coupon_number'];
																echo '<li>Tổng tiền giảm: <span>'.number_format($total_coupon,0,',','.').' đ</span></li>';
															@endphp
														</span>
														<li>Thành tiền: <span>{{number_format($total-$total_coupon,0,',','.')}} đ</span></li>
												 	@endif		
												@endforeach
											
										</li>
										@endif
										<!-- <li>Phí ship <span>Miễn phí</span></li> -->
										<!-- <li>Thành tiền <span>{{(Cart::total()).' VNĐ'}}</span></li> -->
									</ul>
									</div>
								<!-- </td> -->
							</td>

						</tr>
						@else
						<tr>
							<td colspan="5"><center>
							@php
								echo 'Vui lòng thêm sản phẩm vào giỏ hàng';
							@endphp
							<center></td>
						</tr>
						@endif
					</tbody>
					
					</form>				
				</table>
				<div>
					<?php
						$customer_id = Session::get('customer_id');
					?>
					@if($customer_id!=NULL && Session::get('cart'))
						<a onclick="return confirm('Bạn có chắc muốn tiếp tục không?')" style="float: right; margin-right: 420px; height: 28px; margin-top:-120px" class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Tiếp tục</a>
					@elseif($customer_id==NULL)
						<a onclick="return confirm('Bạn có chắc muốn tiếp tục không?')" style="float: right; margin-right: 420px; height: 28px; margin-top:-120px" class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Tiếp tục</a>
					@endif
					@if(Session::get('cart'))
					<input onclick="return confirm('Bạn có chắc muốn cập nhật không?')" style=" float:right; margin-right: 250px; height: 28px; margin-top:-120px"class="btn btn-default btn-sm check_out" width ="50" type="submit" name="update_qty" value="Cập nhật giỏ hàng" >
					<a onclick="return confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng không?')" style="float: right; margin-right: 80px; height: 28px; margin-top:-120px" class="btn btn-default check_out" href="{{URL::to('/del-all-product')}}">Xóa giỏ hàng</a>
					@endif
				</div>
				@if(Session::get('cart'))
				<div>

					<form method="POST" action="{{url('/check-coupon')}}">
						@csrf
						@if(Session::get('coupon'))
						<a onclick="return confirm('Bạn có chắc muốn xóa mã giảm giá không?')" style ="margin-left: 730px;margin-top:-61px; margin-bottom: 5px"type="submit" class="btn btn-default check_out" name="check_coupon" href="{{URL::to('/unset-coupon')}}">Xóa mã</a>
						@endif
						<input style ="margin-left: 650px;margin-top:-100px; margin-bottom: 5px"type="submit" class="btn btn-default check_out" name="check_coupon" value="Tính">
						<input style="width: 180px; margin-top:-78px; margin-left:450px; "type="text" class="form-control" name="coupon"placeholder="Nhập mã giảm giá"><br>
						
					</form>
				</div>
				@endif
			</div>
	</section> <!--/#cart_items-->
	

@endsection