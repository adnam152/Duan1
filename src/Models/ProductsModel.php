<?php
namespace MVC\Models;
use MVC\Model;

class ProductsModel extends Model{
    function __construct(){
        $this->table = "products";
        parent::__construct();
    }
    function get(){
        $sql = "SELECT * FROM $this->table";
        $temp = $this->connect->prepare($sql);
        $temp->execute();
        $result = $temp->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}
?>