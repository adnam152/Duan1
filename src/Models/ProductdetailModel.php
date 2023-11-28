<?php 
namespace MVC\Models;
use MVC\Model;

class ProductdetailModel extends Model{
    function __construct(){
        parent::__construct();
        $this->table = "product_detail";
    }
    function countByProductId($product_id){
        $sql = "SELECT SUM(quantity) as count FROM $this->table WHERE product_id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$product_id]);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }
    function getByProductId($product_id){
        $sql = "SELECT * FROM $this->table WHERE product_id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$product_id]);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    function allMaxPrice(){
        $sql = "SELECT product_id, MAX(price) as max_price FROM $this->table GROUP BY product_id";
        $result = $this->connect->prepare($sql);
        $result->execute();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    function allMinPrice(){
        $sql = "SELECT product_id, MIN(price) as min_price FROM $this->table GROUP BY product_id";
        $result = $this->connect->prepare($sql);
        $result->execute();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>