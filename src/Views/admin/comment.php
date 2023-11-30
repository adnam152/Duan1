<div class="d-flex justify-content-between">
    <div></div>
    <div class="d-flex">
        <?php require "src/Views/admin/components/filter.php" ?>
        <?php require "src/Views/admin/components/pagination.php" ?>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên sản phẩm</th>
            <th scope="col">Tài khoản</th>
            <th scope="col">Nội dung</th>
            <th scope="col">Thời gian</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($allComment as $index => $comment) {
        ?>
            <tr>
                <th scope="row"><?= $index + 1 ?></th>
                <td><?= $comment['product_name'] ?></td>
                <td><?= $comment['username'] ?></td>
                <td><?= $comment['content'] ?></td>
                <td><?= $comment['create_at'] ?></td>
                <td>
                    <button type="button" name="delete" value="<?= $comment['id'] ?>" class="btn btn-danger" onclick="confirmDelete(this)"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<script>
    function confirmDelete(btn){
        if(confirm("Bạn có chắc chắn muốn xóa bình luận này?")){
            let id = btn.value;
            ajaxRequest("/api/comment?delete&id="+id,"GET")
                .then(res =>{
                    if(res == "success")
                        btn.closest("tr").remove();
                    else
                        alert("Xóa thất bại");
                })
        }
    }
</script>