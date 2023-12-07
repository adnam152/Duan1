<?php 
namespace MVC\Models;
use MVC\Model;
use MVC\Models\CategoriesModel;
class BilldetailsModel extends Model{
    function __construct(){
        parent::__construct();
        $this->table = "billdetails";
    }
    function countOrderByUserIdAndCategoryId($user_id, $category_id){
        $sql = "SELECT SUM(billdetails.quantity) FROM $this->table JOIN products ON billdetails.product_id = products.id WHERE billdetails.bill_id IN (SELECT bills.id FROM bills WHERE bills.account_id=?) AND products.category_id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$user_id, $category_id]);
        return $result->fetch(\PDO::FETCH_ASSOC)['SUM(billdetails.quantity)'] ?? 0;
    }
    function getByBillId($bill_id){
        $sql = "SELECT pd.price, p.discount, bd.quantity, pd.size, pd.color, p.name, m.link, p.id product_id, m.link, pd.id detail_id
            FROM $this->table bd join product_detail pd on bd.detail_id = pd.id 
            join products p on pd.product_id = p.id 
            join (SELECT product_id, min(link) as link From medias GROUP BY product_id) m on p.id = m.product_id 
            WHERE bill_id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$bill_id]);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}




?>

