<?php

namespace MVC\Controllers;

use MVC\Models\ProductsModel;
use MVC\Models\ProductdetailModel;
use MVC\Models\CommentsModel;
use MVC\Models\CartsModel;
use MVC\Models\BillsModel;
use MVC\Models\BilldetailsModel;
use MVC\Models\MediasModel;
use MVC\Models\AccountsModel;

class UserAPIController
{
    public function user()
    {
        if (isset($_SESSION['user'])) echo json_encode(["id" => $_SESSION['user']['id']]);
        else echo json_encode("error");
    }
    public function tempuser()
    {
        if (!isset($_SESSION['user'])) :
            if (isset($_POST['add'])) :
                $_SESSION['temp_user'] = [
                    "id" => 0,
                    "fullname" => $_POST['fullname'],
                    "address" => $_POST['address'],
                    "phone_number" => $_POST['phone_number'],
                ];
                echo json_encode("success");
            endif;
        endif;
    }
    public function profile()
    {
        if (isset($_SESSION['user'])) {
            if (!empty($_FILES['avatar']['name'])) {
                $target_dir = "/assets/image/";
                $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
                $check = getimagesize($_FILES["avatar"]["tmp_name"]);
                if ($check !== false) {
                    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], '.' . $target_file)) {
                        $avatar = $target_file;
                    }
                }
            } else $avatar = $_SESSION['user']['image'];
            if ((new AccountsModel)->update([
                "fullname" => $_POST['fullname'],
                "address" => $_POST['address'],
                "phone_number" => $_POST['phone_number'],
                "email" => $_POST['email'],
                "image" => $avatar,
            ], $_SESSION['user']['id'])) {
                // set session
                $_SESSION['user']['fullname'] = $_POST['fullname'];
                $_SESSION['user']['address'] = $_POST['address'];
                $_SESSION['user']['phone_number'] = $_POST['phone_number'];
                $_SESSION['user']['email'] = $_POST['email'];
                $_SESSION['user']['image'] = $avatar;
                echo json_encode("success");
            }
        } else echo json_encode("error");
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
        $detailId = $detail['id'];

        // Nếu chưa đăng nhập thì lưu vào session
        if (!isset($_SESSION['user'])) {
            $_SESSION['cart'][] = [
                "detail_id" => $detailId,
                "quantity" => $_POST['quantity'],
            ];
            echo json_encode("success");
            exit;
        }
        // Nếu đã đăng nhập thì lưu vào database
        if (isset($detail['quantity']) && $detail['quantity'] >= $_POST['quantity']) {
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
    public function increasequantity()
    {
        if (isset($_GET['id'])) {
            $cart_id = $_GET['id'];
            if (!isset($_SESSION['user'])) {
                $_SESSION['cart'][$cart_id]['quantity']++;
                echo json_encode("success");
                exit;
            }
            $cartModel = new CartsModel();
            $cart = $cartModel->get(["id" => $cart_id]);
            $detail = (new ProductdetailModel)->get(["id" => $cart['detail_id']]);
            if ($detail['quantity'] > $cart['quantity']) {
                $cartModel->update([
                    "quantity" => $cart['quantity'] + 1,
                ], $cart_id);
                echo json_encode("success");
                exit;
            } else echo json_encode("error");
        }
        echo json_encode("error");
    }
    public function decreasequantity()
    {
        if (isset($_GET['id'])) {
            $cart_id = $_GET['id'];
            if (!isset($_SESSION['user'])) {
                $_SESSION['cart'][$cart_id]['quantity']--;
                echo json_encode("success");
                exit;
            }
            $cartModel = new CartsModel();
            $cart = $cartModel->get(["id" => $cart_id]);
            if ($cart['quantity'] > 1) {
                $cartModel->update([
                    "quantity" => $cart['quantity'] - 1,
                ], $cart_id);
                echo json_encode("success");
                exit;
            } else echo json_encode("error");
        }
        echo json_encode("error");
    }
    public function removefromcart()
    {
        if (!isset($_SESSION['user']) && isset($_SESSION['cart']) && isset($_GET['id'])) :
            unset($_SESSION['cart'][$_GET['id']]);
            echo json_encode("success");
            exit;
        elseif (isset($_GET['id'])) :
            if ((new CartsModel)->delete($_GET['id']) > 0) {
                echo json_encode("success");
                exit;
            }
        endif;
        echo json_encode("error");
    }
    public function confirmBill()
    {
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // exit;
        if (!isset($_POST['cart_id']) || empty($_POST['cart_id'])) {
            echo json_encode("error");
            exit;
        }
        $totalPrice = 0;
        $details = [];
        if (!isset($_SESSION['user'])) :
            foreach ($_SESSION['cart'] as $id => $cart) :
                $temp = (new CartsModel)->getDetailBySession($id);
                $totalPrice += $temp['price'] * $temp['quantity'] * (1 - $temp['discount'] / 100);
                $details[] = array_merge($temp, ['id' => $cart['detail_id']]);
            endforeach;
        else :
            foreach ($_POST['cart_id'] as $id) {
                $temp = (new CartsModel)->getDetail($id);
                $totalPrice += $temp['price'] * $temp['quantity'] * (1 - $temp['discount'] / 100);
                $details[] = $temp;
            }
        endif;

        // create bill
        $account_id = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
        (new BillsModel)->insert([
            "account_id" => $account_id,
            "total_price" => $totalPrice,
            "pay_method" => $_POST['payment_method'],
            "create_at" => date("Y-m-d H:i:s", time()),
            "fullname" => $_POST['fullname'],
            "address" => $_POST['address'],
            "phone_number" => $_POST['phone_number'],
            "update_at" => date("Y-m-d H:i:s", time()),
        ]);

        // create bill detail and delete cart
        $bill_id = (new BillsModel)->getLastId();
        foreach ($details as $detail) {
            (new BilldetailsModel)->insert([
                "product_id" => $detail['product_id'],
                "bill_id" => $bill_id,
                "detail_id" => $detail['detail_id'],
                "quantity" => $detail['quantity'],
                "price" => $detail['price'] * (1 - $detail['discount'] / 100),
                "category_id" => $detail['category_id'],
            ]);
            // Xóa giỏ hàng
            if (isset($_SESSION['user'])) (new CartsModel)->delete($detail['id']);
            else unset($_SESSION['cart']);

            // Tăng số lượng đã bán và giảm số lượng tồn kho
            (new ProductsModel)->increasePurchase($detail['product_id'], $detail['quantity']);
            (new ProductdetailModel)->decreaseQuantity($detail['id'], $detail['quantity']);
        }
        echo json_encode("success");
    }
    function topSeller()
    {
        $topSeller = (new ProductsModel())->getTopSeller();
        $data = [];
        foreach ($topSeller as $index => $product) {
            $data[$index] = $product;
            $images = (new MediasModel())->getByProductId($product['id'], 2);
            $data[$index]['image'][] = $images[0]['link'];
            $data[$index]['image'][] = $images[1]['link'];
        }
        echo json_encode($data);
    }
}
