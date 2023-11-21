<?php

namespace MVC\Controllers;

use MVC\Controller;
use MVC\Models\CategoriesModel;
use MVC\Models\ProductsModel;
use MVC\Models\CommentsModel;

class AdminController extends Controller
{

    public function index()
    {


        $this->render([
            "view" => "admin/index",
            "page" => "admin",
        ]);
    }
    public function category()
    {
        $categoryModel = new CategoriesModel();

        // add category
        if (isset($_GET["add"]) && isset($_GET["category_name"])) {
            $category_name = $_GET["category_name"];
            $categoryModel->create($category_name);
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit;
        }

        // delete
        if (isset($_GET["delete"])) {
            $id = $_GET["delete"];
            $categoryModel->delete($id);
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit;
        }

        // update
        if (isset($_GET['update'])) {
            $id = $_GET['update'];
            $category_name = $_GET['category_name'];
            $categoryModel->update($id, $category_name);
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit;
        }

        // get category
        $allCategory = $categoryModel->get();

        $this->render([
            "view" => "admin/category",
            "page" => "admin",
            "action" => "2",
            "allCategory" => $allCategory,
        ]);
    }

    // Product
    public function product()
    {
        $productModel = new ProductsModel();
        $categoryModel = new CategoriesModel();

        $allCategory = $categoryModel->get();

        // get product
        $allProducts = $productModel->get();

        // add
        if (isset($_GET['add'])) {
            $product_name = $_GET['product_name'] ?? null;
            $product_price = $_GET['product_price'] ?? null;
            $product_discount = $_GET['product_discount'] ?? null;
            $product_size = $_GET['product_size'] ?? null;
            $product_color = $_GET['product_color'] ?? null;
            $product_quantity = $_GET['product_quantity'] ?? null;
            $product_description = $_GET['product_description'] ?? null;
            $product_category = $_GET['product_category'] ?? null;
        }

        //get product
        $allProducts = $productModel->get();

        // View
        $this->render([
            "view" => "admin/product",
            "page" => "admin",
            "action" => "3",
            "allProducts" => $allProducts,
            "allCategory" => $allCategory,
        ]);
    }
    function user()
    {
        $this->render([
            "view" => "admin/user",
            "page" => "admin",
            "action" => "4",
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
            "action" => "5",
            "comments" => $Allcomment
        ]);
    }
    
    function order()
    {
        $this->render([
            "view" => "admin/order",
            "page" => "admin",
            "action" => "6",
        ]);
    }
}
