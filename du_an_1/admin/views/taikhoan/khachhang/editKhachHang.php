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
            <h1>Quản lý tài khoản khách hàng</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           

          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sửa tài khoản khách hàng:<?=$khachHang['ho_ten']?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= BASE_URL_ADMIN .'?act=sua-khach-hang'?>" method="POST">
                <input type="hidden" name="id_khach_hang" value="<?= $khachHang['id']?>" hidden>
                <div class="card-body">
                  <div class="form-group">
                    <label >Họ tên</label>
                    <input type="text" class="form-control"  name="ho_ten" value="<?= $khachHang['ho_ten']?>" placeholder="Nhập tên ">
                    <?php if(isset($errors['ho_ten'])) {?>
                        <p class="text-danger"><?= $errors['ho_ten'] ?></p>
                      <?php  }?>
                  </div>
                  <div class="form-group">
                    <label >Email</label>
                    <input type="email" class="form-control"  name="email" value="<?= $khachHang['email']?>" placeholder="Nhập email ">
                    <?php if(isset($errors['email'])) {?>
                        <p class="text-danger"><?= $errors['email'] ?></p>
                      <?php  }?>
                  </div>
                  <div class="form-group">
                    <label >Số điện thoại</label>
                    <input type="text" class="form-control"  name="so_dien_thoai" value="<?= $khachHang['so_dien_thoai']?>" placeholder="Nhập số điện thoại">
                    <?php if(isset($errors['so_dien_thoai'])) {?>
                        <p class="text-danger"><?= $errors['so_dien_thoai'] ?></p>
                      <?php  }?>
                  </div>
                  <div class="form-group">
                    <label >Ngày sinh</label>
                    <input type="date" class="form-control"  name="ngay_sinh" value="<?= $khachHang['ngay_sinh']?>" placeholder="Ngày sinh của bạn">
                    <?php if(isset($errors['ngay_sinh'])) {?>
                        <p class="text-danger"><?= $errors['ngay_sinh'] ?></p>
                      <?php  }?>
                  </div>
                  <div class="form-group">
                    <label >Giới tính</label>
                    <select  name="gioi_tinh" class="form-control custom-select">

                  <option <?= $khachHang['gioi_tinh'] == 1 ? 'selected' : '' ?> value="1">Nam</option>
                  <option <?= $khachHang['gioi_tinh'] != 1 ? 'selected' : '' ?> value="2">Nữ</option>

                    
                </select>
                    <?php if(isset($errors['gioi_tinh'])) {?>
                        <p class="text-danger"><?= $errors['gioi_tinh'] ?></p>
                      <?php  }?>
                  </div>
                  <div class="form-group">
                    <label >Địa chỉ</label>
                    <input type="text" class="form-control"  name="dia_chi" value="<?= $khachHang['dia_chi']?>" placeholder="Nhập số địa chỉ">
                    <?php if(isset($errors['dia_chi'])) {?>
                        <p class="text-danger"><?= $errors['dia_chi'] ?></p>
                      <?php  }?>
                  </div>
                  <div class="form-group">
                <label for="inpusStatus">Trang thái tài khoản</label>
                <select  name="trang_thai" class="form-control custom-select">

                  <option <?= $khachHang['trang_thai'] == 1 ? 'selected' : '' ?> value="1">Active</option>
                  <option <?= $khachHang['trang_thai'] != 1 ? 'selected' : '' ?> value="2">Inactive</option>

                    
                </select>
              </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
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

  

</body>
</html>
