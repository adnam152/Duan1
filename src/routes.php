<?php

use MVC\Router;
use MVC\Controllers\HomeController;
use MVC\Controllers\AdminController;
use MVC\Controllers\LoginController;
use MVC\Controllers\APIController;
use MVC\Controllers\UserAPIController;

$uri = trim($_SERVER['REQUEST_URI'], '/');
$position = strpos($uri, '?');
if ($position !== false) {
    $uri = substr($uri, 0, $position);
}
$router = new Router();


$router->addRoute('', HomeController::class, 'index');
$router->addRoute('allproduct', HomeController::class, 'allproduct');
$router->addRoute('allproduct/{category_id}', HomeController::class, 'allproduct');
$router->addRoute('detail', HomeController::class, 'detail');
$router->addRoute('cart', HomeController::class, 'cart');

$router->addRoute('login', LoginController::class, 'login');


$router->addRoute('admin', AdminController::class, 'index');
$router->addRoute('admin/category', AdminController::class, 'category');
$router->addRoute('admin/product', AdminController::class, 'product');
$router->addRoute('admin/account', AdminController::class, 'account');
$router->addRoute('admin/comment', AdminController::class, 'comment');
$router->addRoute('admin/order', AdminController::class, 'order');


$router->addRoute('api/category', APIController::class, 'category');
$router->addRoute('api/product', APIController::class, 'product');
$router->addRoute('api/account', APIController::class, 'account');
$router->addRoute('api/comment', APIController::class, 'comment');

$router->addRoute('api/user', UserAPIController::class, 'user');
$router->addRoute('api/addtocart', UserAPIController::class, 'addtocart');
$router->addRoute('api/countcart', UserAPIController::class, 'countcart');
$router->addRoute('api/getdetail', UserAPIController::class, 'getdetail');
$router->addRoute('api/getcomment', UserAPIController::class, 'getcomment');
$router->addRoute('api/addcomment', UserAPIController::class, 'addcomment');
$router->addRoute('api/removefromcart', UserAPIController::class, 'removefromcart');
$router->addRoute('api/confirmBill', UserAPIController::class, 'confirmBill');
$router->addRoute('api/topseller', UserAPIController::class, 'topSeller');

$router->dispatch($uri);
