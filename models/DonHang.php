<?php
class DonHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    
    public function getDonHangFromUser($taiKhanId){
        try{
        $sql = 'SELECT * FROM don_hangs WHERE tai_khoan_id = :tai_khoan_id';
        $stmt = $this->conn ->prepare($sql);

        $stmt->execute([':tai_khoan_id'=>$taiKhanId]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (Exception $e){
        echo "Lỗi" . $e->getMessage();
    }
}
public function getTrangThaiDonHang(){
    try{
    $sql = 'SELECT * FROM trang_thai_don_hangs';
    $stmt = $this->conn ->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch (Exception $e){
    echo "Lỗi" . $e->getMessage();
}
}
public function getPhuongThucThanhToan(){
    try{
    $sql = 'SELECT * FROM phuong_thuc_thanh_toans';
    $stmt = $this->conn ->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}catch (Exception $e){
    echo "Lỗi" . $e->getMessage();
}
}
public function getDonHangById($donHangId){
    try{
    $sql = 'SELECT * FROM don_hangs WHERE id=:id';
    $stmt = $this->conn ->prepare($sql);
    $stmt->execute([':id'=>$donHangId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}catch (Exception $e){
    echo "Lỗi" . $e->getMessage();
}
}
public function updateTrangThaiDonHang($donHangId,$trangThaiID){
    try{
    $sql = 'UPDATE don_hangs SET trang_thai_id=:trang_thai_id WHERE id=:id';
    $stmt = $this->conn ->prepare($sql);
    $stmt->execute([
        ':trang_thai_id'=>$trangThaiID,
        ':id'=>$donHangId
    ]);
    return true;
}catch (Exception $e){
    echo "Lỗi" . $e->getMessage();
}
}
}
?>