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
          <h1>Quản lý danh sách đơn hàng</h1>
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header"></div>
            <!-- /.card-header -->
            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Tên người nhận</th>
                <th>Số điện thoại</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $totalSuccessAmount = 0; // Biến lưu tổng tiền khi id_trang_thai = 9

              foreach($listDonHang as $key => $donHang) {
                  if ($donHang['trang_thai_id'] == 9) { 
                      $totalSuccessAmount += $donHang['tong_tien']; 
                  }
              ?>
              <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $donHang['ma_don_hang'] ?></td>
                <td><?= $donHang['ten_nguoi_nhan'] ?></td>
                <td><?= $donHang['sdt_nguoi_nhan'] ?></td>
                <td><?= formatDate($donHang['ngay_dat']) ?></td>
                <td><?= number_format($donHang['tong_tien'], 0, ',', '.') ?>₫</td>
                <td><?= $donHang['ten_trang_thai'] ?></td>
                <td>
                  <div class="btn-group" style="display: flex; gap: 5px;">
                    <a href="<?= BASE_URL_ADMIN .'?act=from-sua-don-hang&id_don_hang='. $donHang['id'] ?>"><button class="btn btn-warning"><i class="fa fa-wrench"></i></button></a>
                    <a href="<?= BASE_URL_ADMIN .'?act=chi-tiet-don-hang&id_don_hang='. $donHang['id'] ?>"><button class="btn btn-primary"><i class="fa fa-eye"></i></button></a>
                  </div>
                </td>
              </tr>
              <?php } ?>

              <!-- Thêm hàng tổng tiền -->
              <tr>
                <td colspan="5" style="text-align: right;"><strong>Tổng tiền các đơn hàng thành công </strong></td>
                <td><strong><?= number_format($totalSuccessAmount, 0, ',', '.') ?>₫</strong></td>
                <td colspan="2"></td>
              </tr>
            </tbody>
</table>

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
<!-- /.content-wrapper -->

<!-- footer -->
<?php include './views/layout/footer.php'; ?>
<!-- endfooter -->

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<!-- Code injected by live-server -->
</body>
</html>
