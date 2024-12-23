<?php 
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ



// Require toàn bộ file Controllers
require_once './controllers/AdminDanhMucControllers.php';
require_once './controllers/AdminSanPhamControllers.php';
require_once './controllers/AdminDonHangControllers.php';
require_once './controllers/AdminBaoCaoThongKeControllers.php';
require_once './controllers/AdminTaiKhoanControllers.php';

// Require toàn bộ file Models
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';
require_once './models/AdminDonHang.php';
require_once './models/AdminTaiKhoan.php';

require_once './models/AdminThongKe.php';
// Route
$act = strtolower($_GET['act'] ?? '/');
if ($act !== 'login-admin' && $act !== 'check-login-admin' && $act !== 'logout-admin'){
  checkLoginAdmin();
}

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
match ($act) {
    //route báo cáo thống kê--trang chủ
    '/'=>(new AdminBaoCaoThongKeControllers())->home(),
    // Dashboards
    'danhmuc' => (new AdminDanhMucControllers())->danhSachdanhMuc(),
    'from-them-danh-muc' => (new AdminDanhMucControllers())->formAddDanhMuc(),
    'them-danh-muc' => (new AdminDanhMucControllers())->postAddDanhMuc(),
    'from-sua-danh-muc' => (new AdminDanhMucControllers())->formEditDanhMuc(),
    'sua-danh-muc' => (new AdminDanhMucControllers())->posteditDanhMuc(), 
    'xoa-danh-muc' => (new AdminDanhMucControllers())->deleteDanhMuc(),

    // 'thong-ke' => (new AdminDanhMucControllers())->thongKe(),
   

   //sanpham
    'san-pham'            => (new AdminSanPhamControllers())->danhSachSanPham(),
    'from-them-san-pham'  => (new AdminSanPhamControllers())->formAddSanPham(),
    'them-san-pham'       => (new AdminSanPhamControllers())->postAddSanPham(),
    'from-sua-san-pham'   => (new AdminSanPhamControllers())->formEditSanPham(),
    'sua-san-pham'        => (new AdminSanPhamControllers())->posteditSanPham(), 
    'sua-album-anh-pham'  => (new AdminSanPhamControllers())->posteditAnhSanPham(), 
    'chi-tiet-san-pham'   => (new AdminSanPhamControllers())->detailSanPham(),
     'xoa-san-pham'       => (new AdminSanPhamControllers())->deleteSanPham(),
     //route Bình luận
     'update-trang-thai-binh-luan' => (new AdminSanPhamControllers())->updateTrangThaiBinhLuan(),

   //route quản lí đơn hàng
   'don-hang' => (new AdminDonHangControllers())->danhSachDonHang(),
   'from-sua-don-hang' => (new AdminDonHangControllers())->formEditDonHang(),
   'sua-don-hang' => (new AdminDonHangControllers())->posteditDonHang(),
   'chi-tiet-don-hang' => (new AdminDonHangControllers())->detailDonHang(), 

//route quản lí tài khoản
//quản lí tài khoản quản trị

'list-tai-khoan-quan-tri'=>(new AdminTaiKhoanControllers())->danhSachQuanTri(),
'from-them-quan-tri' => (new AdminTaiKhoanControllers())->formAddQuanTri(),
'them-quan-tri' => (new AdminTaiKhoanControllers())->postAddQuanTri(),
'from-sua-quan-tri' => (new AdminTaiKhoanControllers())->formEditQuanTri(),
'sua-quan-tri' => (new AdminTaiKhoanControllers())->posteditQuanTri(), 

//Route reset password tài khoản

'reset-password' => (new AdminTaiKhoanControllers())->resetPassword(), 

//quản lí tài khoản khách  hàng
'list-tai-khoan-khach-hang'=>(new AdminTaiKhoanControllers())->danhSachKhachHang(),
'from-sua-khach-hang' => (new AdminTaiKhoanControllers())->formEditKhachHang(),
'sua-khach-hang' => (new AdminTaiKhoanControllers())->posteditKhachHang(),
'chi-tiet-khach-hang'=>(new AdminTaiKhoanControllers())->detailKhachHang(),

//route quản lí tài khoản cá nhân(quản trị)
'form-sua-thong-tin-ca-nhan-quan-tri'=>(new AdminTaiKhoanControllers())->formEditCaNhanQuanTri(),
// 'sua-thong-tin-ca-nhan-quan-tri'=>(new AdminTaiKhoanControllers())->postEditCaNhanQuanTri(),
'sua-mat-khau-ca-nhan-quan-tri'=>(new AdminTaiKhoanControllers())->postEditMatKhauCaNhan(),



//route auth
  'login-admin' => (new AdminTaiKhoanControllers())->formLogin(),
  'check-login-admin' => (new AdminTaiKhoanControllers())->login(),
  'logout-admin' => (new AdminTaiKhoanControllers())->logout(),

  
  'bieu-do' => (new AdminBaoCaoThongKeControllers)->bieuDo(),

};
?>