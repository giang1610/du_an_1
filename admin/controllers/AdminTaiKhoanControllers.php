<?php
class AdminTaiKhoanControllers{
    public $modelTaiKhoan;
    public function __construct(){
        $this->modelTaiKhoan = new AdminTaiKhoan();
    }
    public function danhSachQuanTri(){
        $listQuanTri=$this->modelTaiKhoan->getAllTaiKhoan(1);
        // var_dump($listQuanTri);die();
        require_once './views/taikhoan/quantri/listQuanTri.php';
    }
    public function formAddQuanTri() {

        require_once "./views/taikhoan/quantri/addQuanTri.php";

        deleteSessionError();
    }
    public function postAddQuanTri() {
        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $chuc_vu_id=$_POST['chuc_vu_id'] ?? 1;
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
                header("location:".BASE_URL_ADMIN .'?act=list-tai-khoan-quan-tri');
                exit();

            }else{
                $_SESSION['flash'] = true;
                header("location:".BASE_URL_ADMIN .'?act=from-them-quan-tri');
                exit();
            }
        }
    }

    public function formEditQuanTri() {
        $id_quan_tri = $_GET['id_quan_tri'];

        $quanTri = $this->modelTaiKhoan->getDetailTaiKhoan($id_quan_tri);
        // $listTrangThaiQuanTri= $this->modelTaiKhoan->getAllTrangThaiQuanTri();
        // var_dump($quanTri);die();
        require_once "./views/taikhoan/quantri/editQuanTri.php";
        deleteSessionError();
        

 }

 public function posteditQuanTri() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $quan_tri_id= $_POST['quan_tri_id'] ?? '';

       

        $ho_ten = $_POST['ho_ten'] ?? '';
        $email = $_POST['email'] ?? '';
        $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
        $trang_thai = $_POST['trang_thai'] ?? '';
       
        $errors = [];
      

        if (empty( $ho_ten)) {
            $errors['ho_ten'] = 'Tên không được để trống';
        }
        if (empty( $email)) {
            $errors['email'] = 'Email không được để trống';
        }
        if (empty( $so_dien_thoai)) {
            $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
        }
        if (empty( $trang_thai)) {
            $errors['trang_thai'] = 'Trạng thái tài khoản';
        }
        

        $_SESSION['error'] = $errors;

        if (empty($errors)) {
            // Gọi hàm update sản phẩm và chuyển hướng về trang "san-pham"
            $this->modelTaiKhoan->updateTaiKhoan($quan_tri_id,  $ho_ten, $email, $so_dien_thoai, $trang_thai);
            
            // Chuyển hướng về trang san-pham sau khi cập nhật thành công
            header("Location: ".BASE_URL_ADMIN."?act=list-tai-khoan-quan-tri");
            exit();

        } else {
            // Nếu có lỗi, chuyển về form sửa sản phẩm với ID của sản phẩm
            $_SESSION['flash'] = true;
            header("Location: ".BASE_URL_ADMIN."?act=from-sua-quan-tri&id_quan_tri=".$quan_tri_id);
            exit();
        }
    }

}
public function resetPassword(){
    $tai_khoan_id=$_GET['id_quan_tri'];
    $tai_khoan=$this->modelTaiKhoan->getDetailTaiKhoan($tai_khoan_id);

    $password = password_hash('123@123ab', PASSWORD_BCRYPT);

    $status=$this->modelTaiKhoan->resetPassword($tai_khoan_id,$password);
    if ($status && $tai_khoan['chuc_vu_id']==1) {
        header("Location: ".BASE_URL_ADMIN."?act=list-tai-khoan-quan-tri");
        exit();
}elseif ($status && $tai_khoan['chuc_vu_id']==2) {
    header("Location: ".BASE_URL_ADMIN."?act=list-tai-khoan-khach-hang");
        exit();
}
else {
    var_dump('Lỗi reset tài khoản');die();
}
}
public function danhSachKhachHang(){
    $listKhachHang=$this->modelTaiKhoan->getAllTaiKhoan(2);
    // var_dump($listQuanTri);die();
    require_once './views/taikhoan/khachhang/listKhachHang.php';
}
 public function formEditKhachHang() {
        $id_khach_hang= $_GET['id_khach_hang'];

        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
        // $listTrangThaiQuanTri= $this->modelTaiKhoan->getAllTrangThaiQuanTri();
        // var_dump($quanTri);die();
        require_once "./views/taikhoan/khachhang/editKhachHang.php";
        deleteSessionError();
        }
        public function posteditKhachHang() {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id_khach_hang= $_POST['id_khach_hang'] ?? '';
        
               
        
                $ho_ten = $_POST['ho_ten'] ?? '';
                $email = $_POST['email'] ?? '';
                $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
                $ngay_sinh=$_POST['ngay_sinh'] ??'';
                $gioi_tinh=$_POST['gioi_tinh'] ??'';
                $dia_chi=$_POST['dia_chi'] ??'';
                $trang_thai = $_POST['trang_thai'] ?? '';
               
                $errors = [];
              
        
                if (empty( $ho_ten)) {
                    $errors['ho_ten'] = 'Tên không được để trống';
                }
                if (empty( $email)) {
                    $errors['email'] = 'Email không được để trống';
                }
                if (empty( $so_dien_thoai)) {
                    $errors['so_dien_thoai'] = 'Số điện thoại không được để trống';
                }
                if (empty( $ngay_sinh)) {
                    $errors['ngay_sinh'] = 'Ngày không được để trống';
                }
                if (empty( $gioi_tinh)) {
                    $errors['gioi_tinh'] = 'Giới tính của bạn';
                }
                if (empty( $trang_thai)) {
                    $errors['trang_thai'] = 'Trạng thái tài khoản';
                }
                
        
                $_SESSION['error'] = $errors;
        
                if (empty($errors)) {
                    // Gọi hàm update sản phẩm và chuyển hướng về trang "san-pham"
                    $this->modelTaiKhoan->updateTaiKhoanKhachHang($id_khach_hang,  $ho_ten, $email, $so_dien_thoai,$gioi_tinh,$dia_chi, $trang_thai);
                    
                    // Chuyển hướng về trang san-pham sau khi cập nhật thành công
                    header("Location: ".BASE_URL_ADMIN."?act=list-tai-khoan-khach-hang");
                    exit();
        
                } else {
                    // Nếu có lỗi, chuyển về form sửa sản phẩm với ID của sản phẩm
                    $_SESSION['flash'] = true;
                    header("Location: ".BASE_URL_ADMIN."?act=from-sua-khach-hang&id_khach_hang=".$id_khach_hang);
                    exit();
                }
            }
        
        }
        
    }