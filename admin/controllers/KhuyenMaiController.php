<?php

class KhuyenMaiController
{
    private $khuyenmaiModel;

    public function __construct()
    {
        $this->khuyenmaiModel = new KhuyenMai();
    }

    public function index()
    {
       // Kiểm tra nếu có từ khóa tìm kiếm
       $keyword = $_GET['keyword'] ?? null;
        
       // Nếu có từ khóa, thực hiện tìm kiếm
       if ($keyword) {
           $khuyenmais = $this->khuyenmaiModel->search($keyword);
       } else {
           // Nếu không, hiển thị tất cả tin tức
           $khuyenmais = $this->khuyenmaiModel->getAll();
       }
       require_once 'views/khuyenmais/index.php';
    }

    public function show($id)
    {
        $khuyenmai = $this->khuyenmaiModel->getById($id);
        
        if ($khuyenmai) {
            require_once 'views/khuyenmais/show.php';
        } else {
            echo "Khuyến mãi không tồn tại.";
        }
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ten_khuyen_mai' => $_POST['ten_khuyen_mai'],
                'ma_khuyen_mai' => $_POST['ma_khuyen_mai'],
                'gia_tri' => $_POST['gia_tri'],
                'ngay_bat_dau' => $_POST['ngay_bat_dau'],
                'ngay_ket_thuc' => $_POST['ngay_ket_thuc'],
                'mo_ta' => $_POST['mo_ta'],
                'trang_thai' => $_POST['trang_thai']
            ];
            $this->khuyenmaiModel->create($data);
            header('Location: ?act=khuyenmais');
        } else {
            require_once 'views/khuyenmais/create.php';
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ten_khuyen_mai' => $_POST['ten_khuyen_mai'],
                'ma_khuyen_mai' => $_POST['ma_khuyen_mai'],
                'gia_tri' => $_POST['gia_tri'],
                'ngay_bat_dau' => $_POST['ngay_bat_dau'],
                'ngay_ket_thuc' => $_POST['ngay_ket_thuc'],
                'mo_ta' => $_POST['mo_ta'],
                'trang_thai' => $_POST['trang_thai']
            ];
            $this->khuyenmaiModel->update($id, $data);
            header('Location: ?act=khuyenmais');
        } else {
            $khuyenmai = $this->khuyenmaiModel->getById($id);
            require_once 'views/khuyenmais/edit.php';
        }
    }

    public function delete($id)
    {
        $this->khuyenmaiModel->delete($id);
        header('Location: ?act=khuyenmais');
    }

    // Thêm phương thức tìm kiếm
    public function search()
    {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        
        $results = $this->khuyenmaiModel->search($keyword);
        
        require_once 'views/khuyenmais/index.php';
    }
}