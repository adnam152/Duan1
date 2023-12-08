<style>
    th,
    td {
        padding: 10px 0 !important;
    }

    tbody tr td:nth-child(1) {
        padding-left: 2rem !important;
        padding-right: 2rem !important;
    }

    tbody tr td:nth-child(2) {
        text-align: start !important;
        min-width: 100px;
        max-width: 250px;
        text-wrap: wrap;

    }

    #cart_total {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 80px;
        background-color: #9af1ac;
        border-top: 1px solid #000;
    }

    #bill_modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        backdrop-filter: blur(5px);
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 100;
        display: none;
    }

    #bill_modal.active {
        display: block;
    }

    #bill_modal .modal-container {
        position: absolute;
        top: 50px;
        left: 50%;
        transform: translate(-50%);
        width: 500px;
        height: max-content;
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
    }

    #bill_detail_container {
        max-height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    #bill_detail_container::-webkit-scrollbar {
        width: 5px;
    }

    #bill_detail_container::-webkit-scrollbar-thumb {
        background-color: #000;
        border-radius: 10px;
    }

    #bill_detail_container::-webkit-scrollbar-track {
        background-color: #fff;
    }

    #bill_modal img {
        object-fit: contain;
    }

    #bill_modal .bill_quantity {
        position: absolute;
        bottom: 5px;
        right: 15px;
    }
</style>

<div class="container-fluid">
    <table class="table table-inverse  mb-80">
        <thead>
            <tr align="center">
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Size</th>
                <th>Màu</th>
                <th>Giá</th>
                <th>Giảm giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($productInCart as $cart) {
                $newPrice = $cart['price'] - ($cart['price'] * $cart['discount']) / 100;
                $price = $newPrice * $cart['quantity'];
            ?>
                <tr align="center">
                    <td data-index="">1</td>
                    <td>
                        <a href="/detail?id=<?= $cart['product_id'] ?>">
                            <img src="<?= $cart['link'] ?>" alt="" width="80px" class="me-3">
                            <?= $cart['name'] ?>
                        </a>
                    </td>
                    <td><?= $cart['size'] ?></td>
                    <td><?= $cart['color'] ?></td>
                    <td data-old-price="<?=$cart['price']?>"><?= number_format($cart['price']) ?></td>
                    <td data-discount="<?=$cart['discount']?>"><?= $cart['discount'] ?>%</td>
                    <td data-cart-id="<?= $cart['id'] ?>">
                        <div class="d-flex align-items-center justify-content-center">
                            <button class="btn btn-danger shadow-sm" onclick="decreaseQuantity(this)">-</button>
                            <span class="quantity px-3"><?= $cart['quantity'] ?></span>
                            <button class="btn btn-success shadow-sm" onclick="increaseQuantity(this)">+</button>
                        </div>
                    </td>
                    <td data-price="<?= $price ?>"><?= number_format($price) ?></td>
                    <td>
                        <button class="btn btn-danger shadow-sm" data-cart-id="<?= $cart['id']?>" onclick="removeProduct(this)"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<div id="cart_total" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">
        <h6 class="fw-bolder mb-0">Tổng tiền:</h6>
        <div class="d-flex align-items-center">
            <h6 class="fw-bolder mb-0" id="total_money" data-total-price="0">0đ</h6>
            <button class="btn btn-warning rounded fw-bolder ms-3 text-dark shadow-sm" onclick="openBill()">Đặt Hàng</button>
        </div>
    </div>
</div>

<div id="bill_modal" class="">
    <div class="modal-container shadow p-3">
        <h4 class="fw-bolder mb-4">Thông tin đặt hàng</h4>

        <!-- Customer info -->
        <div class="card">
            <!-- If Login -->
            <?php if (isset($_SESSION['user'])) : ?>
                <div class="card-header p-2 d-flex justify-content-between">
                    <h6 class="fw-bolder mb-0">
                        <i class="fa fa-location-arrow me-2"></i> Địa chỉ nhận hàng
                    </h6>
                    <h6>
                        <a href="/profile" class="nav-link py-0">Thay đổi <i class="fa-solid fa-angle-right"></i></a>
                    </h6>
                </div>
                <div class="card-body py-2">
                    <span id="phone_number" data-phone-number="<?= $_SESSION['user']['phone_number'] ?>"><?= $_SESSION['user']['phone_number'] ?></span> -
                    <span id="fullname" data-full-name="<?= $_SESSION['user']['fullname'] ?>"><?= $_SESSION['user']['fullname'] ?></span>
                    <div id="address" data-address="<?= $_SESSION['user']['address'] ?>"><?= $_SESSION['user']['address'] ?></div>
                </div>

                <!-- If No Login - Isset Temp User-->
            <?php elseif (isset($_SESSION['temp_user'])) : ?>
                <div class="card-header p-2 d-flex justify-content-between">
                    <h6 class="fw-bolder mb-0">
                        <i class="fa fa-location-arrow me-2"></i> Địa chỉ nhận hàng
                    </h6>
                    <h6>
                        <a href="#" id="temp-user-change" class="nav-link py-0" onclick="changeMode(this)">Thay đổi <i class="fa-solid fa-angle-right"></i></a>
                    </h6>
                </div>
                <div class="card-body py-2">
                    <span id="phone_number" data-phone-number="<?= $_SESSION['temp_user']['phone_number'] ?>"><?= $_SESSION['temp_user']['phone_number'] ?></span> -
                    <span id="fullname" data-full-name="<?= $_SESSION['temp_user']['fullname'] ?>"><?= $_SESSION['temp_user']['fullname'] ?></span>
                    <div id="address" data-address="<?= $_SESSION['temp_user']['address'] ?>"><?= $_SESSION['temp_user']['address'] ?></div>
                </div>

                <!-- No Temp User -->
            <?php else : ?>
                <div class="card-header p-2 d-flex justify-content-between">
                    <h6 class="fw-bolder mb-0">
                        <i class="fa fa-location-arrow me-2"></i> Địa chỉ nhận hàng
                    </h6>
                </div>
                <div class="card-body py-2">
                    <div id="fullname">
                        <input type="text" class="form-control mb-2" placeholder="Họ và tên">
                    </div>
                    <div id="phone_number">
                        <input type="text" class="form-control mb-2" placeholder="Số điện thoại">
                    </div>
                    <div id="address">
                        <input type="text" class="form-control" placeholder="Địa chỉ">
                    </div>
                </div>
                <div class="card-footer pt-0">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success shadow-sm" onclick="saveInfor(this)">Lưu thông tin</button>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Bill detail -->
        <div id="bill_detail_container">
            <?php
            foreach ($productInCart as $product) {
                $newPrice = $product['price'] - ($product['price'] * $product['discount']) / 100;
                $price = $newPrice * $product['quantity'];
            ?>
                <a href="/detail?id=<?= $product['product_id'] ?>" class="card mb-1 p-2 position-relative product" data-cart-id="<?= $product['id'] ?>">
                    <div class="row ">
                        <div class="col-1">
                            <img src="<?= $product['link'] ?>" width="40px" height="100%" alt="">
                        </div>
                        <div class="col ms-2">
                            <div class="" data-product-name="<?= $product['name'] ?>"><?= $product['name'] ?></div>
                            <div class="fs-7 fst-italic" data-detail-id="<?= $product['detail_id'] ?>">
                                <?= $product['color'] ?>, <?= $product['size'] ?>
                            </div>
                            <div class="fs-7" data-new-price="<?= $newPrice ?>"><?= number_format($newPrice) ?>đ</div>
                        </div>
                        <div class="bill_quantity fst-italic" data-quantity="<?= $product['quantity'] ?>">x<?= $product['quantity'] ?></div>
                    </div>
                </a>
            <?php
            }
            ?>
        </div>

        <div class="mt-3 fw-bolder d-flex justify-content-between align-items-center px-2">
            <p>Tổng thanh toán:</p>
            <p id="order_total_price">0đ</p>
        </div>

        <div class="mt-0 fw-bolder d-flex justify-content-between align-items-center px-2">
            <p class="mb-0">Phương thức thanh toán:</p>
            <select name="payment_method" id="payment_method" class="form-select form-select-sm form-control w-50">
                <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
            </select>
        </div>

        <div class="d-flex justify-content-end mt-3">
            <button class="btn btn-danger shadow-sm" name="cancle" onclick="closeModal()">Hủy</button>
            <button class="btn btn-success shadow-sm ms-3" onclick="confirmBill()">Đồng ý</button>
        </div>
    </div>
</div>

<script>
    // Change Quantity
    function increaseQuantity(btn) {
        const quantity = btn.closest('td').querySelector('.quantity');
        const cart_id = btn.closest('td').dataset.cartId;
        ajaxRequest('/api/increasequantity?id='+cart_id, "GET")
            .then(res => {
                if (res == "success") {
                    quantity.innerHTML = parseInt(quantity.innerHTML) + 1;
                    totalPrice();
                    // modal
                    const bill_quantity = document.querySelector(`.product[data-cart-id="${cart_id}"]`).querySelector('.bill_quantity');
                    bill_quantity.innerHTML = `x${parseInt(bill_quantity.innerHTML.slice(1)) + 1}`;
                }
            })
    }
    function decreaseQuantity(btn) {
        const quantity = btn.closest('td').querySelector('.quantity');
        if(parseInt(quantity.innerHTML) <= 1) return;
        
        const cart_id = btn.closest('td').dataset.cartId;
        ajaxRequest('/api/decreasequantity?id='+cart_id, "GET")
            .then(res => {
                if (res == "success") {
                    quantity.innerHTML = parseInt(quantity.innerHTML) - 1;
                    totalPrice();
                    // modal
                    const bill_quantity = document.querySelector(`.product[data-cart-id="${cart_id}"]`).querySelector('.bill_quantity');
                    bill_quantity.innerHTML = `x${parseInt(bill_quantity.innerHTML.slice(1)) - 1}`;
                }
            })
    }


    // Change Infor User
    function changeMode(btn) {
        const fullname = document.getElementById('fullname').dataset.fullName;
        const phone_number = document.getElementById('phone_number').dataset.phoneNumber;
        const address = document.getElementById('address').dataset.address;
        btn.closest('.card').innerHTML = `
                <div class="card-header p-2 d-flex justify-content-between">
                    <h6 class="fw-bolder mb-0">
                        <i class="fa fa-location-arrow me-2"></i> Địa chỉ nhận hàng
                    </h6>
                </div>
                <div class="card-body py-2">
                    <div id="fullname">
                        <input type="text" class="form-control mb-2" value="${fullname}">
                    </div>
                    <div id="phone_number">
                        <input type="text" class="form-control mb-2" value=${phone_number}>
                    </div>
                    <div id="address">
                        <input type="text" class="form-control" value=${address}>
                    </div>
                </div>
                <div class="card-footer pt-0">
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success shadow-sm" onclick="saveInfor(this)">Lưu thông tin</button>
                    </div>
                </div>
            `
    }

    function saveInfor(btn) {
        const fullname = document.getElementById('fullname').querySelector('input').value;
        const phone_number = document.getElementById('phone_number').querySelector('input').value;
        const address = document.getElementById('address').querySelector('input').value;
        const formData = new FormData();
        formData.append('add', '');
        formData.append('fullname', fullname);
        formData.append('phone_number', phone_number);
        formData.append('address', address);
        ajaxRequest('/api/tempuser', "POST", formData)
            .then(res => {
                if (res == "success") {
                    btn.closest('.card').innerHTML = `
                            <div class="card-header p-2 d-flex justify-content-between">
                                <h6 class="fw-bolder mb-0">
                                    <i class="fa fa-location-arrow me-2"></i> Địa chỉ nhận hàng
                                </h6>
                                <h6>
                                    <a href="#" id="temp-user-change" class="nav-link py-0" onclick="changeMode(this)">Thay đổi <i class="fa-solid fa-angle-right"></i></a>
                                </h6>
                            </div>
                            <div class="card-body py-2">
                                <span id="phone_number" data-phone-number="${phone_number}">${phone_number}</span> -
                                <span id="fullname" data-full-name="${fullname}">${fullname}</span>
                                <div id="address" data-address="${address}">${address}</div>
                            </div>
                        `
                } else alert("Lưu thông tin thất bại");
            })
    }

    function confirmBill() {
        const payment_method = document.getElementById('payment_method');
        const fullname = document.getElementById('fullname').dataset.fullName;
        const phone_number = document.getElementById('phone_number').dataset.phoneNumber;
        const address = document.getElementById('address').dataset.address;
        const bill_detail = document.querySelectorAll('a[data-cart-id]');
        const total_money = document.getElementById('total_money');

        const formData = new FormData();
        formData.append('payment_method', payment_method.value);
        formData.append('fullname', fullname);
        formData.append('address', address);
        formData.append('phone_number', phone_number);

        bill_detail.forEach(item => {
            formData.append('cart_id[]', item.dataset.cartId);
        })
        ajaxRequest('/api/confirmBill', "POST", formData)
            .then(res => {
                if (res == "success") {
                    alert("Đặt hàng thành công");
                    window.location.href = "/cart";
                } else alert("Đặt hàng thất bại");
            })
    }

    function openBill() {
        openModal();
        const order_total_price = document.getElementById('order_total_price');
        const total_money = document.getElementById('total_money');
        order_total_price.innerHTML = total_money.innerHTML;
    }

    function removeProduct(btn) {
        if (!confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) return;
        const cart_id = btn.dataset.cartId;
        ajaxRequest('/api/removefromcart?id=' + cart_id, "GET")
            .then(res => {
                if (res == "success") {
                    btn.closest('tr').remove();
                    totalPrice();
                    // modal
                    document.querySelector(`.product[data-cart-id="${cart_id}"]`).remove();
                }
            })
    }

    window.addEventListener('load', () => {
        totalPrice();
    })

    function totalPrice() {
        const total_money = document.getElementById('total_money');
        const price = document.querySelectorAll('td[data-price]');
        let total = 0;
        price.forEach(item => {
            const oldPirce =parseInt(item.closest('tr').querySelector('td[data-old-price]').dataset.oldPrice);
            const discount = parseInt(item.closest('tr').querySelector('td[data-discount]').dataset.discount);
            const quantity = parseInt(item.closest('tr').querySelector('td[data-cart-id] .quantity').innerHTML);
            const newPrice = (oldPirce - (oldPirce * discount) / 100) * quantity;
            item.innerHTML = formatPrice(newPrice);
            total += newPrice;
        })
        total_money.innerHTML = formatPrice(total) + 'đ';

        // render number index 
        const index = document.querySelectorAll('td[data-index]');
        index.forEach((item, i) => {
            item.innerHTML = i + 1;
        })
        total_money.dataset.totalPrice = total;
    }

    function openModal() {
        document.getElementById('bill_modal')?.classList.toggle('active');
    }

    function closeModal(e) {
        if (!e || e.target.id == 'bill_modal' || e.target.name == 'cancle')
            document.getElementById('bill_modal')?.classList.remove('active');
    }
    document.getElementById('bill_modal')?.addEventListener('click', (e) => {
        closeModal(e);
    })
</script>