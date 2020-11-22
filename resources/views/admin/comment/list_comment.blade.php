@extends('admin_layout')
@section('admin_content')
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/jquery.dataTables.min.css')}}">
<script type="text/javascript" charset="utf8" src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách bình luận
    </div>
    <div id="notify_comment"></div>
    <div class="table-responsive">
      <table id="myTable" class="table table-striped b-t b-light" >
        <thead>
          <tr>
            <th>Duyệt</th>
            <th>Nickname</th>
            <th>Bình luận</th>
            <th>Ngày gửi</th>
            <th>Sản phẩm</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($comment as $key => $comm)
          <tr>
            <td>
              @if($comm->comment_status==1)
                <input type="button" data-comment_status="0" data-comment_id="{{$comm->comment_id}}"id="{{$comm->comment_product_id}}" class="btn btn-xs btn-primary comment_accept_btn" value="Duyệt">
              @else
                <input type="button" data-comment_status="1" data-comment_id="{{$comm->comment_id}}"id="{{$comm->comment_product_id}}" class="btn btn-xs btn-danger comment_accept_btn" value="Bỏ duyệt">
              @endif
            </td>
            <td style=" color: blue">{{ $comm->comment_name}}</td>
            <td style="color: green">{!! $comm->comment!!}
              <ul>
              Trả lời:
                @foreach($comment_rep as $key => $comm_reply)
                  @if($comm_reply->comment_parent_comment==$comm->comment_id)
                  <li style="list-style-type: decimal; color: red; margin: 5px 40px"> {{$comm_reply->comment}} <a onclick="return confirm('Bạn có chắc muốn xóa bình luận này không?')" href="{{URL::to('/delete-admin-comment/'.$comm_reply->comment_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a></li>
                  @endif
                @endforeach
              </ul>

              @if($comm->comment_status==0)
                <br><textarea row="5" class="form-control reply_comment_{{$comm->comment_id}}"></textarea>
                <br><button class="btn btn-sm btn-success btn-reply-comment" data-product_id="{{$comm->comment_product_id}}" data-comment_id="{{$comm->comment_id}}">Trả lời</button>
                
              @endif
              
            </td>           
            <td>{{ $comm->comment_date}}</td>
            <td><a href="{{url('/chi-tiet/'.$comm->product->product_id)}}" target="_blank">{{ $comm->product->product_name}}</a></td>

            <td>
              
              <a onclick="return confirm('Bạn có chắc muốn xóa bình luận này không?')" href="{{URL::to('/delete-comment/'.$comm->comment_product_id)}}" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>   
  </div>
</div>
@endsection
