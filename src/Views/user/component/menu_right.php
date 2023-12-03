<div class="col-md-3">
    <h2 class="mb-4">Danh muc</h2>
    <div class="list-group">
        <div class="card">
            <form method="get">
                  
                <select name="category_id" id="categoryFilter" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    <?php foreach ($allCategory as $category) :
                         ?>
                        <?php
                        $selectedCategoryId = ''; // Set this based on your logic to determine the selected category
                        ?>
                  
                        <option value="<?= $category['id'] ?>" <?= ($selectedCategoryId == $category['id']) ? 'selected' : '' ?>>
                            <?= $category['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
    </div>
</div>
      

            <?php
      //                   $categoryId = isset($_GET['category_id']) ? $_GET['$product_id'] : null;
      //                   foreach ($allCategory as $category) {
      //                         $linkdm = "index.php?act=category&iddm=" . $category['id'];
      //                         echo '<li>
      //            <a href="' . $linkdm . '">' . $category['name'] . '</a>
      //      </li>';
      //                   }

                        ?>