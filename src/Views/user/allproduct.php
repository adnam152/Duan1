<style>
    html{
        scroll-behavior: smooth;
    }
    .me-4 {
        margin-right: 1.5rem !important;
    }

    #filter-bar {
        width: 350px;
        height: max-content;
        position: sticky;
        top: 0;
    }

    .list-group-item {
        display: flex;
        align-items: center;
        border: none;
        padding: 0.25rem 0.5rem;
        user-select: none;
    }

    .container-product {
        width: 100%;
    }

    .container-product>.card-body {
        display: flex;
        flex-wrap: wrap;
    }

    .product-item.card {
        width: 16rem;
        transition: 0.25s;
    }

    .product-item.card:hover {
        scale: 1.05;
        box-shadow: 5px 10px 15px #959393;
        cursor: pointer;
    }

    .product-item.card img {
        width: 100%;
        height: 250px;
        object-fit: contain;
        object-position: center;
    }
</style>

<div class="position-relative d-flex p-3">
    <!-- FILTER BAR -->
    <div id="filter-bar" class="me-4 card">
        <div class="card-body">
            <!-- --------------------------------------------------- -->
            <!-- Danh Muc -->
            <h6 class="card-subtitle mb-2 text-muted">Danh Mục:</h6>
            <ul id="checkbox-category">
                <?php
                foreach ($allCategory as $index => $category) :
                ?>
                    <li class="list-group-item">
                        <input class="" type="checkbox" value="<?= $category['id'] ?>" id="checkbox-cate-<?= $index ?>" <?php if (isset($_GET['category']) && $_GET['category'] == $category['id']) echo "checked" ?>>
                        <label class="ms-2 form-check-label" for="checkbox-cate-<?= $index ?>"><?= $category['name'] ?></label>
                    </li>
                <?php endforeach; ?>
            </ul>

            <hr>
            <!-- Gía -->
            <h6 class="card-subtitle mb-2 text-muted">Giá:</h6>
            <ul id="radio-price">
                <?php foreach ($filterPrice as $index => $price) : ?>
                    <li class="list-group-item">
                        <input class="" type="radio" name="filter-price" value="<?= $index ?>" id="radio-price-<?= $index ?>">
                        <label class="ms-2 form-check-label" for="radio-price-<?= $index ?>"><?= $price ?></label>
                    </li>
                <?php endforeach; ?>
            </ul>

            <hr>
            <!-- Sắp xếp -->
            <h6 class="card-subtitle mb-2 text-muted">Sắp xếp theo:</h6>
            <ul id="radio-order-type">
                <?php foreach ($filterOrderType as $index => $orderType) : ?>
                    <li class="list-group-item">
                        <input class="" type="radio" name="filter-order-type" value="<?= $index ?>" id="radio-order-type-<?= $index ?>">
                        <label class="ms-2 form-check-label" for="radio-order-type-<?= $index ?>"><?= $orderType ?></label>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" onclick="filter()">Lọc</button>
            <button class="btn btn-secondary" onclick="resetFilter()">Reset</button>
        </div>
    </div>

    <!-- LIST PRODUCT -->
    <div class="container-product card">
        <div class="card-body">
            <!-- JS -->
        </div>
    </div>
</div>

<!-- FOOTER -->
<?php require "src/Views/user/component/footer.php" ?>

<script>
    function resetFilter() {
        const categoryElements = document.querySelectorAll('#checkbox-category input');
        categoryElements?.forEach(element => element.checked = false);
        const priceElement = document.querySelector('#radio-price input:checked');
        if(priceElement) priceElement.checked = false;
        const orderElement = document.querySelector('#radio-order-type input:checked');
        if(orderElement) orderElement.checked = false;
    }
    function filter() {
        const categoryElements = document.querySelectorAll('#checkbox-category input:checked');
        const priceElement = document.querySelector('#radio-price input:checked');
        const orderElement = document.querySelector('#radio-order-type input:checked');

        const category = Array.from(categoryElements).map(element => element.value);
        const price = priceElement ? priceElement.value : '';
        const minPrice = price ? price.split('-')[0] : '';
        const maxPrice = price ? price.split('-')[1] : '';
        const order = orderElement ? orderElement.value : '';
        const orderBy = order ? order.split('-')[0] : '';
        const orderType = order ? order.split('-')[1] : '';

        const formData = new FormData();
        category.forEach(cate => formData.append('category_id[]', cate));
        formData.append('min_price', minPrice);
        formData.append('max_price', maxPrice);
        formData.append('order_by', orderBy);
        formData.append('order_type', orderType);

        ajaxRequest('/api/filterproduct', 'POST', formData)
            .then(res => {
                if (res.length > 0) {
                    document.querySelector('.container-product .card-body').innerHTML = '';
                    renderList(res);
                } else {
                    document.querySelector('.container-product .card-body').innerHTML = '<h3 class="text-center">Không có sản phẩm nào</h3>';
                }
                window.scrollTo(0, 0);
            })

    }

    window.addEventListener('load', () => {
        const category = (new URLSearchParams(window.location.search)).get('category');
        let url = '/api/allproduct';
        if (category) url += `?category=${category}`;
        ajaxRequest(url, 'GET')
            .then(res => {
                renderList(res);
            })
        if(!category){
            const search = (new URLSearchParams(window.location.search)).get('search');
            if(search){
                ajaxRequest('/api/searchproduct?search='+search, 'GET')
                    .then(res => {
                        if(Array.isArray(res) && res.length > 0){
                            document.querySelector('.container-product .card-body').innerHTML = '';
                            renderList(res);
                        }
                        else{
                            document.querySelector('.container-product .card-body').innerHTML = '<h3 class="text-center">Không có sản phẩm nào</h3>';
                        }
                    })
            }
        }
    })

    function renderList(allProduct) {
        const listContainer = document.querySelector('.container-product .card-body');
        const html = allProduct.map(product => {
            return `
                <a href="/detail?id=${product.id}" class="text-decoration-none text-dark card product-item ms-3 p-2 position-relative">
                    ${product.discount > 0 ? `
                        <div class="position-absolute top-0 start-0">
                            <span class="badge bg-danger">${product.discount}%</span>
                        </div>` : ''
                    }
                    <img src="${product.media}" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title fw-bolder">${product.name}</h5>
                        <p class="card-text">${product.description.substring(0,120)}...</p>
                    </div>
                    <div class="card-footer">
                        <h6 class="text-danger">${product.min_price==product.max_price?formatPrice(product.min_price)+'đ':formatPrice(product.min_price)+'đ - ' + formatPrice(product.max_price)+'đ'}</h6>
                    </div>
                </a>
            `
        }).join('');
        listContainer.innerHTML += html;
    }
</script>