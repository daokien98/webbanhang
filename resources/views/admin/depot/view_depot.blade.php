@extends('admin_layout')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/jquery.dataTables.min.css')}}">
<script type="text/javascript" charset="utf8" src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Kho hàng 
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="DepotTable">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên sản phẩm</th>
            <th>Trạng thái</th>
            <th>Số lượng đã bán</th>
            <th>Số lượng trong kho</th>
            <th>Số lượng nhập gần nhất</th>
            <th>Lần nhập gần nhất</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i=0;
          @endphp
          @foreach($all_product as $key => $pro)
          @php
            $i++;
          @endphp
          <tr>
            <td>{{$i}}</td>
            <td>{{$pro->product_name}}</td>
            @if($pro->product_sold<$pro->product_quantity)
              <td style="font-weight: bold;color: green">{!!$pro->product_status!!}</td>
            @else
              <td style="font-weight: bold;color: red">Hết hàng</td>
            @endif
            <td>{{$pro->product_sold}}</td>
            <td>{{$pro->product_quantity}}</td>
            <td>{{$pro->product_depot}}</td>
            <td>{{$pro->product_depot_time}}</td>
            <td>
              <a href="{{URL::to('/import-depot/'.$pro->product_id)}}" class="btn btn-sm btn-success">Nhập kho</a>
              @if($pro->product_depot!=NULL)
              <a style="margin-top:10px; float: right" href="{{url('/print-depot/'.$pro->product_id)}}" class="btn btn-sm btn-info">In phiếu nhập kho</a>
              @endif
            </td>
            
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
            $('#DepotTable').DataTable();
</script>
@endsection