<?php

class BannerController
{
    public $modelBanner;

    public function __construct()
    {
        $this->modelBanner = new Banner();
    }

    // Hiển thị danh sách banner
    public function index()
    {
        // Nếu có từ khóa tìm kiếm, gọi đến phương thức searchBanners
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $keyword = $_GET['search'];
            $Banners = $this->modelBanner->searchBanners($keyword);
        } else {
            // Nếu không có từ khóa tìm kiếm, hiển thị tất cả banner
            $Banners = $this->modelBanner->getAll();
        }

        // Đưa dữ liệu ra view
        require_once './views/banner/list_Banner.php';
    }

    // Hiển thị form thêm
    public function creat()
    {
        require_once './views/banner/creat_banner.php';
    }

    // Xử lý thêm mới banner
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tieu_de = $_POST['tieu_de'];
            $trang_thai = $_POST['trang_thai'];
            $hinh_anh = $_FILES['hinh_anh'];
            $file_thumb = uploadFile($hinh_anh, './uploads/');

            // Validate
            $errors = [];
            if (empty($_POST['tieu_de'])) {
                $errors['tieu_de'] = 'Tên tiêu đề là bắt buộc';
            }
            if (empty($_POST['trang_thai'])) {
                $errors['trang_thai'] = 'Trạng thái là bắt buộc';
            }

            // Thêm dữ liệu
            if (empty($errors)) {
                $this->modelBanner->postData($tieu_de, $file_thumb, $trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=banners');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=form-them-banners');
                exit();
            }
        }
    }

    // Hiển thị form sửa
    public function edit()
    {
        $id = $_GET['banner_id'];
        $Banner = $this->modelBanner->getDetailData($id);
        require_once './views/banner/edit_banner.php';
    }

    // Cập nhật dữ liệu banner
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? '';
            $bannerOld = $this->modelBanner->getDetailData($id);
            $old_file = $bannerOld['hinh_anh'];

            $tieu_de = $_POST['tieu_de'] ?? '';
            $hinh_anh = $_FILES['hinh_anh'] ?? null;
            $trang_thai = $_POST['trang_thai'] ?? '';

            // Validate
            $errors = [];
            if (empty($tieu_de)) {
                $errors['tieu_de'] = 'Tên tiêu đề là bắt buộc';
            }
            if (empty($trang_thai)) {
                $errors['trang_thai'] = 'Trạng thái là bắt buộc';
            }

            if (isset($hinh_anh) && $hinh_anh['error'] == UPLOAD_ERR_OK) {
                $new_file = uploadFile($hinh_anh, './uploads/');
                if (!empty($old_file)) {
                    deleteFile($old_file);
                }
            } else {
                $new_file = $old_file;
            }

            if (empty($errors)) {
                $this->modelBanner->updateData($id, $tieu_de, $new_file, $trang_thai);
                unset($_SESSION['errors']);
                header('Location: ?act=banners');
                exit();
            } else {
                $_SESSION['errors'] = $errors;
                header('Location: ?act=form-sua-banners');
                exit();
            }
        }
    }

    // Xóa banner
    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['banner_id'];
            $this->modelBanner->deleteData($id);
            header('Location: ?act=banners');
            exit();
        }
    }
}
