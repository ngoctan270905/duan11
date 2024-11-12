<?php

class DanhMucController
{
    private $danhmucModel;

    public function __construct()
    {
        $this->danhmucModel = new DanhMuc();
    }

    public function index()
    {
      // Kiểm tra nếu có từ khóa tìm kiếm
      $keyword = $_GET['keyword'] ?? null;
        
      // Nếu có từ khóa, thực hiện tìm kiếm
      if ($keyword) {
          $danhmucs = $this->danhmucModel->search($keyword);
      } else {
          // Nếu không, hiển thị tất cả tin tức
          $danhmucs = $this->danhmucModel->getAll();
      }
      require_once 'views/danhmucs/index.php';
    }

    // public function show($id)
    // {
    //     $danhmuc = $this->danhmucModel->getById($id);
    //     require_once 'views/danhmuc/show.php';
    // }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ten_danh_muc' => $_POST['ten_danh_muc'],
                'mo_ta' => $_POST['mo_ta'],
                'trang_thai' => $_POST['trang_thai']
            ];
            
            $this->danhmucModel->create($data);
            header('Location: ?act=danhmucs');
        } else {
            require_once 'views/danhmucs/create.php';
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'ten_danh_muc' => $_POST['ten_danh_muc'],
                'mo_ta' => $_POST['mo_ta'],
                'trang_thai' => $_POST['trang_thai']
            ];
            $this->danhmucModel->update($id, $data);
            header('Location: ?act=danhmucs');
        } else {
            $danhmuc = $this->danhmucModel->getById($id);
            require_once 'views/danhmucs/edit.php';
        }
    }

    public function delete($id)
    {
        $this->danhmucModel->delete($id);
        header('Location: ?act=danhmucs');
    }
}
