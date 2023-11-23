<div class="container">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">san pham</th>
                <th scope="col">binh luan</th>
                <th scope="col">tai khoan</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($comments as  $index => $comment) {
                $index++;
                extract($comment);
                echo '<tr> 
                <td>' . $id . '</td>
                <td>' . $product_id . '</td>
                <td>' . $comment . '</td>
                <td>' . $account_id . '</td>
                <td>
                        <form action="" method="post">
                            <button type="submit" name="delete" value="'.$id.'" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                   
                </tr>'
            ?>
                 

            <?php
            }
            ?>

        </tbody>
    </table>
</div>