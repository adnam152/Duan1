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
   
}
?>
