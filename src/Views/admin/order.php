<style>
    .detail-container{
        max-height: 150px;
        overflow-y: auto;
        overflow-x: hidden;
    }
    .detail-container::-webkit-scrollbar{
        width: 5px;
    }
    .detail-container::-webkit-scrollbar-thumb{
        background-color: #000;
        border-radius: 10px;
    }
    .detail-container::-webkit-scrollbar-track{
        background-color: #fff;
    }
    .detail-container img{
        object-fit: contain;
    }
    .detail-container .bill_quantity{
        position: absolute;
        bottom: 5px;
        right: 15px;
    }
</style>

<div class="d-flex justify-content-between">
    <div></div>
    <div class="d-flex">
        <?php require "src/Views/admin/components/filter.php" ?>
        <?php require "src/Views/admin/components/pagination.php" ?>
    </div>
</div>

<table class="table" id="order_table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tài khoản</th>
            <th scope="col">Ngày đặt hàng</th>
            <th scope="col">Giá trị đơn hàng</th>
            <th scope="col">Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allBills as $index => $bill) : ?>
            <tr data-accordion="<?= $index ?>" class="pointer <?= $bill['status'] == 0 ? 'table-info' : 'bg-success' ?>">
                <td><?= $bill['id'] ?></td>
                <td><?= $bill['username'] ?></td>
                <td><?= $bill['create_at'] ?></td>
                <td><?= number_format($bill['total_price']) ?>đ</td>
                <td><?= $bill['status'] == 1 ? 
                        "<span class='badge bg-success'>Đã giao hàng</span>" : 
                        "<span class='badge bg-warning text-dark'>Đang xử lý</span>" ?>
                </td>
                <td>
                    <button class="btn <?= $bill['status'] == 1 ? 'text-white' : 'btn-success' ?>" onclick="updateStatus(this)" data-bill-id="<?= $bill['id'] ?>" <?= $bill['status'] == 1 ? 'disabled' : '' ?>><?= $bill['status'] == 1 ? '<i class="fas fa-check"></i>' : '<i class="fas fa-credit-card"></i>' ?></button>
                    <button class="btn btn-danger" onclick="deleteBill(this)" data-bill-id="<?= $bill['id'] ?>"><i class="fas fa-trash-alt"></i></button>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="accordion-collapse collapse" data-bs-parent="#accordionExample" data-accordion-show="<?= $index ?>">
                    <div class="card accordion-body p-3">
                        <div class="d-flex align-items-center">
                            <!-- INFOR -->
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <img src="<?= $bill['image'] ?? '/assets/image/no-avatar.webp' ?>" alt="" class="img-account">
                                    <input type="file" name="image" data-user-id="<?= $bill['id'] ?>" enctype="image/*" hidden>
                                    <div class="text-start">
                                        <div data-fullname="<?= $bill['fullname'] ?>">Họ tên: <?= $bill['fullname'] ?></div>
                                        <div data-email="<?= $bill['email'] ?? '' ?>">Email: <?= $bill['email'] ?? '' ?></div>
                                        <div data-phone-number="<?= $bill['phone_number'] ?>">Số điện thoại: <?= $bill['phone_number'] ?></div>
                                        <div data-address="<?= $bill['address'] ?>">Địa chỉ: <?= $bill['address'] ?></div>
                                    </div>
                                </div>
                            </div>

                            <!-- DETAIL -->
                            <div class="col detail-container">
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
                        </div>
                    </div>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<script>
    // show accordion
    window.addEventListener('load', () => {
        document.querySelectorAll('tr[data-accordion]').forEach(tr => {
            tr.addEventListener('click', (e) => {
                if (e.target.nodeName != "BUTTON") {
                    const accordion = tr.dataset.accordion;
                    const tdShow = document.querySelector(`td[data-accordion-show="${accordion}"]`);
                    tdShow.classList.toggle('show');
                }
            })
        })
    })

    // delete bill
    function deleteBill(btn) {
        if (!confirm("Bạn có chắc chắn muốn xóa đơn hàng này?")) return;
        let billId = btn.getAttribute('data-bill-id');
        ajaxRequest('/api/order?delete=' + billId, 'GET')
            .then(res => {
                if (res == "success") {
                    const dataAccordion = btn.closest('tr').dataset.accordion;
                    document.querySelector(`[data-accordion-show="${dataAccordion}"]`)?.closest('tr').remove();
                    btn.closest('tr').remove();
                } else alert("Có lỗi xảy ra");
            })
    }

    function updateStatus(btn) {
        if (!confirm("Bạn có chắc chắn muốn cập nhật trạng thái đơn hàng này?")) return;
        let billId = btn.getAttribute('data-bill-id');
        ajaxRequest('/api/order?updatestatus=' + billId, 'GET')
            .then(res => {
                if (res == "success") {
                    btn.closest('tr').classList.remove('table-info');
                    btn.closest('tr').classList.add('bg-success');
                    btn.classList.remove('btn-success');
                    btn.classList.add('text-white');
                    btn.innerHTML = '<i class="fas fa-check"></i>';
                    btn.disabled = true;
                } else alert("Có lỗi xảy ra");
            })
    }
</script>