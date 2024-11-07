<?php

class AdminSanPhamControllers {

    public $modelSanPham;
    public $modelDanhMuc;
    public function __construct()
    {
        $this->modelSanPham = new AdminSanPham();
        $this->modelDanhMuc = new AdminDanhMuc();
    }

    public function danhSachSanPham() {
        
        // echo 'trang danh muc';
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once "./views/sanpham/listSanPham.php";
    }

    public function formAddSanPham() {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();

        require_once "./views/SanPham/addSanPham.php";

    }

    public function postAddSanPham() {
        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $ten_san_pham = $_POST['ten_san_pham'];
            $gia_san_pham = $_POST['gia_san_pham'];
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'];
            $so_luong = $_POST['so_luong'];
            $ngay_nhap = $_POST['ngay_nhap'];
            $danh_muc_id = $_POST['danh_muc_id'];
            $trang_thai = $_POST['trang_thai'];
            $mo_ta = $_POST['mo_ta'];

            $hinh_anh = $_FILES['hinh_anh'];

            $fil_thumb = uploadFile($hinh_anh,'./uploads/');

            $img_array = $_FILES['img_array'];

            $errors = [];
            if(empty($ten_san_pham)){
                $errors['ten_san_pham'] = 'Tên san pham không trống';
            }
            if(empty($gia_san_pham )){
                $errors['gia_san_pham '] = 'Gia san pham không trống';
            }
            if(empty($gia_khuyen_mai)){
                $errors['gia_khuyen_mai'] = 'gia khuyen mai không trống';
            }
            if(empty($so_luong)){
                $errors['so_luong'] = 'Số lượng san pham không trống';
            }
            if(empty($ngay_nhap)){
                $errors['ngay_nhap'] = 'ngay nhap san pham không trống';
            }
            if(empty($danh_muc_id)){
                $errors['danh_muc_id'] = 'Danh muc san pham phải chọn';
            }
            if(empty($trang_thai)){
                $errors['trang_thai'] = 'trang thai san pham không trống';
            }
            if(empty($errors)){
                $this->modelSanPham->insertSanPham($ten_san_pham,$gia_san_pham,$gia_khuyen_mai,$so_luong,$ngay_nhap,$danh_muc_id,$trang_thai,$mo_ta,$fil_thumb);
                header("location:".BASE_URL_ADMIN .'?act=san-pham');
                exit();

            }else{
                require_once "./views/sanpham/addSanPham.php";
            }
        }
    }

    // public function formEditSanPham() {
    //     $id = $_GET['id_danh_muc'];

    //     $SanPham = $this->modelSanPham->getDetailSanPham($id);
    //     if($SanPham){
    //         require_once "./views/SanPham/editSanPham.php";
    //     }else{
    //         header("location:".BASE_URL_ADMIN .'?act=SanPham');
    //             exit();
    //     }
       

    // }

    // public function posteditSanPham() {
    //     if($_SERVER['REQUEST_METHOD'] =='POST'){
    //         $id = $_POST['id'];
    //         $ten_danh_muc = $_POST['ten_danh_muc'];
    //         $mo_ta = $_POST['mo_ta'];

    //         $errors = [];
    //         if(empty($ten_danh_muc)){
    //             $errors['ten_danh_muc'] = 'Tên danh mục không trống';
    //         }
    //         if(empty($errors)){
    //             $this->modelSanPham->updateSanPham($id,$ten_danh_muc,$mo_ta);
    //             header("location:".BASE_URL_ADMIN .'?act=SanPham');
    //             exit();

    //         }else{
    //             $SanPham = ['id' => $id,'ten_danh_muc'=> $ten_danh_muc,'mo_ta'=>$mo_ta ];
    //             require_once "./views/SanPham/editSanPham.php";
    //         }
    //     }
    // }

    // public function deleteSanPham() {
    //     $id = $_GET['id_danh_muc'];
    
    //     // Kiểm tra danh mục có tồn tại không trước khi xóa
    //     $SanPham = $this->modelSanPham->getDetailSanPham($id);
    
    //     if ($SanPham) {
    //         $this->modelSanPham->destroySanPham($id);
    //     }
        
    //     // Điều hướng sau khi xóa để cập nhật danh sách
    //     header("location:" . BASE_URL_ADMIN . '?act=SanPham');
    //     exit();
    // }
    
}