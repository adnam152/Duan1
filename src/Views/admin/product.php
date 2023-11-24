<div class="container">
    <button type="button" name="add_btn" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa fa-plus"></i>
    </button>

    <!-- TABLE -->
    <table class="table text-center" id="main_table">
        <thead>
            <tr>
                <th scope="col">ID</th>
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
            foreach ($allProducts as $key => $product) {
            ?>
                <tr data-product-id="<?= $product['id'] ?>" data-accordion="<?= $key ?>" class="table-success">
                    <td><?= $product['id'] ?></td>
                    <td data-product-name="<?= $product['name'] ?>"><?= $product['name'] ?></td>
                    <td data-category-id="<?= $product['category_id'] ?>"><?= $product['category'] ?></td>
                    <td data-discount="<?= $product['discount'] ?>"><?= $product['discount'] ?>%</td>
                    <td><?= $product['view'] ?></td>
                    <td><?= $product['purchase'] ?></td>
                    <td id="total-<?= $product['id'] ?>"><?= $product['count'] ?></td>
                    <td>
                        <button name="delete_btn" class="btn btn-danger" onclick="deleteProduct(this)"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                <tr data-accordion-show="<?= $key ?>">
                    <td colspan="10" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="card accordion-body p-3">
                            <div class="row">
                                <div class="col card over-y-auto height-300">
                                    <h5 class="py-3 border-bottom bg-inverse">Images</h5>
                                    <div class="d-flex flex-wrap mb-3 card-block">
                                        <span id="image-container" class="d-flex flex-wrap">
                                            <?php
                                            if ($product['image']) {
                                                foreach ($product['image'] as $id => $image) {
                                                    echo "<div class='position-relative'>";
                                                    echo "<img data-image='$image' src='.$image' alt='' class='m-2 img-sm'>";
                                                    echo "<button name='delete_img_btn' class='x-btn' data-image-id='$id' onclick='deleteImage(this)'>x</button>";
                                                    echo "</div>";
                                                }
                                            }
                                            ?>
                                        </span>
                                        <label for="add_img_<?= $key ?>"><img class="img-sm m-2 pointer" src="/assets/image/add-image-2.png" alt=""></label>
                                        <input type="file" data-product-id="<?= $product['id'] ?>" id="add_img_<?= $key ?>" hidden accept="image/*" multiple onchange="addImage(this)">
                                    </div>
                                </div>
                                <div class="col card over-y-auto height-300">
                                    <h5 class="py-3 border-bottom bg-inverse">Description</h5>
                                    <div class="card-block">
                                        <div class="text-break" id="description-<?= $product['id'] ?>"><?= $product['description'] ?></div>
                                    </div>
                                </div>
                            </div>
                            <table class="table" data-product-id="<?= $product['id'] ?>">
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
                                        <tr data-detail-id="<?= $detail['id'] ?>">
                                            <td data-color="<?= $detail['color'] ?>"><?= $detail['color'] ?></td>
                                            <td data-size="<?= $detail['size'] ?>"><?= $detail['size'] ?></td>
                                            <td data-quantity="<?= $detail['quantity'] ?>"><?= $detail['quantity'] ?></td>
                                            <td data-price="<?= $detail['price'] ?>"><?= number_format($detail['price']) ?> đ</td>
                                            <td>
                                                <button name="update_btn" class="btn btn-primary" value="" onclick="openUpdateModal(this)"><i class="fa fa-edit"></i></button>
                                                <button name="delete_detail_btn" class="btn btn-danger" onclick="deleteDetail(this)"><i class="fa fa-trash"></i></i></button>
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

    <!-- PAGINATION -->
    <div class="jqpagination m-b-10 pagination">
        <a href="#" class="btn first disabled" data-action="first">«</a>
        <a href="#" class="btn previous disabled" data-action="previous">‹</a>
        <input type="text" data-max-page="40" class="m-t-5">
        <a href="?page=2&limit=10" class="btn next" data-action="next">›</a>
        <a href="#" class="btn last" data-action="last">»</a>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm</h1>
                <button type="button" class="btn-close border-0 bg-danger" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>

            <form action="/api/product" method="POST" enctype="multipart/form-data">
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
                            <button disabled class="btn btn-light" type="button">Giá (đ)</button>
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
                    <button type="button" name="update" data-product-id="" data-detail-id="" class="btn btn-primary" hidden onclick="updateDetail(this)">Sửa</button>
                </div>
            </form>
        </div>
    </div>
</div>