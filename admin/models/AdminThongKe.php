<?php
class AdminThongKe{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function convertToVND($amount)
    {
        return number_format($amount, 0, ',', '.') . ' ₫';  // Định dạng số và thêm "₫" sau tiền
    }
    
    public function getAllThongKe(){
        try{
            $sql = "SELECT danh_mucs.ten_danh_muc, danh_mucs.id, 
                           COUNT(san_phams.id) as countSp, 
                           AVG(san_phams.gia_san_pham) as currentPrice,  -- Giá hiện tại
                           AVG(san_phams.gia_khuyen_mai) as discountPrice  -- Giá khuyến mãi
                    FROM san_phams 
                    LEFT JOIN danh_mucs ON danh_mucs.id = san_phams.danh_muc_id
                    GROUP BY danh_mucs.ten_danh_muc, danh_mucs.id
                    ORDER BY danh_mucs.id DESC";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $thongKe = $stmt->fetchAll();

        // Chuyển đổi giá trị tiền tệ sang VND cho các giá trị liên quan
        foreach ($thongKe as &$item) {
            if (isset($item['currentPrice'])) {
                $item['currentPrice'] = $this->convertToVND($item['currentPrice']);
            }
            if (isset($item['discountPrice'])) {
                $item['discountPrice'] = $this->convertToVND($item['discountPrice']);
            }
        }

        return $thongKe;
    
        } catch(Exception $e){
            echo "Lỗi: ".$e->getMessage();
        }
    }
    
}