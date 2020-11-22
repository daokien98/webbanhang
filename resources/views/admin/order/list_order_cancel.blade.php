@extends('admin_layout')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/jquery.dataTables.min.css')}}">
<script type="text/javascript" charset="utf8" src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Đơn hàng bị hủy bỏ
    </div>
    <form action="{{url('order-date')}}" method="GET" class="form-inline" role="form">
      <div class="form-group">
        <input type="date" class="form-control" name="date_from" placeholder="Input Field">
      </div>
      <div class="form-group">
        <input type="date" class="form-control" name="date_to" placeholder="Input Field">
      </div>
      <button type="submit" class="btn btn-primary">Thống kê</button>
    </form>
    <div class="row w3-res-tb">  
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="OrderCanTable">
        <thead>
          <tr>
            <th>Thứ tự</th>
            <th>Mã đơn hàng</th>
            <th>Ngày đặt hàng</th>
            <th>Tình trạng đơn hàng</th>
            <th>Lý do hủy bỏ</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i = 0;
          @endphp
          @foreach($order as $key => $ord)
            @php
              $i++;
            @endphp
          <tr>
            <td><label><i>{{$i}}</i></label></td>
            <td>{{$ord->order_code}}</td>
            <td>{{$ord->created_at}}</td>
            <td>Đơn hàng bị hủy</td>
            <td>{!!$ord->cancel_reason!!}</td>   
            <td>
              <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="btn btn-sm btn-success">Xem chi tiết</a>
              <a style="margin-top:10px; float: right" href="{{url('/print-cancel-order/'.$ord->order_code)}}" class="btn btn-sm btn-info">In phiếu hủy bỏ</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
            $('#OrderCanTable').DataTable();
</script>
@endsection