<?php
class DanhMuc
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM danh_mucs";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM danh_mucs WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO danh_mucs (ten_danh_muc, mo_ta, trang_thai) 
                VALUES (:ten_danh_muc, :mo_ta, :trang_thai)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE danh_mucs SET ten_danh_muc = :ten_danh_muc, mo_ta = :mo_ta, trang_thai = :trang_thai
                WHERE id = :id";
        $data['id'] = $id;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM danh_mucs WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
     // Thêm phương thức tìm kiếm
     public function search($keyword)
     {
        $sql = "SELECT * FROM danh_mucs WHERE ten_danh_muc LIKE :keyword OR mo_ta LIKE :keyword";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        
        // Kiểm tra kết quả tìm kiếm
        $results = $stmt->fetchAll();
        var_dump($results); // Thêm dòng này để kiểm tra kết quả
        return $results;
    }
}
