<?php 
namespace MVC\Models;
use MVC\Model;

class AccountsModel extends Model{
    function __construct(){
        parent::__construct();
        $this->table = "accounts";
    }
}

?>