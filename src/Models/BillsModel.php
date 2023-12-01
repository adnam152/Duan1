<?php 
namespace MVC\Models;
use MVC\Model;

class BillsModel extends Model{
    function __construct(){
        parent::__construct();
        $this->table = "bills";
    }
    function countOrderByUserId($user_id){
        $sql = "SELECT COUNT(*) FROM $this->table WHERE account_id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$user_id]);
        return $result->fetch(\PDO::FETCH_ASSOC)['COUNT(*)'];
    }
}

?>