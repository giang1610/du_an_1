<?php

class AdminDanhMucControllers {

    public $modelDanhMuc;
    public function __construct()
    {
        $this->modelDanhMuc = new AdminDanhMuc();
    }

    public function danhSachdanhMuc() {
        
        // echo 'trang danh muc';
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once "./views/danhmuc/listDanhMuc.php";
    }

    public function formAddDanhMuc() {

        require_once "./views/danhmuc/addDanhMuc.php";

        deleteSessionError();
    }

    public function postAddDanhMuc() {
        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $ten_danh_muc = $_POST['ten_danh_muc'] ?? '';
            $mo_ta = $_POST['mo_ta'] ?? '';

           

            $errors = [];
            if(empty($ten_danh_muc)){
                $errors['ten_danh_muc'] = 'Tên danh mục không trống';
            }

            $_SESSION['error'] = $errors;

            if(empty($errors)){
                $this->modelDanhMuc->insertDanhMuc($ten_danh_muc,$mo_ta);
                header("location:".BASE_URL_ADMIN .'?act=danhmuc');
                exit();

            }else{
                $_SESSION['flash'] = true;
                header("location:".BASE_URL_ADMIN .'?act=from-them-danh-muc');
                exit();
            }
        }
    }

    public function formEditDanhMuc() {
        $id = $_GET['id_danh_muc'];

        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
        if($danhMuc){
            require_once "./views/danhmuc/editDanhMuc.php";
        }else{
            header("location:".BASE_URL_ADMIN .'?act=danhmuc');
                exit();
        }
       

    }

    public function posteditDanhMuc() {
        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            $errors = [];
            if(empty($ten_danh_muc)){
                $errors['ten_danh_muc'] = 'Tên danh mục không trống';
            }

            

            if(empty($errors)){
                $this->modelDanhMuc->updateDanhMuc($id,$ten_danh_muc,$mo_ta);
                header("location:".BASE_URL_ADMIN .'?act=danhmuc');
                exit();

            }else{
                $danhMuc = ['id' => $id,'ten_danh_muc'=> $ten_danh_muc,'mo_ta'=>$mo_ta ];
                require_once "./views/danhmuc/editDanhMuc.php";
            }
        }
    }

    public function deleteDanhMuc() {
        $id = $_GET['id_danh_muc'];
    
        // Kiểm tra danh mục có tồn tại không trước khi xóa
        $danhMuc = $this->modelDanhMuc->getDetailDanhMuc($id);
    
        if ($danhMuc) {
            $this->modelDanhMuc->destroyDanhMuc($id);
        }
        
        // Điều hướng sau khi xóa để cập nhật danh sách
        header("location:" . BASE_URL_ADMIN . '?act=danhmuc');
        exit();
    }
    
}