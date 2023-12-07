<?php

namespace MVC;
use MVC\Models\CartsModel;
class Controller {
    protected $numberOfCart = 0;
    public function __construct(){
        if(isset($_SESSION['cart'])){
            $this->numberOfCart = count($_SESSION['cart']);
        }
        else if(isset($_SESSION['user']['id'])) {
            $this->numberOfCart = (new CartsModel)-> countCart()['count'];
        }
    }
    protected function render($data = []) {
        extract($data);
        $numberOfCart = $this->numberOfCart;
        require "Views/base.php";
    }
}
    