<?php

namespace MVC\Controllers;

use MVC\Controller;
use MVC\Models\CategoriesModel;
use MVC\Models\ProductsModel;
use MVC\Models\MediasModel;
use MVC\Models\AccountsModel;
use MVC\Models\ProductdetailModel;

use MVC\Models\BillsModel;
use MVC\Models\BilldetailsModel;
use MVC\Models\CommentsModel;


class AdminController extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) header("location: /");
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
        if (!isset($_SESSION['PRODUCT_LIMIT'])) $_SESSION['PRODUCT_LIMIT'] = 10;
        if (!isset($_GET['page']) || !isset($_GET['limit']) || !isset($_GET['order'])) header("location: /admin/product?page=1&limit=" . $_SESSION['PRODUCT_LIMIT'] . "&order=ASC");
        if ($_SESSION['PRODUCT_LIMIT'] != $_GET['limit']) $_SESSION['PRODUCT_LIMIT'] = $_GET['limit'];

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
        $numberOfPage = $numberOfPage > 0 ? $numberOfPage : 1;
        if ($_GET['page'] > $numberOfPage) header("location: /admin/product?page=$numberOfPage&limit=" . $_SESSION['PRODUCT_LIMIT'] . "&order=ASC");
        if ($_GET['page'] < 1) header("location: /admin/product?page=1&limit=" . $_SESSION['PRODUCT_LIMIT'] . "&order=ASC");


        if (isset($_GET['filter']) && in_array($_GET['filter'], array_keys($filterBase))) $orderBy = $_GET['filter'];
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
            $allProducts[$index]['category'] = $categoryModel->get([
                "id" => $product['category_id'],
            ])['name']; // get category by id
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
                if ($detail['price'] > $allProducts[$index]['max_price']) $allProducts[$index]['max_price'] = $detail['price'];
                if ($allProducts[$index]['min_price'] == 0 || $detail['price'] < $allProducts[$index]['min_price']) $allProducts[$index]['min_price'] = $detail['price'];
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
        if (!isset($_SESSION['COMMENT_LIMIT'])) $_SESSION['COMMENT_LIMIT'] = 10;
        if (!isset($_GET['page']) || !isset($_GET['limit']) || !isset($_GET['order'])) header("location: /admin/comment?page=1&limit=" . $_SESSION['COMMENT_LIMIT'] . "&order=ASC");
        if ($_SESSION['COMMENT_LIMIT'] != $_GET['limit']) $_SESSION['COMMENT_LIMIT'] = $_GET['limit'];

        $commentModel = new CommentsModel();
        $filterBase = [
            "username" => "Tên tài khoản",
            "create_at" => "Thời gian",
        ];
        // --------------------------------------------
        // Get data để hiển thị ra view
        $numberOfAllComments = $commentModel->count(); // get number of product
        $numberOfPage = ceil($numberOfAllComments / $_GET['limit']); // get number of page
        $numberOfPage = $numberOfPage > 0 ? $numberOfPage : 1;
        if ($_GET['page'] > $numberOfPage) header("location: /admin/comment?page=$numberOfPage&limit=" . $_SESSION['COMMENT_LIMIT'] . "&order=ASC");
        if ($_GET['page'] < 1) header("location: /admin/comment?page=1&limit=" . $_SESSION['COMMENT_LIMIT'] . "&order=ASC");

        if (isset($_GET['filter']) && in_array($_GET['filter'], array_keys($filterBase))) $orderBy = $_GET['filter'];
        else $orderBy = "id";

        $allComment = $commentModel->get([
            "orderBy" => $orderBy,
            "orderType" => $_GET['order'] ?? "DESC", // DESC or ASC
            "page" => is_int($_GET['page']) && $_GET['page'] > 0 ? $_GET['page'] : 1,
            "limit" => $_GET['limit'],
        ]); // get product

        $this->render([
            "view" => "admin/comment",
            "page" => "admin",
            "title" => "Bình luận",
            "action" => "4",
            "filter" => $filterBase,
            "allComment" => $allComment,
            "numberOfItems" => $numberOfAllComments,
            "numberOfPage" => $numberOfPage,
        ]);
    }
    function account()
    {
        if (!isset($_SESSION['ACCOUNT_LIMIT'])) $_SESSION['ACCOUNT_LIMIT'] = 10;
        if (!isset($_GET['page']) || !isset($_GET['limit']) || !isset($_GET['order'])) header("location: /admin/account?page=1&limit=" . $_SESSION['ACCOUNT_LIMIT'] . "&order=ASC");
        if ($_SESSION['ACCOUNT_LIMIT'] != $_GET['limit']) $_SESSION['ACCOUNT_LIMIT'] = $_GET['limit'];

        // init
        $accountModel = new AccountsModel();
        $categoryModel = new CategoriesModel();
        $billModel = new BillsModel();
        $billDetailModel = new BilldetailsModel();
        $filterBase = [
            "id" => "ID",
            "username" => "Tên tài khoản",
            "fullname" => "Họ tên",
            "role" => "Vai trò",
            "create_at" => "Ngày tạo",
        ];

        $numberOfAllAccounts = $accountModel->count(); // get number of product
        $numberOfPage = ceil($numberOfAllAccounts / $_GET['limit']); // get number of page
        $numberOfPage = $numberOfPage > 0 ? $numberOfPage : 1;
        if ($_GET['page'] > $numberOfPage) header("location: /admin/account?page=$numberOfPage&limit=" . $_SESSION['ACCOUNT_LIMIT'] . "&order=ASC");
        if ($_GET['page'] < 1) header("location: /admin/account?page=1&limit=" . $_SESSION['ACCOUNT_LIMIT'] . "&order=ASC");

        if (isset($_GET['filter']) && in_array($_GET['filter'], array_keys($filterBase))) $orderBy = $_GET['filter'];
        else $orderBy = "id";
        $allAccount = $accountModel->get([
            "orderBy" => $orderBy,
            "orderType" => $_GET['order'] ?? "DESC", // DESC or ASC
            "page" => $_GET['page'],
            "limit" => $_GET['limit'],
        ]);
        $allCategory = $categoryModel->get(); // get category
        $data = []; //lưu tất cả dữ liệu account

        foreach ($allAccount as $index => $account) {
            $id = $account['id'];
            $data[$index] = $account;
            $data[$index]['count_order'] = $billModel->countOrderByUserId($id);
            foreach ($allCategory as $category) {
                $data[$index]['count_order_by_category'][$category['name']] = $billDetailModel->countOrderByUserIdAndCategoryId($id, $category['id']);
            }
        }
        $numberOfAllAccounts = $accountModel->count();
        $numberOfPage = ceil($numberOfAllAccounts / $_GET['limit']);
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
        if (!isset($_SESSION['ORDER_LIMIT'])) $_SESSION['ORDER_LIMIT'] = 10;
        if (!isset($_GET['page']) || !isset($_GET['limit']) || !isset($_GET['order'])) header("location: /admin/order?page=1&limit=" . $_SESSION['ORDER_LIMIT'] . "&order=DESC");
        if ($_SESSION['ORDER_LIMIT'] != $_GET['limit']) $_SESSION['ORDER_LIMIT'] = $_GET['limit'];
        $filterBase = [
            "id" => "ID",
            "account_id" => "Tên tài khoản",
            "create_at" => "Ngày tạo",
            "total_price" => "Tổng tiền",
            "ispay" => "Trạng thái",
        ];
        // GET DATA
        if (isset($_GET['filter']) && in_array($_GET['filter'], array_keys($filterBase))) $orderBy = $_GET['filter'];
        else $orderBy = "id";
        $allBills = (new BillsModel())->get([
            "orderBy" => $orderBy,
            "orderType" => $_GET['order'] ?? "DESC",
            "page" => $_GET['page'] ?? 1,
            "limit" => $_GET['limit'] ?? 10,
        ]);
        foreach ($allBills as $index => $bill) {
            $allBills[$index]['bill_detail'] = (new BilldetailsModel())->getByBillId($bill['id']);
        }

        $numberOfAllBills = (new BillsModel())->count();
        $numberOfPage = ceil($numberOfAllBills / $_SESSION['ORDER_LIMIT']);
        $numberOfPage = $numberOfPage > 0 ? $numberOfPage : 1;
        if ($_GET['page'] > $numberOfPage) header("location: /admin/order?page=$numberOfPage&limit=" . $_SESSION['ORDER_LIMIT'] . "&order=DESC");
        if ($_GET['page'] < 1) header("location: /admin/order?page=1&limit=" . $_SESSION['ORDER_LIMIT'] . "&order=DESC");

        $this->render([
            "view" => "admin/order",
            "page" => "admin",
            "title" => "Đơn hàng",
            "action" => "6",
            "numberOfItems" => $numberOfAllBills,
            "numberOfPage" => $numberOfPage,
            "filter" => $filterBase,
            "allBills" => $allBills,
        ]);
    }
}
