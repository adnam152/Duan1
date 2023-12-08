function addCategory(button) {
    const formData = new FormData(button.closest('form'));
    formData.append("add_category", "");
    const url = location.origin + "/api/category";
    ajaxRequest(url, "POST", formData)
        .then(res => {
            if (res == "error") return;
            const tbody = document.querySelector("tbody");
            const html = `
            <tr class="table-success" data-category-name="${res.name}" data-category-id="${res.id}">
                <td>${res.id}</td>
                <td name='category_name'>${res.name}</td>
                <td>
                    <button type="button" class="btn btn-primary" onclick="openUpdateModal(this)"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger" onclick="confirmDelete(this)"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
            `
            tbody.innerHTML += html;
            document.querySelector('.btn-close').click();
        })
}

function confirmDelete(button) {
    if (confirm("Bạn có chắc chắn muốn xóa không?")) {
        const categoryId = button.closest('tr').getAttribute("data-category-id");
        const url = location.origin + "/api/category?delete=&category_id=" + categoryId;
        ajaxRequest(url, "GET")
            .then(res => {
                if (res == "error") return;
                button.closest('tr').remove();
            })
    }
}

function openUpdateModal(button) {
    document.querySelector("button[name='add_btn']").click();
    //sửa thông tin modal
    document.querySelector("#exampleModalLabel").innerHTML = "Sửa";
    document.querySelector("#category").value = button.closest('tr').getAttribute("data-category-name");
    document.querySelector("button[name='add']").hidden = true;
    document.querySelector("button[name='update']").hidden = false;
    document.querySelector("button[name='update']").value = button.closest('tr').getAttribute("data-category-id");
}

function updateCategory(button) {
    const formData = new FormData(button.closest('form'));
    const categoryId = document.querySelector("button[name='update']").value;
    formData.append("category_id", categoryId);
    formData.append("update", "");
    const url = location.origin + "/api/category";

    ajaxRequest(url, "POST", formData)
        .then(res => {
            if (res == "error") return;
            const tr = document.querySelector(`tr[data-category-id="${categoryId}"]`);
            tr.setAttribute("data-category-name", res.name);
            tr.querySelector("td[name='category_name']").innerHTML = res.name;
            document.querySelector('.btn-close').click();
        })
}

window.addEventListener('load', function () {
    //xử lý nút add_btn
    document.querySelector("button[name='add_btn']").addEventListener('click', function () {
        document.querySelector("#exampleModalLabel").innerHTML = "Thêm";
        document.querySelector("#category").value = "";
        document.querySelector("button[name='add']").hidden = false;
        document.querySelector("button[name='update']").hidden = true;
    })
})