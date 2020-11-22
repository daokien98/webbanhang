@extends('admin_layout')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/jquery.dataTables.min.css')}}">
<script type="text/javascript" charset="utf8" src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh mục bài viết
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="CatePostTable">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên danh mục</th>
            <th>Slug</th>
            <th>Mô tả danh mục</th>
            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i=0;
          @endphp
          @foreach($category_post as $key => $cate_post)
          @php
            $i++;
          @endphp
          <tr>
            <td>{{$i}}</td>
            <td>{{$cate_post->cate_post_name}}</td>
            <td>{{$cate_post->cate_post_slug }}</td>
            <td>{!!$cate_post->cate_post_desc!!}</td>
            <td>
                @if($cate_post->cate_post_status==0)
                  Hiển thị
                @else
                  Ẩn danh mục
                @endif
            </td>
            <td>
              <a href="{{URL::to('/edit-category-post/'.$cate_post->cate_post_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc muốn xóa danh mục này không?')" href="{{URL::to('/delete-category-post/'.$cate_post->cate_post_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
            $('#CatePostTable').DataTable();
</script>
@endsection