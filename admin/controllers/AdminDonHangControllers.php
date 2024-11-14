<?php

class AdminDonHangControllers {

    public $modelDonHang;
    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
    }

    public function danhSachDonHang() {
        
        // echo 'trang danh muc';
        $listDonHang = $this->modelDonHang->getAllDonHang();
        require_once "./views/donhang/listDonHang.php";
    }
    public function detailDonHang() {
        $don_hang_id=$_GET['id_don_hang'];

        $donHang=$this->modelDonHang->getDetailDonHang($don_hang_id);
        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);
        $listTrangThaiDonHang= $this->modelDonHang->getAllTrangThaiDonHang();
        require_once './views/donhang/detailDonHang.php';
    }
   

    // public function formEditDonHang() {
     
    
    //     $id = $_GET['id_san_pham'];
    //     $DonHang = $this->modelDonHang->getDetailDonHang($id);
    //     var_dump($DonHang);die;
    //     $listDonHang =$this->modelDonHang->getListAnhDonHang($id);
    //     $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
    //     if($DonHang){
    //         require_once "./views/DonHang/editDonHang.php";
    //     }else{
    //         header("location:".BASE_URL_ADMIN .'?act=san-pham');
    //             exit();
    //     }
       

    // }

    // public function posteditDonHang() {
    //     if($_SERVER['REQUEST_METHOD'] =='POST'){
    //         $id = $_POST['id'];
    //         $ten_danh_muc = $_POST['ten_danh_muc'];
    //         $mo_ta = $_POST['mo_ta'];

    //         $errors = [];
    //         if(empty($ten_danh_muc)){
    //             $errors['ten_danh_muc'] = 'Tên danh mục không trống';
    //         }
    //         if(empty($errors)){
    //             $this->modelDonHang->updateDonHang($id,$ten_danh_muc,$mo_ta);
    //             header("location:".BASE_URL_ADMIN .'?act=DonHang');
    //             exit();

    //         }else{
    //             $DonHang = ['id' => $id,'ten_danh_muc'=> $ten_danh_muc,'mo_ta'=>$mo_ta ];
    //             require_once "./views/DonHang/editDonHang.php";
    //         }
    //     }
    // }

    // public function deleteDonHang() {
    //     $id = $_GET['id_danh_muc'];
    
    //     // Kiểm tra danh mục có tồn tại không trước khi xóa
    //     $DonHang = $this->modelDonHang->getDetailDonHang($id);
    
    //     if ($DonHang) {
    //         $this->modelDonHang->destroyDonHang($id);
    //     }
        
    //     // Điều hướng sau khi xóa để cập nhật danh sách
    //     header("location:" . BASE_URL_ADMIN . '?act=DonHang');
    //     exit();
    // }
    
}