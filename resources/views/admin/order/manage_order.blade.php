@extends('admin_layout')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/jquery.dataTables.min.css')}}">
<script type="text/javascript" charset="utf8" src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
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
      <table class="table table-striped b-t b-light" id="OrderTable">
        <thead>
          <tr>
            <th>Thứ tự</th>
            <th>Mã đơn hàng</th>
            <th>Ngày đặt hàng</th>
            <th>Tình trạng đơn hàng</th>
            <th>Tổng doanh thu</th>
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
            <td>@if($ord->order_status==1)
                    Đơn hàng mới
                @elseif($ord->order_status==2)
                    Đã giao hàng
                @else
                    Đơn hàng bị hủy bỏ
                @endif
            </td>
            <td>
              @if($ord->total_order!=NULL)
                {{number_format($ord->total_order,0,',','.')}} đ
              @else
                Chưa xác nhận số tiền
              @endif
            </td>
            <td>
              <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active" ui-toggle-class=""><i class="fa fa-eye text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này không?')" href="{{URL::to('/delete-order/'.$ord->order
                )}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
            $('#OrderTable').DataTable();
</script>
@endsection