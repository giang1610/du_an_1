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
        deleteSessionError();

    }

    public function postAddSanPham() {
        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $ten_san_pham = $_POST['ten_san_pham'] ?? '';
            $gia_san_pham = $_POST['gia_san_pham']?? '';
            $gia_khuyen_mai = $_POST['gia_khuyen_mai']?? '';
            $so_luong = $_POST['so_luong']?? '';
            $ngay_nhap = $_POST['ngay_nhap']?? '';
            $danh_muc_id = $_POST['danh_muc_id']?? '';
            $trang_thai = $_POST['trang_thai']?? '';
            $mo_ta = $_POST['mo_ta']?? '';

            $hinh_anh = $_FILES['hinh_anh'] ?? null;

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
            if($hinh_anh['error'] !== 0){
                $errors['hinh_anh'] = 'hinh anh san pham không trống';
            }

            $_SESSION['error'] = $errors;

            if(empty($errors)){
                $san_pham_id = $this->modelSanPham->insertSanPham($ten_san_pham,$gia_san_pham,$gia_khuyen_mai,$so_luong,$ngay_nhap,$danh_muc_id,$trang_thai,$mo_ta,$fil_thumb);
                if(!empty($img_array['name'])){
                    foreach($img_array['name'] as $key =>$value){
                        $file = [
                            'name' => $img_array['name'][$key],
                            'type' => $img_array['type'][$key],
                            'tmp_name' => $img_array['tmp_name'][$key],
                            'error' => $img_array['error'][$key],
                            'size' => $img_array['size'][$key],
                        ];
                        $link_hinh_anh = uploadFile($file, './uploads/');
                        $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id,$link_hinh_anh);
                    }
                }
                // var_dump($san_pham_id);die;
                header("location:".BASE_URL_ADMIN .'?act=san-pham');
                exit();

            }else{
                $_SESSION['flash'] = true;
                header("location:".BASE_URL_ADMIN .'?act=from-them-san-pham');
                exit();
            }
        }
    }

    public function formEditSanPham() {
     
    
        $id = $_GET['id_san_pham'];
        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        var_dump($sanPham);die;
        $listSanPham =$this->modelSanPham->getListAnhSanPham($id);
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        if($sanPham){
            require_once "./views/sanpham/editSanPham.php";
        }else{
            header("location:".BASE_URL_ADMIN .'?act=san-pham');
                exit();
        }
       

    }

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