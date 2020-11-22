@extends('admin_layout')
@section('admin_content')
<style type="text/css">
  p.title_thongke{
    text-align: center;
    font-size: 20px;
    font-weight: bold;
  }
</style>
	<div class="row">
   <p class="title_thongke">Thống kê doanh số bán hàng</p>
   <form autocomplete="off">
      @csrf
      <div class="col-md-2">
        Từ:<input type="text" id="datepicker" class="form-control" name="date_from" placeholder="Input Field">
        <button type="button" id="btn-filter" class="btn btn-primary">Lọc kết quả</button>
      </div>
      <div class="col-md-2">
        Đến:<input type="text" id="datepicker2" class="form-control" name="date_to" placeholder="Input Field">
      </div>
      <div class="col-md-2">
        <p>Lọc theo:
          <select class="filter-for form-control">
            <option>---Chọn---</option>
            <option value="thang9">Tháng 9</option>
            <option value="7ngay">7 ngày qua</option>
            <option value="thangtruoc">Tháng trước</option>
            <option value="thangnay">Tháng này</option>
            <option value="365ngay">365 ngày qua</option>
          </select>
        </p>
      </div>
   </form> 
  </div>
  <br><br>
  <div class="col-md-8 floatcharts_w3layouts_left" style="margin-left:-12px;width: 1010px">
        <div class="floatcharts_w3layouts_top">
          <div class="floatcharts_w3layouts_bottom">
            <div id="chart"></div>
            <script>
           var chart = new Morris.Bar({
              element: 'chart',
              lineColors: ['#a8328e','#61a1ce','#ce8f61','#4842f5'],
              parseTime: false,//hiển thị ngày giờ 
              hideHover:'auto',
              xkey: 'period',
              ykeys: ['order','sales','profit','quantity'],
              labels: ['Số đơn hàng','Doanh thu','Lợi nhuận','Số lượng bán']
            });
            </script>

          </div>
        </div>
      </div>
      <!-- Truy cập -->
<p class="title_thongke">Thống kê truy cập</p>
<div class="market-updates">
      <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-2">
          <div class="col-md-4 market-update-right">
            <i class="fa fa-eye"> </i>
          </div>
           <div class="col-md-10 market-update-left">
           <h4>Đang online</h4>
          <h3>{{$visitors_count}}</h3>
          <p>Cập nhật theo thời gian thực</p>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
      <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-1">
          <div class="col-md-4 market-update-right">
            <i class="fa fa-eye" ></i>
          </div>
          <div class="col-md-10 market-update-left">
          <h4>Tháng trước</h4>
            <h3>{{$visitor_last_month_count}}</h3>
            <p>Cập nhật theo thời gian thực</p>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
      <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-3">
          <div class="col-md-4 market-update-right">
            <a href=""><i class="fa fa-eye"></i></a>
          </div>
          <div class="col-md-10 market-update-left">
            <h4>Tháng này</h4>
            <h3>{{$visitor_this_month_count}}</h3>
            <p>Cập nhật theo thời gian thực</p>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
      <div class="col-md-3 market-update-gd">
        <div class="market-update-block clr-block-4">
          <div class="col-md-4 market-update-right">
            <a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>
          </div>
          <div class="col-md-10 market-update-left">
            <h4>Tổng truy cập</h4>
            <h3>{{$all_visitors_count}}</h3>
            <p>Cập nhật theo thời gian thực</p>
          </div>
          <div class="clearfix"> </div>
        </div>
      </div>
       <div class="clearfix"> </div>
    </div>  
    <!-- End truy cập -->
    <!-- Donut -->
    <div>
    <div class="col-md-4 col-xs-12">
        <div class="chart_agile_top">
          <div class="chart_agile_bottom">
            <header class="agileits-box-header clearfix">
              <h3>Thống kê sản phẩm - bài viết - khách hàng</h3>
            </header>
            <div id="graph4" style="height: 300px" ></div>
            <script>
              Morris.Donut({
                element: 'graph4',
                resize: true,
                colors :[
                  '#a8328e',
                  '#61a1ce',
                  '#ce8f61',
                  '#4842f5'
                ],
                data: [
                {value: {!!$product!!}, label: 'Sản phẩm' },
                {value: {!!$post!!}, label: 'Bài viết'},
                {value: {!!$order!!}, label: 'Đơn hàng'},
                {value: {!!$customer!!}, label: 'Khách hàng'}
                ],
              });
            </script>
          </div>
        </div>
      </div>
    <!-- End Donut -->
    <!-- Post View -->
    <div class="col-md-4 col-xs-12">
      <style type="text/css">
        ol.list_views{
          margin: 10px 0;
          color: #fff;
        }
        ol.list_views a{
          color: orange;
          font-weight: 400;
        }
      </style>
      <h3>Bài viết xem nhiều</h3>
      <ol class="list_views">
        @foreach($post_views as $key => $post)
        <li>
          <a target="_blank" href="{{url('/bai-viet/'.$post->post_slug)}}">{{$post->post_title}} | <span style="color: black">{{$post->post_views}}</span></a>
        </li>
        @endforeach
      </ol>
    </div>
    <!-- Product views -->
    <div class="col-md-4 col-xs-12">
      <h3>Sản phẩm xem nhiều</h3>
      <ol class="list_views">
        @foreach($product_views as $key => $pro)
        <li>
          <a target="_blank" href="{{url('/chi-tiet-san-pham/'.$pro->product_id)}}">{{$pro->product_name}} | <span style="color: black">{{$pro->product_views}}</span></a>
        </li>
        @endforeach
      </ol>
    </div>
  </div>




<script type="text/javascript">
  $(function() {
    $("#datepicker").datepicker({
        prevText:"Tháng trước",
        nextText:"Tháng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ Nhật"],
        monthNames:["Tháng 1","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10","Tháng 11","Tháng 12"],
        duration: "slow"
    });

    $("#datepicker2").datepicker({
        prevText:"Tháng trước",
        nextText:"Tháng sau",
        dateFormat:"yy-mm-dd",
        dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ Nhật"],
        monthNames:["Tháng 1","Tháng 2","Tháng 3","Tháng 4","Tháng 5","Tháng 6","Tháng 7","Tháng 8","Tháng 9","Tháng 10","Tháng 11","Tháng 12"],
        duration: "slow"
    });
  });
  </script>
@endsection