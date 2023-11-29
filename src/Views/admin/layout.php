<div id="pcoded" class="pcoded">
    <div class="pcoded-container navbar-wrapper">
        <?php require "./src/Views/admin/components/header.php" ?>
        <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
                <?php require "./src/Views/admin/components/navbar.php" ?>

                <div class="pcoded-content">
                    <div class="pcoded-inner-content">
                        <!-- Content --> <?php require "./src/Views/$view.php" ?>
                    </div>
                </div>
                <div id="styleSelector"></div>
            </div>
        </div>
    </div>
</div>