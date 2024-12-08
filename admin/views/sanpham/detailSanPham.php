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
    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body">
        <div class="row">
          <!-- Cột chứa hình ảnh -->
           
          <div class="col-12 col-sm-6">
            <h3 class="d-inline-block d-sm-none"></h3>
            <div class="col-15">
              <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?> " class="product-image" alt="Product Image" style= "height:500px;width:700px;">
            </div>
            <div class="col-12 product-image-thumbs">
              <?php foreach ($listAnhSanPham as $key => $anh): ?>
                <div class="product-image-thumb <?= $anh[$key] == 0 ? 'active' : '' ?>">
                  <img src="<?= BASE_URL . $anh['link_hinh_anh'] ?>" alt="Product Image">
                </div>
              <?php endforeach ?>
            </div>
          </div>

          <!-- Cột chứa thông tin sản phẩm -->
          <div class="col-12 col-sm-6">
  <!-- Tên sản phẩm -->
  
  <!-- Available Colors -->


  <!-- Size -->
  <div class="product-info ">
 
    <h4 class="my-3">Tên sản phẩm:<small><?=$sanPham['ten_san_pham']?></small></h4>
   
  

    <h4>Giá sản phẩm: <small><?=$sanPham['gia_san_pham']?></small></h4>
    <h4>Giá khuyến mãi: <small><?=$sanPham['gia_khuyen_mai']?></small></h4>
    <h4>Số lượng: <small><?=$sanPham['so_luong']?></small></h4>
    <h4>Lượt xem: <small><?=$sanPham['luot_xem']?></small></h4>
    <h4>Ngày xem: <small><?=$sanPham['ngay_nhap']?></small></h4>
    <h4>Trạng thái: <small><?=$sanPham['trang_thai'] == 1 ? 'Còn bán' : 'Dừng bán' ?></small></h4>
    <h4>Mô tả: <small><?=$sanPham['mo_ta']?></small></h4>
</div>
<style>

.product-info {
    background-color: #fff; 
    border: 1px solid #ddd; 
    border-radius: 8px; 
    padding: 20px; 
    margin-top: 10px; 
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); 
    width: 100%;
    max-width: 700px; 
    position: relative; 
    top: 20px; 
    transition: all 0.3s ease;
}
.product-info:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
    top: -13px; 
}
h4{
  font-weight: bold;
}


</style>
</div>

        </div>

        <!-- Tabs (Description, Comments, Rating) -->
        <div class="row mt-4">
          <nav class="w-100">
            <div class="nav nav-tabs" id="product-tab" role="tablist">
              <!-- <a class="tab-content" id="product-desc-tab" data-toggle="tab" href="#binh-luan" role="tab" aria-controls="product-desc" aria-selected="true">Bình luận về <?=$sanPham['ten_san_pham'] ?></a> -->
             
            </div>
          </nav>
          <div class="tab-content p-3" id="nav-tabContent">
            <div class="tab-pane fade show active" id="binh-luan" role="tabpanel" aria-labelledby="product-desc-tab">
              <div class="container">
              <!-- <table class="table table-striped table-hover">
              
              <thead>
              <tr>
              <th>a</th>
              <th>Tên người bình luận</th>
              <th>Nội dung</th>
              <th>Bình luận</th>
              <th>Ngày đăng</th>
              <th>Thao tác</th>
              </tr>
              </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>aa</td>
                <td>Nội dung</td>
                <td>Quá đẹp luôn</td>
                <td>22/11/2024</td>
                <td>
                  <div class="btn-group">
                        <a href="#"><button class="btn btn-primary">ẩn</button></a>
                        <a href="#"><button class="btn btn-danger">xóa</button></a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table> -->
              </div>
              
            </div>
            
            
          </div>
        </div>
      </div>
    </div>
    <!-- /.card -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- footer -->
<?php include './views/layout/footer.php'; ?>
<!-- endfooter -->

<!-- JavaScript -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false
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

<script>
  $(document).ready(function() {
    $('.product-image-thumb').on('click', function () {
      var $image_element = $(this).find('img')
      $('.product-image').prop('src', $image_element.attr('src'))
      $('.product-image-thumb.active').removeClass('active')
      $(this).addClass('active')
    })
  })
</script>
