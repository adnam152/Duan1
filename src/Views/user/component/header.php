<nav class="navbar navbar-expand-lg shadow-sm py-0">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                if (isset($allCategory)) {
                    foreach ($allCategory as $category) {
                        echo "
                            <li class='nav-item'>
                                <a class='nav-link' href='/allproduct?category=" . $category['id'] . "'>" . $category['name'] . "</a>
                            </li>";
                    }
                }
                ?>
            </ul>
        </div>
        <nav class="navbar header-navbar pcoded-header">
            <div class="navbar-wrapper">
                <div class="navbar-container container-fluid">
                    <ul class="nav-left">
                        <li class="header-search">
                            <div class="main-search morphsearch-search">
                                <div class="input-group">
                                    <span class="input-group-prepend search-close">
                                        <i class="feather icon-x input-group-text"></i>
                                    </span>
                                    <form action="/allproduct">
                                        <input type="text" name="search" class="form-control" placeholder="Enter Keyword">
                                    </form>
                                    <span class="input-group-append search-btn">
                                        <i class="feather icon-search input-group-text" style="color: black;"></i>
                                    </span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                <i class="full-screen feather icon-maximize"></i>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav-right">
                        <!-- CART -->
                        <li>
                            <a href="/cart" class="waves-effect waves-light">
                                <i class="feather icon-shopping-cart"></i>
                                <span class="badge badge-pill badge-primary" id="header_number_cart"><?=$numberOfCart?></span>
                            </a>
                        </li>
                        <!-- LOGIN -->
                        <li class="user-profile header-notification">
                            <?php
                            if (!isset($_SESSION['user'])) {
                                echo "<span onclick='openLoginModal()'>Đăng nhập</span>";
                            } else {
                            ?>
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?= $_SESSION['user']['image'] ?? '/assets/image/no-avatar.webp' ?>" class="rounded-circle" alt="User-Profile-Image">
                                        <span><?= $_SESSION['user']['username'] ?></span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <?php
                                        if ($_SESSION['user']['role'] == 1) {
                                            echo "
                                                <li>
                                                    <a href='/admin' class='nav-link'>
                                                        <i class='feather icon-settings'></i> Admin
                                                    </a>
                                                </li>";
                                        }
                                        ?>
                                        <li>
                                            <a href="/logout" class='nav-link'>
                                                <i class="feather icon-log-out"></i> Logout
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            <?php
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</nav>

<!-- MODAL -->
<div id="form-modal">
    <div class="container">
        <div class="container-area">
            <!-- Login -->
            <form action="" method="post" class="login-area">
                <h1>Login</h1>
                <p>If You Are Already A Member. Easily Log In</p>
                <div>
                    <input type="text" name="username" placeholder="Username">
                    <div class="error"></div>
                </div>
                <div class="password-group">
                    <div>
                        <input type="password" name="password" placeholder="Password" autocomplete="on">
                        <div class="error"></div>
                    </div>
                    <i class="fa fa-eye-slash active hide"></i>
                    <i class="fa fa-eye show"></i>
                </div>
                <button type="submit" id="submit_login">Login</button>
                <div class="or">
                    <div class="line"></div>Or<div class="line"></div>
                </div>
                <button class="google-login">
                    Login with Facebook
                </button>
                <p>Forgot my password?</p>
                <div class="line"></div>
                <p>If you don't have an Account, Create <button type="button" id="reg">Register</button></p>
            </form>

            <!-- Register -->
            <form action="" method="post" class="register-area">
                <h1>Register</h1>
                <p>Become a member to receive many Benefits</p>
                <div>
                    <input type="text" name="username" placeholder="Username">
                    <div class="error"></div>
                </div>
                <div>
                    <input type="email" name="email" placeholder="Email">
                    <div class="error"></div>
                </div>
                <div class="password-group">
                    <div>
                        <input type="password" name="password" placeholder="Password" autocomplete="on">
                        <div class="error"></div>
                    </div>
                    <i class="fa fa-eye-slash active hide"></i>
                    <i class="fa fa-eye show"></i>
                </div>
                <div class="password-group">
                    <div>
                        <input type="password" name="re-password" placeholder="Confirm Password" autocomplete="on">
                        <div class="error"></div>
                    </div>
                    <i class="fa fa-eye-slash active hide"></i>
                    <i class="fa fa-eye show"></i>
                </div>
                <p class="terms-check">By clicking Signup, you agree to the <span class="terms">Terms and Conditions.</span>
                </p>
                <button type="submit" id="submit_register">Sign Up</button>
                <div class="line"></div>
                <p>If you already have an Account, Login <button type="button" id="log">Login</button></p>
            </form>
        </div>
        <img src="" alt="">
    </div>
</div>