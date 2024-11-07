<?php 

// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/AdminDanhMucControllers.php';
require_once './controllers/AdminSanPhamControllers.php';

// Require toàn bộ file Models
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';

// Route
$act = strtolower($_GET['act'] ?? '/');


// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match
match ($act) {
    // Dashboards
    'danhmuc' => (new AdminDanhMucControllers())->danhSachdanhMuc(),
    'from-them-danh-muc' => (new AdminDanhMucControllers())->formAddDanhMuc(),
    'them-danh-muc' => (new AdminDanhMucControllers())->postAddDanhMuc(),
    'from-sua-danh-muc' => (new AdminDanhMucControllers())->formEditDanhMuc(),
    'sua-danh-muc' => (new AdminDanhMucControllers())->posteditDanhMuc(), 
    'xoa-danh-muc' => (new AdminDanhMucControllers())->deleteDanhMuc(),
   
    'san-pham' => (new AdminSanPhamControllers())->danhSachSanPham(),
    'from-them-san-pham' => (new AdminSanPhamControllers())->formAddSanPham(),
    'them-san-pham' => (new AdminSanPhamControllers())->postAddSanPham(),
    // 'from-sua-san-pham' => (new AdminSanPhamControllers())->formEditSanPham(),
    // 'sua-san-pham' => (new AdminSanPhamControllers())->posteditSanPham(), 
    // 'xoa-san-pham' => (new AdminSanPhamControllers())->deleteSanPham(),
   
};
?>