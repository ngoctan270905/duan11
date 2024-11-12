<?php

class LienHeController
{
    private $lienheModel;

    public function __construct()
    {
        $this->lienheModel = new LienHe();
    }

    public function index()
    {
              // Kiểm tra nếu có từ khóa tìm kiếm
              $keyword = $_GET['keyword'] ?? null;
        
              // Nếu có từ khóa, thực hiện tìm kiếm
              if ($keyword) {
                  $lienhes = $this->lienheModel->search($keyword);
              } else {
                  // Nếu không, hiển thị tất cả tin tức
                  $lienhes = $this->lienheModel->getAll();
              }
              require_once 'views/lienhes/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'email' => $_POST['email'],
                'noi_dung' => $_POST['noi_dung'],
                'trang_thai' => $_POST['trang_thai']
            ];
            $this->lienheModel->create($data);
            header('Location: ?act=lienhes');
        } else {
            require_once 'views/lienhes/create.php';
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'email' => $_POST['email'],
                'noi_dung' => $_POST['noi_dung'],
                'trang_thai' => $_POST['trang_thai']
            ];
            $this->lienheModel->update($id, $data);
            header('Location: ?act=lienhes');
        } else {
            $lienhe = $this->lienheModel->getById($id);
            require_once 'views/lienhes/edit.php';
        }
    }

    public function delete($id)
    {
        $this->lienheModel->delete($id);
        header('Location: ?act=lienhes');
    }
}
