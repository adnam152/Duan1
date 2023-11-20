<div class="container">
    <button type="button" name="add_btn" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Thêm
    </button>
    <table class="table">
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
                <tr data-product-id="<?= $product['id'] ?>" data-accordion="<?=$key?>">
                    <td><?= $stt++ ?></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['category'] ?></td>
                    <td><?= $product['discount'] ?></td>
                    <td><?= $product['view'] ?></td>
                    <td><?= $product['purchase'] ?></td>
                    <td><?= $product['count'] ?></td>
                    <td>
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-danger">delete</button>
                    </td>
                </tr>
                <tr data-accordion-show="<?=$key?>">
                    <td colspan="8" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div>
                            <div class="card accordion-body p-3">
                                <?php 
                                foreach($product['image'] as $link){
                                    echo "<img src='.$link' alt='' height='100px' width='100px'>";
                                }
                                ?>
                            </div>
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
                    <div class="mb-2">
                        <input type="text" name="product_name" class="form-control" placeholder="Tên Sản Phẩm">
                    </div>
                    <div class="mb-2">
                        <input type="number" name="product_price" class="form-control" placeholder="Giá">
                    </div>
                    <div class="mb-2">
                        <input type="number" name="product_discount" class="form-control" placeholder="Giảm Giá">
                    </div>
                    <div class="mb-2">
                        <input type="number" name="product_size" class="form-control" placeholder="Size">
                    </div>
                    <div class="mb-2">
                        <input type="text" name="product_color" class="form-control" placeholder="Màu">
                    </div>
                    <div class="mb-2">
                        <input type="number" name="product_quantity" class="form-control" placeholder="Số lượng">
                    </div>
                    <div class="mb-2">
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
                    <div class="mb-2">
                        <textarea name="product_description" class="form-control" aria-label="With textarea" placeholder="Mô tả"></textarea>
                    </div>
                    <div class="mb-2">
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
    const trs = document.querySelectorAll('tr[data-accordion]');
    trs.forEach(tr => {
        tr.addEventListener('click', () => {
            const accordion = tr.dataset.accordion;
            const tdShow = document.querySelector(`tr[data-accordion-show="${accordion}"] >td`);
            tdShow.classList.toggle('show');
        })
        tr.addEventListener('mouseover', ()=>{
            // pointer
            tr.style.cursor = 'pointer';
        })
    })

</script>