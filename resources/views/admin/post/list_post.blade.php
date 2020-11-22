@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách bài viết
    </div>
    
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="PostTable">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên bài viết</th>
            <th>Hình ảnh</th>
            <th>Slug</th>
            <th>Mô tả bài viết</th>
            <th>Từ khóa bài viết</th>
            <th>Danh mục bài viết</th>
            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
            $i=0;
          @endphp
          @foreach($all_post as $key => $post)
          @php
            $i++;
          @endphp
          <tr>
            <td>{{$i}}</td>
            <td>{{ $post->post_title}}</td>
            <td>
              <img src="{{URL::to('./public/uploads/post/'.$post->post_image)}}" height="100"
              width="100"/>
            </td>
            <td>{{ $post->post_slug}}</td>
            <td>{!! $post->post_desc!!}</td>
            <td>{{ $post->post_meta_keywords}}</td>
            <td style= "color: red">{{ $post->cate_post->cate_post_name}}</td>
            <td>
                @if($post->post_status==0)
                  Hiển thị
                @else
                  Ẩn
                @endif
            </td>
            <td>
              <a href="{{URL::to('/edit-post/'.$post->post_id)}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc muốn xóa bài viết này không?')" href="{{URL::to('/delete-post/'.$post->post_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">Hiển thị 3 trên tổng số {{$count}} mục</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
           {!!$all_post->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>

<script type="text/javascript">
            $('#PostTable').DataTable();
</script>
@endsection