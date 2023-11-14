<?php
namespace MVC\Models;
use MVC\Model;

class ProductsModel extends Model{
    function __construct(){
        $this->table = "products";
        parent::__construct();
    }
}
?>