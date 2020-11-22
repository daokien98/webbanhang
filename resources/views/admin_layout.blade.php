<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Trang quản lý ADMIN</title>
    
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}">
<!-- <meta name="csrf-token" content="&lt;input type=" hidden="" value="Ruple2PfyvaWZ07rXXEJjLDGt25sMPo12oTPS4ER"> -->
<meta name="csrf-token" content="{{csrf_token()}}">
<body style="">
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap-tagsinput.css')}}" type="text/css"/>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
<!-- datatables  -->
<link rel="stylesheet" type="text/css" href="{{asset('public/backend/css/jquery.dataTables.min.css')}}">
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script type="text/javascript" charset="utf8" src="{{asset('public/backend/js/jquery.dataTables.min.js')}}"></script>
<script src="http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backend/js/morris.js')}}"></script>
<script src="{{asset('public/backend/js/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{asset('public/backend/js/simple.money.format.js')}}"></script>
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="{{URL::to('/dashboard')}}" class="logo">
        QUẢN TRỊ 
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>

<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- settings start -->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-tasks"></i>
                <span class="badge bg-success">8</span>
            </a>
            <ul class="dropdown-menu extended tasks-bar">
                <li>
                    <p class="">Bạn có 8 nhiệm vụ chờ</p>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Tăng doanh thu bán hàng</h5>
                                <p>25% , Hạn cuối  22 tháng 12 năm 2020</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="30">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Vận chuyển đơn hàng</h5>
                                <p>45% , Hạn cuối  25 tháng 11 năm 2020</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="78">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Hoàn thiện hóa đơn</h5>
                                <p>87% , Hạn cuối  25 tháng 11 năm 2020</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="60">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="task-info clearfix">
                            <div class="desc pull-left">
                                <h5>Liên hệ nhà cung cấp</h5>
                                <p>33% , Hạn cuối  25 tháng 11 năm 2020</p>
                            </div>
                                    <span class="notification-pie-chart pull-right" data-percent="90">
                            <span class="percent"></span>
                            </span>
                        </div>
                    </a>
                </li>

                <li class="external">
                    <a href="#">Xem tất cả công việc</a>
                </li>
            </ul>
        </li>
        <!-- settings end -->
        <!-- inbox dropdown start-->
        <li id="header_inbox_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <i class="fa fa-envelope-o"></i>
                <span class="badge bg-important">4</span>
            </a>
            <ul class="dropdown-menu extended inbox">
                <li>
                    <p class="red">Bạn có 4 thư mới</p>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="{{asset('public/backend/images/kien.jpg')}}"></span>
                                <span class="subject">
                                <span class="from">Kiên Đào</span>
                                <span class="time">Vừa xong</span>
                                </span>
                                <span class="message">
                                    Chào ông nhé, hẹn gặp tuần sau!
                                </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="{{asset('public/backend/images/hai.jpg')}}"></span>
                                <span class="subject">
                                <span class="from">Thanh Hải</span>
                                <span class="time">2 phút trước</span>
                                </span>
                                <span class="message">
                                    Liên hệ tôi ngay nhé!
                                </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="{{asset('public/backend/images/1.png')}}"></span>
                                <span class="subject">
                                <span class="from">Minh Hoạt</span>
                                <span class="time">4 giờ trước</span>
                                </span>
                                <span class="message">
                                    Hoàn thiện website nhanh cho tôi.
                                </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="photo"><img alt="avatar" src="{{asset('public/backend/images/2.png')}}"></span>
                                <span class="subject">
                                <span class="from">Đoàn Hào</span>
                                <span class="time">2 ngày trước</span>
                                </span>
                                <span class="message">
                                    Em chuyển khoản cho anh ngay nhé!
                                </span>
                    </a>
                </li>
                <li>
                    <a href="#">Xem tất cả tin nhắn</a>
                </li>
            </ul>
        </li>
        <!-- inbox dropdown end -->
        <!-- notification dropdown start-->
        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                <i class="fa fa-bell-o"></i>
                <span class="badge bg-warning">3</span>
            </a>
            <ul class="dropdown-menu extended notification">
                <li>
                    <p>Thông báo</p>
                </li>
                <li>
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #1 đã hoàn thiện.</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-danger clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #2 đã hoàn thiện.</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="alert alert-success clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Server #3 đã hoàn thiện.</a>
                        </div>
                    </div>
                </li>

            </ul>
        </li>
        <!-- notification dropdown end -->
    </ul>
    <!--  notification end -->
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <!--<li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li> -->
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
				<img style="height: 38px" alt="" src="{{asset('public/backend/images/kien.jpg')}}">
                <span class="username">
    				<?php
        				$name = Auth::user()->admin_name;
        				if($name){
        				echo $name;
        				}
    				?>
				</span>
				
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="{{URL::to('/all-user')}}"><i class="fa fa-user"></i></i> Tài khoản admin</a></li>
                <li><a href="{{URL::to('/add-user')}}"><i class="fa fa-user-plus"></i> Thêm admin</a></li>
                <li><a href="{{URL::to('/')}}"><i class="fa fa-home"></i> Về trang chủ</a></li>
                <!-- <li><a href="{{URL::to('/admin-logout')}}"><i class="fa fa-key"></i> Đăng Xuất</a></li> -->
                <li><a href="{{URL::to('/logout-auth')}}"><i class="fa fa-key"></i> Đăng Xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng Quan</span>
                    </a>
                </li>
                @hasrole(['administrator'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-male"></i>
                        <span>Quản lý phân quyền</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-users')}}">Thêm tài khoản</a></li>
                    </ul>
                    <ul class="sub">
                        <li><a href="{{URL::to('/users')}}">Danh sách phân quyền</a></li>
                        
                    </ul>            
                </li>
                @endhasrole

                @hasrole(['administrator','manager'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-archive"></i>
                        <span>Báo cáo thống kê</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/overall-report')}}">Thống kê tổng quan</a></li>
                    </ul>
                    <ul class="sub">
                        <li><a href="{{URL::to('/product-report')}}">Thống kê hàng hóa</a></li>
                    </ul>
                    <ul class="sub">
                        <li><a href="{{URL::to('/order-report')}}">Thống kê đơn hàng</a></li>
                    </ul>
                    <ul class="sub">
                        <li><a href="{{URL::to('/income-report')}}">Thống kê doanh thu</a></li>
                    </ul>            
                </li>
                @endhasrole

                @hasrole(['administrator','editor'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-leaf"></i>
                        <span>Quản lý banner</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-banner')}}">Thêm banner</a></li>
                        
                    </ul>
                    <ul class="sub">
                        <li><a href="{{URL::to('/manage-banner')}}">Danh sách banner</a></li>
                        
                    </ul>  
                </li>
                @endhasrole

                @hasrole(['administrator','manager','accountant'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý đơn hàng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/manage-order')}}">Danh sách đơn hàng</a></li>    
                    </ul>
                    <ul class="sub">
                        <li><a href="{{URL::to('/list-order-cancel')}}">Đơn hàng hủy bỏ</a></li> 
                    </ul>
                    <ul class="sub">
                        <li><a href="{{URL::to('/delivery')}}">Quản lý phí vận chuyển</a></li> 
                    </ul>
                </li>
                @endhasrole

                @hasrole(['administrator','manager','accountant'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-home"></i>
                        <span>Quản lý kho hàng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/view-depot')}}">Kho hàng</a></li>              
                    </ul>
                    <ul class="sub">
                        <li><a href="{{URL::to('/delivery')}}">Quản lý phí vận chuyển</a></li>              
                    </ul>
                </li>
                @endhasrole

                <!-- @hasrole(['administrator','manager','accountant'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-money"></i>
                        <span>Quản lý phí vận chuyển</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/delivery')}}">Thêm phí vận chuyển</a></li>
                    </ul>
                </li>
                @endhasrole -->

                @hasrole(['administrator','manager','accountant'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-gift"></i>
                        <span>Quản lý mã giảm giá</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/insert-coupon')}}">Thêm mã giảm giá</a></li>
                        <li><a href="{{URL::to('/list-coupon')}}">Danh sách mã giảm giá</a></li>
                    </ul>
                </li>
                @endhasrole

                @hasrole(['administrator','manager'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-product-hunt"></i>
                        <span>Quản lý danh mục SP</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục</a></li>
						<li><a href="{{URL::to('/all-category-product')}}">Danh mục sản phẩm</a></li>
                    </ul>
                </li>
                @endhasrole

                @hasrole(['administrator','manager'])
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-shopping-bag"></i>
                        <span>Quản lý thương hiệu</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-brand-product')}}">Thêm thương hiệu sản phẩm</a></li>
						<li><a href="{{URL::to('/all-brand-product')}}">Danh sách thương hiệu</a></li>
                        
                    </ul>
                </li>
                @endhasrole

                @hasrole(['administrator','manager'])
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Quản lý sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
						<li><a href="{{URL::to('/all-product')}}">Danh sách sản phẩm</a></li>
                        
                    </ul>
                </li>
                @endhasrole
                
                @hasrole(['administrator','editor'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-file"></i>
                        <span>Quản lý tin tức</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-category-post')}}">Thêm danh mục tin tức</a></li>
                        <li><a href="{{URL::to('/add-post')}}">Thêm tin mới</a></li>
                        <li><a href="{{URL::to('/all-category-post')}}">Danh mục tin tức</a></li>
                        <li><a href="{{URL::to('/all-post')}}">Danh sách tin tức</a></li>
                    </ul>
                </li>
                @endhasrole
                <!-- <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-clipboard"></i>
                        <span>Quản lý tin tức</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/add-post')}}">Thêm tin mới</a></li>
                        <li><a href="{{URL::to('/all-post')}}">Danh sách tin tức</a></li>
                        
                    </ul>
                </li> -->
                @hasrole(['administrator','editor'])
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-camera"></i>
                        <span>Quản lý bình luận</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/comment')}}">Danh sách bình luận</a></li>      
                    </ul>
                </li>
                @endhasrole
                <!-- <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-camera"></i>
                        <span>Quản lý video</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('/video')}}">Thêm video mới</a></li>
                        
                    </ul>
                </li> -->
            </ul>           
             </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
        @yield('admin_content')
</section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>Công ty cổ phần Xây dựng - <a href="http://w3layouts.com">Phương Anh</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
        $(document).ready(function (){
            $('#myTable').DataTable();
        });
</script>
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<!--Format tiền -->
<script type="text/javascript">
    $('.price_format1').simpleMoneyFormat();
    $('.price_format2').simpleMoneyFormat();
    $('.price_format3').simpleMoneyFormat();
    $('.price_format4').simpleMoneyFormat();
</script>
<!-- Statistic -->
<script type="text/javascript">
    // hiển thị 30 ngày
    chart30days();
    
    function chart30days(){
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{url('/days-order')}}",
            method: "POST",
            dataType: "JSON",
            data: {_token:_token},
            success:function(data){
                chart.setData(data);
            }
        });
    }
    //lọc theo ngày 
    $('#btn-filter').click(function(){
        var _token = $('input[name="_token"]').val();
        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
        $.ajax({
            url: "{{url('/filter-by-date')}}",
            method: "POST",
            dataType: "JSON",
            data: {from_date:from_date,to_date:to_date,_token:_token},
            success:function(data){
                chart.setData(data);
            }
        });
    });
    //lọc theo lựa chọn
    $('.filter-for').change(function(){
        var filter_value = $(this).val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{url('/filter-for')}}",
            method: "POST",
            dataType: "JSON",
            data: {filter_value:filter_value,_token:_token},
            success:function(data){
                chart.setData(data);
            }
        })
    });
</script>
<!-- Comment-->
<script type="text/javascript">
    $('.comment_accept_btn').click(function(){
        var comment_status = $(this).data('comment_status');
        var comment_id = $(this).data('comment_id');
        var comment_product_id = $(this).attr('id');
        if(comment_status==0){
            var alert = 'Duyệt thành công!';
        }else{
            var alert = 'Bỏ duyệt thành công!';
        }
        $.ajax({
                url: "{{url('/allow-comment')}}",
                method: "POST",
                data: {comment_status:comment_status,comment_id:comment_id,comment_product_id:comment_product_id},
                headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                success:function(data){
                    location.reload();
                    $('#notify_comment').html('<span class="text text-danger">'+alert+'</span>')
                }
            }); 
    });

    $('.btn-reply-comment').click(function(){
        var comment_id = $(this).data('comment_id');
        var comment = $('.reply_comment_'+comment_id).val();
        
        var comment_product_id = $(this).data('product_id');

        $.ajax({
                url: "{{url('/reply-comment')}}",
                method: "POST",
                data: {comment:comment,comment_id:comment_id,comment_product_id:comment_product_id},
                headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                success:function(data){
                    location.reload();
                    $('.reply_comment_'+comment_id).val('');
                    $('#notify_comment').html('<span class="text text-danger">Trả lời thành công!</span>')
                }
            }); 
    });
</script>
<!-- Video-->
<script type="text/javascript">
       $(document).ready(function(){
        load_video();

        function load_video(){
            $.ajax({
                url: "{{url('/select-video')}}",
                method: "POST",
                headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                success:function(data){
                    $('#video_load').html(data);
                }
            });
        }

        $(document).on('click','.btn-add-video',function(){
            var video_title = $('.video_title').val();
            var video_slug = $('.video_slug').val();
            var video_link = $('.video_link').val();
            var video_desc = $('.video_desc').val();
            var _token = $('input[name="_token"]').val();
            if(confirm('Bạn có muốn thêm video không?')){
                $.ajax({
                    url: "{{url('/insert-video')}}",
                    method: "POST",
                    data: {video_title:video_title,video_slug:video_slug,video_link:video_link,video_desc:video_desc,_token:_token},
                    success:function(data){
                        load_video();
                        $('#notify').html('<span class="text-success">Thêm thành công</span>');
                    }
                });
            }
        });
    });
</script>
<!-- Gallery-->
<script type="text/javascript">
   
        load_gallery();

        function load_gallery(){
            var pro_id = $('.pro_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/select-gallery')}}",
                method: "POST",
                data: {pro_id:pro_id,_token:_token},
                success:function(data){
                    $('#gallery_load').html(data);
                }
            });
        }
        $('#file').change(function(){
            var error = '';
            var files = $('#file')[0].files;

            if(files.length>5){
                error += '<p>Chỉ chọn tối đa 5 ảnh!</p>';
            }else if(files.length==''){
                error += '<p>Bạn không được bỏ trống ảnh</p>';
            }else if(files.size > 2000000){
                error += '<p>File ảnh không được lớn hơn 2MB</p>';
            }

            if(error ==''){

            }else{
                $('#file').val('');
                $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
                return false;
            }
        });
        $(document).on('blur','.edit_gal_name',function(){
            var gal_id = $(this).data('gal_id');
            var gal_text = $(this).text();
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{url('/update-gallery-name')}}",
                method: "POST",
                data: {gal_id:gal_id,gal_text:gal_text,_token:_token},
                success:function(data){
                    $('#error_gallery').html('<span class="text-success">Cập nhật tên thành công</span>');
                }
            });     
        });

        $(document).on('click','.delete-gallery',function(){
            var gal_id = $(this).data('gal_id');
            var _token = $('input[name="_token"]').val();
            if(confirm('Bạn có muốn xóa hình ảnh này không?')){
                $.ajax({
                url: "{{url('/delete-gallery')}}",
                method: "POST",
                data: {gal_id:gal_id,_token:_token},
                success:function(data){
                    $('#error_gallery').html('<span class="text-success">Xóa ảnh thành công</span>');
                    }
                }); 
            }          
        });

        $(document).on('change','.file_image',function(){
            var gal_id = $(this).data('gal_id');
            var image = document.getElementById('file-'+gal_id).files[0];

            var form_data = new FormData();
            form_data.append("file",document.getElementById('file-'+gal_id).files[0]);
            form_data.append("gal_id",gal_id);

                $.ajax({
                url: "{{url('/update-gallery')}}",
                method: "POST",
                headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                data:form_data,
                contentType: false,
                cache: false,
                processData: false,
                success:function(data){
                    load_gallery();
                    $('#error_gallery').html('<span class="text-success">Cập nhật ảnh thành công</span>');
                    }
                }); 
                          
        });
  
</script>
<script type="text/javascript">
 
    function ChangeToSlug()
        {
            var slug;
         
            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
   
   
</script>
<script type="text/javascript">
    $('.update_quantity_order').click(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_'+order_product_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();

        $.ajax({
                url: '{{url('/update-qty')}}',
                method: 'POST',
                data : {_token:_token,order_product_id:order_product_id,order_qty:order_qty,order_code:order_code},
                success:function(data){
                    alert("Cập nhật số lượng thành công");
                    location.reload();
                }
            });
    });
</script>
<script type="text/javascript">
    $('.order_details').change(function(){
        var order_status = $(this).val();
        var orer_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();
        
        //lay so luong san pham
        quantity = [];
        $('input[name="product_sales_quantity"]').each(function(){
            quantity.push($(this).val());
        });
        //lay product_id
        order_product_id = [];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        j = 0;
        for(i=0;i<order_product_id.length;i++){
            var order_qty = $('.order_qty_'+order_product_id[i]).val();
            var order_qty_storage = $('.order_qty_storage_'+order_product_id[i]).val();
            if(parseInt(order_qty)>parseInt(order_qty_storage)){
                j = j+1;
                if(j==1){
                    alert('Số lượng khách hàng đặt lớn hơn số lượng trong kho!');
                }
               
                $('.color_qty_'+order_product_id[i]).css('background','#ccc');
            }
        }
        if(j==0){
            $.ajax({
                url: '{{url('/update-order-qty')}}',
                method: 'POST',
                data : {_token:_token,order_status:order_status,order_id:orer_id,quantity:quantity,order_product_id:order_product_id},
                success:function(data){
                    alert("Thay đổi tình trạng đơn hàng thành công!");
                    location.reload();
                }
            });
        }
        
    });
</script>
<script type="text/javascript">
    //load phí ship
        fetch_delivery();
        function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/select-feeship')}}',
                method: 'POST',
                data : {_token:_token},
                success:function(data){
                    $('#load_delivery').html(data);
                }
            });

        }
</script>
<script type="text/javascript">
    $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            if(action == 'city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url: '{{url('/select-delivery')}}',
                method: 'POST',
                data : {action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                    $('#'+result).html(data);
                }
            });
        });
    $('.add_delivery').click(function(){
            var city = $('.city').val();
            var province = $('.province').val();
            var wards = $('.wards').val();
            var fee_ship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/insert-delivery')}}',
                method: 'POST',
                data : {city:city,province:province,wards:wards,fee_ship:fee_ship,_token:_token},
                success:function(data){
                    fetch_delivery();
                }
            });
        }); 
    $(document).on('blur','.fee_feeship_edit',function(){ //blur:chọn
            var feeship_id = $(this).data('feeship_id');
            var fee_value = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/update-delivery')}}',
                method: 'POST',
                data : {feeship_id:feeship_id,fee_value:fee_value,_token:_token},
                success:function(data){
                    fetch_delivery();
                }
            });
        });
</script>
<!-- morris JavaScript -->	
<!--ckeditor-->
<script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    CKEDITOR.replace('ckeditor');
    CKEDITOR.replace('ckeditor1');
    CKEDITOR.replace('ckeditor2');
</script>
<!--jquery validation form-->
<script src="{{asset('public/backend/js/jquery.form-validator.min.js')}}"></script>
<script type="text/javascript">
    $.validate({});
</script>
<script src="{{asset('web/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('web/js/scripts.js')}}"></script>
<script src="{{asset('web/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('web/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('web/js/jquery.scrollTo.js')}}"></script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->

</body>
</html>
