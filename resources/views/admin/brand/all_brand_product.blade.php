@extends('admin_layout')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/jquery.dataTables.min.css')}}">
<script type="text/javascript" charset="utf8" src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê danh mục sản phẩm
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="BrandTable">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên thương hiệu</th>
            <th>Mô tả</th>
            <th>Tình trạng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i=0;
          @endphp
          @foreach($all_brand_product as $key => $cate_pro)
          @php
            $i++;
          @endphp
          <tr>
            <td>{{$i}}</td>
            <td>{{$cate_pro->brand_name}}</td>
            <td>{!!$cate_pro->brand_desc!!}</td>
            <td>{{$cate_pro->brand_status}}</td>
            <td>
              <a href="{{URL::to('/edit-brand-product/'.$cate_pro->brand_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc muốn xóa thương hiệu này không?')" href="{{URL::to('/delete-brand-product/'.$cate_pro->brand_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>
</div>

<script type="text/javascript">
            $('#BrandTable').DataTable();
</script>
@endsection