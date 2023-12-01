<?php

namespace MVC\Controllers;

use MVC\Controller;
use MVC\Models\CategoriesModel;
use MVC\Models\ProductsModel;
use MVC\Models\MediasModel;
use MVC\Models\AccountsModel;
use MVC\Models\ProductdetailModel;

class AdminController extends Controller
{
    public function __construct(){
        if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) header("location: /");
    }
    public function index()
    {


        $this->render([
            "view" => "admin/index",
            "page" => "admin",
            "title" => "Dashboard",
            "action" => "1"
        ]);
    }
    public function category()
    {
        $categoryModel = new CategoriesModel();
        // get category
        $allCategory = $categoryModel->get();

        $this->render([
            "view" => "admin/category",
            "page" => "admin",
            "js" => "category",
            "title" => "Danh mục",
            "action" => "2",
            "allCategory" => $allCategory,
        ]);
    }
    public function product()
    {
        if(!isset($_SESSION['PRODUCT_LIMIT'])) $_SESSION['PRODUCT_LIMIT'] = 10;
        if(!isset($_GET['page']) || !isset($_GET['limit']) || !isset($_GET['order'])) header("location: /admin/product?page=1&limit=".$_SESSION['PRODUCT_LIMIT']."&order=DESC");
        if($_SESSION['PRODUCT_LIMIT'] != $_GET['limit']) $_SESSION['PRODUCT_LIMIT'] = $_GET['limit'];

        $productModel = new ProductsModel();
        $categoryModel = new CategoriesModel();
        $productDetailModel = new ProductdetailModel();
        $mediaModel = new MediasModel();

        $filterBase = [
            "id" => "ID",
            "name" => "Tên",
            "category_id" => "Danh mục",
            "discount" => "Giảm giá",
            "view" => "Lượt xem",
            "purchase" => "Lượt mua",
            "create_at" => "Ngày tạo",
        ];
        // --------------------------------------------
        // Get data để hiển thị ra view
        $numberOfAllProducts = $productModel->count(); // get number of product
        $numberOfPage = ceil($numberOfAllProducts / $_GET['limit']); // get number of page
        if($_GET['page'] > $numberOfPage) header("location: /admin/product?page=$numberOfPage&limit=".$_SESSION['PRODUCT_LIMIT']."&order=DESC");
        if($_GET['page'] < 1) header("location: /admin/product?page=1&limit=".$_SESSION['PRODUCT_LIMIT']."&order=DESC");

        
        if(isset($_GET['filter']) && in_array($_GET['filter'], array_keys($filterBase))) $orderBy = $_GET['filter'];
        else $orderBy = "id";

        $allProducts = $productModel->get([
            "orderBy" => $orderBy,
            "orderType" => $_GET['order'] ?? "DESC", // DESC or ASC
            "page" => $_GET['page'],
            "limit" => $_GET['limit'],
        ]); // get product
        $allCategory = $categoryModel->get(); // get category


        foreach ($allProducts as $index => $product) {
            $product_id = $product['id'];
            $allDetails = $productDetailModel->getByProductId($product_id); // get price by product id
            $allLinks = $mediaModel->getByProductId($product_id); // get image by product id

            $allProducts[$index]['category_id'] = $product['category_id'];
            $allProducts[$index]['category'] = $categoryModel->get(["id" => $product['category_id'],])['name']; // get category by id
            $allProducts[$index]['count'] = $productDetailModel->countByProductId($product_id)['count'] ?? 0; // get count by product id
            $allProducts[$index]['detail'] = [];

            $allProducts[$index]['image'] = [];
            foreach ($allLinks as $link) {
                $allProducts[$index]['image'][$link['id']] = $link['link'];
            }
            
            $allProducts[$index]['max_price'] = 0;
            $allProducts[$index]['min_price'] = 0;
            foreach ($allDetails as $detail) {
                $allProducts[$index]['detail'][] = [
                    "id" => $detail['id'],
                    "color" => $detail['color'],
                    "size" => $detail['size'],
                    "quantity" => $detail['quantity'],
                    "price" => $detail['price']
                ];
                if($detail['price'] > $allProducts[$index]['max_price']) $allProducts[$index]['max_price'] = $detail['price'];
                if($allProducts[$index]['min_price']==0 || $detail['price'] < $allProducts[$index]['min_price']) $allProducts[$index]['min_price'] = $detail['price'];
            }
        }

        // View
        $this->render([
            "view" => "admin/product",
            "page" => "admin",
            "title" => "Sản phẩm",
            "js" => "product",
            "action" => "3",
            "allProducts" => $allProducts,
            "allCategory" => $allCategory,
            "numberOfItems" => $numberOfAllProducts,
            "numberOfPage" => $numberOfPage,
            "filter" => $filterBase
        ]);
    }

    function comment()
    {
        $this->render([
            "view" => "admin/comment",
            "page" => "admin",
            "title" => "Bình luận",
            "action" => "4",
        ]);
    }
    function account()
    {
        if(!isset($_SESSION['ACCOUNT_LIMIT'])) $_SESSION['ACCOUNT_LIMIT'] = 10;
        if(!isset($_GET['page']) || !isset($_GET['limit']) || !isset($_GET['order'])) header("location: /admin/account?page=1&limit=".$_SESSION['ACCOUNT_LIMIT']."&order=ASC");
        if($_SESSION['ACCOUNT_LIMIT'] != $_GET['limit']) $_SESSION['ACCOUNT_LIMIT'] = $_GET['limit'];

        // init
        $accountModel = new AccountsModel();
        // delete
        if (isset($_GET["delete"])) {
            $id = $_GET["delete"];
            $accountModel->delete($id);
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit;
        }

        // update
        if (isset($_GET['update'])) {
            $id = $_GET['update'];
            $username = $_GET['username'];
            $password = $_GET['password'];
            $image = $_FILES['image'];
            $email = $_GET['email'];
            $phone_number = $_GET['phone_number'];
            $address = $_GET['address'];
            $fullname = $_GET['fullname'];
            $role = $_GET['role'];
            $dataUpdate = [
                "username" => $username,
                "password" => $password,
                "image" => $image,
                "email" => $email,
                "phone_number" => $phone_number,
                "address" => $address,
                "fullname" => $fullname,
                "role" => $role,
            ];
            $accountModel->update($dataUpdate, $id);
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $allAccount = $accountModel->get();
        $this->render([
            "view" => "admin/account",
            "page" => "admin",
            "title" => "Tài khoản",
            "action" => "5",
            "js" => "account",
            "allAccount" => $data,
            "filter" => $filterBase,
            "numberOfItems" => $numberOfAllAccounts,
            "numberOfPage" => $numberOfPage,
        ]);
    }
    function order()
    {

        $this->render([
            "view" => "admin/order",
            "page" => "admin",
            "title" => "Đơn hàng",
            "action" => "6",
        ]);
    }
}
