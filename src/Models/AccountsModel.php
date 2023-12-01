<?php 
namespace MVC\Models;
use MVC\Model;

class AccountsModel extends Model{
    function __construct(){
        parent::__construct();
        $this->table = "accounts";
    }
public function getUserByEmailPassword($email, $password)
{
    $sql = "
        SELECT 
            * 
        FROM {$this->table} 
        WHERE 
            email = :email 
            AND 
            password = :password 
        LIMIT 1
    ";

    $stmt = $this->connect->prepare($sql);

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    $stmt->execute();

    $stmt->setFetchMode(\PDO::FETCH_ASSOC);

    return $stmt->fetch();
}
}


?>