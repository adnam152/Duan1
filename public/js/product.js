function updateDetail(button) {
    // ajax
    const xhr = new XMLHttpRequest();
    const form = button.closest('form');
    const formData = new FormData(form);
    const productId = button.dataset.productId;
    const detailId = button.dataset.detailId;
    formData.append('update', '');
    formData.append('detail_id', detailId);
    formData.append('product_id', productId);
    xhr.open('POST', location.origin + '/api/product');
    xhr.send(formData);
    xhr.onload = function () {
        if (xhr.status == 200) {
            const res = xhr.responseText;
            const data = JSON.parse(res);
            if (res == 'error') return;
            console.log(data);
            document.querySelector('button.btn-close').click();

            const tr_detail = document.querySelector('tr[data-detail-id="' + detailId + '"]');
            tr_detail.querySelector('td[data-price]').innerHTML = formatPrice(data.price);
            tr_detail.querySelector('td[data-price]').setAttribute('data-price', data.price);
            tr_detail.querySelector('td[data-size]').innerHTML = data.size;
            tr_detail.querySelector('td[data-size]').setAttribute('data-size', data.size);
            tr_detail.querySelector('td[data-color]').innerHTML = data.color;
            tr_detail.querySelector('td[data-color]').setAttribute('data-color', data.color);
            tr_detail.querySelector('td[data-quantity]').innerHTML = data.quantity;
            tr_detail.querySelector('td[data-quantity]').setAttribute('data-quantity', data.quantity);
            document.querySelector('tr[data-product-id="' + productId + '"] > td[data-category-id]').innerHTML = data.category_name;
            document.querySelector('tr[data-product-id="' + productId + '"] > td[data-category-id]').setAttribute('data-category-id', data.category_id);
            document.querySelector('tr[data-product-id="' + productId + '"] > td[data-discount]').innerHTML = data.discount + '%';
            document.querySelector('tr[data-product-id="' + productId + '"] > td[data-discount]').setAttribute('data-discount', data.discount);
            document.querySelector('tr[data-product-id="' + productId + '"] > td[data-product-name]').innerHTML = data.name;
            document.querySelector('tr[data-product-id="' + productId + '"] > td[data-product-name]').setAttribute('data-product-name', data.name);
            document.querySelector('#description-' + productId).innerHTML = data.description;

            setTotalQuantity(productId);
        }
    }
}

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
});

// Xử lý các action (Thêm, Sửa, Xóa)
document.querySelector('button[name="add_btn"]').addEventListener('click', () => {
    document.querySelector('button[name="add"]').hidden = false;
    document.querySelector('button[name="update"]').hidden = true;
    document.querySelector('.modal-title').innerHTML = "Thêm";
    document.querySelector('input[name="product_image[]"]').closest('.input-group').style.display = 'flex';
    document.querySelector('button[name="reset_btn"]').click();
});

function openUpdateModal(button) {
    document.querySelector('button[name="add_btn"]').click();
    document.querySelector('button[name="add"]').hidden = true;
    document.querySelector('button[name="update"]').hidden = false;
    document.querySelector('.modal-title').innerHTML = "Sửa";

    const this_table = button.closest('table');
    const dataAccordion = this_table.closest('tr').dataset.accordionShow;
    const main_tr = document.querySelector(`tr[data-accordion="${dataAccordion}"]`);
    const this_tr = button.closest('tr');

    const productId = main_tr.dataset.productId;
    const detailId = this_tr.dataset.detailId;
    const productName = main_tr.querySelector('td[data-product-name]').dataset.productName;
    const price = this_tr.querySelector('td[data-price]').dataset.price;
    const discount = main_tr.querySelector('td[data-discount]').dataset.discount;
    const size = this_tr.querySelector('td[data-size]').dataset.size;
    const color = this_tr.querySelector('td[data-color]').dataset.color;
    const quantity = this_tr.querySelector('td[data-quantity]').dataset.quantity;
    const categoryId = main_tr.querySelector('td[data-category-id]').dataset.categoryId;
    const description = document.querySelector('#description-' + productId).innerText;

    // set value
    document.querySelector('input[name="product_name"]').value = productName;
    document.querySelector('input[name="product_price"]').value = price;
    document.querySelector('input[name="product_discount"]').value = discount;
    document.querySelector('input[name="product_size"]').value = size;
    document.querySelector('input[name="product_color"]').value = color;
    document.querySelector('input[name="product_quantity"]').value = quantity;
    document.querySelector('select[name="product_category"]').value = categoryId;
    document.querySelector('textarea[name="product_description"]').value = description;

    document.querySelector('button[name="update"]').setAttribute('data-product-id', productId);
    document.querySelector('button[name="update"]').setAttribute('data-detail-id', detailId);
    document.querySelector('button[name="update"]').hidden = false;
    document.querySelector('button[name="add"]').hidden = true;
    document.querySelector('.modal-title').innerHTML = "Sửa";
    document.querySelector('input[name="product_image[]"]').closest('.input-group').style.display = 'none';
}



function deleteProduct(button) {
    if (confirm("Xác nhận xóa?")) {
        ajaxRequest(location.origin + '/api/product?delete=&product_id=' + button.closest('tr').dataset.productId, 'GET')
            .then(res => {
                if (res == 'success') {
                    const accordionKey = button.closest('tr').dataset.accordion;
                    document.querySelector(`tr[data-accordion-show="${accordionKey}"]`).remove();
                    button.closest('tr').remove();
                }
            })
    }
}

function deleteDetail(button) {
    const productId = button.closest('table').dataset.productId;
    const detailId = button.closest('tr').dataset.detailId;
    const url = location.origin + '/api/product?delete_detail=&detail_id=' + detailId;
    if (confirm("Xác nhận xóa?")) {
        ajaxRequest(url, 'GET')
            .then(res => {
                if (res == 'success') {
                    button.closest('tr').remove();
                    setTotalQuantity(productId);
                }
            })
    }
}

// Delete Image
function deleteImage(button) {
    if (confirm("Xác nhận xóa?")) {
        ajaxRequest(location.origin + '/api/product?delete_img=&img_id=' + button.dataset.imageId, 'GET')
            .then(res => {
                if (res == 'success') {
                    button.closest('div.position-relative').remove();
                }
            })
    }

}

// Add Image
function addImage(input) {
    // ajax
    const formData = new FormData();
    const productId = input.dataset.productId;
    const images = input.files;
    formData.append('product_id', productId);
    formData.append('post_img', '');

    for (const image of images) {
        formData.append('add_img[]', image);
    }
    ajaxRequest(location.origin + '/api/product', 'POST', formData)
        .then(res => {
            if (res == 'error') return;
            const imgContainer = input.closest('.card-block').querySelector('#image-container');
            for (const image of res) {
                const html = `
            <div class='position-relative'>
                <img data-image='${image.link}' src='${image.link}' alt='' class='m-2 img-sm'>
                <button name='delete_img_btn' class='x-btn' data-image-id='${image.id}' onclick='deleteImage(this)'>x</button>
            </div>`;
                imgContainer.innerHTML += html;
            }
        })
}


// Support Method
function setTotalQuantity(productId) {
    var count = 0;
    const tr = document.querySelector('tr[data-product-id="' + productId + '"]');
    console.log(tr);
    tr.parentElement.querySelector('table[data-product-id="' + productId + '"]').querySelectorAll('td[data-quantity]').forEach(td => {
        count += parseInt(td.dataset.quantity);
    })
    document.querySelector('#total-' + productId).innerHTML = count;
}
