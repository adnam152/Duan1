<select name="select" class="form-control form-control-info product_select" onchange="filterSelect(this)" id="filter_select">
    <option value="">Sắp xếp theo</option>
    <?php 
    if(isset($filter)){
        foreach($filter as $key => $value){
            ?>
                <option value="<?=$key?>"><?=$value?></option>
            <?php
        }
    }
    
    ?>
</select>
<select class="form-control form-control-info product_select" onchange="orderSelect(this)" id="order_select">
    <option value="ASC">Tăng dần</option>
    <option value="DESC">Giảm dần</option>
</select>
<script>
    function filterSelect(e) {
        let filter = e.value;
        if(filter) window.location.href = `?page=<?=$_GET['page']?>&limit=<?= $_GET['limit'] ?>&filter=${filter}<?=isset($_GET['order'])?"&order=".$_GET['order']:''?>`;
        else window.location.href = `?page=<?=$_GET['page']?>&limit=<?= $_GET['limit'] ?><?=isset($_GET['order'])?"&order=".$_GET['order']:''?>`;
    }
    function orderSelect(e) {
        let order = e.value;
        if(order) window.location.href = `?page=<?=$_GET['page']?>&limit=<?= $_GET['limit'] ?>&order=${order}<?=isset($_GET['filter'])?"&filter=".$_GET['filter']:''?>`;
        else window.location.href = `?page=<?=$_GET['page']?>&limit=<?= $_GET['limit'] ?><?=isset($_GET['filter'])?"&filter=".$_GET['filter']:''?>`;
    }

    document.querySelector('#order_select option[value="<?= $_GET['order'] ?? 'DESC' ?>"]').selected = true
    document.querySelector('#filter_select option[value="<?= $_GET['filter'] ?? '' ?>"]').selected = true
</script>