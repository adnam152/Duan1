<style>
    #detail .main-img img {
        height: 450px;
        max-width: 100%;
        object-fit: contain;
        object-position: center;
        border-radius: 5px;
    }

    #detail .container-img {
        display: flex;
        flex-wrap: nowrap;
        position: relative;
        transition: 0.3s;
        left: 0;
    }

    #detail .container-img img {
        width: 100px;
        height: 100px;
        object-fit: contain;
        object-position: center;
        transition: 0.3s;
    }
    #detail .container-img img:hover{
        transform: scale(1.05);
        cursor: pointer;
    }

    #detail .container-img img.active {
        border: 2px solid orangered;
    }

    #detail .prev,
    #detail .next {
        color: white;
        width: 30px;
        height: 100px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        position: absolute;
        z-index: 1;
        top: 0;
        opacity: 0.5;
        transition: 0.5s;
    }

    #detail .prev:hover,
    #detail .next:hover {
        opacity: 0.8;
    }

    #detail .prev {
        background: linear-gradient(to left, transparent, #333333);
        left: 0;
    }

    #detail .next {
        background: linear-gradient(to right, transparent, #333333);
        right: 0;
    }

    #detail .btn:hover {
        color: white !important;
        background: #5e6373 !important;
    }

    #detail button.active {
        color: white;
        background: #5e6373;
    }

    #detail .description {
        height: 200px;
        overflow-y: auto;
    }

    #detail .description::-webkit-scrollbar {
        width: 5px;
    }

    #detail .description::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    #detail .description::-webkit-scrollbar-thumb {
        background: #5e6373;
    }

    #detail .description::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Ẩn nút tăng giảm của input type number */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .my-shadow{
        box-shadow: 8px 15px 20px #0000002b;
    }
</style>

<div class="container" id="detail" data-id="<?= $_GET['id'] ?>">
    <div class="row my-shadow p-2" style="border-radius: 20px">
        <div class="col-5 px-0">
            <div class="main-img p-2 mb-3 d-flex justify-content-center">
                <img src="" alt="">
            </div>
            <div class="position-relative" style="overflow:hidden">
                <div class="prev">
                    <i class="fas fa-chevron-left"></i>
                </div>
                <div class="container-img border">
                    <?php
                    foreach ($allImage as $image) {
                        echo "<img src='" . $image["link"] . "' alt='' class=''>";
                    }
                    ?>
                </div>
                <div class="next">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>
        </div>

        <div class="col  px-4 pt-3">
            <h2 class="m-0 fw-bolder"><?= $product['name'] ?></h2>
            <p class="fw-light px-2 m-0">(<?= $product['view'] ?> lượt xem)</p>
            <del id="root_price">1,000,000</del> <span class="fs-1 fw-bolder" id="new_price">1,000,000đ</span><button class="px-3 bg-danger btn mb-4 ms-2 shadow rounded" id="discount"><?= $product['discount'] ?>%</button>

            <div class="color-group row align-items-center mt-2">
                <h5 class="col-2 mb-0">Color: </h5>
                <div class="col">
                    <?php
                    foreach ($colors as $color) {
                        echo "<button data-color='$color' data-id='" . $_GET['id'] . "' class='rounded shadow btn btn-outline-dark mx-2 color'>$color</button>";
                    }
                    ?>
                </div>
            </div>
            <div class="size-group row align-items-center my-3">
                <h5 class="col-2 mb-0">Size: </h5>
                <div class="col">
                    <?php
                    foreach ($sizes as $size) {
                        echo "<button data-size='$size' data-id='" . $_GET['id'] . "' class='rounded shadow btn btn-outline-dark mx-2 size'>$size</button>";
                    }
                    ?>
                </div>
            </div>
            <!-- Quantity -->
            <div class="quantity-group row align-items-center my-3">
                <h5 class="col-2 mb-0">Quantity: </h5>
                <div class="col pe-0 d-flex align-items-center">
                    <button class="rounded shadow btn btn-outline-dark mx-2 minus">-</button>
                    <input type="number" class="rounded shadow btn btn-outline-dark mx-2 quantity" value="1" min="1" max="10">
                    <button class="rounded shadow btn btn-outline-dark ms-2 plus">+</button>
                    <span class="mb-0 ms-3" id="count_detail">(<span><?= $quantity_product ?></span> sản phẩm còn lại)</span>
                </div>
            </div>
            <!-- ADD BTN -->
            <div class="btn-group">
                <button class="rounded shadow btn btn-outline-dark btn-primary" data-id="<?= $product['id'] ?>" <?= isset($_SESSION['user']) ? "onclick='addToCart(this)'" : "onclick='alert(\"Bạn cần đăng nhập để thêm vào giỏ hàng\")'" ?>>Thêm vào giỏ hàng</button>
            </div>
            <!-- DESCRIPTION -->
            <h2 class="fw-bolder mt-4">Mô tả sản phẩm</h2>
            <div class="description border px-2">
                <p class="fw-light"><?= $product['description'] ?></p>
            </div>
        </div>
    </div>

    <div class="row px-3">
        <h2 class="fw-bolder mt-4">Bình luận</h2>
        <textarea class="form-control" data-id="<?= $_GET['id'] ?>" aria-label="With textarea" id="text_area" style="height: 100px"></textarea>
        <div class="mt-2 w-100 d-flex justify-content-end"><button name="send_comment" class="btn btn-primary mt-2" onclick="addComment()">Gửi</button></div>
        <div id="comment_container" class="col py-3">
            <!-- JS -->
        </div>
    </div>
</div>

<script>
    var loadIndex = 1;
    var scrollStatus = true;
    window.onload = () => {
        getQuantity();
        renderComment();
    };
    // -------------------------------------------------------------------------------
    // LAZY LOAD comment
    (()=>{
        const containerComment = document.querySelector("#comment_container");
        window.addEventListener("scroll", function() {
            const containerBottom = containerComment.getBoundingClientRect().bottom;
            if(scrollStatus && containerBottom < window.innerHeight + 50){
                scrollStatus = false;
                renderComment();
            }
        })
    })();

    // text area
    document.querySelector("#text_area").onkeydown = function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            addComment();
        }
    };
    // DETAIL BTN
    (() => {
        const colorBtns = document.querySelectorAll(".color");
        const sizeBtns = document.querySelectorAll(".size");
        colorBtns[0].classList.add("active");
        sizeBtns[0].classList.add("active");
        colorBtns.forEach(btn => {
            btn.onclick = function() {
                document.querySelector(".color.active")?.classList.remove("active");
                btn.classList.add("active");
                getQuantity(btn);
            }
        })
        sizeBtns.forEach(btn => {
            btn.onclick = function() {
                document.querySelector(".size.active")?.classList.remove("active");
                btn.classList.add("active");
                getQuantity(btn);
            }
        })
        const quantity = document.querySelector(".quantity");
        const plus = document.querySelector(".plus");
        const minus = document.querySelector(".minus");
        plus.onclick = function() {
            quantity.value++;
        }
        minus.onclick = function() {
            quantity.value <= 1 ? quantity.value = 1 : quantity.value--;
        }
    })();

    // IMAGE
    (() => {
        const mainImg = document.querySelector(".main-img img");
        const containerImg = document.querySelector(".container-img");
        const prev = document.querySelector(".prev");
        const next = document.querySelector(".next");
        const allImg = document.querySelectorAll(".container-img img");

        let index = 0;

        function changeImg() {
            mainImg.src = allImg[index].src;
            document.querySelector(".container-img img.active")?.classList.remove("active");
            allImg[index].classList.add("active");

            const width = containerImg.offsetWidth - 100;
            const left = allImg[index].offsetWidth * index;
            if (left > width) {
                containerImg.style.left = -left + width + "px";
            }
            if (left < width) {
                containerImg.style.left = 0;
            }
        }
        changeImg();

        prev.onclick = function() {
            index--;
            if (index < 0) index = allImg.length - 1;
            changeImg();
        }
        next.onclick = function() {
            index++;
            if (index > allImg.length - 1) index = 0;
            changeImg();
        }
        allImg.forEach((img, i) => {
            img.onclick = function() {
                index = i;
                changeImg();
            }
        })
    })();

    function getQuantity() {
        const color = document.querySelector(".color.active")?.dataset.color;
        const size = document.querySelector(".size.active")?.dataset.size;
        if (!color || !size) return;
        const formData = new FormData();
        formData.append("product_id", document.querySelector('#detail').dataset.id);
        formData.append("color", color);
        formData.append("size", size);
        ajaxRequest(`/api/getdetail`, "POST", formData)
            .then(res => {
                let quantity = 0;
                if (res) quantity = res.quantity;
                if (quantity > 0)
                    document.querySelector("#count_detail").innerHTML = "(" + quantity + " sản phẩm còn lại)";
                else
                    document.querySelector("#count_detail").innerHTML = "(Hết hàng)";
                updatePrice();
            })
    }

    function updatePrice() {
        const root_price = document.querySelector("#root_price");
        const new_price = document.querySelector("#new_price");
        const size = document.querySelector(".size.active")?.dataset.size;
        const color = document.querySelector(".color.active")?.dataset.color;
        if (!size || !color) return;
        const formData = new FormData();
        formData.append("product_id", document.querySelector(".color.active").dataset.id);
        formData.append("color", color);
        formData.append("size", size);
        ajaxRequest(`/api/getdetail`, "POST", formData)
            .then(res => {
                if (!res.id) {
                    root_price.classList.add('disable');
                    new_price.classList.add('disable');
                    return;
                }
                root_price.classList.contains('disable') && root_price.classList.remove('disable');
                new_price.classList.contains('disable') && new_price.classList.remove('disable');
                const price = parseInt(res.price);
                const discount = parseFloat(res.discount);
                root_price.innerHTML = formatPrice(price);
                new_price.innerHTML = formatPrice((price * (100 - discount) / 100)) + 'đ';
            })
    }

    function addToCart(btn) {
        ajaxRequest('/api/user', "POST")
            .then(res => {
                if (res == "error") {
                    alert("Chưa đăng nhập");
                    return;
                }
                // ----------------
                const product_id = btn.dataset.id;
                const account_id = res.id;
                const color = document.querySelector(".color.active")?.dataset.color;
                const size = document.querySelector(".size.active")?.dataset.size;
                if (!color || !size) return alert("Vui lòng chọn màu và size");
                const quantity = document.querySelector(".quantity").value;
                const data = {
                    product_id,
                    color,
                    size,
                    quantity,
                    account_id
                }
                const formData = new FormData();
                for (let key in data) {
                    formData.append(key, data[key]);
                }
                // thêm vào giỏ hàng
                ajaxRequest('/api/addtocart', "POST", formData)
                    .then(res => {
                        if (res == "error") return alert("Hết hàng");
                        if (res == "success") {
                            // update số lượng trong giỏ hàng
                            ajaxRequest('/api/countcart', "POST")
                                .then(res => {
                                    alert("Thêm vào giỏ hàng thành công");
                                    document.querySelector("#header_number_cart").innerHTML = res.count;
                                })
                        }
                    })
            })
    }

    function addComment() {
        ajaxRequest('/api/user', "POST")
            .then(res => {
                if (res == "error") {
                    alert("Đăng nhập để bình luận");
                    return;
                }
                const content = document.querySelector("#text_area").value;
                if (!content.trim()) return alert("Vui lòng nhập nội dung");
                const formData = new FormData();
                formData.append("product_id", document.querySelector("#detail").dataset.id);
                formData.append("content", content);
                ajaxRequest('/api/addcomment', "POST", formData)
                    .then(res => {
                        if (res == "error") return alert("Không thể bình luận");
                        
                        document.querySelector("#text_area").value = "";
                        const containerComment = document.querySelector("#comment_container");
                        containerComment.innerHTML = `
                            <div class='card p-3 mb-0'>
                                <div class="infor d-flex">
                                    <img src="${res.image}" alt="" class="avatar shadow-sm">
                                    <div class="ms-2">
                                        <b>${res.username}</b>
                                        <div class="fs-7 fst-italic">${res.create_at}</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="px-3">${content}</div>
                            </div>
                        ` + containerComment.innerHTML;
                    })
            })
    }

    function renderComment() {
        const formData = new FormData();
        formData.append("product_id", document.querySelector("#detail").dataset.id);
        formData.append("page", loadIndex++);
        ajaxRequest('/api/getcomment', "POST", formData)
            .then(res => {
                if(res == "error") return;
                const htmls = res.map(comment => {
                    return `
                        <div class='card p-3 mb-0'>
                            <div class="infor d-flex">
                                <img src="${comment.image}" alt="" class="avatar shadow-sm">
                                <div class="ms-2">
                                    <b>${comment.username}</b>
                                    <div class="fs-7 fst-italic">${comment.create_at}</div>
                                </div>
                            </div>
                            <hr>
                            <div class="px-3">${comment.content}</div>
                        </div>
                    `
                })
                document.querySelector("#comment_container").innerHTML += htmls.join("");
                scrollStatus = true;
            })
    }
</script>