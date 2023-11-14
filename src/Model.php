<?php

namespace MVC;

class Model
{
    protected $connect;
    protected $table;

    function __construct()
    {

        try {
            $this->connect = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
            $this->connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            // echo"Connect succesfully!";
        } catch (\PDOException $e) {
            die("" . $e->getMessage());
        }
    }
    public function __destruct(){
        $this->connect = null;
    }

    // các hàm dùng chung
    function get($id=null){
        if($id==null){
            $sql= "SELECT * FROM $this->table";
            $result=$this->connect->prepare($sql);
            $result->execute();
            return $result->fetchAll(\PDO::FETCH_ASSOC);
        }else{
            $sql= "SELECT * FROM $this->table WHERE id=?";
            $result=$this->connect->prepare($sql);
            $result->execute([$id]);
            return $result->fetch(\PDO::FETCH_ASSOC);
        }
    }
    function delete($id){
        $sql= "DELETE FROM $this->table Where id=?";
        $result=$this->connect->prepare($sql);
        $result->execute([$id]);
        return $result->rowCount();
    }
}
