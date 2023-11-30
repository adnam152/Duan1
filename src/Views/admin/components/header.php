<nav class="navbar header-navbar pcoded-header">
    <div class="navbar-wrapper">
        <div class="navbar-logo">
            <a href="/">
                LOGO
                <!-- <img class="img-fluid" src="files/assets/images/logo.png" alt="Theme-Logo" /> -->
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="#!">
                <i class="feather icon-menu icon-toggle-right"></i>
            </a>
            <a class="mobile-options waves-effect waves-light">
                <i class="feather icon-more-horizontal"></i>
            </a>
        </div>
        <div class="navbar-container container-fluid">
            <ul class="nav-left">
                <!-- <li class="header-search">
                    <div class="main-search morphsearch-search">
                        <div class="input-group">
                            <span class="input-group-prepend search-close">
                                <i class="feather icon-x input-group-text"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Enter Keyword">
                            <span class="input-group-append search-btn">
                                <i class="feather icon-search input-group-text"></i>
                            </span>
                        </div>
                    </div>
                </li> -->
                <li>
                    <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                        <i class="full-screen feather icon-maximize"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav-right">
                <li class="user-profile header-notification">
                    <div class="dropdown-primary dropdown">
                        <div class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?=isset($_SESSION['user']['image']) ? $_SESSION['user']['image'] : NO_AVATAR?>" class="rounded-circle" alt="User-Profile-Image">
                            <span><?=$_SESSION['user']['username']?></span>
                            <i class="feather icon-chevron-down"></i>
                        </div>
                        <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                            <li>
                                <a href="/logout">
                                    <i class="feather icon-log-out"></i> Đăng xuất
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>