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
            <h1>Quản lý tài khoản quản trị</h1>
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
                <h3 class="card-title">Sửa tài khoản quản trị:<?=$quanTri['ho_ten']?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?= BASE_URL_ADMIN .'?act=sua-quan-tri'?>" method="POST">
                <input type="hidden" name="quan_tri_id" value="<?= $quanTri['id']?>" hidden>
                <div class="card-body">
                  <div class="form-group">
                    <label >Họ tên</label>
                    <input type="text" class="form-control"  name="ho_ten" value="<?= $quanTri['ho_ten']?>" placeholder="Nhập tên ">
                    <?php if(isset($errors['ho_ten'])) {?>
                        <p class="text-danger"><?= $errors['ho_ten'] ?></p>
                      <?php  }?>
                  </div>
                  <div class="form-group">
                    <label >Email</label>
                    <input type="email" class="form-control"  name="email" value="<?= $quanTri['email']?>" placeholder="Nhập email ">
                    <?php if(isset($errors['email'])) {?>
                        <p class="text-danger"><?= $errors['email'] ?></p>
                      <?php  }?>
                  </div>
                  <div class="form-group">
                    <label >Số điện thoại</label>
                    <input type="text" class="form-control"  name="so_dien_thoai" value="<?= $quanTri['so_dien_thoai']?>" placeholder="Nhập số điện thoại">
                    <?php if(isset($errors['ho_ten'])) {?>
                        <p class="text-danger"><?= $errors['so_dien_thoai'] ?></p>
                      <?php  }?>
                  </div>
                  <div class="form-group">
                <label for="inpusStatus">Trang thái tài khoản</label>
                <select  name="trang_thai" class="form-control custom-select">

                  <option <?= $quanTri['trang_thai'] == 1 ? 'selected' : '' ?> value="1">Active</option>
                  <option <?= $quanTri['trang_thai'] != 1 ? 'selected' : '' ?> value="2">Inactive</option>

                    
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
