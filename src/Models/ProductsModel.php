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
    function getByCategoryId($category_id){
        $sql = "SELECT * FROM $this->table WHERE category_id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$category_id]);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    function delete($id){
        // delete product detail
        (new ProductdetailModel())->deleteByProductId($id);
        // delete media
        (new MediasModel())->deleteByProductId($id);
        // delete comment
        (new CommentsModel())->deleteByProductId($id);
        // delete product
        $sql = "DELETE FROM $this->table WHERE id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$id]);
        return $result->rowCount();
    }
    function count(){
        $sql = "SELECT COUNT(*) as count FROM $this->table";
        $result = $this->connect->prepare($sql);
        $result->execute();
        return $result->fetch(\PDO::FETCH_ASSOC)["count"];
    }
}
?>