<?php
namespace MVC\Models;

use MVC\Model;
class CategoriesModel extends Model{
    function __construct(  ){
        parent::__construct();
        $this->table = "categories";    
    }
}


?>