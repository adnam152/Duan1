<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--  -->
    <link rel="icon" href="/DA1/assets/files/assets/images/favicon.ico" type="image/x-icon"> <!-- icon -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/DA1/assets/files/bower_components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/DA1/assets/files/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="/DA1/assets/files/assets/icon/feather/css/feather.css">
    <link rel="stylesheet" type="text/css" href="/DA1/assets/files/assets/css/font-awesome-n.min.css">
    <link rel="stylesheet" href="/DA1/assets/files/bower_components/chartist/css/chartist.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="/DA1/assets/files/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/DA1/assets/files/assets/css/widget.css">
</head>

<body>
    <?php
    if ($page == "admin") { ?>
        <div id="pcoded" class="pcoded">
            <div class="pcoded-container navbar-wrapper">
                <?php require "./src/Views/admin/components/header.php" ?>
                <div class="pcoded-main-container">
                    <div class="pcoded-wrapper">
                        <?php require "./src/Views/admin/components/navbar.php" ?>

                        <div class="pcoded-content">

                            <div class="pcoded-inner-content">
                                <!-- Content -->
                                <?php require "./src/Views/$view.php" ?>
                            </div>
                        </div>

                        <div id="styleSelector"></div>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    
    ?>

</body>

<script type="text/javascript" src="/DA1/assets/files/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="/DA1/assets/files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="/DA1/assets/files/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="/DA1/assets/files/bower_components/bootstrap/js/bootstrap.min.js"></script>
<script src="/DA1/assets/files/assets/pages/waves/js/waves.min.js"></script>
<script type="text/javascript" src="/DA1/assets/files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- <script src="/DA1/assets/files/assets/pages/chart/float/jquery.flot.js"></script>
<script src="/DA1/assets/files/assets/pages/chart/float/jquery.flot.categories.js"></script>
<script src="/DA1/assets/files/assets/pages/chart/float/curvedLines.js"></script>
<script src="/DA1/assets/files/assets/pages/chart/float/jquery.flot.tooltip.min.js"></script> -->
<script src="/DA1/assets/files/bower_components/chartist/js/chartist.js"></script>
<script src="/DA1/assets/files/assets/pages/widget/amchart/amcharts.js"></script>
<script src="/DA1/assets/files/assets/pages/widget/amchart/serial.js"></script>
<script src="/DA1/assets/files/assets/pages/widget/amchart/light.js"></script>
<script src="/DA1/assets/files/assets/js/pcoded.min.js"></script>
<script src="/DA1/assets/files/assets/js/vertical/vertical-layout.min.js"></script>
<!-- <script type="text/javascript" src="/DA1/assets/files/assets/pages/dashboard/custom-dashboard.min.js"></script> -->
<script type="text/javascript" src="/DA1/assets/files/assets/js/script.min.js"></script>

</html>