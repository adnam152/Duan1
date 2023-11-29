<?php 
namespace MVC\Models;
use MVC\Model;

class AccountsModel extends Model{
    function __construct(){
        parent::__construct();
        $this->table = "accounts";
    }
    function check($id, $username){
        $sql = "SELECT * FROM $this->table WHERE id != ? AND username = ?";
        $result = $this->connect->prepare($sql);
        $result->execute([$id, $username]);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }
    function getOne($data=[]){
        // $data = [username, password]
        if(!isset($data['username']) || !isset($data['password'])) return false;
        $sql = "SELECT * FROM $this->table WHERE username = ? AND password = ?";
        $result = $this->connect->prepare($sql);
        $result->execute([$data['username'], $data['password']]);
        return $result->fetch(\PDO::FETCH_ASSOC);
    }
}

?>