<?php

class LienHe
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB(); // Hàm kết nối cơ sở dữ liệu
    }

    // Phương thức lấy tất cả dữ liệu, hỗ trợ tìm kiếm bằng từ khóa
    public function getAll()
    {
        $sql = "SELECT * FROM lien_hes";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Phương thức lấy một bản ghi theo ID
    public function getById($id)
    {
        $sql = "SELECT * FROM lien_hes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Phương thức tạo mới một bản ghi
    public function create($data)
    {
        $sql = "INSERT INTO lien_hes (email, noi_dung, trang_thai) 
                VALUES (:email, :noi_dung, :trang_thai)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    // Phương thức cập nhật một bản ghi
    public function update($id, $data)
    {
        $sql = "UPDATE lien_hes SET email = :email, noi_dung = :noi_dung, trang_thai = :trang_thai
                WHERE id = :id";
        $data['id'] = $id;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    // Phương thức xóa một bản ghi
    public function delete($id)
    {
        $sql = "DELETE FROM lien_hes WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
     // Thêm phương thức tìm kiếm
     public function search($keyword)
     {
        $sql = "SELECT * FROM lien_hes WHERE noi_dung LIKE :keyword OR email LIKE :keyword";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        
        // Kiểm tra kết quả tìm kiếm
        $results = $stmt->fetchAll();
        var_dump($results); // Thêm dòng này để kiểm tra kết quả
        return $results;
    }
}
