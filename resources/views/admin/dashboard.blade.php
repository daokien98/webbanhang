@extends('admin_layout')
@section('admin_content')
<p style="font-size: 25px"class="text-center"><strong>CHÀO MỪNG ĐẾN VỚI TRANG QUẢN TRỊ VIÊN</strong></p>
<section class="wrapper">
		<!-- //market-->
		<div class="market-updates">
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-2">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
					 <div class="col-md-8 market-update-left">
					 <h4>Tổng số sản phẩm</h4>
					<h3>{{$pr_qty}}</h3>
					<p>Cập nhật theo thời gian thực</p>
				  </div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-4 market-update-right">
						<i class="fa fa-users" ></i>
					</div>
					<div class="col-md-8 market-update-left">
					<h4>Tổng số khách hàng</h4>
						<h3>{{$customer}}</h3>
						<p>Cập nhật theo thời gian thực</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-4 market-update-right">
						<a href="{{URL('/manage-order')}}"><i class="fa fa-usd"></i></a>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Tổng doanh thu</h4>
						<h3 style="float: right;">{{number_format($sum,0,',','.')}}đ</h3>
						<p>Cập nhật theo thời gian thực</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
			<div class="col-md-3 market-update-gd">
				<div class="market-update-block clr-block-4">
					<div class="col-md-4 market-update-right">
						<a href="{{URL('/manage-order')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
					</div>
					<div class="col-md-8 market-update-left">
						<h4>Đơn hàng đã xử lý</h4>
						<h3>{{$order_done}}/{{$order_count}}</h3>
						<p>Cập nhật theo thời gian thực</p>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>	
		<!-- //market-->

		<div class="agil-info-calendar">
		<!-- calendar -->
		<div class="col-md-6 agile-calendar">
			<div class="calendar-widget">
                <div class="panel-heading ui-sortable-handle">
					<span class="panel-icon">
                      <i class="fa fa-calendar-o"></i>
                    </span>
                    <span class="panel-title">Lịch</span>
                </div>
				<!-- grids -->
					<div class="agile-calendar-grid">
						<div class="page">
							
							<div class="w3l-calendar-left">
								<div class="calendar-heading">
									
								</div>
								<div class="monthly" id="mycalendar"></div>
							</div>
							
							<div class="clearfix"> </div>
						</div>
					</div>
			</div>
		</div>
		<!-- //calendar -->

		<div class="col-md-6 chart_agile_right">

				<div class="chart_agile_top">

					<div class="chart_agile_bottom">
						<header class="agileits-box-header clearfix">
							<h3>Sản phẩm bán chạy nhất</h3>
						</header>
						<div id="graph4"></div>
						<script>
							Morris.Donut({
							  element: 'graph4',
							  data: [
								{value: 70, label: 'Xi măng', formatted: 'Gần 70%' },
								{value: 15, label: 'Gạch ngói', formatted: 'Xấp xỉ 15%' },
								{value: 10, label: 'Thép', formatted: 'Xấp xỉ 10%' },
								{value: 5, label: 'Tôn', formatted: 'Khoảng 5%' }
							  ],
							  formatter: function (x, data) { return data.formatted; }
							});
						</script>

					</div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
			
		<!-- //tasks -->
		<div class="agileits-w3layouts-stats">
					<div class="col-md-4 stats-info widget">
						<div class="stats-info-agileits">
							<div class="stats-title">
								<h4 class="title">Thống kê trình duyệt truy cập</h4>
							</div>
							<div class="stats-body">
								<ul class="list-unstyled">
									<li>GoogleChrome <span class="pull-right">85%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar green" style="width:85%;"></div> 
										</div>
									</li>
									<li>Firefox <span class="pull-right">35%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar yellow" style="width:35%;"></div>
										</div>
									</li>
									<li>Internet Explorer <span class="pull-right">78%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar red" style="width:78%;"></div>
										</div>
									</li>
									<li>Safari <span class="pull-right">50%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar blue" style="width:50%;"></div>
										</div>
									</li>
									<li>Opera <span class="pull-right">80%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar light-blue" style="width:80%;"></div>
										</div>
									</li>
									<li class="last">Các trình duyệt khác <span class="pull-right">60%</span>  
										<div class="progress progress-striped active progress-right">
											<div class="bar orange" style="width:60%;"></div>
										</div>
									</li> 
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-8 stats-info stats-last widget-shadow">
						<div class="stats-last-agile">
							<div class="stats-title">
								<h4 class="title">Thống kê danh mục sản phẩm bán ra</h4>
							</div>
							<table class="table stats-table ">
								<thead>
									<tr>
										<th>STT</th>
										<th>Tên sản phẩm</th>
										<th>Trạng thái</th>
										<th>Tình trạng</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th scope="row">1</th>
										<td>Xi măng</td>
										<td><span class="label label-success">Đang có hàng</span></td>
										<td><h5>85% <i class="fa fa-level-up"></i></h5></td>
									</tr>
									<tr>
										<th scope="row">2</th>
										<td>Ống bê tông</td>
										<td><span class="label label-warning">Mới nhập</span></td>
										<td><h5>35% <i class="fa fa-level-up"></i></h5></td>
									</tr>
									<tr>
										<th scope="row">3</th>
										<td>Gạch</td>
										<td><span class="label label-danger">Quá hạn</span></td>
										<td><h5 class="down">40% <i class="fa fa-level-down"></i></h5></td>
									</tr>
									<tr>
										<th scope="row">4</th>
										<td>Thép</td>
										<td><span class="label label-info">Hết hàng</span></td>
										<td><h5>100% <i class="fa fa-level-up"></i></h5></td>
									</tr>
									<tr>
										<th scope="row">5</th>
										<td>Đá xây dựng</td>
										<td><span class="label label-success">Đang có hàng</span></td>
										<td><h5 class="down">10% <i class="fa fa-level-down"></i></h5></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="clearfix"> </div>
				</div>
</section>
@endsection