<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
<div class="col-md-4">
    <div class="center-form">
        <h2 class="text-center">Register</h2>
<?php
        // Xác định controller và action từ URL
        $controllerName = $_GET['controller'] ?? 'User';
        $actionName = $_GET['action'] ?? 'showRegisterForm';

        // Tạo đối tượng controller và gọi action tương ứng
        $controllerClassName = ucfirst($controllerName) . 'Controller';
        require_once "controllers/{$controllerClassName}.php";

        $controller = new $controllerClassName();
        $controller->$actionName();
        ?>
        
        <form action="?controller=LoginController&action=register" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone_number">Phone Number:</label>
                <input type="text" class="form-control" name="phone_number" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" name="address" required>
            </div>
            <div class="form-group">
                <label for="fullname">Fullname:</label>
                <input type="text" class="form-control" name="fullname" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select class="form-control" name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Profile Image:</label>
                <input type="file" class="form-control-file" name="image" accept="image/*" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Register">
            </div>
        </form>
    </div>
    </div>
</body>

</html> 