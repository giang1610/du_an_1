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
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-8">
                            <h1>Báo cáo thống kê</h1>
                        </div>
                    </div><!-- /.container-fluid -->
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1"
                                            class="table table-bordered table-striped table-responsive">
                                            <thead>
                                                <tr>
                                                    <th>Mã danh mục</th>
                                                    <th>Tên danh mục</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá hiện tại</th> <!-- Hiển thị giá hiện tại -->
                                                    <th>Giá khuyến mãi</th> <!-- Hiển thị giá khuyến mãi -->

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($listThongKe as $thongKe) { ?>
                                                <tr>
                                                    <td><?= $thongKe['id'] ?></td>
                                                    <td><?= $thongKe['ten_danh_muc'] ?></td>
                                                    <td><?= $thongKe['countSp'] ?></td>
                                                    <td><?= $thongKe['currentPrice'] ?></td>
                                                    <!-- Hiển thị giá hiện tại -->
                                                    <td><?= $thongKe['discountPrice'] ?></td>
                                                    <!-- Hiển thị giá khuyến mãi -->
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Mã danh mục</th>
                                                    <th>Tên danh mục</th>
                                                    <th>Số lượng</th>
                                                    <th>Giá hiện tại</th> <!-- Hiển thị giá hiện tại -->
                                                    <th>Giá khuyến mãi</th> <!-- Hiển thị giá khuyến mãi -->
                                                </tr>
                                            </tfoot>
                                        </table>
                                        <a href="<?= BASE_URL_ADMIN . '?act=bieu-do' ?>"> <button type="button"
                                                class="btn btn-primary">Xem biểu đồ</button></a>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- footer -->
        <?php
    include "./views/layout/footer.php"
    ?>

        <!-- end footer -->
</body>

</html>