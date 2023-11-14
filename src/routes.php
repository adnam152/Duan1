<?php

use MVC\Router;
use MVC\Controllers\HomeController;
use MVC\Controllers\AdminController;
use MVC\Controllers\LoginController;

$uri = $_GET['url']??"";
$router = new Router();


$router->addRoute('', HomeController::class, 'index');
$router->addRoute('admin', AdminController::class,'index');
$router->addRoute('admin/category', AdminController::class,'category');
$router->addRoute('admin/product', AdminController::class,'product');
$router->addRoute('admin/user', AdminController::class,'user');
$router->addRoute('admin/comment', AdminController::class,'comment');
$router->addRoute('admin/order', AdminController::class,'order');


$router->dispatch($uri);
