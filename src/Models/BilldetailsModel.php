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
}




?>

