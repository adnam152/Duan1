<?php 
namespace MVC\Controllers;
use MVC\Controller;
use MVC\Models\AccountsModel;
class LoginController extends Controller{
    public function login(){
        $accountModel = new AccountsModel();
        $account = $accountModel->get();
        // echo "<prev>";
        // print_r($account);
        // echo"</prev>";
    }
    public function logout(){

    }
}

?>