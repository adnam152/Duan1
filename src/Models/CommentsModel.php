<?php

namespace MVC\Models;
use MVC\Model;

class CommentsModel extends Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = "comments";
    }
    function get($data=[])
    {
        $sql = "SELECT cmt.*, accounts.username, accounts.image, products.name as product_name FROM $this->table cmt INNER JOIN accounts ON cmt.account_id = accounts.id INNER JOIN products ON cmt.product_id = products.id";
        if (isset($data['id'])) {
            $sql .= " WHERE cmt.id=?";
            $result = $this->connect->prepare($sql);
            $result->execute([$data['id']]);
            return $result->fetch(\PDO::FETCH_ASSOC);
        }
        else{
            
            if(isset($data['product_id'])){
                $sql .= " WHERE product_id = ?";
            }
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
        if(isset($data['product_id']))
            $result->execute([$data['product_id']]);
        else 
            $result->execute();
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
    function getByProductId($product_id, $limit = 5){
        $sql = "SELECT cmt.*, accounts.username, accounts.image FROM $this->table cmt INNER JOIN accounts ON cmt.account_id = accounts.id WHERE product_id=? ORDER BY cmt.create_at DESC LIMIT $limit";
        $result = $this->connect->prepare($sql);
        $result->execute([$product_id]);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
    }
}



?>
