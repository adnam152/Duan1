<style>
    * {
        /* box-shadow: 0 0 2px black; */
    }

    .position-sticky {
        margin-bottom: 0;
        padding: 1rem 0;
        background-color: #fff;
        top: 0;
        z-index: 1;
        border-bottom: 1px solid rgba(0, 0, 0, 0.125);
    }

    .card {
        border-radius: 0.5rem;
        height: 100%;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .card::-webkit-scrollbar {
        width: 5px;
    }

    .card::-webkit-scrollbar-thumb {
        background-color: #000;
        border-radius: 10px;
    }

    .card::-webkit-scrollbar-track {
        background-color: #fff;
    }

    .infor {
        width: 45rem;
        margin-right: 1rem;
        height: 100%;
    }

    .history {
        width: 100%;
        height: 100%;
    }

    .pointer {
        cursor: pointer;
        user-select: none;
    }

    .pointer:hover {
        color: #0d6efd;
    }

    .bill_quantity {
        position: absolute;
        bottom: 5px;
        right: 15px;
    }

    #form-infor input {
        display: none;
    }

    #form-infor:not(.active) input {
        display: none;
    }

    #form-infor:not(.active) .text-content {
        display: block;
    }

    #form-infor.active input {
        display: block;
    }

    #form-infor.active .text-content {
        display: none;
    }

    #save-edit {
        display: none;
    }

    #save-edit.active {
        display: block;
    }

    #change-password-group:not(.active) {
        display: none;
    }
</style>
<div class="d-flex px-5 m-0 mt-3" style="height: calc(100vh - 100px)">
    <!-- Thông tin người dùng -->
    <div class="infor">
        <div class="card">
            <form action="" id="form-infor" enctype="multipart/form-data">
                <div class="row mx-0">
                    <div class="col-md-4 gradient-custom text-center px-2" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                        <input type="file" name="avatar" id="" accept="image/*" hidden>
                        <img src="<?= $_SESSION['user']['image'] ?? NO_AVATAR ?>" alt="Avatar" id="avatar-img" class="img-fluid my-5" style="height: 80px;" />
                        <div class="edit-group mb-3">
                            <h6 class="fw-bolder text-content"><?= $_SESSION['user']['fullname'] ?></h6>
                            <input name="fullname" type="text" class="form-control">
                        </div>
                        <p><?= $_SESSION['user']['username'] ?></p>
                    </div>
                    <div class="col-md-8 px-2">
                        <div class="card-body">
                            <h6 class="text-center fw-bolder">Thông tin cá nhân</h6>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1">
                                <div class="col-6">
                                    <h6 class="fw-bolder">Email:</h6>
                                    <div class="edit-group mb-3">
                                        <input name="email" type="text" class="form-control">
                                        <p class="text-muted text-content mb-0"><?= $_SESSION['user']['email'] ?></p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h6 class="fw-bolder">Số điện thoại:</h6>
                                    <div class="edit-group mb-3">
                                        <input name="phone_number" type="tel" class="form-control">
                                        <p class="text-muted text-content mb-0"><?= $_SESSION['user']['phone_number'] ?></p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h6 class="fw-bolder">Địa chỉ:</h6>
                                    <div class="edit-group mb-3">
                                        <input name="address" type="text" class="form-control">
                                        <p class="text-muted text-content mb-0"><?= $_SESSION['user']['address'] ?></p>
                                    </div>
                                </div>
                                <div class="col">
                                    <h6 class="fw-bolder mb-0">Ngày tạo tài khoản:</h6>
                                    <p class="text-muted mb-0"><?= date('F d, Y h:i:s A', strtotime($_SESSION['user']['create_at'])) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-0 mt-4">
                <button type="button" class="btn btn-primary w-maxcontent mx-auto px-5 mb-3" id="save-edit">Lưu thay đổi</button>
                <div class="d-flex justify-content-evenly" id="edit-btn-group">
                    <div class="pointer w-maxcontent mx-auto" id="edit-profile-btn">
                        <i class="far fa-edit"></i> Sửa thông tin
                    </div>
                    <div class="pointer w-maxcontent mx-auto" id="change-password-btn" onclick="openFormPassword(this)">
                        <i class="far fa-edit"></i> Đổi mật khẩu
                    </div>
                </div>
            </form>
            <div id="change-password-group" class="mt-5 px-5">
                <input name="password" type="password" class="form-control mb-2" placeholder="Mật khẩu hiện tại" required>
                <input name="new-password" type="password" class="form-control mb-2" placeholder="Mật khẩu mới" required>
                <input name="confirm-password" type="password" class="form-control mb-2" placeholder="Nhập lại mật khẩu" required>
                <div class="float-right w-maxcontent">
                    <button type="button" class="btn btn-secondary w-maxcontent px-5 mb-3" onclick="closeChangePassword()">Hủy</button>
                    <button type="button" class="btn btn-primary w-maxcontent px-5 mb-3" id="save-password">Lưu</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Lịch sử mua hàng -->
    <div class="history">
        <div class="card px-3 pb-3 position-relative">
            <h5 class="card-title text-center fw-bolder position-sticky">Lịch sử mua hàng</h5>
            <table class="table">
                <thead>
                    <tr align="center">
                        <th scope="col">#</th>
                        <th scope="col">Mã đơn hàng</th>
                        <th scope="col">Ngày đặt</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($allBills) && !empty($allBills))
                        foreach ($allBills as $index => $bill) {
                    ?>
                        <tr data-accordion="<?= $index ?>" align="center">
                            <th scope="row"><?= $index + 1 ?></th>
                            <td><?= $bill['id'] ?></td>
                            <td><?= date('F d, Y h:i:s A', strtotime($bill['create_at'])) ?></td>
                            <td><?= number_format($bill['total_price']) ?>đ</td>
                            <td>
                                <?php
                                if ($bill['status'] == 0) {
                                    echo "<span class='badge bg-warning text-dark'>Đang chờ</span>";
                                } else if ($bill['status'] == 1) {
                                    echo "<span class='badge bg-success'>Đã giao hàng</span>";
                                } else {
                                    echo "<span class='badge bg-danger'>Đã hủy</span>";
                                }
                                ?>
                            </td>
                            <td>
                                <a href="#">
                                    <i class="fas fa-info-circle bill-detail"></i>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="8" class="accordion-collapse collapse" data-bs-parent="#accordionExample" data-accordion-show="<?= $index ?>">
                                <div class="card accordion-body p-3">
                                    <?php
                                    foreach ($bill['bill_detail'] as $product) {
                                        $newPrice = $product['price'] - ($product['price'] * $product['discount']) / 100;
                                        $price = $newPrice * $product['quantity'];
                                    ?>
                                        <a href="/detail?id=<?= $product['product_id'] ?>" class="card mb-1 p-2 position-relative product">
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
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Save password
    document.querySelector('#save-password').onclick = function() {
        let password = document.querySelector('#change-password-group input[name="password"]').value;
        let newPassword = document.querySelector('#change-password-group input[name="new-password"]').value;
        let confirmPassword = document.querySelector('#change-password-group input[name="confirm-password"]').value;
        if (password.length < 8 || newPassword.length < 8 || confirmPassword.length < 8) {
            alert("Mật khẩu phải có ít nhất 8 ký tự");
            return;
        }
        if (newPassword != confirmPassword) {
            alert("Mật khẩu mới không khớp");
            return;
        }
        const formData = new FormData();
        formData.append('password', password);
        formData.append('new-password', newPassword);
        formData.append('change-password', '');
        ajaxRequest('/api/changepassword', "POST", formData)
            .then(res => {
                if (res == 'error') {
                    alert("Mật khẩu hiện tại không đúng");
                    return;
                }
                if (res == 'success') {
                    alert("Đổi mật khẩu thành công");
                    closeChangePassword();
                }
            })
    }
    // Close form password
    function closeChangePassword() {
        document.querySelector('#change-password-group').classList.remove('active');
        document.querySelector('#change-password-btn').hidden = false;
    }
    // Open form password
    function openFormPassword(btn) {
        document.querySelector('#change-password-group').classList.add('active');
        btn.hidden = true;
        document.querySelectorAll('#change-password-group input').forEach(input => {
            input.value = '';
        })
    }

    // Onload
    window.addEventListener('load', () => {
        document.querySelectorAll('tr[data-accordion]').forEach(tr => {
            tr.addEventListener('click', (e) => {
                if (e.srcElement.classList.contains('bill-detail')) {
                    const accordion = tr.dataset.accordion;
                    const tdShow = document.querySelector(`td[data-accordion-show="${accordion}"]`);
                    tdShow.classList.toggle('show');
                }
            })
        })

        // avatar
        document.querySelector('#avatar-img').addEventListener('click', () => {
            if (!document.querySelector('#form-infor.active')) return;
            document.querySelector('input[name="avatar"]').click();
        })
        document.querySelector('input[name="avatar"]').addEventListener('change', (e) => {
            console.log('abc')
            const file = e.target.files[0];
            const formData = new FormData();
            formData.append('avatar', file);
            ajaxRequest('/api/profile', "POST", formData)
                .then(res => {
                    if (res == "error") {
                        alert("Có lỗi xảy ra");
                        return;
                    }
                    document.querySelector('#avatar-img').src = res;
                    document.querySelector('input[name="avatar"]').value = '';
                })
        })

        // Save Btn
        document.querySelector('#save-edit').addEventListener('click', () => {
            const formData = new FormData(document.querySelector('#form-infor'));
            ajaxRequest('/api/profile', "POST", formData)
                .then(res => {
                    console.log(res);
                    if (res == "success") {
                        document.querySelector('#edit-profile-btn').hidden = false;
                        document.querySelector('#form-infor').classList.remove('active');
                        document.querySelector('#save-edit').classList.remove('active');
                    } else alert("Có lỗi xảy ra")
                })
        })

        // Edit Btn
        document.querySelector('#edit-profile-btn').addEventListener('click', () => {
            document.querySelector('#edit-profile-btn').hidden = true;
            const infor = document.querySelector('#form-infor');
            infor.classList.add('active');
            document.querySelector('#save-edit').classList.add('active');

            document.querySelectorAll('.edit-group').forEach((group, index) => {
                const currentText = group.querySelector('.text-content').innerText;
                const inputElement = group.querySelector('input');
                inputElement.value = currentText;
                group.onkeyup = (e) => {
                    // ESC -> cancel
                    if (e.keyCode == 27) {
                        inputElement.value = currentText;
                    }
                    // ENTER -> save
                    if (e.keyCode == 13) {
                        group.querySelector('.text-content').innerText = inputElement.value;
                        // next input
                        const nextInput = document.querySelectorAll('.edit-group')[index + 1];
                        if (nextInput) nextInput.querySelector('input').focus();
                        else document.querySelector('#save-edit')?.focus();
                    }
                }
                // if click outside
                document.addEventListener('click', (e) => {
                    // if click edit btn
                    if (e.target.closest('#edit-profile-btn')) {
                        return;
                    }
                    if (!group.contains(e.target)) {
                        group.querySelector('.text-content').innerText = inputElement.value;
                    }
                })
            })
        })
    })
</script>