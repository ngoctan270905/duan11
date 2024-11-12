<?php
class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function index()
    {
            // Kiểm tra nếu có từ khóa tìm kiếm
            $keyword = $_GET['keyword'] ?? null;
        
            // Nếu có từ khóa, thực hiện tìm kiếm
            if ($keyword) {
                $users = $this->userModel->search($keyword);
            } else {
                // Nếu không, hiển thị tất cả tin tức
                $users = $this->userModel->getAll();
            }
            require_once 'views/users/index.php';
    }

    public function show($id)
    {
        $user = $this->userModel->getById($id);
        require_once 'views/users/show.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Xử lý upload ảnh
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/avatars/';
                $fileName = basename($_FILES['avatar']['name']);
                $uploadFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
                    $avatarPath = $uploadFile;
                } else {
                    $avatarPath = null;
                }
            }

            $data = [
                'ten_nguoi_dung' => $_POST['ten_nguoi_dung'],
                'ho_va_ten' => $_POST['ho_va_ten'],
                'email' => $_POST['email'],
                'sdt' => $_POST['sdt'],
                'dia_chi' => $_POST['dia_chi'],
                'mat_khau' => password_hash($_POST['mat_khau'], PASSWORD_DEFAULT),
                'ngay_sinh' => $_POST['ngay_sinh'],
                'gioi_tinh' => $_POST['gioi_tinh'],
                'avatar' => isset($avatarPath) ? $avatarPath : null,
                'vai_tro' => $_POST['vai_tro'],
                'trang_thai' => $_POST['trang_thai']
            ];

            $this->userModel->create($data);
            header('Location: ?act=users');
        } else {
            require_once 'views/users/create.php';
        }
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/avatars/';
                $fileName = basename($_FILES['avatar']['name']);
                $uploadFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile)) {
                    $avatarPath = $uploadFile;
                } else {
                    $avatarPath = null;
                }
            } else {
                $avatarPath = $_POST['current_avatar'];
            }

            $data = [
                'ten_nguoi_dung' => $_POST['ten_nguoi_dung'],
                'ho_va_ten' => $_POST['ho_va_ten'],
                'email' => $_POST['email'],
                'sdt' => $_POST['sdt'],
                'dia_chi' => $_POST['dia_chi'],
                'mat_khau' => password_hash($_POST['mat_khau'], PASSWORD_DEFAULT),
                'ngay_sinh' => $_POST['ngay_sinh'],
                'gioi_tinh' => $_POST['gioi_tinh'],
                'avatar' => $avatarPath,
                'vai_tro' => $_POST['vai_tro'],
                'trang_thai' => $_POST['trang_thai']
            ];

            $this->userModel->update($id, $data);
            header('Location: ?act=users');
        } else {
            $user = $this->userModel->getById($id);
            require_once 'views/users/edit.php';
        }
    }

    public function delete($id)
    {
        $user = $this->userModel->getById($id);

        if ($user['avatar'] && file_exists($user['avatar'])) {
            unlink($user['avatar']);
        }

        $this->userModel->delete($id);
        header('Location: ?act=users');
    }

}
