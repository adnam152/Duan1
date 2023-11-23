<?php

namespace MVC\Controllers;

use MVC\Controller;
use MVC\Model;

class HomeController extends Controller{
    public function index(){
        //header("location: /admin");
    }


  function allproducts(){ 
    $products = array();
    
    $this->render([
        "view" => "user/index",
        "page" => "user",
        "products"=> $products
    ]);
  }
}




?>