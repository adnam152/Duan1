<?php 
namespace MVC\Controllers;
use MVC\Controller;
use MVC\Models\AccountsModel;
class LoginController extends Controller{
    private $accountModel;
    function __construct(){
        $this->accountModel = new AccountsModel();
    }
    public function login(){
        if(isset($_POST['login'])){
            $account = $this->accountModel->getOne([
                "username" => $_POST['username'],
                "password" => $_POST['password'],
            ]);
            if($account){
                $_SESSION['user'] = [
                    "id" => $account['id'], 
                    "username" => $_POST['username'],
                    "password" => $_POST['password'],
                    "fullname" => $account['fullname'],
                    "image" => $account['image'],
                    "role" => $account['role'],
                ];
                echo json_encode("success");
                exit;
            }
            else echo json_encode("error");
            
        }
    }
    public function logout(){
        unset($_SESSION['user']);
        header("Location: ".$_SERVER['HTTP_REFERER']);
    }
    function register(){
        if(isset($_POST['register']) && isset($_POST['username']) && isset($_POST['password'])){
            if($this->accountModel->isExist([
                "username" => $_POST['username'],
            ])){
                echo json_encode("exist");
                exit;
            }
            if($this->accountModel->insert([
                "username" => $_POST['username'],
                "password" => $_POST['password'],
                "email" => $_POST['email'],
            ]) > 0){
                $account = $this->accountModel->getOne([
                    "username" => $_POST['username'],
                    "password" => $_POST['password'],
                ]);
                $_SESSION['user'] = [
                    "username" => $_POST['username'],
                    "password" => $_POST['password'],
                    "fullname" => $account['fullname'],
                    "image" => $account['image'],
                    "role" => $account['role'],
                ];
                echo json_encode("success");
                exit;
            }
            else echo json_encode("error");
        }
    }
}

?>