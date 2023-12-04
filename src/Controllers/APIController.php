<?php

namespace MVC\Controllers;

use MVC\Models\CategoriesModel;
use MVC\Models\ProductsModel;
use MVC\Models\ProductdetailModel;
use MVC\Models\MediasModel;
use MVC\Models\AccountsModel;
use MVC\Models\CommentsModel;
use MVC\Models\CartsModel;
use MVC\Models\BillsModel;
use MVC\Models\BilldetailsModel;

class APIController
{
    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
            exit('error');
        }
    }
    public function category()
    {
        $categoryModel = new CategoriesModel();
        // add category
        if (isset($_POST["add_category"])) {
            $category_name = $_POST["category_name"];
            if ($categoryModel->insert([
                "name" => $category_name,
            ])) {
                $id = $categoryModel->getLastId();
                echo json_encode([
                    "id" => $id,
                    "name" => $category_name
                ]);
            }
            exit;
        }

        // delete
        if (isset($_GET["delete"])) {
            $id = $_GET["category_id"];
            if ($categoryModel->delete($id) > 0) echo json_encode("success");
            else echo json_encode("error");
            exit;
        }

        // update
        if (isset($_POST['update'])) {
            $id = $_POST['category_id'];
            $category_name = $_POST['category_name'];
            if ($categoryModel->update([
                "name" => $category_name
            ], $id) > 0) echo json_encode([
                "id" => $id,
                "name" => $category_name
            ]);
            else echo json_encode("error");
            exit;
        }
    }
    public function product()
    {
        $productModel = new ProductsModel();
        $productDetailModel = new ProductdetailModel();
        $categoryModel = new CategoriesModel();
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
            if ($product_name && $product_size && $product_color && $product_category) {
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
                if (count($images['name']) > 0) {
                    foreach ($images['name'] as $index => $image) {
                        $link = '/assets/image/' . $image;
                        if (move_uploaded_file($images['tmp_name'][$index], '.' . $link)) {
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

        // add image
        if (isset($_POST['post_img']) && isset($_POST['product_id'])) {
            // add
            $product_id = $_POST['product_id'];
            $images = $_FILES['add_img'];
            $result = [];
            if (count($images['name']) > 0) {
                foreach ($images['name'] as $index => $image) {
                    $link = '/assets/image/' . $image;
                    if (move_uploaded_file($images['tmp_name'][$index], '.' . $link)) {
                        $media_data = [
                            "product_id" => $product_id,
                            "link" => $link,
                        ];
                        if ($mediaModel->insert($media_data) > 0) {
                            $data = [
                                "id" => $mediaModel->getLastId(),
                                "link" => $link,
                            ];
                            $result[] = $data;
                        }
                    }
                }
            }
            echo json_encode(empty($result) ? "error" : $result);
            exit;
        }

        // update infor
        if (isset($_POST['update'])) {
            $product_id = $_POST['product_id'];
            $detail_id = $_POST['detail_id'];

            $productUpdate = [];
            $detailUpdate = [];

            $_POST['product_name'] && $productUpdate['name'] = $_POST['product_name'];
            $_POST['product_discount'] && $productUpdate['discount'] = $_POST['product_discount'];
            $_POST['product_description'] && $productUpdate['description'] = $_POST['product_description'];
            $_POST['product_category'] && $productUpdate['category_id'] = $_POST['product_category'];

            $_POST['product_size'] && $detailUpdate['size'] = $_POST['product_size'];
            $_POST['product_color'] && $detailUpdate['color'] = $_POST['product_color'];
            $_POST['product_quantity'] && $detailUpdate['quantity'] = $_POST['product_quantity'];
            $_POST['product_price'] && $detailUpdate['price'] = $_POST['product_price'];

            $categoryName = $categoryModel->get([
                "id" => $_POST['product_category']
            ])['name'];
            $allData = array_merge($productUpdate, $detailUpdate);
            $allData['category_name'] = $categoryName;
            $allData['message'] = "Thành công";

            $rowProductUpdate = $productModel->update($productUpdate, $product_id);
            $rowDetailUpdate = $productDetailModel->update($detailUpdate, $detail_id);
            if ($rowProductUpdate + $rowDetailUpdate > 0) {
                echo json_encode($allData);
            } else echo json_encode("error");
            exit;
        }

        // delete product
        if (isset($_GET['delete']) && isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];
            $productDetailModel->deleteByProductId($product_id);
            $mediaModel->deleteByProductId($product_id);
            if ($productModel->delete($product_id) > 0) echo json_encode("success");
            exit;
        }

        // delete detail
        if (isset($_GET['delete_detail']) && isset($_GET['detail_id'])) {
            $detail_id = $_GET['detail_id'];
            if ($productDetailModel->delete($detail_id) > 0) echo json_encode("success");
            exit;
        }

        // delete image
        if (isset($_GET['delete_img']) && isset($_GET['img_id'])) {
            $img_id = $_GET['img_id'];
            if ($mediaModel->delete($img_id) > 0) echo json_encode("success");
            exit;
        }
    }
    public function comment()
    {
        if (isset($_GET['delete']) && isset($_GET['id'])) {
            $commentModel = new CommentsModel();
            if ($commentModel->delete($_GET['id']) > 0) echo json_encode("success");
            else echo json_encode("error");
            exit;
        }
    }
    public function account()
    {
        $accountModel = new AccountsModel();
        // add
        if (isset($_POST['add'])) {
            // Kiểm tra tồn tại
            if ($accountModel->isExist([
                "username" => $_POST['username'],
            ]) > 0) {
                echo json_encode("error");
                exit;
            }
            $image = $_FILES['user_image'];
            if ($image['name'] != "") {
                $link = './assets/image/' . $image['name'];
                if (move_uploaded_file($image['tmp_name'], $link)) {
                    $image = '/assets/image/' . $image['name'];
                }
            } else $image = "";

            $dataInsert = [
                "username" => $_POST['username'],
                "password" => $_POST['password'],
                "image" => $image,
                "email" => $_POST['email'],
                "phone_number" => $_POST['phone_number'],
                "address" => $_POST['address'],
                "fullname" => $_POST['fullname'],
                "role" => $_POST['role'],
                "create_at" => date("Y-m-d H:i:s", time()),
            ];
            if ($accountModel->insert($dataInsert) > 0)
                echo json_encode("success");
            exit;
        }

        // delete
        if (isset($_GET["delete"])) {
            $id = $_GET["delete"];
            $accountModel->delete($id);
            echo json_encode("success");
            exit;
        }

        // update
        if (isset($_POST['update'])) {
            if ($accountModel->check($_POST['id'], $_POST['username'])) {
                echo json_encode("exist username");
                exit;
            }
            $dataUpdate = [
                "username" => $_POST['username'],
                "password" => $_POST['password'],
                "email" => $_POST['email'],
                "phone_number" => $_POST['phone_number'],
                "address" => $_POST['address'],
                "fullname" => $_POST['fullname'],
                "role" => $_POST['role'],
            ];
            if ($accountModel->update($dataUpdate, $_POST['id']) > 0)
                echo json_encode($dataUpdate);
            else echo json_encode("error");
            exit;
        }

        // update image
        if (isset($_POST['update_image'])) {
            $image = $_FILES['image'];
            if ($image['name'] != "") {
                $link = '/assets/image/' . $image['name'];
                if (move_uploaded_file($image['tmp_name'], '.' . $link)) {
                    $image = $link;
                }
            } else $image = "";
            $dataUpdate = [
                "image" => $image,
            ];
            if ($accountModel->update($dataUpdate, $_POST['id']) > 0)
                echo json_encode($dataUpdate);
            else echo json_encode("error");
            exit;
        }
    }
    public function order()
    {
        // Update status
        if (isset($_GET['updatestatus'])) {
            if((new BillsModel())->update(['ispay' => 1], $_GET['updatestatus']) > 0)
                echo json_encode("success");
            exit;
        }
        // Delete
        if (isset($_GET['delete'])) {
            if((new BillsModel())->delete($_GET['delete']))
                echo json_encode("success");
            exit;
        }
    }
}
