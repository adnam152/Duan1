<?php

use MVC\Router;
use MVC\Controllers\HomeController;
use MVC\Controllers\AdminController;
use MVC\Controllers\LoginController;
use MVC\Controllers\APIController;

$uri = trim($_SERVER['REQUEST_URI'], '/');
$position = strpos($uri, '?');
if ($position !== false) {
    $uri = substr($uri, 0, $position);
}
$router = new Router();


$router->addRoute('', HomeController::class, 'index');
$router->addRoute('allproduct', HomeController::class, 'allproduct');
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
$router->addRoute('api/user', APIController::class, 'user');
$router->addRoute('api/addtocart', APIController::class, 'addtocart');
$router->addRoute('api/countcart', APIController::class, 'countcart');
$router->addRoute('api/getdetail', APIController::class, 'getdetail');
$router->addRoute('api/getcomment', APIController::class, 'getcomment');
$router->addRoute('api/addcomment', APIController::class, 'addcomment');


$router->dispatch($uri);
