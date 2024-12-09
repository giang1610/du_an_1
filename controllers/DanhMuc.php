<?php


class DanhMucController
{
    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
    }

    public function sanPhamDanhMuc()
    {
        $listtop10 = $this->modelSanPham->top10();

        if (isset($_GET['danh_muc_id']) && $_GET['danh_muc_id'] > 0) {
            $iddm = $_GET['danh_muc_id'];
            $spdm = $this->modelSanPham->sanPhamTheoDanhMuc($iddm);
            //var_dump($spdm);die();


            $listDanhMuc = $this->modelSanPham->getAllDanhMuc();
            //    var_dump($listDanhMuc);die();
            require_once './views/sanPhamTheoDanhMuc.php';
        } else {
            $listDanhMuc = $this->modelSanPham->getAllDanhMuc();
            $listSanPham = $this->modelSanPham->getAllSanPham();
            $listtop10 = $this->modelSanPham->top10();
            require_once './views/sanPham.php';
        }
    }
}
