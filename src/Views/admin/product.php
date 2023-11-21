<div class="container">
    <button type="button" name="add_btn" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Thêm
    </button>
    <table class="table text-center">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên Sản Phẩm</th>
                <th scope="col">Danh Mục</th>
                <th scope="col">Giảm Giá</th>
                <th scope="col">View</th>
                <th scope="col">Lượt Bán</th>
                <th scope="col">Tổng số lượng</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stt = 1;
            // echo "<pre>";
            // print_r($allProducts);
            // echo "</pre>";
            foreach ($allProducts as $key => $product) {
            ?>
                <tr data-product-id="<?= $product['id'] ?>" data-accordion="<?= $key ?>" class="table-success">
                    <td><?= $stt++ ?></td>
                    <td data-product-name="<?= $product['name'] ?>"><?= $product['name'] ?></td>
                    <td data-category-id="<?= $product['category_id'] ?>"><?= $product['category'] ?></td>
                    <td data-discount="<?= $product['discount'] ?>"><?= $product['discount'] ?>%</td>
                    <td><?= $product['view'] ?></td>
                    <td><?= $product['purchase'] ?></td>
                    <td><?= $product['count'] ?></td>
                    <td>
                        <button name="delete_btn" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
                <tr data-accordion-show="<?= $key ?>">
                    <td colspan="8" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="card accordion-body p-3">
                            <div class="row">
                                <div class="col card">
                                    <h5 class="py-3 border-bottom bg-inverse">Ảnh</h5>
                                    <div class="d-flex flex-wrap mb-3 card-block">
                                        <?php
                                        if ($product['image']) {
                                            foreach ($product['image'] as $image) {
                                                echo "<img data-image='$image' src='.$image' alt='' class='mx-2' height='100px' width='100px'>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col card">
                                    <h5 class="py-3 border-bottom bg-inverse">Mô tả</h5>
                                    <div class="card-block">
                                        <div class="text-break" id="description"><?= $product['description'] ?></div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="py-3 border-bottom bg-inverse">Chi tiết</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Màu</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Giá</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($product['detail'] as $detail) {
                                    ?>
                                        <tr data-detail-id="<?=$detail['id']?>">
                                            <td data-color="<?= $detail['color'] ?>"><?= $detail['color'] ?></td>
                                            <td data-size="<?= $detail['size'] ?>"><?= $detail['size'] ?></td>
                                            <td data-quantity="<?= $detail['quantity'] ?>"><?= $detail['quantity'] ?></td>
                                            <td data-price="<?= $detail['price'] ?>"><?= number_format($detail['price']) ?> VNĐ</td>
                                            <td>
                                                <button name="update_btn" class="btn btn-primary" value="">Update</button>
                                                <button name="delete_detail_btn" class="btn btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
                <!-- modal form -->
                <div class="modal-body">
                    <div class="input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Tên Sản Phẩm</button>
                        </div>
                        <input type="text" name="product_name" class="form-control">
                    </div>
                    <div class="input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Giá (VNĐ)</button>
                        </div>
                        <input type="number" name="product_price" class="form-control">
                    </div>
                    <div class=" input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Giảm Giá (%)</button>
                        </div>
                        <input type="number" name="product_discount" class="form-control">
                    </div>
                    <div class="input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Size</button>
                        </div>
                        <input type="number" name="product_size" class="form-control">
                    </div>
                    <div class="input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Màu</button>
                        </div>
                        <input type="text" name="product_color" class="form-control">
                    </div>
                    <div class="input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Số lượng</button>
                        </div>
                        <input type="number" name="product_quantity" class="form-control">
                    </div>
                    <div class="mb-2 input-group">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Danh mục</button>
                        </div>
                        <select name="product_category" class="form-control form-control-inverse fill">
                            <option selected></option>
                            <?php
                            foreach ($allCategory as $category) {
                            ?>
                                <option value="<?= $category['id'] ?>" style="text-align: center;"><?= $category['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Mô tả</button>
                        </div>
                        <textarea name="product_description" class="form-control" aria-label="With textarea"></textarea>
                    </div>
                    <div class="input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Ảnh</button>
                        </div>
                        <input type="file" name="product_image[]" class="form-control" id="inputGroupFile02" accept="image/*" multiple>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="reset" name="reset_btn" class="btn btn-secondary">Reset</button>
                    <button type="submit" name="add" class="btn btn-primary">Thêm</button>
                    <input type="text" hidden name="product_detail_id" value="">
                    <button type="submit" name="update" value="" hidden class="btn btn-primary">Sửa</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/public/js/admin_product.js"></script>