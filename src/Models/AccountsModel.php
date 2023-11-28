<?php 
namespace MVC\Models;
use MVC\Model;

class AccountsModel extends Model{
    function __construct(){
        parent::__construct();
        $this->table = "accounts";
    }
    function count(){
        $sql = "SELECT COUNT(*) as count FROM $this->table";
        $result = $this->connect->prepare($sql);
        $result->execute();
        return $result->fetch(\PDO::FETCH_ASSOC)['count'];
    }
}

?>