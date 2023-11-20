
<div class="container">
    <button type="button" name="add_btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Thêm
    </button>
    <table class="table text-center" >
        <thead>
            <tr>
                <th scope="col-3">STT</th>
                <th scope="col-5">Danh mục</th>
                <th scope="col-4">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($allCategory as $index => $category) {
                $index++;
            ?>
                <tr>
                    <td><?= $index ?></td>
                    <td data-category-name="<?= $category['name'] ?>" data-category-id="<?= $category['id'] ?>"><?= $category['name'] ?></td>
                    <td>
                        <form action="">
                            <button type="button" name="update_btn" class="btn btn-primary">Sửa</button>
                            <button type="button" name="delete" value="<?= $category['id'] ?>" class="btn btn-danger">Xóa</button>
                        </form>
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
                    <button type="submit" name="add" class="btn btn-primary">Thêm</button>
                    <button type="submit" name="update" value="" hidden class="btn btn-primary">Sửa</button>

                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Xác nhận xóa
    const deleteBtns = document.querySelectorAll('button[name="delete"]');
    deleteBtns.forEach(btn =>{
        btn.addEventListener('click', function(){
            if(confirm("Bạn có chắc chắn muốn xóa không?")){
                btn.type = "submit";
            }
        })
    })

    window.addEventListener('load', function() {
        const updateBtns = document.querySelectorAll("button[name='update_btn']");
        updateBtns.forEach(btn => {
            btn.onclick = function() {
                const addBtn = document.querySelector("button[name='add_btn']");
                addBtn.click();
                //sửa thông tin modal
                const title = document.querySelector("#exampleModalLabel");
                const categoryName = document.querySelector("#category");
                const add = document.querySelector("button[name='add']");
                const update = document.querySelector("button[name='update']");
                const name = btn.closest('tr').querySelector('td[data-category-name]').getAttribute("data-category-name");
                const id = btn.closest('tr').querySelector('td[data-category-id]').getAttribute("data-category-id");

                title.innerHTML = "Sửa";
                categoryName.value = name;
                add.hidden = true;
                update.value = id;
                update.hidden = false;
            }

        });

        //xử lý nút add
        const addBtn = document.querySelector("button[name='add_btn']");
        addBtn.addEventListener('click', function() {
            const title = document.querySelector("#exampleModalLabel");
            const categoryName = document.querySelector("#category");
            const add = document.querySelector("button[name='add']");
            const update = document.querySelector("button[name='update']");

            title.innerHTML = "Thêm";
            categoryName.value = "";
            add.hidden = false;
            update.hidden = true;
        })
    })
</script>