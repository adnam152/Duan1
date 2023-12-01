<?php

namespace MVC\Controllers;

use MVC\Models\ProductsModel;
use MVC\Models\ProductdetailModel;
use MVC\Models\CommentsModel;
use MVC\Models\CartsModel;
use MVC\Models\BillsModel;
use MVC\Models\BilldetailsModel;

class UserAPIController
{
    public function user()
    {
        if (isset($_SESSION['user'])) echo json_encode(["id" => $_SESSION['user']['id']]);
        else echo json_encode("error");
    }
    public function countcart()
    {
        $cartModel = new CartsModel();
        $count = $cartModel->countCart();
        echo json_encode($count);
    }
    public function getdetail()
    {
        $detailModel = new ProductdetailModel();
        $data = [];
        $temp = $detailModel->getByColorAndSize($_POST['product_id'], $_POST['color'], $_POST['size']);
        if ($temp) $data = array_merge($data, $temp);
        $discount = (new ProductsModel)->get(['id' => $_POST['product_id']])['discount'];
        $data['discount'] = $discount;
        echo json_encode($data);
    }
    public function addtocart()
    {
        $cartModel = new CartsModel();
        $detailModel = new ProductdetailModel();
        $detail = $detailModel->getByColorAndSize($_POST['product_id'], $_POST['color'], $_POST['size']);
        if (isset($detail['quantity']) && $detail['quantity'] >= $_POST['quantity']) {
            $detailId = $detail['id'];
            if ($cartModel->isExist([
                "account_id" => $_POST['account_id'],
                "detail_id" => $detailId,
            ]) > 0) {
                $cart = $cartModel->getByAccountIdAndDetailId($_POST['account_id'], $detailId);
                $newQuantity = $cart['quantity'] + $_POST['quantity'];
                $cartModel->update([
                    "quantity" => $newQuantity,
                ], $cart['id']);
            } else
                $cartModel->insert([
                    "account_id" => $_POST['account_id'],
                    "detail_id" => $detailId,
                    "quantity" => $_POST['quantity'],
                ]);
            echo json_encode("success");
            exit;
        } else echo json_encode("error");
    }
    public function getcomment()
    {
        $commentModel = new CommentsModel();
        $data = $commentModel->get([
            "product_id" => $_POST['product_id'],
            "orderBy" => "create_at",
            "orderType" => "DESC",
            "limit" => 3,
            "page" => $_POST['page'],
        ]);
        if (count($data) > 0)
            echo json_encode($data);
        else echo json_encode("error");
    }
    public function addcomment()
    {
        $commentModel = new CommentsModel();
        if ($commentModel->insert([
            "account_id" => $_SESSION['user']['id'],
            "product_id" => $_POST['product_id'],
            "content" => $_POST['content'],
            "create_at" => date("Y-m-d H:i:s", time()),
        ]) > 0) {
            $lastId = $commentModel->getLastId();
            $res = $commentModel->get([
                "id" => $lastId,
            ]);
            echo json_encode($res);
        } else echo json_encode("error");
    }
    public function removefromcart()
    {
        if (isset($_GET['id'])) {
            if ((new CartsModel)->delete($_GET['id']) > 0) {
                echo json_encode("success");
                exit;
            }
        }
        echo json_encode("error");
    }
    public function confirmBill()
    {
        if(!isset($_POST['card_id']) || empty($_POST['card_id'])) {
            echo json_encode("error");
            exit;
        }
        $totalPrice = 0;
        $details = [];
        foreach($_POST['cart_id'] as $id){
            $temp = (new CartsModel)->getDetail($id);
            $totalPrice += $temp['price'] * $temp['quantity'] * (1 - $temp['discount']/100);
            $details[] = $temp;
        }

        // create bill
        (new BillsModel)->insert([
            "account_id" => $_SESSION['user']['id'] ?? 0,
            "total_price" => $totalPrice,
            "pay_method" => $_POST['payment_method'],
            "create_at" => date("Y-m-d H:i:s", time()),
            "fullname" => $_POST['fullname'],
            "address" => $_POST['address'],
            "phone_number" => $_POST['phone_number'],
        ]);
        
        // create bill detail and delete cart
        $bill_id = (new BillsModel)->getLastId();
        foreach($details as $detail){
            (new BilldetailsModel)->insert([
                "product_id" => $detail['product_id'],
                "bill_id" => $bill_id,
                "detail_id" => $detail['id'],
                "quantity" => $detail['quantity'],
                "price" => $detail['price'] * (1 - $detail['discount']/100),
                "category_id" => $detail['category_id'],
            ]);
            (new CartsModel)->delete($detail['id']);
        }
        echo json_encode("success");
    }
}
