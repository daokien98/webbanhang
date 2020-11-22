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
				<p>Mời bạn điền thông tin gửi hàng trong form phía dưới!</p>
			</div><!--/register-req-->
			@endif
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12 clearfix" style="padding: 10px; margin-left: 200px">
						<div class="bill-to">
							@if(Session::get('cart'))
							<p>Thông tin gửi hàng</p>
							<div class="form-one">
								<form>
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Chọn Thành Phố</label>
                                    <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                        <option value="">---Chọn Thành Phố---</option>
                                        @foreach ($city as $key => $ci)
                                            <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Chọn Quận/Huyện</label>
                                    <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                        <option value="">---Chọn Quận/Huyện---</option>

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">*Chọn Xã/Phường</label>
                                    <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                        <option value="">---Chọn Xã/Phường---</option>
                                    </select>
                                </div>
                                <input style=""class="btn btn-default btn-primary calculate_delivery" width ="50" type="button" name="calculate_order" value="Tính phí vận chuyển" >
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
								@if(Session::get('cart') && $total_after > 0)
								<a onclick="return confirm('Bạn có chắc muốn đặt hàng không?')" style="float: right; margin-right: 420px; height: 28px; margin-top:-120px" class="btn btn-default check_out" href="{{URL::to('/infor-order')}}">Đặt hàng</a>
								<input style=" float:right; margin-right: 250px; height: 28px; margin-top:-120px"class="btn btn-default btn-sm check_out" width ="50" type="submit" name="update_qty" value="Cập nhật giỏ hàng" >
								<a style="float: right; margin-right: 80px; height: 28px; margin-top:-120px" class="btn btn-default check_out" href="{{URL::to('/del-all-product')}}">Xóa giỏ hàng</a>
								@else
									<input style=" float:right; margin-right: 100px; height: 28px; margin-top:-120px"class="btn btn-default btn-sm check_out" width ="50" type="button" name="update_qty" value="Không thể đặt hàng với mã giảm giá lớn hơn tổng số tiền" >
								@endif

							</div>
							@if(Session::get('cart'))
							<div>

								<form method="POST" action="{{url('/check-coupon')}}">
									@csrf
									@if(Session::get('coupon'))
									<a style ="margin-left: 730px;margin-top:-61px; margin-bottom: 5px"type="submit" class="btn btn-default check_out" name="check_coupon" href="{{URL::to('/unset-coupon')}}">Xóa mã</a>
									@endif
									<input style ="margin-left: 650px;margin-top:-100px; margin-bottom: 5px"type="submit" class="btn btn-default check_out" name="check_coupon" value="Nhập">
									<input style="width: 180px; margin-top:-78px; margin-left:450px; "type="text" class="form-control" name="coupon"placeholder="Nhập mã giảm giá"><br>
									
								</form>
							</div>
							@endif
					</div>				
				</div>
			</div>
		</div>
		<!-- </div> -->
	</section> <!--/#cart_items-->
@endsection