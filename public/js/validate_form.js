// Validate
const notEmpty = function () {
    return {
        errorMessage(value) {
            return value.trim() == '' ? 'Field cannot be empty' : undefined;
        }
    }
}
const minLength = function () {
    return {
        errorMessage(value) {
            return value.trim().length < 8 ? 'Min 8 chars' : undefined;
        }
    }
}
const isEmail = function () {
    const Regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return {
        errorMessage(value) {
            return Regex.test(value) ? undefined : 'Email invalid';
        }
    }
}
const confimPassword = function () {
    return {
        errorMessage(value) {
            const password = document.querySelector('#form-modal .register-area input[name="password"]').value;
            return value == password ? undefined : 'Password and Confirm Password do not match';
        }
    }
}

function validate([selector, key, rules]) {
    const errorBox = selector[key].parentElement.querySelector('.error');
    let isValidate = true;
    for (const rule of rules[key]) {
        const message = rule.errorMessage(selector[key].value);
        if (message) {
            errorBox.innerText = message;
            isValidate = false;
            break;
        } else errorBox.innerText = '';
    }
    return isValidate;
}
// ----------------------------------------------------------------
const formContainer = document.querySelector('#form-modal');

function openLoginModal() {
    formContainer.classList.add('show');
    document.querySelector('#modal-img').src = "https://res.cloudinary.com/dzkdgm4c7/image/upload/v1690888778/Workshop1/n2r71bndgsrttfgzmo6z.webp";
};

// Validate Login And Login
(() => {
    const loginBtn = document.querySelector('#form-modal #submit_login');
    const username = document.querySelector('#form-modal .login-area input[name="username"]');
    const password = document.querySelector('#form-modal .login-area input[name="password"]');
    const rules = {
        'username': [
            notEmpty(),
            minLength()
        ],
        'password': [
            notEmpty(),
            minLength()
        ]
    };
    const selector = {
        'username': username,
        'password': password
    };

    // oninput validate
    for (const key in selector) {
        selector[key].addEventListener('input', function () {
            validate([selector, key, rules]);
        })
    }
    // submit validate
    loginBtn.onclick = function (e) {
        e.preventDefault();
        let isValid = true;
        for (const key in selector) {
            let temp = validate([selector, key, rules]);
            if (!temp) isValid = false;
        }
        if (isValid) {
            const formData = new FormData();
            formData.append('username', username.value);
            formData.append('password', password.value);
            formData.append('login', '');

            ajaxRequest('/login', "POST", formData)
                .then(res => {
                    if (res == "success") location.reload();
                    else alert("Tên tài khoản hoặc mật khẩu không đúng");
                })
        }
        return false;
    }
})();

// Validate Register And Register
(() => {
    const registerBtn = document.querySelector('#form-modal #submit_register');
    const username = document.querySelector('#form-modal .register-area input[name="username"]');
    const email = document.querySelector('#form-modal .register-area input[name="email"]');
    const password = document.querySelector('#form-modal .register-area input[name="password"]');
    const rePassword = document.querySelector('#form-modal .register-area input[name="re-password"]');
    const rules = {
        'username': [
            notEmpty(),
            minLength()
        ],
        'email': [
            notEmpty(),
            isEmail()
        ],
        'password': [
            notEmpty(),
            minLength()
        ],
        'rePassword': [
            notEmpty(),
            confimPassword()
        ]
    };
    const selector = {
        'username': username,
        'email': email,
        'password': password,
        'rePassword': rePassword
    };

    // oninput validate
    for (const key in selector) {
        selector[key].addEventListener('input', function () {
            validate([selector, key, rules]);
        })
    }
    // submit validate
    registerBtn.onclick = async function (e) {
        e.preventDefault();
        let isValid = true;
        for (const key in selector) {
            let temp = validate([selector, key, rules]);
            if (!temp) isValid = false;
        }
        if (isValid) {
            const formData = new FormData();
            formData.append('username', username.value);
            formData.append('email', email.value);
            formData.append('password', password.value);
            formData.append('register', '');

            ajaxRequest('/register', "POST", formData)
                .then(res => {
                    if (res == "success") location.reload();
                    else if (res == "exist") alert("Tài khoản đã tồn tại");
                    else alert("Đăng ký thất bại");
                })
        }
        return false;
    }
})();

// Xử lý form
(() => {
    // Hiển thị modal
    formContainer.onclick = function () {
        formContainer.classList.remove('show');
    }
    formContainer.querySelector('.container').onclick = function (e) {
        e.stopPropagation();
    }
    // Chuyển đổi Login - Register
    const regBtn = document.getElementById('reg');
    const logBtn = document.getElementById('log');
    const form = document.querySelector('#form-modal .container');
    const img = form.querySelector('img');
    const area = form.querySelector('.container-area');
    const registerArea = form.querySelector('.register-area');
    const loginArea = form.querySelector('.login-area');

    regBtn.onclick = function () {
        img.style.left = -area.offsetWidth + 'px';
        area.style.left = img.offsetWidth + 'px';
        registerArea.style.display = 'block';
        loginArea.style.opacity = 0;
    }

    logBtn.onclick = function () {
        img.style.left = 0;
        area.style.left = 0;
        loginArea.style.opacity = 1;
        registerArea.style.display = 'none';
    };

    // Hiển thị - Tắt Password
    const passwordGroup = form.querySelectorAll('.password-group');
    passwordGroup.forEach(group => {
        group.onclick = function (e) {
            const iTag = group.querySelectorAll('i');
            const inputTag = group.querySelector('input');
            if (e.target.tagName == 'I') {
                iTag.forEach(item => item.classList.toggle('active'));
                inputTag.type = group.querySelector('i.show.active') ? 'text' : 'password';
            }
            inputTag.oninput = function () {
                this.type = group.querySelector('i.show.active') ? 'text' : 'password';
            }
        }
    })
})();