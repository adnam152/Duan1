<?php

namespace MVC\Controllers;

use MVC\Controller;
use MVC\Models\CategoriesModel;

class HomeController extends Controller{
    private $allCategory;
    public function __construct(){
        $this->allCategory = (new CategoriesModel())->get();
    }
    public function index(){

        $this->render([
            "view" => "user/index",
            "page" => "home",
            "title" => "Trang chủ",
            "allCategory" => $this->allCategory,
        ]);
    }
    function allproduct(){
        
        $this->render([
            "view" => "user/allproduct",
            "page" => "home",
            "title" => "Tất cả sản phẩm",
            "css" => "user",
            "js" => "user",
        ]);
    }

}
