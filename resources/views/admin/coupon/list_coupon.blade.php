@extends('admin_layout')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/jquery.dataTables.min.css')}}">
<script type="text/javascript" charset="utf8" src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê mã giảm giá
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="CouponTable">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên mã giảm giá</th>
            <th>Mã giảm giá</th>
            <th>Số lượng</th>
            <th>Tính năng</th>
            <th>Số giảm</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i=0;
          @endphp
          @foreach($coupon as $key => $cou)
          @php
            $i++;
          @endphp
          <tr>
            <td>{{$i}}</td>
            <td>{{$cou->coupon_name}}</td>
            <td>{{$cou->coupon_code}}</td>
            <td>{{$cou->coupon_time}}</td>
            <td> <span class="text-ellipsis">
              <?php 
                if($cou->coupon_condition==1){
              ?>
                Giảm theo phần trăm
              <?php
                }else{
              ?>
                Giảm theo số tiền
              <?php
               }
              ?>
            </span></td>
            <td> <span class="text-ellipsis">
              <?php 
                if($cou->coupon_condition==1){
              ?>
                Giảm {{$cou->coupon_number}} %
              <?php
                }else{
              ?>
                Giảm {{$cou->coupon_number}} đ
              <?php
               }
              ?>
            </span></td>
            <td>
              <a onclick="return confirm('Bạn có chắc muốn xóa mã giảm giá này không?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
            $('#CouponTable').DataTable();
</script>
@endsection