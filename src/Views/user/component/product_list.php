<div class="container mt-5">
      <div class="row">
            <div class="col-md-3">
                  <!-- Cột danh mục bên trái -->
                  <div class="list-group">


                  </div>
            </div>

            <div class="col-md-9">
                  <h2 class="mb-4">Danh sách sản phẩm</h2>
                  <div class=" row">
                        <?php
                        foreach ($allProducts as  $product) : ?>
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
                                          <div class="card-body text-center">

                                                <p class="card-text"><?= $product['discount'] ?></p>
                                                <h5 class="card-title"><?= $product['name'] ?></h5>
                                          </div>
                                    </div>
                              </div>
                        <?php endforeach; ?>
                  </div>
            </div>
      </div>
</div>