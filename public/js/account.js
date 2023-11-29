function addAccount(button) {
    const formData = new FormData(button.closest('form'));
    formData.append('add', '');
    ajaxRequest("/api/account", "POST", formData)
        .then(res => {
            if (res == "error") {
                alert("Tài khoản đã tồn tại!");
                return;
            }
            if (res == "success") {
                location.reload();
            }
        })
}
function updateAccount(button) {
    const formData = new FormData(button.closest('form'));
    formData.append('update', '');
    formData.append('id', button.value);

    ajaxRequest("/api/account", "POST", formData)
        .then(res => {
            if (res == "exist username") {
                alert("Tên tài khoản đã tồn tại!");
                return;
            }
            const tr = document.querySelector(`td[data-id="${button.value}"]`).closest('tr');
            const tdUsername = tr.querySelector('td[data-username]');
            const tdPassword = tr.querySelector('td[data-password]');
            const tdRole = tr.querySelector('td[data-role]');
            const tdShow = document.querySelector(`td[data-accordion-show="${tr.dataset.accordion}"]`);
            const divEmail = tdShow.querySelector('div[data-email]');
            const divPhoneNumber = tdShow.querySelector('div[data-phone-number]');
            const divAddress = tdShow.querySelector('div[data-address]');
            const divFullname = tdShow.querySelector('div[data-fullname]');
            tdUsername.dataset.username = formData.get('username');
            tdPassword.dataset.password = formData.get('password');
            tdRole.dataset.role = formData.get('role');
            tdUsername.innerHTML = formData.get('username');
            tdPassword.innerHTML = formData.get('password');
            tdRole.innerHTML = formData.get('role') == 1 ? 'Quản trị viên' : 'Người dùng';
            divEmail.dataset.email = formData.get('email');
            divPhoneNumber.dataset.phoneNumber = formData.get('phone_number');
            divAddress.dataset.address = formData.get('address');
            divFullname.dataset.fullname = formData.get('fullname');
            divEmail.innerHTML = "Email: " + formData.get('email');
            divPhoneNumber.innerHTML = "Số điện thoại: " + formData.get('phone_number');
            divAddress.innerHTML = "Địa chỉ: " + formData.get('address');
            divFullname.innerHTML = "Họ tên: " + formData.get('fullname');

            document.querySelector('.btn-close').click();
        })
}
function confirmDelete(button) {
    if (confirm("Bạn có chắc chắn muốn xóa không?")) {
        const accountId = button.value;
        ajaxRequest("/api/account?delete=" + accountId, "GET")
            .then(res => {
                if (res == "success") {
                    const this_tr = button.closest('tr');
                    const dataAccordion = this_tr.dataset.accordion;
                    document.querySelector(`td[data-accordion-show="${dataAccordion}"]`).closest('tr').remove();
                    this_tr.remove();
                }
            })
    }
};

function updateImage(btn) {
    const input = btn.parentElement.querySelector('input[name="image"]');
    const id = input.dataset.userId;
    input.click();
    input.onchange = function () {
        const formData = new FormData();
        formData.append('image', input.files[0]);
        formData.append('id', id);
        formData.append('update_image', '');
        ajaxRequest('/api/account', "POST", formData)
            .then(res => {
                const link = res.image;
                btn.src = link;
            })
    }
}

// ----------------------------------------------------------------------

(() => {
    document.querySelector('button[name="add_btn"]').addEventListener('click', () => {
        const modal = document.querySelector('.modal');
        const modalTitle = modal.querySelector('.modal-title');
        modalTitle.innerHTML = "Thêm";
        modal.querySelector('button[name="update"]').hidden = true;
        modal.querySelector('button[name="add"]').hidden = false;
        modal.querySelector('button[type="reset"]').click();
        if (!document.querySelector('#modal-image'))
            modal.querySelector('.modal-body').innerHTML += `
                    <div class="mb-2 input-group input-group-button" id="modal-image">
                        <div class="input-group-prepend">
                            <button disabled class="btn btn-light" type="button">Ảnh</button>
                        </div>
                        <input type="file" name="user_image" class="form-control" accept="image/*">
                    </div>
            `

    })
})();

function openModal(btn) {
    document.querySelector("button[name='add_btn']").click();
    //sửa thông tin modal
    const tr = btn.closest('tr');
    const dataAccordion = tr.dataset.accordion;
    const tdShow = document.querySelector(`td[data-accordion-show="${dataAccordion}"]`);
    const modal = document.querySelector('.modal');
    const modalTitle = modal.querySelector('.modal-title');
    const modalSelect = modal.querySelector('select');
    const modalImage = modal.querySelector('img');
    const id = tr.querySelector('td[data-id]').dataset.id;
    modalTitle.innerHTML = "Sửa";
    modal.querySelector('button[name="update"]').hidden = false;
    modal.querySelector('button[name="update"]').value = id;
    modal.querySelector('button[name="add"]').hidden = true;
    document.getElementById('modal-image')?.remove();

    modal.querySelector('input[name="username"]').value = tr.querySelector('td[data-username]').dataset.username;
    modal.querySelector('input[name="password"]').value = tr.querySelector('td[data-password]').dataset.password;
    modal.querySelector('input[name="email"]').value = tdShow.querySelector('div[data-email]').dataset.email;
    modal.querySelector('input[name="phone_number"]').value = tdShow.querySelector('div[data-phone-number]').dataset.phoneNumber;
    modal.querySelector('input[name="address"]').value = tdShow.querySelector('div[data-address]').dataset.address;
    modal.querySelector('input[name="fullname"]').value = tdShow.querySelector('div[data-fullname]').dataset.fullname;
    modalSelect.value = tr.querySelector('td[data-role]').dataset.role;
}

document.querySelectorAll('tr[data-accordion]').forEach(tr => {
    tr.addEventListener('click', (e) => {
        if (e.target.nodeName != "BUTTON") {
            const accordion = tr.dataset.accordion;
            const tdShow = document.querySelector(`td[data-accordion-show="${accordion}"]`);
            tdShow.classList.toggle('show');
        }
    })
})