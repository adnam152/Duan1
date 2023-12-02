<style>
    #banner>img {
        object-fit: cover;
        object-position: center;
        height: 500px;
    }

    #banner .content {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    #banner .bottom-btn {
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translate(-50%, 50%);
    }

    #banner img.main-img {
        position: relative;
        top: 0;
        left: 0;
        filter: drop-shadow(10px 25px 3px #33333382);
    }
</style>
<div id="banner" class="position-relative">
    <img src="/assets/image/banner_1.jpg" alt="" class="w-100">
    <div class="content d-flex align-items-center">
        <div class="row w-100 ms-0">
            <div class="col-5 d-flex flex-column align-items-center justify-content-center">
                <h2 class="text-center fw-bolder">SANG TRỌNG</h2>
                <h1 class="text-center fw-bolder">ĐẲNG CẤP - THỜI THƯỢNG</h1>
                <a href="/allproduct?category=4" class="btn btn-info w-maxcontent px-5">Mua ngay</a>
            </div>
            <div class="col-3">
                <img src="/assets/image/snapedit_1701070067505.png" alt="" class="main-img">
            </div>
            <div class="col d-flex align-items-center">
                <h4 class="fw-bolder mt-5 px-5 text-dark">
                    Cung cấp những sản phẩm chính hãng,
                    đảm bảo về chất lượng khiến người dùng tự tin tỏa sáng
                </h4>
            </div>
            <div class="bottom-btn">
                <a href="#">
                    <img src="/assets/image/to_bottom.png" alt="" />
                </a>
            </div>
        </div>
    </div>
</div>