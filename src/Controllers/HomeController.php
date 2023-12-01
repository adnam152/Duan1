<?php

namespace MVC\Controllers;

use MVC\Controller;
use MVC\Model;

class HomeController extends Controller{
    public function index(){
        // header("location: /admin");
    }
    public function category()
    {
        $categoryModel = new CategoriesModel();

        $productModel = new ProductsModel();
        $allProducts = $productModel->get();

        // get category
        $allCategory = $categoryModel->get();

        $this->render([
            "view" => "home/allproduct",
            "page" => "home",
            "title" => "Tất cả sản phẩm",
        ]);
    }
}





?>