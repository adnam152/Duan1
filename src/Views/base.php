<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Document' ?></title>
    <!--  -->
    <link rel="icon" href="/assets/files/assets/images/favicon.ico" type="image/x-icon"> <!-- icon -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/assets/files/bower_components/bootstrap/css/bootstrap.min.css">
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
        background-color: white !important;
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
</style>

<body>
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>
    <!-- ADMIN PAGE -->
    <?php
    if ($page == "admin") {
        require "./src/Views/admin/layout.php";
    } else {
        require "./src/Views/user/layout.php";
    }
    if (isset($js)) echo "<script src='/public/js/$js.js'></script>";
    ?>
    <script src="/public/js/ajax.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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

</html>