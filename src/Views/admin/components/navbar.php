<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <div class="pcoded-navigation-label">Navigation</div>

            <ul class="pcoded-item pcoded-left-item" item-border="true" item-border-style="solid" subitem-border="false">
                <li class="<?=$action=='1'?'active':''?>">
                    <a href="/admin" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-home"></i>
                        </span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="<?=$action=='2'?'active':''?>">
                    <a href="/admin/category" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="feather icon-menu"></i>
                        </span>
                        <span class="pcoded-mtext">Danh mục</span>
                    </a>
                </li>
                <li class="<?=$action=='3'?'active':''?>">
                    <a href="/admin/product" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-briefcase"></i>
                        </span>
                        <span class="pcoded-mtext">Sản phẩm</span>
                    </a>
                </li>
                <li class="<?=$action=='5'?'active':''?>">
                    <a href="/admin/comment" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-comment"></i>
                        </span>
                        <span class="pcoded-mtext">Bình luận</span>
                    </a>
                </li>
                <li class="<?=$action=='4'?'active':''?>">
                    <a href="/admin/account" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-users"></i>
                        </span>
                        <span class="pcoded-mtext">Tài Khoản</span>
                    </a>
                </li>
                <li class="<?=$action=='6'?'active':''?>">
                    <a href="/admin/order" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-shopping-cart"></i>
                        </span>
                        <span class="pcoded-mtext">Đơn hàng</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>