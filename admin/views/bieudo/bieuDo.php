<!-- header -->
<?php
include "./views/layout/header.php"
?>
<!-- end header -->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <?php
        include "./views/layout/navbar.php"
        ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php
        include "./views/layout/sidebar.php"
        ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Biểu đồ</h1>
                        </div>
                    </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                <div id="myChart" style="width:100%; height:800px;">
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!--footer-->
        <?php include './views/layout/footer.php'; ?>

        <!-- /.control-sidebar -->
    </div>
    <script src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            // Set Data
            const data = google.visualization.arrayToDataTable([
                ['Danh mục', 'Số lượng sản phẩm'],
                <?php
                $tongDanhMuc = count($listThongKe);
                for ($i = 0; $i < $tongDanhMuc; $i++) {
                    $dauPhay = ($i < $tongDanhMuc - 1) ? ',' : '';
                ?>['<?= $listThongKe[$i]['ten_danh_muc'] ?>', <?= $listThongKe[$i]['countSp'] ?>] <?= $dauPhay ?>
                <?php } ?>
            ]);

            // Set Options
            const options = {
                title: 'Thống kê sản phẩm theo danh mục',
                height: 800, // Điều chỉnh chiều cao của biểu đồ
                width: '100%' // Điều chỉnh chiều rộng của biểu đồ
            };

            // Draw
            const chart = new google.visualization.PieChart(document.getElementById('myChart'));
            chart.draw(data, options);

        }
    </script>

</body>

</html>