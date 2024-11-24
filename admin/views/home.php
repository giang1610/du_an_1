<!-- header -->
<?php include './views/layout/header.php'; ?>
 <!-- endheader -->
  <!-- Navbar -->
  <?php include './views/layout/navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include './views/layout/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Báo cáo thống kê</h1>
            <html>
              <?php


$connect = new mysqli('localhost','xuangiang','xuangiang','duan1cc');
  
        $sql = 'SELECT danh_mucs.ten_danh_muc, COUNT(san_phams.id) AS so_luong_san_pham
        FROM san_phams
        INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
        GROUP BY danh_mucs.ten_danh_muc';
        $result = mysqli_query($connect,$sql);
        $data = []; 
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = $row;
        }
        
        //var_dump($data);die;

              ?>

  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['ten_danh_muc', 'so_luong_san_pham'],
          <?php
          foreach($data as $a) {
              echo "['" . $a['ten_danh_muc'] . "' , " . $a['so_luong_san_pham'] . "],";
            }
          ?>
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>

          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- footer -->
<?php include './views/layout/footer.php'; ?>
  <!-- endfooter -->
<!-- Page specific script -->

<!-- Code injected by live-server -->

</body>
</html>
