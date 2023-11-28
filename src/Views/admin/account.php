<div class="d-flex justify-content-between">
    <button type="button" name="add_btn" class="btn btn-success m-b-10" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa fa-plus"></i>
    </button>
    <div class="d-flex">
        <?php require "src/Views/admin/components/filter.php" ?>
        <?php require "src/Views/admin/components/pagination.php" ?>
    </div>
</div>

<table class="table text-center" id="main-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Mật khẩu</th>
            <th>Vai trò</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($allAccount as $index => $account) {
            $image = $account['image'] ? $account['image'] : './assets/image/no-avatar.webp';
        ?>
            <tr data-accordion="<?= $index ?>" class="table-success pointer">
                <td data-id="<?=$account['id']?>"><?= $account['id'] ?></td>
                <td data-username="<?=$account['username']?>"><?= $account['username'] ?></td>
                <td data-password="<?=$account['password']?>"><?= $account['password'] ?></td>
                <td data-role="<?=$account['role']?>"><?= $account['role'] == 1 ? 'Quản trị viên' : 'Người dùng' ?></td>
                <td>
                    <button type="button" name="update_btn" class="btn btn-primary" onclick="openModal(this)"><i class="fa fa-edit"></i></button>
                    <button type="button" name="delete" value="<?= $account['id'] ?>" class="btn btn-danger" onclick="confirmDelete(this)"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="accordion-collapse collapse" data-bs-parent="#accordionExample" data-accordion-show="<?= $index ?>">
                    <div class="card accordion-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="col">
                                <div class="d-flex align-items-center">
                                    <img src=".<?= $image ?>" alt="" class="img-account" onclick="updateImage(this)">
                                    <input type="file" name="image" data-user-id="<?=$account['id']?>" enctype="image/*" hidden>
                                    <div class="text-start">
                                        <div data-fullname="<?=$account['fullname']?>">Họ tên: <?= $account['fullname'] ?></div>
                                        <div data-email="<?=$account['email']?>">Email: <?= $account['email'] ?></div>
                                        <div data-phone-number="<?=$account['phone_number']?>">Số điện thoại: <?= $account['phone_number'] ?></div>
                                        <div data-address="<?=$account['address']?>">Địa chỉ: <?= $account['address'] ?></div>
                                        <div>Ngày tạo: <?= $account['create_at'] ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col text-start">
                                <h6>Tổng số đơn hàng đã mua: <?= $account['count_order'] ?></h6>
                                <div class="row">
                                    <?php
                                    foreach ($account['count_order_by_category'] as $category => $count) {
                                        echo "<div class='col-6'><p>$category: $count</p></div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Sửa</h1>
                <button type="button" class="btn-close bg-danger border-0" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <!-- modal form -->
                <div class="modal-body">
                    <div class="mb-2 input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Username</button>
                        </div>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="mb-2 input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Password</button>
                        </div>
                        <input type="text" name="password" class="form-control">
                    </div>
                    <div class="mb-2 input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Email</button>
                        </div>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="mb-2 input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Số điện thoại</button>
                        </div>
                        <input type="text" name="phone_number" class="form-control">
                    </div>
                    <div class="mb-2 input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Địa chỉ</button>
                        </div>
                        <input type="text" name="address" class="form-control">
                    </div>
                    <div class="mb-2 input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Họ tên</button>
                        </div>
                        <input type="text" name="fullname" class="form-control">
                    </div>
                    <div class="mb-2 input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Vai trò</button>
                        </div>
                        <select name="role" id="" class="form-control form-control-inverse fill">
                            <option value="0" selected>Người dùng</option>
                            <option value="1">Quản trị viên</option>
                        </select>
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="reset" hidden></button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" name="update" value="" class="btn btn-primary" onclick="updateAccount(this)">Sửa</button>
                    <button type="button" name="add" value="" class="btn btn-primary" onclick="addAccount(this)">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>
