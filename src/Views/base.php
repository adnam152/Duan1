<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <?php
    if ($page == "admin") { ?>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="#">Navbar</a> 
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?php if($action=="1") echo "active" ?>" href="/DA1/admin">Thống kê</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($action=="2") echo "active" ?>" href="/DA1/admin/category">Danh mục</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($action=="3") echo "active" ?>" href="/DA1/admin/product">Sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($action=="4") echo "active" ?>" href="/DA1/admin/user">Khách hàng</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($action=="5") echo "active" ?>" href="/DA1/admin/comment">Bình luận</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if($action=="6") echo "active" ?>" href="/DA1/admin/order">Đơn hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    <?php }
    require "./src/Views/$view.php"
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>