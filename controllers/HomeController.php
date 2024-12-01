
<?php 
require_once './models/DonHang.php'; // Đường dẫn chính xác đến file ModelDonHang


class HomeController
{
    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;
    public $conn;


    public function __construct()
    
    {
       $this-> modelSanPham = new sanPham();
       $this-> modelTaiKhoan = new taiKhoan();
       $this-> modelGioHang = new GioHang();
       $this->conn = connectDB();
       if (!$this->conn) {
        die("Kết nối cơ sở dữ liệu thất bại.");
    }
    }

    public function home() {
        $listSanPham = $this -> modelSanPham ->getAllSanPham();
        require_once './views/home.php';
    }
    
    
    public function chiTietSanPham(){
        $id = $_GET['id_san_pham'];

        $sanPham = $this->modelSanPham->getDetailSanPham($id);

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
    
    
    public function dachsachsanpham($kyw = "") {
        try {
            $sql = "SELECT * FROM san_phams WHERE 1";
            if ($kyw != "") {
                $sql .= " AND ten_san_pham LIKE :ten_san_pham"; // Sử dụng placeholder
            }
            $sql .= " ORDER BY id DESC";
    
            $stmt = $this->conn->prepare($sql);
            if ($kyw != "") {
                $stmt->bindValue(':ten_san_pham', '%' . $kyw . '%'); // Ràng buộc giá trị cho placeholder
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Đảm bảo trả về mảng kết hợp
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
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

           

            $errors = [];
            if(empty($ho_ten)){
                $errors['ho_ten'] = 'Họ tên không trống';
            }
            if(empty($email)){
                $errors['email'] = 'Email không trống';
            }

            $_SESSION['error'] = $errors;

            if(empty($errors)){
                
                $password = password_hash('123@123ab', PASSWORD_BCRYPT);
                $this->modelTaiKhoan->insertTaiKhoan($ho_ten,$email, $password,$chuc_vu_id);
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
            var_dump("Chưa đăng nhập");die;
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
        require_once './views/thanhToan.php';
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
    }
    public function huyDonHang(){
        if(isset($_SESSION['user_client'])){
                $this->modelDonHang = new DonHang();
                $user=$this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
                $tai_khoan_id=$user['id'];
        //Lấy ra id đơn hàng   
            $donHangId=$_GET['id'];
            //Kiểm tra có đơn hàng không
            $donHang=$this->modelDonHang->getDonHangById($donHangId);
            if($donHang['tai_khoan_id'] != 1){
                echo"Bạn không có quền hủy đơn hàng này";
                exit;
            }
            if($donHang['trang_thai_id'] != $tai_khoan_id){
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
}
        
    
   
