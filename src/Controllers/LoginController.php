<?php 
namespace MVC\Controllers;
use MVC\Controller;
use MVC\Models\AccountsModel;
class LoginController extends Controller{
    public function login(){
        $accountModel = new AccountsModel();
        $account = $accountModel->get();
        
        $this->render([
            "view" => "user/login",
            "page" => "login",
        ]);
    }
    function register(){
        $this->render([
            "view" => "user/register",
            "page" => "register",
            "css" => "login",
        ]);
    }
    public function logout(){

    }
}

?>