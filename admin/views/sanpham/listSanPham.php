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
            <h1>Quản lý danh sách thú cưng</h1>
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
              <div class="card-header">
               <a href="<?= BASE_URL_ADMIN .'?act=from-them-san-pham'?>">
                <button class="btn btn-success">Thêm gấu bông mới</button>
               </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>STT</th>
                   <th>Tên sản phẩm</th>
                   <th>Ảnh san phẩm</th>
                   <th>Giá tiền</th>
                   <th>Số lượng</th>
                   <th>ID danh mục</th>
                   <th>Trạng thái</th>
                    <th>Thao tác</th>                 
                  </tr>
                  </thead>
                  <tbody>
                    <?php foreach($listSanPham as $sanPham) :?>

                  <tr>
                   <td><?= $sanPham['id']  ?></td>
                   <td><?=  $sanPham['ten_san_pham']  ?></td>
                   <td>
                    <img src="<?=BASE_URL . $sanPham['hinh_anh']  ?>" style="width:100px" alt=""
                    onerror="this.onerorr=null; this.src='https://bizweb.dktcdn.net/thumb/1024x1024/100/348/581/products/pikaboo1-anh-bia1.jpg?v=1691572409643'"
                    >
                    
                   </td>
                   <td><?= $sanPham['gia_san_pham']  ?></td>
                   <td><?= $sanPham['so_luong']  ?></td>
                   <td><?= $sanPham['danh_muc_id']  ?></td>
                   <td><?= $sanPham['trang_thai'] == 1? 'Còn bán':'Dừng bán' ?></td>
                   
                   <td>
                    <a href="<?= BASE_URL_ADMIN .'?act=from-sua-san-pham&id_san-pham='. $sanPham['id']?>"><button class="btn btn-warning"><i class="fa fa-wrench"></i></button></a>
                     <a href="<?= BASE_URL_ADMIN .'?act=xoa-san-pham&id_san-pham='. $sanPham['id']?>" onclick="return confirm('Bạn muốn xóa thật không?')">
                     <button class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                     </a>
                   </td>
                  </tr>
                <?php endforeach ?>
                  </tbody>
                  <!-- <tfoot>
                  <tr>
                  <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Thao tác</th>  
                  </tr>
                  </tfoot> -->
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
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
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
