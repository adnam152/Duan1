<?php

namespace MVC\Controllers;

use MVC\Controller;
use MVC\Models\CategoriesModel;
use MVC\Models\ProductsModel;
use MVC\Models\MediasModel;
use MVC\Models\AccountsModel;
use MVC\Models\ProductdetailModel;
use MVC\Models\CommentsModel;

class AdminController extends Controller
{

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
            "title"=> "Danh mục",
            "action" => "2",
            "allCategory" => $allCategory,
        ]);
    }

    // Product
    public function product()
    {
        $productModel = new ProductsModel();
        $categoryModel = new CategoriesModel();
        $productDetailModel = new ProductdetailModel();
        $mediaModel = new MediasModel();

        // --------------------------------------------
        // Get data để hiển thị ra view
        $allProducts = $productModel->get(); // get product
        $allCategory = $categoryModel->get(); // get category
        foreach ($allProducts as $index => $product) {
            $product_id = $product['id'];
            $allDetails = $productDetailModel->getByProductId($product_id); // get price by product id
            $allLinks = $mediaModel->getByProductId($product_id); // get image by product id

            $allProducts[$index]['category_id'] = $product['category_id'];
            $allProducts[$index]['category'] = $categoryModel->get($product['category_id'])['name']; // get category by id
            $allProducts[$index]['count'] = $productDetailModel->countByProductId($product_id)['count'] ?? 0; // get count by product id
            $allProducts[$index]['detail'] = [];

            $allProducts[$index]['image'] = [];
            foreach ($allLinks as $link) {
                $allProducts[$index]['image'][$link['id']] = $link['link'];
            }
            foreach ($allDetails as $detail) {
                $allProducts[$index]['detail'][] = [
                    "id" => $detail['id'],
                    "color" => $detail['color'],
                    "size" => $detail['size'],
                    "quantity" => $detail['quantity'],
                    "price" => $detail['price'],
                ];
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
        ]);
    }
    
    function comment()
    {


        $commentmodel = new CommentsModel();
        $Allcomment = $commentmodel->get();
        
        if (isset($_POST["delete"])) {
            $id = $_POST["delete"];
            $commentmodel->delete($id);
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit;
        }

        

        $this->render([
            "view" => "admin/comment",
            "page" => "admin",
            "title"=> "Bình luận",
            "action" => "4",
            "comments" => $Allcomment
        ]);
    }
    function account()
    {
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
            $accountModel->update($id,$username,$password,$image,$email,$phone_number,$address,$fullname,$role);
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $allAccount = $accountModel->get();
        $this->render([
            "view" => "admin/account",
            "page" => "admin",
            "title" => "Tài khoản",
            "action" => "5",
            "allAccount" => $allAccount,
        ]);
    }
    function order(){
        $this->render([
            "view" => "admin/order",
            "page" => "admin",
            "title"=> "Đơn hàng",
            "action" => "6",
        ]);
    }
}
