<?php
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once 'controllers/DashboardController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/DanhMucController.php';
require_once 'controllers/TinTucController.php';
require_once 'controllers/LienHeController.php';
require_once 'controllers/KhuyenMaiController.php';
require_once 'controllers/TrangThaiController.php';
require_once 'controllers/BannerController.php';


// Require toàn bộ file Models
require_once 'models/User.php';
require_once 'models/DanhMuc.php';
require_once 'models/TinTuc.php';
require_once 'models/LienHe.php';
require_once 'models/KhuyenMai.php';
require_once 'models/TrangThai.php';
require_once 'models/Banner.php';




// Route
$act = $_GET['act'] ?? '/';

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
  // Dashboards
  '/' => (new DashboardController())->index(),
  //Quản lý người dùng
  'users'             => (new UserController())->index(),
  'users/create'      => (new UserController())->create(),
  'users/edit'        => (new UserController())->edit($_GET['id'] ?? 0),
  'users/delete'      => (new UserController())->delete($_GET['id'] ?? 0),
  'users/show'        => (new UserController())->show($_GET['id'] ?? 0),

  // //Quản lý danh mục sp
  'danhmucs'             => (new DanhMucController())->index(),
  'danhmucs/create'      => (new DanhMucController())->create(),
  'danhmucs/edit'        => (new DanhMucController())->edit($_GET['id'] ?? 0),
  'danhmucs/delete'      => (new DanhMucController())->delete($_GET['id'] ?? 0),

  // // quản lý danh mục tin tức
  'tintucs'             => (new TinTucController())->index(),
  'tintucs/create'      => (new TinTucController())->create(),
  'tintucs/edit'        => (new TinTucController())->edit($_GET['id'] ?? 0),
  'tintucs/delete'      => (new TinTucController())->delete($_GET['id'] ?? 0),

  // // quản lý danh mục lien he
  'lienhes'             => (new LienHeController())->index(),
  'lienhes/create'      => (new LienHeController())->create(),
  'lienhes/edit'        => (new LienHeController())->edit($_GET['id'] ?? 0),
  'lienhes/delete'      => (new LienHeController())->delete($_GET['id'] ?? 0),

    // //Quản lý khuyến mãi
    'khuyenmais'             => (new KhuyenMaiController())->index(),
    'khuyenmais/create'      => (new KhuyenMaiController())->create(),
    'khuyenmais/edit'        => (new KhuyenMaiController())->edit($_GET['id'] ?? 0),
    'khuyenmais/delete'      => (new KhuyenMaiController())->delete($_GET['id'] ?? 0),
    'khuyenmais/show'        => (new KhuyenMaiController())->show($_GET['id'] ?? 0),

     // // quản lý trạng thái
     'trangthais'             => (new TrangThaiController())->index(),
     'trangthais/create'      => (new TrangThaiController())->create(),
     'trangthais/edit'        => (new TrangThaiController())->edit($_GET['id'] ?? 0),
     'trangthais/delete'      => (new TrangThaiController())->delete($_GET['id'] ?? 0),
    //qly banner
  // quản lý banners
  'banners'                => (new BannerController())->index(),
  'form-them-banners'      => (new BannerController())->creat(),
  'them-banners'           => (new BannerController())->store(),
  'form-sua-banners'       => (new BannerController())->edit(),
  'sua-banners'            => (new BannerController())->update(),
  'xoa-banners'            => (new BannerController())->destroy(),
 

  
 
};
