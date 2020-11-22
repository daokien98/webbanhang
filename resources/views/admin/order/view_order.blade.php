@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin khách hàng
    </div>
 
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            </th>
            <th>Tên khách hàng</th>
            <th>Email</th>
            <th>Số điện thoại</th>
          </tr>
        </thead>
        <tbody>
      
          <tr>
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_email}}</td>
            <td>{{$customer->customer_phone}}</td>

          </tr>

        </tbody>
      </table>
    </div>
    
  </div>
</div>
<br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển
    </div>
 
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>

            <th>Tên người vận chuyển</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Ghi chú</th>
            <th>Hình thức thanh toán</th>
          </tr>
        </thead>
        <tbody>
      
          <tr>
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>{{$shipping->shipping_email}}</td>
            <td>{{$shipping->shipping_note}}</td>
            <td>@if($shipping->shipping_method==0)
                    Chuyển khoản
                @else
                    Thanh toán tiền mặt
                @endif
            </td>
          </tr>

        </tbody>
      </table>
    </div>
    
  </div>
</div>
<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê chi tiết đơn hàng
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Thứ tự</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng(kho)</th>
            <th>Mã giảm giá</th>
            <th>Số lượng</th>
            <th>Giá gốc</th>
            <th>Giá bán</th>
            <th>Phí ship</th>
            <th>Tổng tiền</th>
          </tr>
        </thead>
        <tbody>
        @php
          $i = 0;
          $total = 0;
        @endphp
        @foreach($order_details as $key => $details)
          @php
            $i++;
            $subtotal = $details->product_price*$details->product_sales_quantity;
            $total += $subtotal; 
          @endphp
          <tr class="color_qty_{{$details->product_id}}">
            <td><label><i>{{$i}}</i></label></td>
            <td>{{$details->product_name}}</td>
            <td>{{$details->product->product_quantity}}</td>
            <td>@if($details->product_coupon!='no')
                  {{$details->product_coupon}}
                @else
                  Không
                @endif
            </td>
            <td>
              @if($order_status==1)
              <input type="number" min="1" class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_quantity}}" name="product_sales_quantity">
              @elseif($order_status!=1)
              <input type="number" min="1" disabled class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_quantity}}" name="product_sales_quantity">
              @endif
              <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">

              <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">

              <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">
              @if($order_status!=2 && $order_status!=3)
              <button class="btn btn-default update_quantity_order" data-product_id ="{{$details->product_id}}" name="update_quantity_order">Cập nhật</button>
              @endif
            </td>
            <td>{{number_format($details->product->product_cost,0,',','.')}}đ</td>
            <td>{{number_format($details->product_price,0,',','.')}}đ</td>
            <td>{{number_format($details->product_fee,0,',','.')}}đ</td>
            <td>{{number_format($details->product_price*$details->product_sales_quantity,0,',','.')}}đ</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="3">
                @php
                  $total_coupon = 0;
                @endphp
                @if($coupon_condition==1)
                    @php
                    $total_after_coupon = ($total*$coupon_number)/100;
                    echo 'Tổng giảm: '.number_format($total_after_coupon,0,',','.').'đ'.'<br>';
                    $total_coupon = $total - $total_after_coupon + $details->product_fee;  
                    @endphp
                @else
                    @php
                    echo 'Tổng giảm: '.number_format($coupon_number,0,',','.').'đ'.'<br>';
                    $total_coupon = $total - $coupon_number + $details->product_fee;
                    @endphp
                @endif
                Phí ship: {{number_format($details->product_fee,0,',','.')}}đ<br>
                Thanh toán: {{number_format($total_coupon,0,',','.')}}đ
                
            <td>
          </tr>
          <tr>
            <td colspan="5">
              @foreach($order as $key =>$or)
                @if($or->order_status == 1)
                  <form>
                    @csrf
                    <select style="width: 500px"class="form-control order_details">
                      <option value="" >---Chọn hình thức---</option>
                      <option id="{{$or->order_id}}" selected value="1" >Chưa xử lý</option>
                      <option id="{{$or->order_id}}" value="2" >Đã giao hàng</option>
                      <option id="{{$or->order_id}}" value="3">Hủy đơn hàng</option>
                    </select> 
                  </form>
              @elseif($or->order_status == 2)
                  <form>
                    @csrf
                    <select style="width: 500px"class="form-control order_details">
                      <option value="" >---Chọn hình thức---</option>
                      <option disabled id="{{$or->order_id}}" value="1" >Chưa xử lý</option>
                      <option id="{{$or->order_id}}" selected value="2">Đã giao hàng</option>
                      <option disabled id="{{$or->order_id}}" value="3">Hủy đơn hàng</option>
                    </select> 
                  </form>
              @else
                  <form>
                    @csrf
                    <select style="width: 500px"class="form-control order_details">
                      <option value="" >---Chọn hình thức---</option>
                      <option disabled id="{{$or->order_id}}" value="1" >Chưa xử lý</option>
                      <option disabled id="{{$or->order_id}}" value="2">Đã giao hàng</option>
                      <option id="{{$or->order_id}}" selected value="3">Hủy đơn hàng</option>
                    </select> 
                  </form>
              @endif
              @endforeach
            </td>
          </tr>
        </tbody>
      </table>
      <a style="margin-top:-87px; margin-left: 700px"class="btn btn-sm btn-success" href="{{url('/print-order/'.$details->order_code)}}">In đơn hàng</a>
      <form action="{{URL::to('/update-sales-order/'.$order_get->order_id)}}" method ="post">
          {{csrf_field()}}
          <input type="hidden" name="total_order" value="{{$total_coupon}}">
          @if($order_get->order_status==2 && $order_get->total_order == NULL)
          <button style="margin-top: -132px;margin-left: 820px;" type="submit" class="btn btn-sm btn-success" name="update-sales-order">Nhận tiền</button>
          @endif
      </form>
      @if($order_get->order_status==3)
      <a style="margin-top: -50px; margin-left: 15px" href="{{url('/cancel-order/'.$details->order_code)}}" class="btn btn-sm btn-danger" href="#">Hủy đơn hàng</a>
      @endif
    </div>
  </div>
</div>

@endsection