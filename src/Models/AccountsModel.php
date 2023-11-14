<?php 
namespace MVC\Models;
use MVC\Model;

class AccountsModel extends Model{
    function __construct(){
        parent::__construct();
        $this->table = "accounts";
    }
    function get(){
        $sql = "SELECT * FROM $this->table";
        $res = $this->connect->prepare($sql);
        $res->execute();
        $result = $res->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
}

?>