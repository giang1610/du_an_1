<?php
class AdminTaiKhoan{
    public $conn;
    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllTaiKhoan($chuc_vu_id){
        try{
            $sql = 'SELECT * FROM tai_khoans WHERE chuc_vu_id = :chuc_vu_id';
            
           
            
            $stmt = $this->conn->prepare($sql);
            $stmt ->execute([':chuc_vu_id'=>$chuc_vu_id]);
            return $stmt->fetchAll();
        }catch (Exception $e){
            echo "lỗi" . $e ->getMessage();
        }
    }
    public function insertTaiKhoan($ho_ten,$email, $password,$chuc_vu_id){
        try{
            $sql = 'INSERT INTO tai_khoans (ho_ten,email, mat_khau,chuc_vu_id) 
            VALUES(:ho_ten,:email, :password,:chuc_vu_id)
            ';
            $stmt = $this->conn->prepare($sql);
            $stmt ->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':password' => $password,
                ':chuc_vu_id' => $chuc_vu_id
            ]);
            return true;
        }catch (Exception $e){
            echo "lỗi" . $e ->getMessage();
        }
    }

//     public function updateDanhMuc($id,$ten_danh_muc, $mo_ta){
//         try{
//             $sql = 'UPDATE danh_mucs set ten_danh_muc = :ten_danh_muc,mo_ta =:mo_ta WHERE id =:id';
//             $stmt = $this->conn->prepare($sql);
//             $stmt ->execute([
//                 ':ten_danh_muc' => $ten_danh_muc,
//                 ':mo_ta' => $mo_ta,
//                 ':id' => $id
//             ]);
//             return true;
//         }catch (Exception $e){
//             echo "lỗi" . $e ->getMessage();
//         }
//     }

//     public function getDetailDanhMuc($id){
//         try{
//             $sql = 'SELECT * FROM danh_mucs Where id = :id';
//             $stmt = $this->conn->prepare($sql);
//             $stmt ->execute([
//                 ':id' => $id
               
//             ]);
//             return $stmt->fetch();
//         }catch (Exception $e){
//             echo "lỗi" . $e ->getMessage();
//         }
//     }

}