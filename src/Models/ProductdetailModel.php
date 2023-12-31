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
    function getSize($product_id){
        // lấy ra size không trùng của sản phẩm
        $sql = "SELECT DISTINCT size FROM $this->table WHERE product_id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$product_id]);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    function getColor($product_id){
        // lấy ra color không trùng của sản phẩm
        $sql = "SELECT DISTINCT color FROM $this->table WHERE product_id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$product_id]);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    function getByColorAndSize($product_id, $color, $size){
        $sql = "SELECT * FROM $this->table WHERE product_id=? AND color=? AND size=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$product_id, $color, $size]);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }
    function minPrice($product_id){
        $sql = "SELECT MIN(price) as min FROM $this->table WHERE product_id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$product_id]);
        return $result->fetch(\PDO::FETCH_ASSOC)['min'];
    }
    function maxPrice($product_id){
        $sql = "SELECT MAX(price) as max FROM $this->table WHERE product_id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$product_id]);
        return $result->fetch(\PDO::FETCH_ASSOC)['max'];
    }
    function decreaseQuantity($id, $quantity){
        $sql = "UPDATE $this->table SET quantity = quantity - ? WHERE id=?";
        $result = $this->connect->prepare($sql);
        return  $result->execute([$quantity, $id]);
    }
}

?>