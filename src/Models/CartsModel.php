<?php 
namespace MVC\Models;
use MVC\Model;

class CartsModel extends Model{
    function __construct(){
        parent::__construct();
        $this->table = "carts";
    }
    function countCart(){
        $account_id = $_SESSION['user']['id'];
        $sql = "SELECT count(*) as count FROM $this->table WHERE account_id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$account_id]);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }
    function getByAccountIdAndDetailId($account_id, $detail_id){
        $sql = "SELECT * FROM $this->table WHERE account_id=? AND detail_id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$account_id, $detail_id]);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }
}

?>