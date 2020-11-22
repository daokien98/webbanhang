@extends('admin_layout')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/jquery.dataTables.min.css')}}">
<script type="text/javascript" charset="utf8" src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách banner
    </div>

      <table class="table table-striped b-t b-light" id="BannerTable">
        @php
          $i=0;
        @endphp
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên banner</th>
            <th>Hình ảnh</th>
            <th>Mô tả</th>
            <th>Tình trạng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_banner as $key => $banner)
            @php
              $i++;
            @endphp
          <tr>
            <td>{{$i}}</td>
            <td>{{$banner->banner_name}}</td>
            <td><img src="{{URL::to('./public/uploads/banner/'.$banner->banner_image)}}" height="120"
            width="500"/></td>
            <td>{!!$banner->banner_desc!!}</td>
            <td><span class="text-ellipsis">
              <?php
                if($banner->banner_status==1){
              ?>
                  <a href="{{URL::to('/unactive-banner/'.$banner->banner_id)}}"><span class="fa-thumb-styling fa fa-thumbs-up"></span></a>
              <?php
              }else{
              ?>
                  <a href="{{URL::to('/active-banner/'.$banner->banner_id)}}"><span class="fa-thumb-styling fa fa-thumbs-down"></span></a>
              <?php
                }
              ?>
            </span></td>
            <td>
              <a onclick="return confirm('Bạn có chắc muốn xóa banner này không?')" href="{{URL::to('/delete-banner/'.$banner->banner_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
            $('#BannerTable').DataTable();
</script>
@endsection