@extends('admin_layout')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/jquery.dataTables.min.css')}}">
<script type="text/javascript" charset="utf8" src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
    </div>
    
    <div class="table-responsive">
      <table id="ProductTable" class="table table-striped b-t b-light" >
        <thead>
          <tr>
            <th>Số thứ tự</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Thư viện ảnh</th>
            <th>Đơn vị tính</th>
            <th>Giá bán</th>
            <th>Giá gốc</th>
            <th>Mô tả</th>
            <th>Hình ảnh</th>
            <th>Tình trạng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i=0;
          @endphp
          @foreach($all_product as $key => $product_pro)
          @php
            $i++;
          @endphp
          <tr>
            <td>{{$i}}</td>
            <td>{{ $product_pro->product_name}}</td>
            <td>{{ $product_pro->product_quantity}}</td>
            <td><a href="{{url('add-gallery/'.$product_pro->product_id)}}">Thêm thư viện ảnh</a></td>
            <td>{{ $product_pro->product_note}}</td>
            <td>{{number_format($product_pro->product_price,0,',','.')}} VNĐ</td>
            <td>{{number_format($product_pro->product_cost,0,',','.')}} VNĐ</td>
            <td>{!! $product_pro->product_content!!}</td>
            <td>
            <img src="{{URL::to('./public/uploads/product/'.$product_pro->product_image)}}" height="100"
            width="100"/>
            </td>
            <td>{{ $product_pro->product_status}}</td>
            <td>
              <a href="{{URL::to('/edit-product/'.$product_pro->product_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" href="{{URL::to('/delete-product/'.$product_pro->product_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>   
  </div>
</div>

<script type="text/javascript">
            $('#ProductTable').DataTable();
</script>
@endsection
