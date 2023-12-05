<style>
  * {
    /* box-shadow: 0 0 2px black; */
  }

  img.img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
  }
  .h-750 {
    height: 738px !important;
  }

  .h-50 {
    height: 50% !important;
  }
  .category .category-item {
    height: 100%;
    position: relative;
    color: white;
    overflow: hidden;
  }
  .category .category-item:hover .label-category{
    transform: translateX(111%);
  }
  .category .label-category {
    width: max-content;
    position: absolute;
    bottom: 8px;
    right: 100%;
    font-size: 17px;
    font-weight: 700;
    transition: 0.3s;
  }

  .endow.container i {
    font-size: 40px;
  }

  #content1 .bg-danger {
    height: 200px;
    box-shadow: 5px 10px 15px #959393;
  }

  #content1 .list-image .card {
    box-shadow: 5px 10px 15px #959393;
    transition: all 0.3s;
  }

  #content1 .list-image .card:hover {
    transform: scale(1.05);
  }

  #content1 .list-image .card img {
    height: 250px;
    object-fit: cover;
    object-position: center;
  }
  .rounded-2 {
    border-radius: 1.5rem;
  }
  .rounded-5{
    border-radius: 0.3rem;
  }
</style>

<!-- BANNER -->
<?php
require "src/Views/user/component/banner.php";
?>

<!-- MAIN -->
<div class="container mt-5">
  <div class="category">
    <div class="row">
      <div class="col">
        <div class="row h-50">
          <a href="/allproduct?category=3" class="col py-2 category-item">
            <img src="/assets/image/cong_so.jpeg" alt="" class="img rounded-2 img-1">
            <button class="label-category btn btn-primary rounded-5">Giày công sở</button>
          </a>
          <a href="/allproduct?category=4" class="col py-2 category-item">
            <img src="/assets/image/sneaker.jpg" alt="" class="img rounded-2 img-1">
            <button class="label-category btn btn-primary rounded-5">Giày Sneaker</button>
          </a>
        </div>
        <div class="row h-50">
          <a href="/allproduct?category=2" class="col py-2 category-item">
            <img src="/assets/image/thethao.jpg" alt="" class="img rounded-2 img-2">
            <button class="label-category btn btn-primary rounded-5">Giày thể thao</button>
          </a>
        </div>
      </div>
      <a href="/allproduct?category=4" class="col py-2 category-item">
        <img src="/assets/image/caogot.jpg" alt="" class="img rounded-2 img-3 h-750">
        <button class="label-category btn btn-primary rounded-5">Giày cao gót</button>
      </a>
    </div>
  </div>
</div>

<div class="container mt-4">
  <div class="endow container">
    <div class="row">
      <div class="col">
        <div class="row">
          <div class="col-3 d-flex align-items-center">
            <div class="text-danger">
              <i class="endow-fs fa-solid fa-truck-fast"></i>
            </div>
          </div>
          <div class="">
            Free Ship!
            <p class="text-danger mb-0">Trên toàn quốc</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="row">
          <div class="col-3 d-flex align-items-center">
            <div class=" text-danger">
              <i class="endow-fs fa-solid fa-sack-dollar"></i>
            </div>
          </div>
          <div class="">
            Hoàn tiền!
            <p class="text-danger mb-0">Lên đến 20%</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="row">
          <div class="col-3 d-flex align-items-center">
            <div class=" text-danger">
              <i class="endow-fs fa-solid fa-tag"></i>
            </div>
          </div>
          <div class="">
            Voucher!
            <p class="text-danger mb-0">Siêu ưu đãi</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="row">
          <div class="col-3 d-flex align-items-center">
            <div class="text-danger">
              <i class="endow-fs fa-brands fa-cc-visa"></i>
            </div>
          </div>
          <div class="">
            Thanh toán!
            <p class="text-danger mb-0">Online dễ dàng</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="my-5" id="content1">
  <div class="bg-danger"></div>
  <!-- TOP SELLER -->
  <h2 class="text-center fw-bolder my-5">Best Seller Products</h2>
  <div class="d-flex flex-wrap justify-content-between container list-image">
    <!-- js -->
  </div>
</div>

<!-- FOOTER -->
<?php require "src/Views/user/component/footer.php" ?>

<script>
  window.addEventListener('load', () => {
    renderListImage();
  })

  function renderListImage() {
    ajaxRequest('/api/topseller', "GET")
      .then(res => {
        if (Array.isArray(res) && res.length > 0) {
          res.forEach(product => {
            const html = `
            <div class="card" style="width: 16rem;">
              <img src="${product.image[0]}" class="card-img-top p-2"
                data-src1="${product.image[1]}"
                data-src0="${product.image[0]}"
              >
              <div class="card-body">
                <h5 class="card-title fw-bolder">${product.name}</h5>
                <p class="card-text">${product.description.substring(0,120)}...</p>
              </div>
              <div class="card-footer pt-0">
                <a href="/detail?id=${product.id}" class="btn btn-primary">Mua ngay</a>
              </div>
            </div>
            `
            document.querySelector('#content1 .list-image').innerHTML += html;
            const allCard = document.querySelectorAll('#content1 .list-image .card');
            allCard.forEach(card => {
              card.addEventListener('mouseover', () => {
                card.querySelector('img').src = card.querySelector('img').dataset.src1;
              })
              card.addEventListener('mouseout', () => {
                card.querySelector('img').src = card.querySelector('img').dataset.src0;
              })
            })
          })
        }
      })
  }
</script>