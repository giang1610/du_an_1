
<?php 
require_once './models/DonHang.php'; // Đường dẫn chính xác đến file ModelDonHang
require_once './models/BinhLuan.php';

class HomeController
{
    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;
    public $modelBinhLuan;
    public $conn;


    public function __construct()
   

    
    {
       $this-> modelSanPham = new sanPham();
       $this-> modelTaiKhoan = new taiKhoan();
       $this-> modelGioHang = new GioHang();
       $this->modelDonHang = new DonHang();
       $this->modelBinhLuan = new BinhLuan();
    //    $this->modelBinhluan =new BinhLuan
       $this->conn = connectDB();
       if (!$this->conn) {
        die("Kết nối cơ sở dữ liệu thất bại.");
    }
    }

    public function home() {
        $listSanPham = $this -> modelSanPham ->getAllSanPham();
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        $listtop10 = $this->modelSanPham->top10();
        require_once './views/home.php';
    }
    
    
    public function chiTietSanPham(){
        $id = $_GET['id_san_pham'];

        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['danh_muc_id']);

        if($sanPham){
            require_once './views/detailSanPham.php';
        }else{
            header("Location: " . BASE_URL);
            exit();
        }
    }
    
    
   
    public function formRegister() {

        require_once "./views/auth/formRegister.php";

        deleteSessionError();
    }
    public function postRegister() {
        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $chuc_vu_id=$_POST['chuc_vu_id'] ?? 2;
            $ho_ten = $_POST['ho_ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'] ?? '';
            $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';

           

            $errors = [];
            if(empty($ho_ten)){
                $errors['ho_ten'] = 'Họ tên không trống';
            }
            if(empty($email)){
                $errors['email'] = 'Email không trống';
            }
            if(empty($ngay_sinh)){
                $errors['ngay_sinh'] = 'Ngày sinh không trống';
            }
            if(empty($so_dien_thoai)){
                $errors['so_dien_thoai'] = 'Số điện thoạikhông trống';
            }
            $_SESSION['error'] = $errors;

            if(empty($errors)){
                
                $password = password_hash('123@123ab', PASSWORD_BCRYPT);
                $this->modelTaiKhoan->insertTaiKhoanKhachHang($ho_ten,$email, $password,$chuc_vu_id,$ngay_sinh,$so_dien_thoai);
                $_SESSION['success'] = 'Đăng ký thành công! Mật khẩu mặc định là: 123@123ab.';
                header("location:".BASE_URL .'?act=login');
                exit();

            }else{
                $_SESSION['flash'] = true;
                header("location:".BASE_URL .'?act=Register');
                exit();
            }
        }
    }

    
    
    
    

    public function formLogin(){
        require_once './views/auth/formLogin.php';
        deleteSessionError();
        exit();
    }
    public function postlogin(){
        // echo '<pre>';
        // print_r($_POST);
        // die();
        if(!empty($_POST['email'])){
            // lay email va pass gui len tu form
            $email = $_POST['email'];
            $password = $_POST['password'];
            // die('xxxxx');

            // xu li kiem tra thong tin dang nhap
            $user = $this->modelTaiKhoan->checkLogin($email, $password);
            // var_dump($user == $email);
            // die();
            if($user == $email){ // truong hop dang nhap thanh cong
                // luu thong tin vao session
                $_SESSION['user_client'] = $user;
                header("Location: " . BASE_URL);
                exit();
            }else{
                // loi thi luu loi vao session
                $_SESSION['error'] = $user; 
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL . '?act=login');
                exit();
            }
        }else{
            die("khong phai post");
        }
    }
    public function logout() {
        if (isset($_SESSION['user_client'])) {
            unset($_SESSION['user_client']); // Xóa thông tin đăng nhập
            session_destroy(); // Hủy toàn bộ session (nếu cần)
            header("Location: " . BASE_URL); // Chuyển hướng về trang chủ
            exit();
        } else {
            header("Location: " . BASE_URL); // Nếu chưa đăng nhập, chuyển về trang chủ
            exit();
        }
    }
    
    public function addGioHang(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_SESSION['user_client'])){
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            // Lấy dữ liệu giỏ hàng của người dùng
            // var_dump($mail['id']);die;
            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
            if(!$gioHang){
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                $gioHang = ['id'=>$gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }else{
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }

            $san_pham_id = $_POST['san_pham_id'];
            $so_luong = $_POST['so_luong'];

            $checkSanPham = false;

            foreach($chiTietGioHang as $detail){
                if($detail['san_pham_id'] == $san_pham_id){
                    $newSoLuong = $detail['so_luong'] + $so_luong;
                    $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $newSoLuong);
                    $checkSanPham = true;
                    break;
                }
            }
            if(!$checkSanPham){
                $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
            }
            header("Location:" . BASE_URL . '?act=gio-hang');
        }else{
            header("Location:" . BASE_URL . '?act=login');
        }
    }
}
    public function gioHang(){
        if(isset($_SESSION['user_client'])){
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            // Lấy dữ liệu giỏ hàng của người dùng
            // var_dump($mail['id']);die;
            $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);
            if(!$gioHang){
                $gioHangId = $this->modelGioHang->addGioHang($mail['id']);
                $gioHang = ['id'=>$gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }else{
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }

            require_once './views/gioHang.php';

        }else{
            header("Location: " . BASE_URL . '?act=login');
        }
    }
    public function thanhToan(){
        if(isset($_SESSION['user_client'])){
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            // Lấy dữ liệu giỏ hàng của người dùng
            // var_dump($mail['id']);die;
            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
            if(!$gioHang){
                $gioHangId = $this->modelGioHang->addGioHang($user['id']);
                $gioHang = ['id'=>$gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }else{
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }

            require_once './views/thanhToan.php';

        }else{
            var_dump('Chưa đăng nhập');die;
        }

    }
    public function postThanhToan(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];

            $ngay_dat = date('Y-m-d');
            $trang_thai_id = 1;

            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];

            $ma_don_hang = 'DH' . rand(1000, 9999);

            // Thêm thông tin vào db

            $donHang = $this->modelDonHang->addDonHang($tai_khoan_id, $ten_nguoi_nhan, $email_nguoi_nhan, $sdt_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $tong_tien, $phuong_thuc_thanh_toan_id, $ngay_dat, $ma_don_hang, $trang_thai_id);
            // Lấy thông tin giỏ hàng của người dùng
            $gioHang = $this->modelGioHang->getGioHangFromUser($tai_khoan_id);

            // Lưu sản phẩm vào chi tiết đơn hàng
            if($donHang){
                // Lấy ra toàn bộ sản phẩm trong giỏ hàng
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                
                // Thêm từng sản phẩmtừ giỏ hàng vào bảng chi tiết đơn hàng
                foreach($chiTietGioHang as $item){
                    $donGia = $item['gia_khuyen_mai'] ?? $item['gia_san_pham']; // Ưu tiên đơn giá sẽ lấy giá khuyến mãi

                    $this->modelDonHang->addChiTietDonHang(
                        $donHang, // ID đơn hàng vừa tạo
                        $item['san_pham_id'], // ID sản phẩm
                        $donGia, // Đơn giá lấy từ sản phẩm
                        $item['so_luong'], // Số lượng
                        $donGia * $item['so_luong'] // Thành tiền
                    );
                }

                // Sau khi thêm xong thì phải tiến hành xóa sản phẩm trong giỏ hàng
                // Xóa toàn bộ sản phẩm trong chi tiết gior hàng
                $this->modelGioHang->clearDetailGioHang($gioHang['id']);

                // Xóa thông tin giỏ hàng người dùng
                $this->modelGioHang->clearGioHang($tai_khoan_id);

                // Chuyển hướng về trang lịch sử mua hàng
                header("Location: " . BASE_URL . '?act=lich-su-mua-hang');
                exit;

            }else{
                var_dump('Lỗi đặt hàng. VUi lòng thử lại sau');
                die;
            }
        }
    }
    public function lichSuMuaHang(){
        if(isset($_SESSION['user_client'])){
            $this->modelDonHang = new DonHang();
            $user=$this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id=$user['id'];
            //DS trạng thái đơn hàng
                $arrTrangThaiDonHang=$this->modelDonHang->getTrangThaiDonHang();
                $arrTrangThaiDonHang=array_column($arrTrangThaiDonHang,'ten_trang_thai','id');
                // var_dump($arrTrangThaiDonHang);die
            //DS phương thức thanh toán
            $arrPhuongThucThanhToan=$this->modelDonHang->getPhuongThucThanhToan();
            $arrPhuongThucThanhToan=array_column($arrPhuongThucThanhToan,'ten_phuong_thuc','id');
            //DS tất cả đơn hàng
            $donHangs=$this->modelDonHang->getDonHangFromUser($tai_khoan_id) ;
        require_once "./views/lichSuMuaHang.php";

    }else{
        var_dump("Bạn chưa đăng nhập!Vui lòng đăng nhập để tiếp tục");die();
    }
}
    public function chiTietMuaHang(){

        if(isset($_SESSION['user_client'])){
            $user=$this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id=$user['id'];
    //Lấy ra id đơn hàng   
        $donHangId=$_GET['id'];
    //DS trạng thái đơn hàng
         $arrTrangThaiDonHang=$this->modelDonHang->getTrangThaiDonHang();
         $arrTrangThaiDonHang=array_column($arrTrangThaiDonHang,'ten_trang_thai','id');
         // var_dump($arrTrangThaiDonHang);die
    //DS phương thức thanh toán
     $arrPhuongThucThanhToan=$this->modelDonHang->getPhuongThucThanhToan();
     $arrPhuongThucThanhToan=array_column($arrPhuongThucThanhToan,'ten_phuong_thuc','id');
    //Lấy thông tin đơn hàng
        $donHangId=$_GET['id'];
       $donHang =$this->modelDonHang->getDonHangById($donHangId);
    //Lấy thông tin sản phẩm
    $ChiTietDonHang=$this->modelDonHang->getChiTietDonHangByDonHangId($donHangId);


    if($donHang['tai_khoan_id'] !=$tai_khoan_id){
        echo"Bạn không có quyền truy cập";
        exit;
    }
    require_once "./views/chiTietMuaHang.php";
    }else{
        var_dump('Bạn chưa đăng nhập!Vui lòng đăng nhập đẻ tiếp tục');
    }
        

    }
    public function huyDonHang(){
        if(isset($_SESSION['user_client'])){
                $user=$this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
                $tai_khoan_id=$user['id'];
        //Lấy ra id đơn hàng   
            $donHangId=$_GET['id'];
        //Kiểm tra có đơn hàng không
            $donHang=$this->modelDonHang->getDonHangById($donHangId);
            if($donHang['tai_khoan_id'] != $tai_khoan_id){
                echo"Bạn không có quyền hủy đơn hàng này";
                exit;
            }
            if($donHang['trang_thai_id'] != 1){
                echo"Đơn hàng ở trạng thái 'Chưa xác nhận' mới hủy được";
                exit;
            }
            //Hủy đơn
            $this->modelDonHang->updateTrangThaiDonHang($donHangId,11);

            header("Location: " . BASE_URL . '?act=lich-su-mua-hang');
            exit;
        }else{
            var_dump('Bạn chưa đăng nhập!Vui lòng đăng nhập đẻ tiếp tục');
        }
    }

    public function timKiem()
    {
        // Lấy danh sách danh mục và top 10 sản phẩm để hiển thị lên giao diện
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();
        $listtop10 = $this->modelSanPham->top10();

        // Kiểm tra nếu phương thức gửi dữ liệu là POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy từ khóa từ người dùng và loại bỏ khoảng trắng thừa
            $keyword = trim($_POST['keyword'] ?? '');

            if (empty($keyword)) {
                // Nếu từ khóa rỗng, chuyển hướng hoặc hiển thị thông báo
                $error = "Vui lòng nhập từ khóa tìm kiếm.";
                header("Location: " . BASE_URL);
                return;
            }

            // Tìm kiếm sản phẩm theo từ khóa
            $listSanPhamTimKiem = $this->modelSanPham->search(htmlspecialchars($keyword));

            // Hiển thị trang tìm kiếm
            require_once './views/timKiemSp.php';
        } else {
            // Chuyển hướng về trang chủ nếu không phải phương thức POST
            header("Location: " . BASE_URL);
            exit;
        }
    }

    public function formAddDanhMuc() {

        require_once "./views/danhmuc/addDanhMuc.php";

        deleteSessionError();
    }
    public function addBinhLuan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_client'])) {
                $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
                $taiKhoanId = $user['id'];
                $sanPhamId = $_POST['san_pham_id'];
                $noiDung = $_POST['noi_dung'];
    
                if (!empty($noiDung)) {
                    $this->modelBinhLuan->addBinhLuan($sanPhamId, $taiKhoanId, $noiDung);
                    $_SESSION['success'] = "Thêm bình luận thành công!";
                } else {
                    $_SESSION['error'] = "Nội dung bình luận không được để trống.";
                }
                header("Location: " . BASE_URL . "?act=chi-tiet-san-pham&id_san_pham=" . $sanPhamId);
            } else {
                $_SESSION['error'] = "Bạn cần đăng nhập để bình luận.";
                header("Location: " . BASE_URL . "?act=login");
            }
            exit();
        }
    }
    

}
        
    
   
