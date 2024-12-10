<?php 

session_start();

// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';

require_once './controllers/DanhMuc.php';

// Require toàn bộ file Models
require_once './models/Student.php';
require_once './models/sanPham.php';
require_once './models/TaiKhoan.php';
require_once './models/GioHang.php';
require_once './models/BinhLuan.php';

// if($_SERVER['REQUEST_METHOD' ] == 'POST') {
//     echo '<pre>';
//         print_r($_POST);
//         die();
// }


// Route
$act = $_GET['act'] ?? '/';
// var_dump($_GET['act']);die();

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ
    '/'                                      => (new HomeController())->home(),
    // 'trangchu'                 => (new HomeController())->trangchu(),
    
    'chi-tiet-san-pham'                      => (new HomeController())-> chiTietSanPham(),
    'them-gio-hang'                          => (new HomeController())->addGioHang(),
    'gio-hang'                               => (new HomeController())->gioHang(),
    'thanh-toan'                             => (new HomeController())->thanhToan(),
    'xu-ly-thanh-toan'                       => (new HomeController())->postThanhToan(),
    'chi-tiet-mua-hang'                      => (new HomeController())->chiTietMuaHang(),
    'lich-su-mua-hang'                       => (new HomeController())->lichSuMuaHang(),
    'huy-don-hang'                           => (new HomeController())->huyDonHang(),
    //sanpham
    'san-pham-theo-danh-muc' => (new DanhMucController())->sanPhamDanhMuc(),
    
    'search' => (new HomeController())->timKiem(),
    //Bình Luận
    'add-binh-luan'=> (new HomeController())->addBinhLuan(),
    // Auth
    'Register' => (new HomeController())->formRegister(),
    'them-Register' => (new HomeController())->postRegister(),
    'login' => (new HomeController())->formLogin(),
    'check-login' => (new HomeController())->postLogin(),
    'logout' => (new HomeController())->logout(),

};