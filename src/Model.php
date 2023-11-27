<?php

namespace MVC;

class Model
{
    protected $connect;
    protected $table;

    function __construct()
    {

        try {
            $this->connect = new \PDO("mysql:host=" . DB_HOST . ";dbname=duan1" . DB_NAME, DB_USERNAME, DB_PASSWORD);
            $this->connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            // echo"Connect succesfully!";
        } catch (\PDOException $e) {
            die("" . $e->getMessage());
        }
    }
    // các hàm dùng chung
    function get($data=[])
    { // lấy tất cả dữ liệu hoặc lấy dữ liệu theo id hoặc lấy dữ liệu theo limit, offset, order
        // $data = [
        //     id => value,
        //     limit => value,
        //     orderBy => value,
        //      orderType => value,
        //     page => value,
        // ]
        $sql = "SELECT * FROM $this->table";
        if (isset($data['id'])) {
            $sql .= " WHERE id=?";
            $result = $this->connect->prepare($sql);
            $result->execute([$data['id']]);
            return $result->fetch(\PDO::FETCH_ASSOC);
        }else{
            if(isset($data['orderBy']) && isset($data['orderType'])){
                if($data['orderType'] != "ASC" && $data['orderType'] != "DESC") $data['orderType'] = "DESC";
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
    function delete($id)
    {
        $sql = "DELETE FROM $this->table Where id=?";
        $result = $this->connect->prepare($sql);
        $result->execute([$id]);
        return $result->rowCount();
    }
    function insert($data=[])
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
    function update($data, $id){
        // $data = [
        //     column1 => value1,
        //    column2 => value2,
        // ]
        $allColumn = "";
        foreach ($data as $key => $value) {
            $allColumn .= $key . "=?,";
        }
        $allColumn = trim($allColumn, ",");
        $data[] = $id;
        $sql = "UPDATE $this->table SET $allColumn WHERE id=?";
        $result = $this->connect->prepare($sql);
        $result->execute(array_values($data)); // 
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
        foreach ($data as $key => $value) {
            $allColumn .= $key . "=? AND ";
        }
        $allColumn = trim($allColumn, "AND ");
        $sql = "SELECT * FROM $this->table WHERE $allColumn";
        $result = $this->connect->prepare($sql);
        $result->execute(array_values($data));
        return $result->rowCount();
    }
    function getByColumn($data=[]){ // lấy dữ liệu theo cột
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
    function deleteByProductId($product_id){// dùng cho bảng product_details, comments, medias
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
