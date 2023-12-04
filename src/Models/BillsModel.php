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
    function delete($bill_id){
        // delete bill detail
        $sql = "DELETE FROM billdetails WHERE bill_id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$bill_id]);
        
        // delete bill
        $sql = "DELETE FROM $this->table WHERE id=?";
        $result = $this->connect->prepare($sql);
        return $result->execute([$bill_id]);
    }
    function get($data=[])
    {
        $sql = "SELECT b.*, a.username, a.image, a.email FROM $this->table b join accounts a on b.account_id = a.id";
        if (isset($data['id'])) {
            $sql .= " WHERE id=?";
            $result = $this->connect->prepare($sql);
            $result->execute([$data['id']]);
            return $result->fetch(\PDO::FETCH_ASSOC);
        }else{
            if(isset($data['orderBy']) && isset($data['orderType'])){
                if($data['orderType'] != "ASC" && $data['orderType'] != "DESC") $data['orderType'] = "ASC";
                $sql .= " ORDER BY " . $data['orderBy'] . " " . $data['orderType'];
            }

            if(isset($data['limit'])){
                if($data['limit'])
                    $sql .= " LIMIT " . $data['limit'];
            }
            if(isset($data['page'])){
                if($data['limit'])
                    $sql .= " OFFSET " . ($data['page']-1)*$data['limit'];
            }
        }
        $result = $this->connect->prepare($sql);
        $result->execute();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}

?>