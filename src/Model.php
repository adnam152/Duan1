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
    // các hàm dùng chung
    function get($id = null)
    { // lấy tất cả dữ liệu hoặc lấy dữ liệu theo id
        $temp_sql = "SELECT * FROM $this->table";
        if($id){
            $temp_sql .= " WHERE id=?";
            $res = $this->connect->prepare($temp_sql);
            $res->execute([$id]);
            return $res->fetch(\PDO::FETCH_ASSOC);
        }else{
            $res = $this->connect->prepare($temp_sql);
            $res->execute();
            return $res->fetchAll(\PDO::FETCH_ASSOC);
        }
        
    }
    function delete($id)
    {
        $sql = "DELETE FROM $this->table Where id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$id]);
        return $result->rowCount();
    }
    function insert($data)
    {
        // $data = [
        //     column1 => value1,
        //    column2 => value2,
        // ]
        $allColumn = "";
        $allValue = "";
        foreach ($data as $key => $value) {
            $allColumn .= $key . ",";
            $allValue .= "'" . $value . "',";
        }
        $allColumn = trim($allColumn, ",");
        $allValue = trim($allValue, ",");
        $sql = "INSERT INTO $this->table($allColumn) VALUES($allValue)";
        $result = $this->connect->prepare($sql);
        $result->execute();
        return $result->rowCount();
    }
    function update($data){
        // $data = [
        //     column1 => value1,
        //    column2 => value2,
        //   id => id  // id đứng cuối
        // ]
        $allColumn = "";
        $allValue = "";
        foreach ($data as $key => $value) {
            $allColumn .= $key . "=?,";
            $allValue .= "'" . $value . "',";
        }
        $allColumn = trim($allColumn, ",");
        $allValue = trim($allValue, ",");
        $sql = "UPDATE $this->table SET $allColumn WHERE id=?";
        $result = $this->connect->prepare($sql);
        $result->execute(array_values($data));
        return $result->rowCount();
    }
    function getLastId(){ // lấy id của dữ liệu vừa thêm vào
        $sql = "SELECT * FROM $this->table ORDER BY id DESC LIMIT 1";
        $result = $this->connect->prepare($sql);
        $result->execute();
        return $result->fetch(\PDO::FETCH_ASSOC)['id'];
    }
    function isExist($data = []){ // kiểm tra dữ liệu có tồn tại hay không
        // cấu trúc $data = [
        //     column1 => value1,
        //    column2 => value2,
        // ]
        $allColumn = "";
        $allValue = "";
        foreach ($data as $key => $value) {
            $allColumn .= $key . "=? AND ";
            $allValue .= "'" . $value . "',";
        }
        $allColumn = trim($allColumn, "AND ");
        $allValue = trim($allValue, ",");
        $sql = "SELECT * FROM $this->table WHERE $allColumn";
        $result = $this->connect->prepare($sql);
        $result->execute(array_values($data));
        return $result->rowCount();
    }
    function getByColumn($data){ // lấy dữ liệu theo cột
        // cấu trúc $data = [
        //     column1 => value1,
        //    column2 => value2,
        // ]
        $allColumn = "";
        $allValue = "";
        foreach ($data as $key => $value) {
            $allColumn .= $key . "=? AND ";
            $allValue .= "'" . $value . "',";
        }
        $allColumn = trim($allColumn, "AND ");
        $allValue = trim($allValue, ",");
        $sql = "SELECT * FROM $this->table WHERE $allColumn";
        $result = $this->connect->prepare($sql);
        $result->execute(array_values($data));
        return $result->fetch(\PDO::FETCH_ASSOC);
    }
    function deleteByProductId($product_id){
        $sql = "DELETE FROM $this->table WHERE product_id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$product_id]);
        return $result->rowCount();
    }
    public function __destruct()
    { // đóng kết nối
        $this->connect = null;
    }
}
