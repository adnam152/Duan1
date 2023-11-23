<div class="container">
    <button type="button" name="add_btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Thêm
    </button>
    <table class="table text-center">
        <thead>
            <tr>
                <th scope="col-3">ID</th>
                <th scope="col-5">Danh mục</th>
                <th scope="col-4">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($allCategory as $category) {
            ?>
                <tr class="table-success" data-category-name="<?= $category['name'] ?>" data-category-id="<?= $category['id'] ?>">
                    <td><?= $category['id'] ?></td>
                    <td name="category_name"><?= $category['name'] ?></td>
                    <td>
                        <button type="button" class="btn btn-primary" onclick="openUpdateModal(this)">Sửa</button>
                        <button type="button" class="btn btn-danger" onclick="confirmDelete(this)">Xóa</button>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="">
                <!-- modal form -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category" class="form-label">Tên danh mục</label>
                        <input type="text" name="category_name" class="form-control" id="category">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" name="add" class="btn btn-primary" onclick="addCategory(this)">Thêm</button>
                    <button type="button" name="update" value="" class="btn btn-primary" onclick="updateCategory(this)">Sửa</button>
                </div>
            </form>
        </div>
    </div>
</div>
