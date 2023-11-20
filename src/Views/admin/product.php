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
                    <td data-discount="<?= $product['discount'] ?>"><?= $product['discount'] ?></td>
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
                                <div class="col">
                                    <div class="d-flex flex-wrap mb-3">
                                        <?php
                                        if ($product['image']) {
                                            foreach ($product['image'] as $image) {
                                                echo "<img data-image='$image' src='.$image' alt='' class='mx-2' height='100px' width='100px'>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <p id="description"><?= $product['description'] ?></p>
                                </div>
                            </div>
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
                                        <tr>
                                            <td data-color="<?= $detail['color'] ?>"><?= $detail['color'] ?></td>
                                            <td data-size="<?= $detail['size'] ?>"><?= $detail['size'] ?></td>
                                            <td data-quantity="<?= $detail['quantity'] ?>"><?= $detail['quantity'] ?></td>
                                            <td data-price="<?= $detail['price'] ?>"><?= $detail['price'] ?></td>
                                            <td>
                                                <button name="update_btn" class="btn btn-primary">Update</button>
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
                            <button disabled class="btn btn-light" type="button">Button</button>
                        </div>
                        <input type="text" class="form-control" placeholder="Both side addons">
                    </div>
                    <div class="input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Button</button>
                        </div>
                        <input type="text" class="form-control" placeholder="Both side addons">
                    </div>
                    <div class="input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Button</button>
                        </div>
                        <input type="text" class="form-control" placeholder="Both side addons">
                    </div>
                    <div class="input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Button</button>
                        </div>
                        <input type="text" class="form-control" placeholder="Both side addons">
                    </div>
                    <div class="input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Button</button>
                        </div>
                        <input type="text" class="form-control" placeholder="Both side addons">
                    </div>
                    <div class="input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Button</button>
                        </div>
                        <input type="text" class="form-control" placeholder="Both side addons">
                    </div>
                    <div class="input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Button</button>
                        </div>
                        <input type="text" class="form-control" placeholder="Both side addons">
                    </div>
                    <div class="input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Button</button>
                        </div>
                        <input type="text" class="form-control" placeholder="Both side addons">
                    </div>
                    <div class="input-group input-group-button">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Button</button>
                        </div>
                        <input type="text" class="form-control" placeholder="Both side addons">
                    </div>
                    <div class="mb-2 input-group">
                        <span class="input-group-text">aaa</span>
                        <input type="text" name="product_name" class="form-control" placeholder="Tên Sản Phẩm">
                    </div>
                    <div class="mb-2 input-group">
                        <input type="number" name="product_price" class="form-control" placeholder="Giá">
                    </div>
                    <div class="mb-2 input-group">
                        <input type="number" name="product_discount" class="form-control" placeholder="Giảm Giá">
                    </div>
                    <div class="mb-2 input-group">
                        <input type="number" name="product_size" class="form-control" placeholder="Size">
                    </div>
                    <div class="mb-2 input-group">
                        <input type="text" name="product_color" class="form-control" placeholder="Màu">
                    </div>
                    <div class="mb-2 input-group">
                        <input type="number" name="product_quantity" class="form-control" placeholder="Số lượng">
                    </div>
                    <div class="mb-2 input-group">
                        <select name="product_category" class="form-control form-control-inverse fill">
                            <option selected style="text-align: center;">Danh mục</option>
                            <?php
                            foreach ($allCategory as $category) {
                            ?>
                                <option value="<?= $category['id'] ?>" style="text-align: center;"><?= $category['name'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-2 input-group">
                        <textarea name="product_description" class="form-control" aria-label="With textarea" placeholder="Mô tả"></textarea>
                    </div>
                    <div class="mb-2 input-group">
                        <input type="file" name="product_image" class="form-control" id="inputGroupFile02" accept="image/*">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="reset" name="reset_btn" class="btn btn-secondary">Reset</button>
                    <button type="submit" name="add" class="btn btn-primary">Thêm</button>
                    <button type="submit" name="update" value="" hidden class="btn btn-primary">Sửa</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Xử lý table
    const trs = document.querySelectorAll('tr[data-accordion]');
    trs.forEach(tr => {
        tr.addEventListener('click', (e) => {
            if (e.target.nodeName != "BUTTON") {
                const accordion = tr.dataset.accordion;
                const tdShow = document.querySelector(`tr[data-accordion-show="${accordion}"] >td`);
                tdShow.classList.toggle('show');
            }
        })
        tr.addEventListener('mouseover', () => {
            // pointer
            tr.style.cursor = 'pointer';
        })
    })

    // Xử lý các action (Thêm, Sửa, Xóa)
    const addBtn = document.querySelector('button[name="add_btn"]');
    const updateBtns = document.querySelectorAll('button[name="update_btn"]');
    const deleteBtn = document.querySelectorAll('button[name="delete_btn"]');
    const deleteDetailBtn = document.querySelectorAll('button[name="delete_detail_btn"]');
    const resetBtn = document.querySelector('button[name="reset_btn"]');
    const add = document.querySelector('button[name="add"]');
    const update = document.querySelector('button[name="update"]');
    const modalTitle = document.querySelector('.modal-title');

    addBtn.onclick = function() {
        resetBtn.click();
        add.hidden = false;
        update.hidden = true;
        modalTitle.innerHTML = "Thêm";
    }
    updateBtns.forEach(btn => {
        btn.onclick = function() {
            addBtn.click();
            add.hidden = true;
            update.hidden = false;
            modalTitle.innerHTML = "Sửa";

            const this_table = btn.closest('table');
            const dataAccordion = this_table.closest('tr').dataset.accordionShow;
            const main_tr = document.querySelector(`tr[data-accordion="${dataAccordion}"]`);
            const this_tr = btn.closest('tr');

            const productId = main_tr.dataset.productId;
            const productName = main_tr.querySelector('td[data-product-name]').dataset.productName;
            const price = this_tr.querySelector('td[data-price]').dataset.price;
            const discount = main_tr.querySelector('td[data-discount]').dataset.discount;
            const size = this_tr.querySelector('td[data-size]').dataset.size;
            const color = this_tr.querySelector('td[data-color]').dataset.color;
            const quantity = this_tr.querySelector('td[data-quantity]').dataset.quantity;
            const categoryId = main_tr.querySelector('td[data-category-id]').dataset.categoryId;
            const description = document.querySelector('#description').innerText;
            const listImage = [];
            this_table.closest('tr').querySelectorAll('img[data-image]').forEach(img => {
                listImage.push(img.dataset.image);
            })

            // set value
            document.querySelector('input[name="product_name"]').value = productName;
            document.querySelector('input[name="product_price"]').value = price;
            document.querySelector('input[name="product_discount"]').value = discount;
            document.querySelector('input[name="product_size"]').value = size;
            document.querySelector('input[name="product_color"]').value = color;
            document.querySelector('input[name="product_quantity"]').value = quantity;
            document.querySelector('select[name="product_category"]').value = categoryId;
            document.querySelector('textarea[name="product_description"]').value = description;


            // log all
            console.log(productId);
            console.log(productName);
            console.log(price);
            console.log(discount);
            console.log(size);
            console.log(color);
            console.log(quantity);
            console.log(categoryId);
            console.log(description);
            console.log(listImage);
        }
    })
</script>