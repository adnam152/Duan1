<?php

namespace MVC\Models;

use MVC\Model;
use MVC\Models\MediasModel;
use MVC\Models\ProductdetailModel;
use MVC\Models\CommentsModel;

class ProductsModel extends Model
{
    function __construct()
    {
        $this->table = "products";
        parent::__construct();
    }
    function getByCategoryId($category_id, $limit = null)
    {
        $sql = "SELECT * FROM $this->table WHERE category_id=?";
        if ($limit != null) {
            $sql .= " LIMIT $limit";
        }
        $result = $this->connect->prepare($sql);
        $result->execute([$category_id]);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    function delete($id)
    {
        // delete product detail
        (new ProductdetailModel())->deleteByProductId($id);
        // delete media
        (new MediasModel())->deleteByProductId($id);
        // delete comment
        (new CommentsModel())->deleteByProductId($id);
        // delete product
        $sql = "DELETE FROM $this->table WHERE id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$id]);
        return $result->rowCount();
    }
    function getTopSeller($limit = 8)
    {
        $sql = "SELECT * FROM $this->table p join (select product_id, min(link) as link from medias group by product_id) m on p.id = m.product_id ORDER BY p.purchase DESC, p.view DESC LIMIT $limit";
        $result = $this->connect->prepare($sql);
        $result->execute();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    function increasePurchase($id, $quantity)
    {
        $sql = "UPDATE $this->table SET purchase = purchase + ? WHERE id=?";
        $result = $this->connect->prepare($sql);
        return  $result->execute([$quantity, $id]);
    }
    function filter($data = [])
    {   
        $sql = "SELECT p.*, pd.min_price, pd.max_price, m.link media FROM $this->table p 
            join (select product_id, min(link) as link from medias group by product_id) m on p.id = m.product_id 
            join (select min(price) as min_price, max(price) as max_price, product_id from product_detail group by product_id) pd on p.id = pd.product_id
            WHERE 1=1
        ";
        if(isset($data['category_id']) && is_array($data['category_id']) && count($data['category_id']) > 0){
            $sql .= " AND p.category_id IN (".implode(',', $data['category_id']).")";
        }
        if(isset($data['maxPrice']) && $data['maxPrice'] != ''){
            $sql .= " AND pd.min_price <= ".$data['maxPrice'];
        }
        if(isset($data['minPrice']) && $data['minPrice']){
            $sql .= " AND pd.max_price >= ".$data['minPrice'];
        }
        if(isset($data['orderBy']) && isset($data['orderType']) && $data['orderBy'] != '' && $data['orderType'] != ''){
            if($data['orderBy'] == 'price'){
                $sql .= " ORDER BY pd.min_price " . $data['orderType'];
            }
            elseif($data['orderBy'] == 'create_at'){
                $sql .= " ORDER BY p.create_at " . $data['orderType'];
            }
        }
        // echo json_encode($sql);
        $result = $this->connect->prepare($sql);
        $result->execute();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    function search($keyword){
        $sql = "SELECT p.*, pd.min_price, pd.max_price, m.link media FROM $this->table p 
            join (select product_id, min(link) as link from medias group by product_id) m on p.id = m.product_id 
            join (select min(price) as min_price, max(price) as max_price, product_id from product_detail group by product_id) pd on p.id = pd.product_id
            WHERE p.name LIKE '%$keyword%' OR p.description LIKE '%$keyword%'
        ";
        $result = $this->connect->prepare($sql);
        $result->execute();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    function countProductByCategory()
    {
        $sql = "select c.name c_name, count(p.id) count from $this->table p join categories c on p.category_id=c.id group by c.name";
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function getTopNew($limit = 3){
        $sql = "SELECT * FROM $this->table ORDER BY create_at DESC LIMIT $limit";
        $result = $this->connect->prepare($sql);
        $result->execute();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    function getTopView($limit = 3){
        $sql = "SELECT * FROM $this->table ORDER BY view DESC LIMIT $limit";
        $result = $this->connect->prepare($sql);
        $result->execute();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    function getTopPurchase($limit = 3){
        $sql = "SELECT * FROM $this->table ORDER BY purchase DESC LIMIT $limit";
        $result = $this->connect->prepare($sql);
        $result->execute();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}
