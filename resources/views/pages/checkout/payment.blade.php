@extends('layout')
@section('content')
	<section id="cart_items">
			<div class="breadcrumbs">
				  <ol class="breadcrumb">

				  <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div>

			<div>
				<h3>Xem lại giỏ hàng</h3>
			</div>

			<div class="table-responsive cart_info">
				<?php
				$content = Cart::content();
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description">Mô tả</td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>

						@foreach($content as $key => $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('/public/uploads/product/'.basename($v_content->options->image))}}" width = "50" alt="" /></a>
							</td>
							
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							
							<td class="cart_price">
								<p>{{number_format($v_content->price).' vnđ'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									
									<form action="{{URL::to('/update-cart-quantity')}}" method="POST">
										{{ csrf_field() }}
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}" style="width: 50px">
									<input class="form-control" width ="50" type="hidden" name="rowId_cart" value="{{$v_content->rowId}}" >
									<input style="margin-left: 10px; height: 28px "class="btn btn-default btn-sm" width ="50" type="submit" name="update_qty" value="Cập nhật" >
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
									<?php
										$subtotal = $v_content->price * $v_content->qty;
										echo number_format($subtotal).' VNĐ';
									?>
								</p>
							</td>
							<td class="cart_delete">
								<a onclick="return confirm('Bạn có chắc muốn xóa giỏ hàng này không?')" class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>

							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
	<!--/#cart_items-->

			<h4 style="margin: 40px 0; font-size: 20px">Chọn hình thức thanh toán</h4>
			<form action="{{URL::to('/order-place')}}" method="POST">
					{{ csrf_field()  }}
				<div class="payment-options">			
					<span>
						<label><input name="payment_option" value="1" type="checkbox"> Sử dụng thẻ ngân hàng</label>
					</span>
					<span>
						<label><input name="payment_option" value="2" type="checkbox"> Trả tiền mặt (khi giao hàng)</label>
					</span>
					<span>
						<label><input name="payment_option" value="3" type="checkbox"> Sử dụng ví điện tử</label>
					</span>
					<input style="margin-top: 0px" type="submit" class="btn btn-default btn-primary" width ="50" name="send_order_place" value="Đặt hàng" >
				</div>
			</form>
	
	
@endsection