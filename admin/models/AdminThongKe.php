<?php
class adminThongKe{
    // public $conn;
    // public function __construct()
    // {
    //     $this->conn = connectDB();
    // }
    // public function home(){
    //     try{
    //         $sql = 'SELECT danh_mucs.ten_danh_muc, COUNT(san_phams.id) AS so_luong_san_pham
    //         FROM san_phams
    //         INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
    //         GROUP BY danh_mucs.ten_danh_muc';
    //         $result = mysqli_query($conn,$sql);
    //         $data = [];
    //         while($row = mysqli_fetch_array($result)){
    //             $data = $row;
    //         }
            
    //        var_dump($data);die;
            
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt ->execute();
    //         return $stmt->fetch();
    //     }catch (Exception $e){
    //         echo "lỗi" . $e ->getMessage();
    //     }

    // }
}