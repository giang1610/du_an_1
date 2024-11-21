<?php 

class HomeController
{
    public $modelSanPham;

    public function __construct()
    {
       $this-> modelSanPham = new sanPham();
    }

    public function home() {
        require_once './views/home.php';
    }
    public function trangchu() {
        echo "trangchu đây";
    }
    public function dachsachsanpham() {
        $listProduct = $this -> modelSanPham ->getAllProduct();
        require_once './views/listProduct.php';
    }
}