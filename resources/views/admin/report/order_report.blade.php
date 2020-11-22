@extends('admin_layout')
@section('admin_content')
  
 <div class="col-md-4 chart_agile_right">
        <div class="chart_agile_top">
          <div class="chart_agile_bottom">
            <header class="agileits-box-header clearfix">
              <h3>Thống kê tình trạng đơn hàng</h3>
            </header>
            <div id="graph4" style="height: 300px" ></div>
            <script>
              Morris.Donut({
                element: 'graph4',
                data: [
                {value: {!!$order_new!!}, label: 'Đơn hàng mới', formatted: '{!!$order_new!!}' },
                {value: {!!$order_accept!!}, label: 'Đã giao hàng', formatted: '{!!$order_accept!!}' },
                {value: {!!$order_cancel!!}, label: 'Bị hủy', formatted: '{!!$order_cancel!!}' }
                ],
                formatter: function (x, data) { return data.formatted; }
              });
            </script>

          </div>
        </div>
      </div>

      <div class="col-md-8 floatcharts_w3layouts_left">
        <div class="floatcharts_w3layouts_top">
          <div class="floatcharts_w3layouts_bottom">
            <h3><center>Thống kê số lượng đơn hàng</center></h3>
            <div id="graph5"></div>
            <script>
            /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
            var day_data = [
              {"Tháng": "Tháng 9", "accept": {!!$order_accept_september!!}, "cancel": {!!$order_cancel_september!!}},
              {"Tháng": "Tháng 10", "accept": {!!$order_accept_october!!}, "cancel":{!!$order_cancel_october!!}},
              {"Tháng": "Tháng 11", "accept": {!!$order_accept_november!!}, "cancel":{!!$order_cancel_november!!}},
            ];
            Morris.Bar({
              element: 'graph5',
              data: day_data,
              xkey: 'Tháng',
              ykeys: ['accept', 'cancel'],
              labels: ['Đơn đã giao', 'Đơn bị hủy'],
              xLabelAngle: 60
            });
            </script>

          </div>
        </div>
      </div>
@endsection