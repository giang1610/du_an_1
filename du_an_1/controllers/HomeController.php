<?php 

class HomeController
{
    public $modelSanPham;

    public function __construct()
    {
       $this-> modelSanPham = new sanPham();
    }

    public function home() {
        echo "home đây";
    }
    public function trangchu() {
        echo "trangchu đây";
    }
    public function dachsachsanpham() {
        $listProduct = $this -> modelSanPham ->getAllProduct();
        require_once './views/listProduct.php';
    }
}