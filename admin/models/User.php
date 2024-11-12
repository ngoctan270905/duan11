<?php
class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM nguoi_dungs";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM nguoi_dungs WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data)
    {
        $sql = "INSERT INTO nguoi_dungs (ten_nguoi_dung, ho_va_ten, email, sdt, dia_chi, mat_khau, ngay_sinh, gioi_tinh, avatar, vai_tro, trang_thai) 
                VALUES (:ten_nguoi_dung, :ho_va_ten, :email, :sdt, :dia_chi, :mat_khau, :ngay_sinh, :gioi_tinh, :avatar, :vai_tro, :trang_thai)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE nguoi_dungs SET 
                ten_nguoi_dung = :ten_nguoi_dung, 
                ho_va_ten = :ho_va_ten, 
                email = :email, 
                sdt = :sdt, 
                dia_chi = :dia_chi, 
                mat_khau = :mat_khau, 
                ngay_sinh = :ngay_sinh, 
                gioi_tinh = :gioi_tinh, 
                avatar = :avatar, 
                vai_tro = :vai_tro, 
                trang_thai = :trang_thai 
                WHERE id = :id";
        $data['id'] = $id;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM nguoi_dungs WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
 // Thêm phương thức tìm kiếm
 public function search($keyword)
 {
    $sql = "SELECT * FROM nguoi_dungs WHERE ten_nguoi_dung LIKE :keyword OR vai_tro LIKE :keyword";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['keyword' => '%' . $keyword . '%']);
    
    // Kiểm tra kết quả tìm kiếm
    $results = $stmt->fetchAll();
    var_dump($results); // Thêm dòng này để kiểm tra kết quả
    return $results;
}


}