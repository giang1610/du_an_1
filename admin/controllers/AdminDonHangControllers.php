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
   

    public function formEditDonHang() {
     
    
        $id = $_GET['id_don_hang'];
        $donHang = $this->modelDonHang->getDetailDonHang($id);
        $listTrangThaiDonHang= $this->modelDonHang->getAllTrangThaiDonHang();
        if($donHang){
            require_once "./views/donhang/editDonHang.php";
            deleteSessionError();
        }else{
            header("location:".BASE_URL_ADMIN .'?act=don-hang');
                exit();
        }
       

    }

   
    public function posteditDonHang() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $don_hang_id = $_POST['id_don_hang'] ?? '';
    
    
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? '';
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
            $dia_chi_nguoi_nhan= $_POST['dia_chi_nguoi_nhan'] ?? '';
            $ghi_chu= $_POST['ghi_chu'] ?? '';
            $trang_thai_id = $_POST['trang_thai_id'];
    
           
    
            $errors = [];
            
            if (empty($ten_nguoi_nhan)) {
                $errors['ten_nguoi_nhan'] = 'Tên người nhân không được để trống';
            }
            if (empty($sdt_nguoi_nhan)) {
                $errors['sdt_nguoi_nhan'] = 'SĐT không được để trống';
            }
            if (empty($email_nguoi_nhan)) {
                $errors['email_nguoi_nhan'] = 'Email không được để trống';
            }
            if (empty($dia_chi_nguoi_nhan)) {
                $errors['email_nguoi_nhan'] = 'Địa chỉ không được để trống';
            }
            if (empty($trang_thai_id)) {
                $errors['trang_thai_id'] = 'Trạng thái đơn hàng';
            }
            
            $_SESSION['error'] = $errors;
           
             if (empty($errors)) {
                // Gọi hàm update sản phẩm và chuyển hướng về trang "san-pham"
                $this->modelDonHang->updateDonHang($ten_nguoi_nhan, $sdt_nguoi_nhan, $email_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $trang_thai_id, $don_hang_id);
                // Chuyển hướng về trang san-pham sau khi cập nhật thành công
                header("Location: ".BASE_URL_ADMIN."?act=don-hang");
                exit();
                // var_dump($abc);die();
    
            } else {
                // Nếu có lỗi, chuyển về form sửa sản phẩm với ID của sản phẩm
                $_SESSION['flash'] = true;
                 header("Location: ".BASE_URL_ADMIN."?act=from-sua-don-hang&id_don_hang=".$don_hang_id);
                 exit();
             }
        }



    }
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