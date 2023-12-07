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
    function getTopSeller($limit = 8){
        $sql = "SELECT * FROM $this->table p join (select product_id, min(link) as link from medias group by product_id) m on p.id = m.product_id ORDER BY p.purchase DESC, p.view DESC LIMIT $limit";
        $result = $this->connect->prepare($sql);
        $result->execute();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    function increasePurchase($id, $quantity){
        $sql = "UPDATE $this->table SET purchase = purchase + ? WHERE id=?";
        $result = $this->connect->prepare($sql);
        return  $result->execute([$quantity, $id]);
    }
}
?>