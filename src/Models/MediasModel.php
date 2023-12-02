<?php 
namespace MVC\Models;
use MVC\Model;

class MediasModel extends Model{
    function __construct(){
        parent::__construct();
        $this->table = "medias";
    }
    function getByProductId($product_id, $limit = null){
        $sql = "SELECT * FROM $this->table WHERE product_id=?";
        if($limit) $sql .= " LIMIT $limit";
        $result = $this->connect->prepare($sql);
        $result->execute([$product_id]);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    function getLinkByProductId($product_id, $limit = null){
        $sql = "SELECT link FROM $this->table WHERE product_id=?";
        if($limit) $sql .= " LIMIT $limit";
        $result = $this->connect->prepare($sql);
        $result->execute([$product_id]);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>