<?php

namespace MVC\Controllers;

use MVC\Controller;
use MVC\Model;

class HomeController extends Controller{
    public function index(){
        header("location: /DA1/admin");
    }
}





?>