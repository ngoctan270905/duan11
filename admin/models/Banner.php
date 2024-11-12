<?php
class Banner
{
    public $conn;
    
    // Kết nối cơ sở dữ liệu
    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy danh sách tất cả banner
    public function getAll()
    {
        try {
            $sql = 'SELECT * FROM banners';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Chức năng tìm kiếm banner theo từ khóa
    public function searchBanners($keyword)
    {
        try {
            $sql = 'SELECT * FROM banners WHERE tieu_de LIKE :keyword';
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
            $keyword = '%' . $keyword . '%';
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    // Thêm dữ liệu vào CSDL
    public function postData($tieu_de, $hinh_anh, $trang_thai)
    {
        try {
            $sql = 'INSERT INTO banners (tieu_de, hinh_anh, trang_thai)
                    VALUES (:tieu_de, :hinh_anh, :trang_thai)';

            $stmt = $this->conn->prepare($sql);

            // Gán giá trị vào các tham số
            $stmt->bindParam(':tieu_de', $tieu_de);
            $stmt->bindParam(':hinh_anh', $hinh_anh);
            $stmt->bindParam(':trang_thai', $trang_thai);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    // Lấy thông tin chi tiết banner
    public function getDetailData($id)
    {
        try {
            $sql = 'SELECT * FROM banners WHERE id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    // Cập nhật dữ liệu vào CSDL
    public function updateData($id, $tieu_de, $hinh_anh, $trang_thai)
    {
        try {
            $sql = 'UPDATE banners SET tieu_de = :tieu_de, hinh_anh = :hinh_anh, trang_thai = :trang_thai WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            // Gán giá trị vào các tham số
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':tieu_de', $tieu_de);
            $stmt->bindParam(':hinh_anh', $hinh_anh);
            $stmt->bindParam(':trang_thai', $trang_thai);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }

    // Xóa dữ liệu trong CSDL
    public function deleteData($id)
    {
        try {
            $sql = 'DELETE FROM banners WHERE id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo 'Lỗi: ' . $e->getMessage();
        }
    }
    
    // Hủy kết nối CSDL
    public function __destruct()
    {
        $this->conn = null;
    }
}
