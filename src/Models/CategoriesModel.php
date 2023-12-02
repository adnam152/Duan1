<?php
namespace MVC\Models;

use MVC\Model;
use MVC\Models\ProductsModel;

class CategoriesModel extends Model{
    function __construct(  ){
        parent::__construct();
        $this->table = "categories";    
    }
    // function delete($id){
    //     // get all product_id of category
    //     $allProductId = (new ProductsModel())->getByCategoryId($id);
    //     foreach($allProductId as $product){
    //         (new ProductsModel())->delete($product["id"]);
    //     }

    //     // delete category
    //     $sql = "DELETE FROM $this->table Where id=?";
    //     $result = $this->connect->prepare($sql);
    //     $result->execute([$id]);
    //     return $result->rowCount();
    // }
//     public function categorybyid_home( $table,$table_product,$id ){
//         $sql = "SELECT * FROM $table,$table_product  WHERE $table.id_category=$table_product.id_category
//         AND $table_product.id_product='$id' ORDER BY  id_category DESC";
//       $result=$this->connect->prepare($sql);
//       $result->execute([$table,$table_product,$id]);
//          return $result->rowCount();

// }
}

?>