<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Document' ?></title>
    <!--  -->
    <link rel="icon" href="/assets/files/assets/images/favicon.ico" type="image/x-icon"> <!-- icon -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link rel="stylesheet" type="text/css" href="/assets/files/bower_components/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
    <link rel="stylesheet" href="/assets/files/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="/assets/files/assets/icon/feather/css/feather.css">
    <link rel="stylesheet" type="text/css" href="/assets/files/assets/css/font-awesome-n.min.css">
    <link rel="stylesheet" href="/assets/files/bower_components/chartist/css/chartist.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="/assets/files/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/files/assets/css/widget.css">
    <link rel="stylesheet" href="/assets/files/assets/pages/jqpagination/jqpagination.css">
    <?php if ($page == "admin") { ?>
        <link rel="stylesheet" type="text/css" href="/public/css/admin.css">
    <?php } else {
    ?>
        <link rel="stylesheet" type="text/css" href="/public/css/user.css">
    <?php
    }
    if (isset($css)) echo "<link rel='stylesheet' type='text/css' href='/public/css/$css.css'>";
    ?>
</head>
<style>
    @font-face {
        font-family: 'tuffy';
        src: url('/public/Tuffy-Regular.ttf');
    }

    body {
        font-family: 'tuffy';
        background-color: #f2f7fb !important;
        background-image: none !important;
    }

    .btn i {
        margin-right: 0;
    }

    .product_select {
        margin-right: 10px;
        width: unset;
    }

    .text-start {
        text-align: start;
    }

    .img-account {
        max-width: 100px;
        object-fit: contain;
        margin-right: 10px;
    }
    img.avatar{
        width: 40px;
        height: 40px;
        object-fit: cover;
        border-radius: 50%;
    }
    .header-navbar .navbar-wrapper .navbar-container .nav-right>.header-notification:nth-child(1) .show-notification li:first-child:hover,
    .header-navbar .navbar-wrapper .navbar-container .nav-right>.header-notification:nth-child(1) .profile-notification li:first-child:hover {
        background-color: #f1f1f1;
    }
    nav{
        user-select: none;
    }
    nav .waves-effect{
        overflow: unset;
    }
    .disable {
        color: #cacaca !important;
    }
    th,td{
        vertical-align: middle !important;
    }
    .px-100 {
        padding: 0 70px;
    }

    .fw-bolder {
        font-weight: 900;
    }

    .fst-italic {
        font-style: italic;
    }

    .fs-1 {
        font-size: 2rem;
    }

    .fs-7 {
        font-size: 0.7rem;
    }

    .px-0 {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    .px-2 {
        padding-left: 0.5rem !important;
        padding-right: 0.5rem !important;
    }

    .px-3 {
        padding-left: 1rem !important;
        padding-right: 1rem !important;
    }
    .py-1{
        padding-top: 0.25rem !important;
        padding-bottom: 0.25rem !important;
    }
    .py-2{
        padding-top: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }
    .py-3 {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
    }

    .ps-2 {
        padding-left: 0.5rem !important;
    }

    .mt-3 {
        margin-top: 1rem !important;
    }

    .ms-2 {
        margin-left: 0.5rem !important;
    }

    .ms-3 {
        margin-left: 1rem !important;
    }
    .me-2{
        margin-right: 0.5rem !important;
    }
    .mb-0{
        margin-bottom: 0 !important;
    }
    .mb-1 {
        margin-bottom: 0.25rem !important;
    }
    .mb-2 {
        margin-bottom: 0.5rem !important;
    }
    .mb-4 {
        margin-bottom: 1.5rem !important;
    }
    .mb-80{
        margin-bottom: 80px !important;
    }
    .mb-100{
        margin-bottom: 100px !important;
    }
</style>

<body>
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>
    <!-- ADMIN PAGE -->
    <?php
    if ($page == "admin") {
        require "./src/Views/admin/layout.php";
    } 

    // USER PAGE
    else {
        require "./src/Views/user/layout.php";
    }
    if (isset($js)) echo "<script src='/public/js/$js.js'></script>";
    ?>
    <script src="/public/js/ajax.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/assets/files/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/assets/files/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="/assets/files/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <script src="/assets/files/assets/pages/waves/js/waves.min.js"></script>
    <script type="text/javascript" src="/assets/files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- <script src="/assets/files/assets/pages/chart/float/jquery.flot.js"></script>
    <script src="/assets/files/assets/pages/chart/float/jquery.flot.categories.js"></script>
    <script src="/assets/files/assets/pages/chart/float/curvedLines.js"></script>
    <script src="/assets/files/assets/pages/chart/float/jquery.flot.tooltip.min.js"></script> -->
    <script src="/assets/files/bower_components/chartist/js/chartist.js"></script>
    <script src="/assets/files/assets/pages/widget/amchart/amcharts.js"></script>
    <script src="/assets/files/assets/pages/widget/amchart/serial.js"></script>
    <script src="/assets/files/assets/pages/widget/amchart/light.js"></script>
    <script src="/assets/files/assets/js/pcoded.min.js"></script>
    <script src="/assets/files/assets/js/vertical/vertical-layout.min.js"></script>
    <!-- <script type="text/javascript" src="/assets/files/assets/pages/dashboard/custom-dashboard.min.js"></script> -->
    <script type="text/javascript" src="/assets/files/assets/js/script.min.js"></script>
</body>
<script>
    function formatPrice(price){
        return price.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
</script>

</html>