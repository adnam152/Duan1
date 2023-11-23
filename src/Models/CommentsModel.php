<?php

namespace MVC\Models;


use MVC\Model;



class CommentsModel extends Model
{
    function __construct()
    {
        parent::__construct();
        $this->table = "Comments";
    }


    function insert_comments($id, $product_id, $comment, $account_id)
    {


        $sql = "
                insert into binhluan(id,product_id,comment,account_id) values ('$id','$product_id','$comment','$account_id')
                    
                ";
        $result = $this->connect->prepare($sql);
        $result->execute([$id, $product_id, $comment, $account_id]);
    }


    function getAllComments()
    {
        $sql = "select *from comments order by id desc  ";
        $Allcomments = $this->connect->prepare($sql);
        return  $Allcomments;
    }
}



?>
