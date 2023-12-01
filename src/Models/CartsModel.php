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
    function getAllInforByAccountId($account_id){
        $sql = "SELECT c.id, c.quantity, pd.id detail_id, pd.size, pd.color, pd.price, p.id product_id, p.name, p.discount, m.link FROM $this->table c join product_detail pd on c.detail_id = pd.id join products p on pd.product_id = p.id join (SELECT product_id, min(link) as link From medias GROUP BY product_id) m on p.id = m.product_id WHERE c.account_id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$account_id]);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    function getDetail($id){
        $sql = "SELECT c.id, c.quantity, pd.size, pd.color, pd.price,p.id product_id, p.name, p.discount, ca.id category_id FROM $this->table c join product_detail pd on c.detail_id = pd.id join products p on pd.product_id = p.id join categories ca on p.category_id = ca.id WHERE c.id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$id]);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }
}

?>