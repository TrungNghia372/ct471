<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php
        if (defined('TITLE')) {
            echo TITLE;
        } else {
            echo 'Trang Chủ';
        }
        ?></title>

    <link rel="stylesheet" href="css/app.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</head>

<body>
    <header>
        <nav class="navbar container">
            <div class="container-fluid">
                <a href="index.php"><img style="width: 80px" src="https://khachsan5.maugiaodien.com/wp-content/uploads/2019/02/logo-vntrip-black.png" class="navbar-brand" alt=""></a>
                <form class="d-flex" method="GET" acction="">
                    <!-- Tìm kiếm -->
                    <input type="text" value="" name="search" class="form-control me-2" placeholder="Tìm kiếm" aria-label="Search" style="width: 500px">
                    <button type="submit" value="Tìm kiếm" class="btn btn-outline-info me-2"><i class="fa fa-search"></i></button>
                    <!-- Giỏ hàng -->
                    <button class="btn btn-outline-info" type="button"><i class="fa-solid fa-house"></i></button>
                </form>
            </div>
        </nav>

        <nav class="navbar navbar-expand-lg bg-color">
            <div class="container-fluid container">
                <a class="navbar-brand me-2 px-2 nav-link btn btn-outline-info" href="/">Trang Chủ</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link me-2 btn btn-outline-info" aria-current="page" href="gioithieu.php">Giới Thiệu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-2 btn btn-outline-info" href="tintuc.php">Tin Tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-2 btn btn-outline-info" href="sanpham.php">Phòng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-info" href="lienhe.php">Liên Hệ</a>
                        </li>
                    </ul>
                    <div class="navbar-nav ml-auto">
                        <a href="/login" type="button" class="nav-link btn btn-outline-info">Đăng Nhập</a>
                        <a href="/register" type="button" class="nav-link btn btn-outline-info ms-2">Đăng Ký</a>
                    </div>
                    
                </div>
            </div>
        </nav>
    </header>
