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
        $sql = "SELECT cmt.*, accounts.username, products.name as product_name FROM $this->table cmt INNER JOIN accounts ON cmt.account_id = accounts.id INNER JOIN products ON cmt.product_id = products.id";
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
