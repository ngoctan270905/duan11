<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">
<head>
    <meta charset="utf-8" />
    <title> Banners | PhoneStore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <!-- CSS -->
    <?php
    require_once "views/layouts/libs_css.php";
    ?>
</head>
<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <!-- HEADER -->
        <?php
        require_once "views/layouts/header.php";
        require_once "views/layouts/siderbar.php";
        ?>

        <!-- Left Sidebar End -->
        <div class="vertical-overlay"></div>

        <!-- Start right Content here -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Quản lý Banners</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                        <li class="breadcrumb-item active">Banners</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- Search Form -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <form action="" method="GET" class="d-flex">
                                <input type="hidden" name="act" value="banners">
                                <input type="text" name="search" class="form-control" placeholder="Tìm kiếm banner theo tiêu đề" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                                <button type="submit" class="btn btn-primary ms-2">Tìm kiếm</button>
                            </form>
                        </div>
                    </div>
                    <!-- End Search Form -->

                    <div class="row">
                        <div class="col">
                            <div class="h-100">
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Danh sách Banners</h4>
                                        <a href="?act=form-them-banners" class="btn btn-soft-success material-shadow-none">
                                            <i class="ri-add-circle-line align-middle me-1"></i> Thêm Banner
                                        </a>
                                    </div>

                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-nowrap align-middle mb-0 table text-center">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">STT</th>
                                                            <th scope="col">Tiêu đề</th>
                                                            <th scope="col">Hình ảnh</th>
                                                            <th scope="col">Trạng thái</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($Banners as $index => $Banner) { ?>
                                                        <tr>
                                                            <td class="fw-medium"><?= $index+1 ?></td>
                                                            <td><?= $Banner['tieu_de'] ?></td>
                                                            <td>
                                                                <img src="<?=".".$Banner['hinh_anh'] ?>" alt="" width="100px">
                                                            </td>
                                                            <td>
                                                                <?php if($Banner['trang_thai'] == 1) { ?>
                                                                    <span class="badge bg-success">Hiển thị</span>
                                                                <?php } else { ?>
                                                                    <span class="badge bg-danger">Không hiển thị</span>
                                                                <?php } ?>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex justify-content-center hstack gap-3 flex-wrap ">
                                                                    <a href="?act=form-sua-banners&banner_id=<?= $Banner['id'] ?>" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                                                                    <form action="?act=xoa-banners" method="POST" onsubmit="return confirm('Bạn có chắc chắn xóa không?')">
                                                                        <input type="hidden" name="banner_id" value="<?= $Banner['id'] ?>">
                                                                        <button type="submit" class="link-danger fs-15" style="border:none; background: none;">
                                                                            <i class="ri-delete-bin-line"></i>
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © Velzon.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <?php
    require_once "views/layouts/libs_js.php";
    ?>
</body>
</html>
