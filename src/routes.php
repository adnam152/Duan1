<?php

use MVC\Router;
use MVC\Controllers\HomeController;
use MVC\Controllers\AdminController;
use MVC\Controllers\LoginController;

$uri = trim($_SERVER['REQUEST_URI'], '/');
$router = new Router();


$router->addRoute('', HomeController::class, 'index');
$router->addRoute('login', LoginController::class, 'login');


$router->addRoute('admin', AdminController::class,'index');
$router->addRoute('admin/category', AdminController::class,'category');
$router->addRoute('admin/product', AdminController::class,'product');
$router->addRoute('admin/account', AdminController::class,'account');
$router->addRoute('admin/comment', AdminController::class,'comment');
$router->addRoute('admin/order', AdminController::class,'order');

$router->dispatch($uri);
