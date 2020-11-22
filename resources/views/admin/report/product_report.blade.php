@extends('admin_layout')
@section('admin_content')
    <!-- Sản phẩm -->
    {!!'<script type="text/javascript">
      var product = '.$product->toJson().';
      var pro = product.map((product)=> [product.product_name, product.product_sold]); 
      </script>'
    !!}
    <!-- Danh mục -->
    {!!'<script type="text/javascript">
      var category = '.$category->toJson().';
      var cate = category.map((category)=> [category.category_name, category.count]); 
      </script>'
    !!}

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!-- Sản phẩm-->
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
         ["Sản phẩm", "Số lượng bán ra"], ...pro
        ]);

        var options = {
          title: 'Thống kê sản phẩm bán chạy nhất',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>

    <!-- Danh mục -->
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
         ["Tên danh mục", "Số lượng sản phẩm"], ...cate
        ]);

        var options = {
          title: 'Thống kê số lượng sản phẩm từng danh mục',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2_3d'));
        chart.draw(data, options);
      }
    </script>
  <body>
    <div id="piechart_3d" style="margin-left:10px; width: 550px; height: 500px;"></div>
      <br><br>
    <div id="piechart2_3d" style="margin-left:535px; margin-top: -544px;width: 450px; height: 500px;"></div>
  </body>

  <div class="col-md-12 chart_agile_right" style="margin-left: -5px; margin-top: 50px; width: 1000px">

        <div class="chart_agile_top">

          <div class="chart_agile_bottom">
            <header class="agileits-box-header clearfix">
              <h3>Thống kê danh mục bán chạy nhất</h3>
            </header>
            <div id="graph4"></div>
            <script>
              Morris.Donut({
                element: 'graph4',
                data: [
                {value: {!!$da!!}, label: 'Đá', formatted: '{!!$da!!}' },
                {value: {!!$ximang!!}, label: 'Xi măng', formatted: '{!!$ximang!!}' },
                {value: {!!$betong!!}, label: 'Ống bê tông', formatted: '{!!$betong!!}' },
                {value: {!!$thep!!}, label: 'Thép', formatted: '{!!$thep!!}' },
                {value: {!!$gach!!}, label: 'Gạch', formatted: '{!!$gach!!}' },
                {value: {!!$ton!!}, label: 'Tôn', formatted: '{!!$ton!!}' }
                ],
                formatter: function (x, data) { return data.formatted; }
              });
            </script>

          </div>
        </div>
      </div>
@endsection