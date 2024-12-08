<?php
class BinhLuan {
    private $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // Lấy danh sách bình luận của một sản phẩm
    public function getBinhLuanBySanPhamId($sanPhamId) {
        $stmt = $this->conn->prepare("SELECT * FROM binh_luans WHERE san_pham_id = ? ORDER BY ngay_dang DESC");
        $stmt->execute([$sanPhamId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm một bình luận mới
    public function addBinhLuan($sanPhamId, $taiKhoanId, $noiDung) {
        $stmt = $this->conn->prepare("INSERT INTO binh_luans (san_pham_id, tai_khoan_id, noi_dung) VALUES (?, ?, ?)");
        return $stmt->execute([$sanPhamId, $taiKhoanId, $noiDung]);
    }
}
