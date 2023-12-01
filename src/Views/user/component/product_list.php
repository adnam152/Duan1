<div class="container mt-5">

      <div class="row">
     
       <form method="get">
    <label for="categoryFilter">Select a category:</label>
    <select name="category_id" id="categoryFilter" onchange="this.form.submit()">
        <option value="">All Categories</option>
        <?php foreach ($allCategory as $category): ?>
            <option value="<?= $category['id'] ?>" <?= ($selectedCategoryId == $category['id']) ? 'selected' : '' ?>>
                <?= $category['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

            <div class="col-md-9">
                  <h2 class="mb-4">Danh sách sản phẩm</h2>
                  <div class=" row">
                        <?php
                        foreach ($allProducts as  $product) :   
?>
                              <div class="col-md-4 mb-4">
                                    <div class="card">
                                       
                                          <?php
                                          if ($product['image']) {
                                                foreach ($product['image'] as $id => $image) {
                                                      $firstImage = $product['image'] ? reset($product['image']) : null;
                                                      if ($firstImage) {
                                                            echo "<div class='card-img-top '>";
                                                            echo "<img src='$firstImage' class='card-img-top ' alt='Product Image'> ";
                                                            echo "</div>";
                                                      }
                                                }
                                          }
                                          ?>
                                          <?php
                                          foreach ($product["detail"] as $detail) {
                                                $originalPrice = $detail['price'];
                                                $discountPercentage = $product['discount'];
                                                // Calculate the discounted price
                                                $discountedPrice = $originalPrice - ($originalPrice * $discountPercentage / 100);
                                          ?>
                                                <div class="card-body text-center">
                                                      <td data-price="<?= $discountedPrice ?>"><?= number_format($discountedPrice) ?> đ</td>
                                                      <h5 class="card-title"><?= $product['name'] ?></h5>
                                                      <h5 class="fas fa-eye" class="card-title"><?= $product['view'] ?> đã xem  </h5>

                                                </div>
                                                
                                          <?php
                                          }
                                          ?>

                                    </div>
                              </div>
                        <?php endforeach; ?>
                  </div>
            </div>
      </div>
</div>