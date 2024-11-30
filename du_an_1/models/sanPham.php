<?php

class SanPham{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllSanPham(){
        try{
            $sql = 'SELECT * FROM san_phams';
            
           
            
            $stmt = $this->conn->prepare($sql);
            $stmt ->execute();
            return $stmt->fetchAll();
        }catch (Exception $e){
            echo "lỗi" . $e ->getMessage();
        }
    }
    public function getAllProduct() {
        try {
            $sql = 'SELECT * FROM san_phams.*, danh_mucs.ten_danh_muc
            FROM san_phams
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();

        }catch (Exception $e){
            echo "lỗi" . $e->getMessage();
        }
    }   
    public function getDetailSanPham($id){
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
            FROM san_phams
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
            WHERE san_phams.id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id'=>$id]);

            return $stmt->fetch();
        } catch(Exception $e){
            echo "Lỗi" . $e->getMessage();
        }
    }
    public function getListAnhSanPham($id){
        try{
            $sql = 'SELECT * FROM hinh_anh_san_phams WHERE san_pham_id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id'=>$id]);

            return $stmt->fetchAll();
        } catch (Exception $e){
            echo "Lỗi" . $e->getMessage();
        }
    }
    public function getBinhLuanFromSanPham($id){
        try{
            $sql = 'SELECT binh_luans.*,tai_khoans.ho_ten, tai_khoans.anh_dai_dien
            FROM binh_luans
            INNER JOIN tai_khoans ON binh_luans.tai_khoan_id = tai_khoans.id
            WHERE binh_luans.san_pham_id = :id
            ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id'=>$id]);

            return $stmt->fetchAll();
        }catch (Exception $e){
            echo "Lỗi" . $e->getMessage();
        }
    }
    public function getListSanPhamDanhMuc($danh_muc_id) {
        try {
            // Truy vấn SQL
            $sql = 'SELECT san_phams.id, san_phams.ten_san_pham, san_phams.gia, danh_mucs.ten_danh_muc
                    FROM san_phams
                    INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                    WHERE san_phams.danh_muc_id = ' . $danh_muc_id;
    
            // Chuẩn bị và thực thi câu lệnh
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':danh_muc_id' => $danh_muc_id]);
    
            // Trả về danh sách sản phẩm
            return $stmt->fetchAll();
    
        } catch (Exception $e) {
            // Xử lý lỗi
            error_log("SQL Error: " . $e->getMessage());
            
            return [];
        }
    }
    
}

?>
