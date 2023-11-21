<?php 
namespace MVC\Models;
use MVC\Model;

class AccountsModel extends Model{
    function __construct(){
        parent::__construct();
        $this->table = "accounts";
    }

    function update($id,$username,$password,$image,$email,$phone_number,$address,$fullname,$role){ 
        $sql= "UPDATE $this->table SET name=? WHERE id=?";
        $result=$this->connect->prepare($sql);
        $result->execute([$id,$username,$password,$image,$email,$phone_number,$address,$fullname,$role]);
        return $result->rowCount();
    }
}

?>