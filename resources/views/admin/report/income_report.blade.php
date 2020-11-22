@extends('admin_layout')
@section('admin_content')
	<!-- <head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Month');
      data.addColumn('number', 'Guardians of the Galaxy');
      data.addColumn('number', 'The Avengers');
      data.addColumn('number', 'Transformers: Age of Extinction');

      data.addRows([
        [1,  37.8, 80.8, 41.8],
        [2,  30.9, 69.5, 32.4],
        [3,  25.4,   57, 25.7],
        [4,  11.7, 18.8, 10.5],
        [5,  11.9, 17.6, 10.4],
        [6,   8.8, 13.6,  7.7],
        [7,   7.6, 12.3,  9.6],
        [8,  12.3, 29.2, 10.6],
        [9,  16.9, 42.9, 14.8],
        [10, 12.8, 30.9, 11.6],
        [11,  5.3,  7.9,  4.7],
        [12,  6.6,  8.4,  5.2],
        [13,  4.8,  6.3,  3.6],
        [14,  4.2,  6.2,  3.4]
      ]);

      var options = {
        chart: {
          title: 'Box Office Earnings in First Two Weeks of Opening',
          subtitle: 'in millions of dollars (USD)'
        },
        width: 900,
        height: 500,
        axes: {
          x: {
            0: {side: 'top'}
          }
        }
      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>
</head>
<body>
  <div id="line_top_x"></div>
</body> -->
<!-- Doanh thu tháng -->
<div class="col-md-8 floatcharts_w3layouts_left" style="width: 1010px">
        <div class="floatcharts_w3layouts_top">
          <div class="floatcharts_w3layouts_bottom">
            <h3><center>Thống kê doanh thu tháng</center></h3>
            <div id="graph5"></div>
            <script>
            /* data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type */
            var day_data = [
              {"M": "Tháng 1", "accept": 0},
              {"M": "Tháng 2", "accept": 0},
              {"M": "Tháng 3", "accept": 0},
              {"M": "Tháng 4", "accept": 0},
              {"M": "Tháng 5", "accept": 0},
              {"M": "Tháng 6", "accept": 0},
              {"M": "Tháng 7", "accept": 0},
              {"M": "Tháng 8", "accept": 0},
              {"M": "Tháng 9", "accept": 25000000},
              {"M": "Tháng 10", "accept": 25300000},
              {"M": "Tháng 11", "accept": 22000000},
              {"M": "Tháng 12", "accept": 0},
            ];
            Morris.Bar({
              element: 'graph5',
              data: day_data,
              xkey: 'M',
              ykeys: ['accept'],
              labels: ['Doanh thu'],
              xLabelAngle: 60
            });
            </script>

          </div>
        </div>
      </div>

      <!-- Doanh thu quý-->
  <div class="col-md-12 w3ls-graph">
          <!--agileinfo-grap-->
            <div class="agileinfo-grap">
              <div class="agileits-box">
                <header class="agileits-box-header clearfix">
                  <h3>Thống kê doanh thu quý</h3>
                    <div class="toolbar">
                 </div>
                </header>
                <div class="agileits-box-body clearfix">
                  <div id="hero-area"></div>
                </div>
              </div>
            </div>
  <!--//agileinfo-grap-->

        </div>
        <br><br>
        <script type="text/javascript">
    
    graphArea2 = Morris.Area({
      element: 'hero-area',
      padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
      data: [
        {period: '2019 ', t1: 5312312, t2: 12378313, t3: 373687320, t4: 6821340,t5: 354330, t6: 1232130, t7: 3687880, t8: 56788760,t9: 5671230, t10: 754430, t11: 68767860, t12: 7867863},
        {period: '2020 ', t1: 47867630, t2: 8768540, t3: 456310, t4:786560,t5: 7865430, t6:6654534, t7: 864610, t8: 453783370,t9: 25000000, t10: 30000000, t11: 25000000, t12: 786540},
        {period: '2021 ', t1: 4567860, t2: 786560, t3: 786876780, t4: 7868760,t5: 7868760, t6: 7867860, t7: 786780, t8: 78687670,t9: 8767860, t10: 786780, t11: 7866870, t12: 7860},
      ],
      lineColors:['#eb6f6f','#926383','#eb6f6f'],
      xkey: 'period',
            redraw: true,
            ykeys: ['t1','t2','t3','t4','t5','t6','t7','t8','t9', 't10', 't11','t12'],
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4','Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8','Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
      pointSize: 2,
      hideHover: 'auto',
      resize: true
    });
        </script>

        <br><br>
    
@endsection