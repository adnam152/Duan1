<?php

namespace MVC\Controllers;

use MVC\Controller;
use MVC\Models\CategoriesModel;
use MVC\Models\ProductsModel;
use MVC\Models\SizesModel;
use MVC\Models\ColorsModel;
use MVC\Models\PricingModel;
use MVC\Models\MediasModel;
use MVC\Models\AccountsModel;


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
        $sizeModel = new SizesModel();
        $colorModel = new ColorsModel();
        $pricingModel = new PricingModel();
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
            $image = $_FILES['product_image'];

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
                // Insert size
                if (!$sizeModel->isExist([
                    "product_id" => $product_id,
                    "size" => $product_size,
                ])) { // kiểm tra nếu chưa tồn tại size thì thêm mới
                    $size_data = [
                        "product_id" => $product_id,
                        "size" => $product_size,
                    ];
                    $sizeModel->insert($size_data); // insert size
                    $size_id = $sizeModel->getLastId(); //lấy id của size vừa thêm vào
                } else $size_id = $sizeModel->getByColumn([
                    "product_id" => $product_id,
                    "size" => $product_size,
                ])['id']; // nếu đã tồn tại size thì lấy ra size_id
                // --------------------------------------------
                // Insert color
                if (!$colorModel->isExist([
                    "product_id" => $product_id,
                    "color" => $product_color,
                ])) { // kiểm tra nếu chưa tồn tại color thì thêm mới
                    $color_data = [
                        "product_id" => $product_id,
                        "color" => $product_color,
                    ];
                    $colorModel->insert($color_data); // insert color
                    $color_id = $colorModel->getLastId(); //lấy id của color vừa thêm vào
                } else $color_id = $colorModel->getByColumn([
                    "product_id" => $product_id,
                    "color" => $product_color,
                ])['id']; // nếu đã tồn tại color thì lấy ra color_id
                // --------------------------------------------
                // Insert pricing
                if (!$pricingModel->isExist([
                    "product_id" => $product_id,
                    "size_id" => $size_id,
                    "color_id" => $color_id,
                ])) { // kiểm tra nếu chưa tồn tại pricing thì thêm mới
                    $pricing_data = [
                        "product_id" => $product_id,
                        "size_id" => $size_id,
                        "color_id" => $color_id,
                        "quantity" => $product_quantity,
                        "price" => $product_price,
                    ];
                    $pricingModel->insert($pricing_data); // insert pricing
                }
                // --------------------------------------------
                // Insert media
                if ($image['name']) { // kiểm tra nếu có ảnh thì thêm mới
                    $link = './assets/image/' . $image['name'];
                    if (move_uploaded_file($image['tmp_name'], $link)) {
                        $media_data = [
                            "product_id" => $product_id,
                            "link" => $link,
                        ];
                        $mediaModel->insert($media_data); // insert media
                    }
                }
            }
            header("location:" . $_SERVER['HTTP_REFERER']);
            exit;
        }

        // --------------------------------------------
        // Get data để hiển thị ra view
        $allProducts = $productModel->get(); // get product
        $allCategory = $categoryModel->get(); // get category
        foreach ($allProducts as $index => $product) {
            $product_id = $product['id'];
            $allPrices = $pricingModel->getByProductId($product_id); // get price by product id
            $allLinks = $mediaModel->getByProductId($product_id); // get image by product id

            $allProducts[$index]['category_id'] = $product['category_id'];
            $allProducts[$index]['category'] = $categoryModel->get($product['category_id'])['name']; // get category by id
            $allProducts[$index]['count'] = $pricingModel->countByProductId($product_id)['count']; // get count by product id

            $allProducts[$index]['image'] = [];
            foreach ($allLinks as $link) {
                $allProducts[$index]['image'][] = $link['link'];
            }
            foreach ($allPrices as $price) {
                $allProducts[$index]['detail'][] = [
                    "color_id" => $price['color_id'],
                    "color" => $colorModel->get($price['color_id'])['color'],
                    "size_id" => $price['size_id'],
                    "size" => $sizeModel->get($price['size_id'])['size'],
                    "quantity" => $price['quantity'],
                    "price" => $price['price'],
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
