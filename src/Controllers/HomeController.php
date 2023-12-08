<?php

namespace MVC\Controllers;

use MVC\Controller;
use MVC\Models\CategoriesModel;
use MVC\Models\CartsModel;
use MVC\Models\ProductsModel;
use MVC\Models\MediasModel;
use MVC\Models\ProductdetailModel;
use MVC\Models\CommentsModel;
use MVC\Models\BillsModel;
use MVC\Models\BilldetailsModel;

class HomeController extends Controller
{
    private $allCategory;
    public function __construct()
    {
        parent::__construct();
        $this->allCategory = (new CategoriesModel())->get();
    }
    public function index()
    {
        $this->render([
            "view" => "user/home",
            "page" => "home",
            "title" => "Trang chủ",
            "allCategory" => $this->allCategory,
            "numberOfCart" => $this->numberOfCart,
        ]);
    }
    public function allproduct()
    {
        $filterPrice = [
            "0-200000" => "Dưới 200.000đ",
            "200000-500000" => "200.000đ - 500.000đ",
            "500000-1000000" => "500.000đ - 1.000.000đ",
            "1000000-2000000" => "1.000.000đ - 2.000.000đ",
            "2000000-" => "Trên 2.000.000đ",
        ];
        $filterOrderType = [
            "create_at-asc" => "Mới nhất",
            "create_at-desc" => "Cũ nhất",
            "price-asc" => "Giá tăng dần",
            "price-desc" => "Giá giảm dần",
        ];
        
        $this->render([
            "view" => "user/allproduct",
            "page" => "home",
            "title" => "Tất cả sản phẩm",
            "allCategory" => $this->allCategory,
            "numberOfCart" => $this->numberOfCart,
            "filterPrice" => $filterPrice,
            "filterOrderType" => $filterOrderType,
        ]);
    }
    function detail()
    {
        $productModel = new ProductsModel();
        $product = $productModel->get(['id' => $_GET['id']]);
        if (!$product) header("Location: /");
        $mediaModel = new MediasModel();
        $productDetailModel = new ProductdetailModel();
        $commentModel = new CommentsModel();

        $productModel->update([ //tăng view
            'view' => $productModel->get([
                'id' => $_GET['id']
            ])['view'] + 1
        ], $_GET['id']);

        // Lấy data
        $allComment = $commentModel->getByProductId($_GET['id']);
        $quantity_product = $productDetailModel->countByProductId($_GET['id'])['count'];
        $allImage = $mediaModel->getByProductId($_GET['id']);
        $detail = $productDetailModel->getByProductId($_GET['id']);
        $colors = [];
        foreach ($productDetailModel->getColor($_GET['id']) as $color) {
            $colors[] = $color['color'];
        }
        $sizes = [];
        foreach ($productDetailModel->getSize($_GET['id']) as $size) {
            $sizes[] = $size['size'];
        }

        $topProduct = $productModel->getTopSeller(5);
        $this->render([
            "view" => "user/detail",
            "page" => "home",
            "title" => "Chi tiết sản phẩm",
            "allCategory" => $this->allCategory,
            "numberOfCart" => $this->numberOfCart,
            "product" => $product,
            "quantity_product" => $quantity_product,
            "allImage" => $allImage,
            "detail" => $detail,
            "colors" => $colors,
            "sizes" => $sizes,
            "allComment" => $allComment,
            "topProduct" => $topProduct,
        ]);
    }
    function cart()
    {
        $cartModel = new CartsModel();

        $productInCart = [];
        if (isset($_SESSION['user']))
            $productInCart = $cartModel->getAllInforByAccountId($_SESSION['user']['id']);
        else $productInCart = $cartModel->getAllInforBySession();
        $this->render([
            "view" => "user/cart",
            "page" => "home",
            "title" => "Giỏ hàng",
            "allCategory" => $this->allCategory,
            "numberOfCart" => $this->numberOfCart,
            "productInCart" => $productInCart,
        ]);
    }
    function profile()
    {
        if (!isset($_SESSION['user'])) header("Location: /");
        $allBills = (new BillsModel())->getByAccountId($_SESSION['user']['id']);
        foreach ($allBills as $index => $bill) {
            $allBills[$index]['bill_detail'] = (new BilldetailsModel())->getByBillId($bill['id']);
        }
        $this->render([
            "view" => "user/profile",
            "page" => "home",
            "title" => "Thông tin cá nhân",
            "allCategory" => $this->allCategory,
            "numberOfCart" => $this->numberOfCart,
            "allBills" => $allBills,
        ]);
    }
}
