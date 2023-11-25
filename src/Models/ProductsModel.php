<?php
namespace MVC\Models;
use MVC\Model;

class ProductsModel extends Model{
    function __construct(){
        $this->table = "products";
        parent::__construct();
    }

//     function getAllProducts() {
//         $sql = "SELECT * FROM $this->table WHERE  1 order by id desc limit 0,15"; 
//         $result = $this->connect->prepare($sql);
//         $result->execute([]);
//         return $result->fetchAll(\PDO::FETCH_ASSOC);
// }
}
?> 