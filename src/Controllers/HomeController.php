<?php

namespace MVC\Controllers;

use MVC\Controller;
use MVC\Model;

class HomeController extends Controller{
    public function index(){
        // header("location: /admin");
    }
    function allproduct(){
        
        $this->render([
            "view" => "home/allproduct",
            "page" => "home",
            "title" => "Tất cả sản phẩm",
        ]);
    }
}





?>