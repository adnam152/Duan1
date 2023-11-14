<?php
namespace MVC\Models;

use MVC\Model;
class CategoriesModel extends Model{
    function __construct(  ){
        parent::__construct();
        $this->table = "categories";    
    }

    function create($name){
        $sql="INSERT INTO $this->table (name) value(?)";
        $result=$this->connect->prepare($sql);
        $result->execute([$name]);
    }

    function update($id,$name){ 
        $sql= "UPDATE $this->table SET name=? WHERE id=?";
        $result=$this->connect->prepare($sql);
        $result->execute([$name,$id]);
        return $result->rowCount();
    }
}


?>