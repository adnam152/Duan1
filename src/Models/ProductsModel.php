<?php
namespace MVC\Models;
use MVC\Model;
use MVC\Models\MediasModel;
use MVC\Models\ProductdetailModel;
use MVC\Models\CommentsModel;

class ProductsModel extends Model{
    function __construct(){
        $this->table = "products";
        parent::__construct();
    }
    

}
?> 