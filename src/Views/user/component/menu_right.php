<div class="col-md-3">
         <h2 class="mb-4">Danh muc</h2>
                  <div class="list-group">
                    <div class="card">
                        <?php
                        $categoryId = isset($_GET['category_id']) ? $_GET['$product_id'] : null;
                        foreach ($allCategory as $category) {
                              $linkdm = "index.php?act=category&iddm=" . $category['id'];
                              echo '<li>
                 <a href="' . $linkdm . '">' . $category['name'] . '</a>
           </li>';
                        }

                        ?>
                  </div>
            </div>
         
          </div>
          