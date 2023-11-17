<?php 
namespace MVC\Models;
use MVC\Model;

class MediasModel extends Model{
    function __construct(){
        parent::__construct();
        $this->table = "medias";
    }
    function getByProductId($product_id){
        $sql = "SELECT * FROM $this->table WHERE product_id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$product_id]);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>