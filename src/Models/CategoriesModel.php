<?php
namespace MVC\Models;

use MVC\Model;
use MVC\Models\ProductsModel;

class CategoriesModel extends Model{
    function __construct(  ){
        parent::__construct();
        $this->table = "categories";    
    }
    function delete($id){
        // get all product_id of category
        $allProductId = (new ProductsModel())->getByCategoryId($id);
        foreach($allProductId as $product){
            (new ProductsModel())->delete($product["id"]);
        }

        // delete category
        $sql = "DELETE FROM $this->table Where id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$id]);
        return $result->rowCount();
    }
}


?>