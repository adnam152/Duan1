<?php

namespace MVC\Controllers;

use MVC\Controller;
use MVC\Model;

class HomeController extends Controller
{
    public function index()
    {
        $this->render([
            "view" => "user/home",
            "page" => "home",
            "title" => "Tất cả sản phẩm",
            "css" => "user",
            "js" => "user",
        ]);
    }
    function allproduct()
    {

        $this->render([
            "view" => "user/home",
            "page" => "user",
            "title" => "Tất cả sản phẩm",
        ]);
    }
}
