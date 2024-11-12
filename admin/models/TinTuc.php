<?php
class TinTuc
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM tin_tucs";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM tin_tucs WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO tin_tucs (tieu_de, noi_dung, trang_thai) 
                VALUES (:tieu_de, :noi_dung, :trang_thai)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE tin_tucs SET tieu_de = :tieu_de, noi_dung = :noi_dung, trang_thai = :trang_thai
                WHERE id = :id";
        $data['id'] = $id;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM tin_tucs WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
     // Thêm phương thức tìm kiếm
     public function search($keyword)
     {
        $sql = "SELECT * FROM tin_tucs WHERE tieu_de LIKE :keyword OR noi_dung LIKE :keyword";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        
        // Kiểm tra kết quả tìm kiếm
        $results = $stmt->fetchAll();
        var_dump($results); // Thêm dòng này để kiểm tra kết quả
        return $results;
    }
    
}
