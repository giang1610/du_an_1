<?php 
class AdminBaoCaoThongKeControllers{
    
    public $modelThongKe;
    
    public function __construct()
    {
        $this->modelThongKe = new AdminThongKe();
    }

    public function home(){
        $listThongKe = $this->modelThongKe->getAllThongKe();
        // var_dump($listThongKe);die();
        require_once './views/home.php';
    }
    public function bieuDo(){
        $listThongKe = $this->modelThongKe->getAllThongKe();
        // var_dump($listThongKe);die();
        require_once './views/bieudo/bieuDo.php';

    }

    
}