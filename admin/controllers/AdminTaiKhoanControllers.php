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
                $abc=$this->modelTaiKhoan->insertTaiKhoan($ho_ten,$email, $password,$chuc_vu_id);
                header("location:".BASE_URL_ADMIN .'?act=list-tai-khoan-quan-tri');
                exit();

            }else{
                $_SESSION['flash'] = true;
                header("location:".BASE_URL_ADMIN .'?act=from-them-quan-tri');
                exit();
            }
        }
    }

//     public function formEditDanhMuc() {
//         $id = $_GET['id_danh_muc'];

//         $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
//         if($danhMuc){
//             require_once "./views/danhmuc/editDanhMuc.php";
//         }else{
//             header("location:".BASE_URL_ADMIN .'?act=danhmuc');
//                 exit();
//         }
       

//     }

//     public function posteditDanhMuc() {
//         if($_SERVER['REQUEST_METHOD'] =='POST'){
//             $id = $_POST['id'];
//             $ten_danh_muc = $_POST['ten_danh_muc'];
//             $mo_ta = $_POST['mo_ta'];

//             $errors = [];
//             if(empty($ten_danh_muc)){
//                 $errors['ten_danh_muc'] = 'Tên danh mục không trống';
//             }

            

//             if(empty($errors)){
//                 $this->modelDanhMuc->updateDanhMuc($id,$ten_danh_muc,$mo_ta);
//                 header("location:".BASE_URL_ADMIN .'?act=danhmuc');
//                 exit();

//             }else{
//                 $danhMuc = ['id' => $id,'ten_danh_muc'=> $ten_danh_muc,'mo_ta'=>$mo_ta ];
//                 require_once "./views/danhmuc/editDanhMuc.php";
//             }
//         }
//     }
}