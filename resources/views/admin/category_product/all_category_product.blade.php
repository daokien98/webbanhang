@extends('admin_layout')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/jquery.dataTables.min.css')}}">
<script type="text/javascript" charset="utf8" src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê các danh mục
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="CateProTable">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên danh mục</th>
            <th>Thuộc</th>
            <th>Slug</th>
            <th>Tình trạng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i=0;
          @endphp
          @foreach($all_category_product as $key => $cate_pro)
          @php
            $i++;
          @endphp
          <tr>
            <td>{{$i}}</td>
            <td>{{ $cate_pro->category_name}}</td>
            <td>
              @if($cate_pro->category_parent==0)
                <span style="color: red;">Danh mục cha</span>
              @else
                @foreach($category_product as $key => $cate_sub_pro)
                  @if($cate_sub_pro->category_id == $cate_pro->category_parent)
                    <span style="color: green;">{{$cate_sub_pro->category_name}}</span>
                  @endif
                @endforeach
              @endif
            </td>
            <td>{{ $cate_pro->slug_category_product }}</td>
            <td>{{ $cate_pro->category_producer}}</td>
            <td>
              <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?')" href="{{URL::to('/delete-category-product/'.$cate_pro->category_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
            $('#CateProTable').DataTable();
</script>
@endsection