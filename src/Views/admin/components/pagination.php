<!-- PAGINATION -->
<select name="select" data-limit="<?=$_GET['limit']?>" <?=isset($_GET['filter'])?"data-filter=".$_GET['filter']:''?>  class="form-control form-control-info product_select" onchange="limitSelect(this)" id="limit_select">
    <option value="<?=$numberOfAllProducts?>">Tất cả</option>
    <option value="10">10</option>
    <option value="20">20</option>
    <option value="50">50</option>
</select>
<div class="jqpagination m-b-10 pagination ms-2">
    <!-- First -->
    <a href="?page=1&limit=<?php
        echo $_GET['limit'];
        if(isset($_GET['filter'])) echo "&filter=".$_GET['filter'];
        if(isset($_GET['order'])) echo "&order=".$_GET['order'];
    ?>" 
        class="first <?= $_GET['page'] == 1 ? 'disabled' : '' ?>" data-action="first">«</a>
    <!-- Previous -->
    <a href="?page=<?= $_GET['page'] == 1 ? 1 : $_GET['page'] - 1 ?>&limit=<?php
        echo $_GET['limit'];
        if(isset($_GET['filter'])) echo "&filter=".$_GET['filter'];
        if(isset($_GET['order'])) echo "&order=".$_GET['order'];
    ?>" 
        class="previous <?= $_GET['page'] == 1 ? 'disabled' : '' ?>" data-action="previous">‹</a>

    <!-- Input -->
    <input type="text"
        class="m-t-5" value="<?= $_GET['page'] ?>/<?= $numberOfPage ?>" disabled>

    <!-- Next -->
    <a href="?page=<?= $_GET['page'] < $numberOfPage ? $_GET['page'] + 1 : $numberOfPage ?>&limit=<?php
        echo $_GET['limit'];
        if(isset($_GET['filter'])) echo "&filter=".$_GET['filter'];
        if(isset($_GET['order'])) echo "&order=".$_GET['order'];
    ?>" 
        class="next <?= $_GET['page'] == $numberOfPage ? 'disabled' : '' ?>" data-action="next">›</a>
    <!-- Last -->
    <a href="?page=<?= $numberOfPage ?>&limit=<?php
        echo $_GET['limit'];
        if(isset($_GET['filter'])) echo "&filter=".$_GET['filter'];
        if(isset($_GET['order'])) echo "&order=".$_GET['order'];
    ?>" 
        class="last <?= $_GET['page'] == $numberOfPage ? 'disabled' : '' ?>" data-action="last">»</a>
</div>

<script>
    function limitSelect(e) {
        let limit = e.value;
        let page = 1;
        if (limit == "all") {
            page = "1";
            limit = "<?= $numberOfAllProducts ?>";
        }
        let filter = e.dataset.filter;
        if (filter) window.location.href = `?page=${page}&limit=${limit}&filter=${filter}<?=isset($_GET['order'])?"&order=".$_GET['order']:''?>`;
        else window.location.href = `?page=${page}&limit=${limit}<?=isset($_GET['order'])?"&order=".$_GET['order']:''?>`;
    }
    document.querySelector('#limit_select option[value="<?= $_GET['limit'] ?>"]').selected = true
</script>