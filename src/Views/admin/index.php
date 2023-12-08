<div class="container" style="width: 100%">
    <canvas id="myChart"></canvas>
</div>
<div class="container mb-3">
    <div class="row mt-2">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header pb-0 text-danger fw-bolder">Top sản phẩm mới nhất</h5>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        foreach ($newProducts as $newProduct) {
                        ?>
                            <a class="mb-2" href="/detail?id=<?php echo $newProduct['id'] ?>">
                                <li class="list-group-item">
                                    <?php echo $newProduct['name'] ?>
                                    <span class="text-danger fw-bolder">(<?php echo $newProduct['create_at'] ?>)</span>
                                </li>
                            </a>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header pb-0 text-danger fw-bolder">Top sản phẩm có view cao nhất</h5>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        foreach ($viewProducts as $viewProduct) {
                        ?>
                            <a class="mb-2" href="/detail?id=<?php echo $viewProduct['id'] ?>">
                                <li class="list-group-item">
                                    <?php echo $viewProduct['name'] ?>
                                    <span class="text-danger fw-bolder">(<?php echo $viewProduct['view'] ?>)</span>
                                </li>
                            </a>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header pb-0 text-danger fw-bolder">Top sản phẩm bán chạy nhất</h5>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        foreach ($purchaseProducts as $purchaseProduct) {
                        ?>
                            <a class="mb-2" href="/detail?id=<?php echo $purchaseProduct['id'] ?>">
                                <li class="list-group-item">
                                    <?php echo $purchaseProduct['name'] ?>
                                    <span class="text-danger fw-bolder">(<?php echo $purchaseProduct['purchase'] ?>)</span>
                                </li>
                            </a>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header pb-0 text-danger fw-bolder">Đơn hàng mới nhất</h5>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        foreach ($orders as $order) {
                        ?>
                            <li class="list-group-item mb-2">
                                <?= $order['phone_number'].' - ' . $order['fullname'] ?>
                                <span class="text-danger fw-bolder">(<?= $order['create_at'] ?>)</span>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div class="card">
                <h5 class="card-header pb-0 text-danger fw-bolder">Bình luận mới nhất</h5>
                <div class="card-body">
                    <ul class="list-group">
                        <?php
                        foreach ($comments as $comment) {
                        ?>
                            <a class="mb-2" href="/detail?id=<?php echo $comment['product_id'] ?>">
                                <li class="list-group-item">
                                    <div class="row col-md-7">
                                        <div class="col-md-1"><img src="<?php echo $comment['image'] ?>" class="avatar" alt=""></div>
                                        <span class="col">
                                            <span class="fw-bolder">
                                                <span class="text-primary"><?php echo $comment['username'] ?></span>
                                                <span class="text-danger ">(<?php echo $comment['create_at'] ?>)</span>
                                            </span>
                                            <div class="fw-semibold fs-7"><?php echo $comment['fullname'] ?></div>
                                        </span>
                                    </div>
                                    <!-- CMT Content -->
                                    <p class="comment-content mt-2 col ms-5 mb-0"><?php echo $comment['content'] ?></p>
                                </li>
                            </a>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('myChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels, JSON_UNESCAPED_UNICODE) ?>,
            datasets: [{
                label: 'Thống kê tổng sản phẩm theo danh mục',
                data: <?php echo json_encode($datas, JSON_UNESCAPED_UNICODE) ?>,
                borderWidth: 1,
                backgroundColor: ['orange', '#000080', '#00FF00', '#EE0000']
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>