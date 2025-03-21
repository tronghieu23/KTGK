<?php
class Student {
    private $conn;
    private $table = "SinhVien";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT sv.*, nh.TenNganh 
                 FROM " . $this->table . " sv
                 JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($data) {
        try {
            $query = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                      VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            return $stmt->execute([
                $data['masv'],
                $data['hoten'],
                $data['gioitinh'],
                $data['ngaysinh'],
                $data['hinh'] ?? null,  // Handle image field
                $data['manganh']
            ]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                throw new Exception("Mã sinh viên đã tồn tại!");
            }
            throw new Exception("Lỗi: " . $e->getMessage());
        }
    }

    public function getById($id) {
        $query = "SELECT sv.*, nh.TenNganh 
                 FROM " . $this->table . " sv
                 JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh
                 WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data) {
        $query = "UPDATE " . $this->table . "
                 SET HoTen=:hoten, GioiTinh=:gioitinh, 
                     NgaySinh=:ngaysinh, Hinh=:hinh, MaNganh=:manganh
                 WHERE MaSV=:masv";
        
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE MaSV = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>