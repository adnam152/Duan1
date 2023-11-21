// Xử lý table
const trs = document.querySelectorAll('tr[data-accordion]');
trs.forEach(tr => {
    tr.addEventListener('click', (e) => {
        if (e.target.nodeName != "BUTTON") {
            const accordion = tr.dataset.accordion;
            const tdShow = document.querySelector(`tr[data-accordion-show="${accordion}"] >td`);
            tdShow.classList.toggle('show');
        }
    })
    tr.addEventListener('mouseover', () => {
        tr.style.cursor = 'pointer';
    })
})

// Xử lý các action (Thêm, Sửa, Xóa)
const addBtn = document.querySelector('button[name="add_btn"]');
const updateBtns = document.querySelectorAll('button[name="update_btn"]');
const deleteBtn = document.querySelectorAll('button[name="delete_btn"]');
const deleteDetailBtn = document.querySelectorAll('button[name="delete_detail_btn"]');
const resetBtn = document.querySelector('button[name="reset_btn"]');
const add = document.querySelector('button[name="add"]');
const update = document.querySelector('button[name="update"]');
const modalTitle = document.querySelector('.modal-title');
const formImageGroup = document.querySelector('input[name="product_image[]"]').closest('.input-group');

// add btn
addBtn.onclick = function () {
    resetBtn.click();
    add.hidden = false;
    update.hidden = true;
    modalTitle.innerHTML = "Thêm";
    formImageGroup.style.display = 'flex';
}

// update btn
updateBtns.forEach(btn => {
    btn.onclick = function () {
        addBtn.click();
        add.hidden = true;
        update.hidden = false;
        modalTitle.innerHTML = "Sửa";

        const this_table = btn.closest('table');
        const dataAccordion = this_table.closest('tr').dataset.accordionShow;
        const main_tr = document.querySelector(`tr[data-accordion="${dataAccordion}"]`);
        const this_tr = btn.closest('tr');

        const productId = main_tr.dataset.productId;
        const productName = main_tr.querySelector('td[data-product-name]').dataset.productName;
        const price = this_tr.querySelector('td[data-price]').dataset.price;
        const discount = main_tr.querySelector('td[data-discount]').dataset.discount;
        const size = this_tr.querySelector('td[data-size]').dataset.size;
        const color = this_tr.querySelector('td[data-color]').dataset.color;
        const quantity = this_tr.querySelector('td[data-quantity]').dataset.quantity;
        const categoryId = main_tr.querySelector('td[data-category-id]').dataset.categoryId;
        const description = document.querySelector('#description').innerText;
        const detailId = this_tr.dataset.detailId;

        // set value
        document.querySelector('input[name="product_name"]').value = productName;
        document.querySelector('input[name="product_price"]').value = price;
        document.querySelector('input[name="product_discount"]').value = discount;
        document.querySelector('input[name="product_size"]').value = size;
        document.querySelector('input[name="product_color"]').value = color;
        document.querySelector('input[name="product_quantity"]').value = quantity;
        document.querySelector('select[name="product_category"]').value = categoryId;
        document.querySelector('textarea[name="product_description"]').value = description;

        document.querySelector('input[name="product_detail_id"]').value = detailId;
        document.querySelector('button[name="update"]').value = productId;
        formImageGroup.style.display = 'none';
    }
})

// delete btn
deleteBtn.forEach(btn =>{
    btn.onclick = function(){
        const productId = btn.closest('tr').dataset.productId;
        const url = location.href + '?delete=&product_id=' + productId;
        if(confirm("Xác nhận xóa?")) location.href = url;
    }
})

// delete detail btn
deleteDetailBtn.forEach(btn =>{
    btn.onclick = function(){
        const productId = btn.closest('tr').dataset.productId;
        const detailId = btn.closest('tr').dataset.detailId;
        const url = location.href + '?delete_detail=&product_id=' + productId + '&detail_id=' + detailId;
        if(confirm("Xác nhận xóa?")) location.href = url;
    }
})
