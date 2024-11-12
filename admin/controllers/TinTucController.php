<?php

class TinTucController
{
    private $tintucModel;

    public function __construct()
    {
        $this->tintucModel = new TinTuc();
    }

    public function index()
    {
        // Kiểm tra nếu có từ khóa tìm kiếm
        $keyword = $_GET['keyword'] ?? null;
        
        // Nếu có từ khóa, thực hiện tìm kiếm
        if ($keyword) {
            $tintucs = $this->tintucModel->search($keyword);
        } else {
            // Nếu không, hiển thị tất cả tin tức
            $tintucs = $this->tintucModel->getAll();
        }
        require_once 'views/tintucs/index.php';
    }

    // public function show($id)
    // {
    //     $tintuc = $this->tintucModel->getById($id);
    //     require_once 'views/tintucs/show.php';
    // }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'tieu_de' => $_POST['tieu_de'],
                'noi_dung' => $_POST['noi_dung'],
                'trang_thai' => $_POST['trang_thai']
            ];
            $this->tintucModel->create($data);
            header('Location: ?act=tintucs');
        } else {
            require_once 'views/tintucs/create.php';
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'tieu_de' => $_POST['tieu_de'],
                'noi_dung' => $_POST['noi_dung'],
                'trang_thai' => $_POST['trang_thai']
            ];
            $this->tintucModel->update($id, $data);
            header('Location: ?act=tintucs');
        } else {
            $tintuc = $this->tintucModel->getById($id);
            require_once 'views/tintucs/edit.php';
        }
    }

    public function delete($id)
    {
        $this->tintucModel->delete($id);
        header('Location: ?act=tintucs');
    }
}
