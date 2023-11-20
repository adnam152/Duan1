<div class="container">
    <table class="table text-center">
        <thead>
            <tr>
                <th>STT</th>
                <th>Username</th>
                <th>Mật khẩu</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Vai trò</th>

                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($allAccount as $index => $account) {
                $index++;
            ?>
                <tr data-accordion="<?= $index ?>">
                    <td><?= $index ?></td>
                    <td><?= $account['username'] ?></td>
                    <td><?= $account['password'] ?></td>
                    <td><?= $account['phone_number'] ?></td>
                    <td><?= $account['address'] ?></td>
                    <td><?= $account['role'] ?></td>
                    <td>
                        <form action="">
                            <button type="button" name="update_btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Sửa</button>
                            <button type="button" name="delete" value="<?= $account['id'] ?>" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="8" class="accordion-collapse collapse" data-bs-parent="#accordionExample" data-accordion-show="<?= $index ?>">
                        <div class="card accordion-body p-3">
                            <?php
                            $image = $account['image'] ? $account['image'] : '';
                            echo "<img src='.$image.' alt='' height='100px' width='100px'>";
                            ?>
                            <div>Email: <?= $account['email'] ?></div>
                            <div>Ngày tạo: <?= $account['create_at'] ?></div>
                            <div>Họ tên: <?= $account['fullname'] ?></div>
                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>

        </tbody>
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Sửa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <!-- modal form -->
                <div class="modal-body">
                    <div class="mb-2">
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="mb-2">
                        <input type="number" name="password" class="form-control" placeholder="Mật khẩu">
                    </div>
                    <div class="mb-2">
                        <input type="file" name="user_image" class="form-control" id="inputGroupFile02" accept="image/*">
                    </div>
                    <div class="mb-2">
                        <input type="text" name="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="mb-2">
                        <input type="text" name="phone_number" class="form-control" placeholder="Số điện thoại">
                    </div>
                    <div class="mb-2">
                        <input type="text" name="address" class="form-control" placeholder="Địa chỉ">
                    </div>
                    <div class="mb-2">
                        <input type="text" name="fullname" class="form-control" placeholder="Họ tên">
                    </div>
                    <div class="mb-2">
                        <input type="text" name="role" class="form-control" placeholder="Vai trò">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update" value="" class="btn btn-primary">Sửa</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Xác nhận xóa
    const deleteBtns = document.querySelectorAll('button[name="delete"]');
    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            if (confirm("Bạn có chắc chắn muốn xóa không?")) {
                btn.type = "submit";
            }
        })
    })

    window.addEventListener('load', function() {
        const updateBtns = document.querySelectorAll("button[name='update_btn']");
        updateBtns.forEach(btn => {
            btn.onclick = function() {
                // const addBtn = document.querySelector("button[name='add_btn']");
                // addBtn.click();
                //sửa thông tin modal
                const title = document.querySelector("#exampleModalLabel");
                const categoryName = document.querySelector("#category");
                const add = document.querySelector("button[name='add']");
                const update = document.querySelector("button[name='update']");
                const name = btn.closest('tr').querySelector('td[data-category-name]').getAttribute(
                    "data-category-name");
                const id = btn.closest('tr').querySelector('td[data-category-id]').getAttribute(
                    "data-category-id");


                categoryName.value = name;
                // add.hidden = true;
                update.value = id;
                // update.hidden = false;
            }

        });
    })
    const trs = document.querySelectorAll('tr[data-accordion]');
    trs.forEach(tr => {
        tr.addEventListener('click', (e) => {
            if(e.target.nodeName != "BUTTON"){
                const accordion = tr.dataset.accordion;
                const tdShow = document.querySelector(`td[data-accordion-show="${accordion}"]`);
                tdShow.classList.toggle('show');
            }
        })
    })
</script>