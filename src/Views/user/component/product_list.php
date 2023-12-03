<div class="container mt-5">

      <div class="row">          
   <?php  include("menu_right.php") ?>
            <div class="col-md-9">
                  <h2 class="mb-4">Danh sách sản phẩm</h2>
                  <div class=" row">
                        <?php
                        $displayedProductIds = [];
                        foreach ($allProducts as  $product) :
                              
                              // if (!in_array($product['id'], $displayedProductIds)) :
                              //       $displayedProductIds[] = $product['id']; 
                        ?>
                              <div class="col-md-4 mb-4">
                                    <div class="card">
 
                                   
                                          <?php
                                           $imageDisplayed = false;

                                          if ($product['image']) {
                                                foreach ($product['image'] as $id => $image) {
                                                      $firstImage = $product['image'] ? reset($product['image']) : null;
                                                      if ($firstImage && !$imageDisplayed) {
                                                          echo "<div class='card-img-top '>";
                                                          echo "<img src='$firstImage' class='card-img-top ' alt='Product Image'> ";
                                                          echo "</div>";
                                                          $imageDisplayed = true;
                                                      }
                                                }
                                          }
                                          ?>
                                          <?php
                                             $originalPrice = null;
                                             $discountedPrice = null;
                                          foreach ($product["detail"] as $detail) {
                                                $originalPrice = $detail['price'];
                                                $discountPercentage = $product['discount'];
                                             
                                                $discountedPrice = $originalPrice - ($originalPrice * $discountPercentage / 100);
                                                if ($originalPrice !== null && $discountedPrice !== null) {
                                          ?>
                                                <div class="card-body text-center">
                                                      <td data-price="<?= $discountedPrice ?>"><?= number_format($discountedPrice) ?> đ</td>
                                                      <h5 class="card-title"><?= $product['name'] ?></h5>
                                                      <h5 class="fas fa-eye" class="card-title"><?= $product['view'] ?> đã xem </h5>

                                                </div>
                                                <?php
                   
                                                      break;
                                                }
                                                
                                                ?>

                                          <?php
                                          }
                                          ?>

                                    </div>
                              </div>
                  
                  <?php
                  // endif; 
                  endforeach; ?>
                  </div>
            </div>
      </div>
</div>