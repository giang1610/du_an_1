<?php

class TaiKhoan
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function checkLogin($email, $mat_khau){
        try{
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email'=>$email]);
            $user = $stmt->fetch();

            if($user && password_verify($mat_khau, $user['mat_khau'])){
                if($user['chuc_vu_id'] == 2){
                    if($user['trang_thai'] == 1){
                        return $user['email']; // truong hop dang nhap thanh cong
                    }else{
                        return "Tài khoản bị cấm";
                    }
                }else{
                    return "Tài khoản không có quyền đăng nhập";
                }
            }else{
                return "Bạn nhập sai thông tin tài khoản hoặc mật khẩu";
            }
        }catch(\Exception $e){
            echo "Lỗi" . $e->getMessage();
            return false;
        }
    }
    public function getTaiKhoanFromEmail($email){
        try{
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';

            $stmt =$this->conn->prepare($sql);

            $stmt->execute([
                ':email' => $email
            ]);
            return $stmt->fetch();
        }catch (Exception $e){
            echo "Lỗi" . $e->getMessage();
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

    public function insertTaiKhoanKhachHang($ho_ten,$email, $password,$chuc_vu_id,$ngay_sinh){
        try{
            $sql = 'INSERT INTO tai_khoans (ho_ten,email, mat_khau,chuc_vu_id,ngay_sinh) 

            ';
            $stmt = $this->conn->prepare($sql);
            $stmt ->execute([
                ':ho_ten' => $ho_ten,
                ':email' => $email,
                ':password' => $password,
                ':chuc_vu_id' => $chuc_vu_id,
                ':ngay_sinh' => $ngay_sinh

            ]);
            return true;
        }catch (Exception $e){
            echo "lỗi" . $e ->getMessage();
        }
    }
}

?>