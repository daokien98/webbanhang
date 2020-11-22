@extends('layout')
@section('content')
	<section id="cart_items">
		<!-- <div class="container"> -->
			<div class="breadcrumbs">
				  <ol class="breadcrumb">

				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>	

			@if(Session::get('cart'))
			<div class="register-req">
				<p>Mời bạn điền thông tin gửi hàng chi tiết trong form phía dưới!</p>
			</div><!--/register-req-->
			@endif
			<div class="shopper-informations">
					<div class="col-sm-12 clearfix" style="padding: 10px; margin-left: 200px">
						<div class="bill-to">
							@if(Session::get('cart'))
							<p>Thông tin gửi hàng chi tiết</p>
							<div class="form-one">
								<form method="POST">
									@csrf
									@foreach($info_customer as $key => $val)
									<input type="text" data-validation="email" data-validation-error-msg="Vui lòng điền đúng định dạng email"name="shipping_email" class= "shipping_email" value="{{$val->customer_email}}">
									<input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Vui lòng điền ít nhất 3 ký tự" name="shipping_name" class= "shipping_name" value="{{$val->customer_name}}">
									<input type="text" data-validation="length" data-validation-length="min3" data-validation-error-msg="Vui lòng điền ít nhất 3 ký tự" name="shipping_address" class= "shipping_address" value="{{$val->customer_address}}">
									<input type="text" data-validation="length" data-validation-length="min10" data-validation-error-msg="Vui lòng điền ít nhất 10 ký tự" name="shipping_phone" class= "shipping_phone" value="{{$val->customer_phone}}">
									@endforeach
									<textarea name="shipping_note" class= "shipping_note" placeholder="Ghi chú đơn hàng" rows="5"></textarea>	
									
									@if(Session::get('fee'))						
										<input type="hidden" name="order_fee" class= "order_fee" value="{{Session::get('fee')}}">
									@else
										<input type="hidden" name="order_fee" class= "order_fee" value="20000">
									@endif

									@if(Session::get('coupon'))		
										@foreach(Session::get('coupon') as $key => $cou)				
										<input type="hidden" name="order_coupon" class= "order_coupon" value="{{$cou['coupon_code']}}">
										@endforeach
									@else
										<input type="hidden" name="order_coupon" class= "order_coupon" value="No">
									@endif
							<div class="payment_option">
								<div class="form-group">
                                    <label for="exampleInputPassword1">*Chọn hình thức thanh toán</label>
                                    <select name="payment_select" class="form-control input-sm m-bot15 payment_select">
                                        <option value="0">Chuyển khoản</option>
                                        <option value="1">Thanh toán trực tiếp</option>
                                    </select>
                                </div>
                                
						</div>
								
							<input type="button" class="btn btn-default btn-primary send_order" width ="50" name="send_order" value="Xác nhận đơn hàng" >
							</form>	
							@endif		
							</div>
						</div>
					</div>
					<div class="col-sm-12 clearfix">
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
											<a class="cart_quantity_delete" href="{{URL::to('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
										</td>
									</tr>
									@endforeach
									<tr>
										<td>
											<!-- <td> -->
												<div class="total_area" >
												<ul>
													<li>Tổng cộng: <span>{{number_format($total,0,',','.')}} đ</span></li>
													<!-- <li>Thuế <span>{{(Cart::tax()).' đ'}}</span></li> -->
													@if(Session::get('coupon'))
													<li>
															@foreach(Session::get('coupon') as $key =>$cou)
																@if($cou['coupon_condition']==1)
																	Mã giảm giá:
																	<span>{{$cou['coupon_number']}}%
																		@php
																			$total_coupon = ($total*$cou['coupon_number'])/100;
																			
																		@endphp
																	</span>
																	<span>
																		@php
																		$total_after_coupon = $total-$total_coupon;
																		@endphp
																	</span>
																@elseif($cou['coupon_condition']==2)
																	Mã giảm giá:
																	<span>{{number_format($cou['coupon_number'],0,',','.')}} đ
																		@php
																			$total_coupon = $cou['coupon_number'];
																			
																		@endphp
																	</span>
																	@php
																		$total_after_coupon =$total - $total_coupon;
																	@endphp
															 	@endif		
															@endforeach
														
													</li>
													@endif
													@if(Session::get('fee'))
													<li>
														<a class="cart_quantity_delete" href="{{URL::to('/del-fee')}}"><i class="fa fa-times"></i></a>
														Phí vận chuyển<span>{{number_format(Session::get('fee'),0,',','.')}} đ</span>
														<?php
															$total_after_fee = $total + Session::get('fee');
														?>
													</li>
													@endif
													<li>Thành tiền:
													<?php
														if(Session::get('fee') && !Session::get('coupon')){
															$total_after = $total_after_fee;
															echo '<span>'.number_format($total_after,0,',','.').' đ</span>';
														}elseif(!Session::get('fee') && Session::get('coupon')){
															$total_after = $total_after_coupon;
															echo '<span>'.number_format($total_after,0,',','.').' đ</span>';
														}elseif(Session::get('fee') && Session::get('coupon')){
															$total_after = $total_after_coupon;
															$total_after = $total_after - Session::get('fee');
															echo '<span>'.number_format($total_after,0,',','.').' đ</span>';
														}elseif(!Session::get('fee') && !Session::get('coupon')){
															$total_after = $total;
															echo '<span>'.number_format($total_after,0,',','.').' đ</span>';
														}
													?>
													
													</li>
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
								<!-- <input style=" float:right; margin-right: 250px; height: 28px; margin-top:-120px"class="btn btn-default btn-sm check_out" width ="50" type="submit" name="update_qty" value="Cập nhật giỏ hàng" > -->
								@if(Session::get('cart'))
								<a style="float: right; margin-right: 80px; height: 28px; margin-top:-120px" class="btn btn-default check_out" onclick="return confirm('Bạn có chắc muốn xóa giỏ hàng này không?')" href="{{URL::to('/del-all-product')}}">Xóa giỏ hàng</a>
								@endif
							</div>
							@if(Session::get('cart'))
							<div>

								<!-- <form method="POST" action="{{url('/check-coupon')}}">
									@csrf
									@if(Session::get('coupon'))
									<a style ="margin-left: 730px;margin-top:-61px; margin-bottom: 5px"type="submit" class="btn btn-default check_out" name="check_coupon" href="{{URL::to('/unset-coupon')}}">Xóa mã</a>
									@endif
									<input style ="margin-left: 650px;margin-top:-100px; margin-bottom: 5px"type="submit" class="btn btn-default check_out" name="check_coupon" value="Tính">
									<input style="width: 180px; margin-top:-78px; margin-left:450px; "type="text" class="form-control" name="coupon"placeholder="Nhập mã giảm giá"><br>
									
								</form> -->
							</div>
							@endif
					</div>				
				</div>
			</div>
		</div>
		<!-- </div> -->
	</section> <!--/#cart_items-->
@endsection