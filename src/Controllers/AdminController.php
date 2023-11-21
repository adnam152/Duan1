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

        // add category
        if (isset($_GET["add"]) && isset($_GET["category_name"])) {
            $category_name = $_GET["category_name"];
            $categoryModel->insert([
                "name" => $category_name,
            ]);
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

        // add
        if (isset($_POST['add'])) {
            // Get
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'] ?? 0;
            $product_discount = $_POST['product_discount'] ?? 0;
            $product_size = $_POST['product_size'];
            $product_color = $_POST['product_color'];
            $product_quantity = $_POST['product_quantity'] ?? 0;
            $product_description = $_POST['product_description'] ?? '';
            $product_category = $_POST['product_category'];
            $images = $_FILES['product_image'];

            // Nếu đủ dữ liệu thì thêm
            // Tên, size, color, category, quantity không được để trống
            if ($product_name && $product_size && $product_color && $product_category && $product_quantity) {
                // --------------------------------------------
                // Insert product - get product_id
                if ($productModel->isExist([
                    "name" => $product_name,
                    "category_id" => $product_category,
                ])) { // Kiểm tra nếu đã tồn tại tên sản phẩm thì lấy ra product_id
                    $product_id = $productModel->getByColumn([
                        "name" => $product_name,
                        "category_id" => $product_category,
                    ])['id'];
                } else { // nếu chưa tồn tại sản phẩm thì thêm mới
                    $product_data = [  //data của product cần thêm, key là tên cột trong database, value là giá trị
                        "name" => $product_name,
                        "discount" => $product_discount,
                        "description" => $product_description,
                        "category_id" => $product_category,
                        "create_at" => date("Y-m-d H:i:s", time()),
                    ];
                    $productModel->insert($product_data); // insert product
                    $product_id = $productModel->getLastId(); //lấy id của product vừa thêm vào
                }

                // --------------------------------------------
                // Insert detail
                if (!$productDetailModel->isExist([
                    "product_id" => $product_id,
                    "size" => $product_size,
                    "color" => $product_color,
                ])) { // kiểm tra nếu chưa tồn tại pricing thì thêm mới
                    $pricing_data = [
                        "product_id" => $product_id,
                        "size" => $product_size,
                        "color" => $product_color,
                        "quantity" => $product_quantity,
                        "price" => $product_price,
                    ];
                    $productDetailModel->insert($pricing_data); // insert pricing
                }
                // --------------------------------------------
                // Insert media
                // echo "<pre>";
                // print_r($images);
                // echo "</pre>";
                if(count($images['name']) > 0){
                    foreach ($images['name'] as $index => $image) {
                        $link = './assets/image/' . $image;
                        if(move_uploaded_file($images['tmp_name'][$index], $link)){
                            $media_data = [
                                "product_id" => $product_id,
                                "link" => $link,
                            ];
                            $mediaModel->insert($media_data); // insert media
                        }
                    }
                }
            }
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit;
        }

        // update
        if(isset($_POST['update'])){
            // Get
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'] ?? 0;
            $product_discount = $_POST['product_discount'] ?? 0;
            $product_size = $_POST['product_size'];
            $product_color = $_POST['product_color'];
            $product_quantity = $_POST['product_quantity'] ?? 0;
            $product_description = $_POST['product_description'] ?? '';
            $product_category = $_POST['product_category'];
            $images = $_FILES['product_image'];

            // if($product_id) 
        }

        // delete  
        if(isset($_GET['delete']) && isset($_GET['product_id'])){
            $product_id = $_GET['product_id'];
            $productDetailModel->deleteByProductId($product_id);
            $mediaModel->deleteByProductId($product_id);
            $productModel->delete($product_id);
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit;
        }

        // delete detail
        if(isset($_GET['delete_detail']) && isset($_GET['detail_id'])){
            $detail_id = $_GET['detail_id'];
            $productDetailModel->delete($detail_id);
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit;
        }


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
                $allProducts[$index]['image'][] = $link['link'];
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
            "action" => "3",
            "allProducts" => $allProducts,
            "allCategory" => $allCategory,
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
            "action" => "4",
            "allAccount" => $allAccount,
        ]);
    }
    function comment()
    {
        $this->render([
            "view" => "admin/comment",
            "page" => "admin",
            "title"=> "Bình luận",
            "action" => "5",
        ]);
    }
    function order()
    {
        $this->render([
            "view" => "admin/order",
            "page" => "admin",
            "title"=> "Đơn hàng",
            "action" => "6",
        ]);
    }
}
