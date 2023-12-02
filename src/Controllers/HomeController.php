<?php

namespace MVC\Controllers;

use MVC\Controller;
use MVC\Models\CategoriesModel;
use MVC\Models\CartsModel;
use MVC\Models\ProductsModel;
use MVC\Models\MediasModel;
use MVC\Models\ProductdetailModel;
use MVC\Models\CommentsModel;

class HomeController extends Controller{
    private $allCategory;
    private $numberOfCart = 0;
    public function __construct(){
        $this->allCategory = (new CategoriesModel())->get();
        if(isset($_SESSION['user']['id']))
            $this->numberOfCart = (new CartsModel)-> count(['account_id' => $_SESSION['user']['id']]);
    }
    public function index(){
        
        $this->render([
            "view" => "user/home",
            "page" => "home",
            "title" => "Trang chủ",
            "allCategory" => $this->allCategory,
            "numberOfCart" => $this->numberOfCart,
        ]);
    }
    function allproduct(){
        
        $this->render([
            "view" => "user/allproduct",
            "page" => "home",
            "title" => "Tất cả sản phẩm",
            "allCategory" => $this->allCategory,
            "numberOfCart" => $this->numberOfCart,
        ]);
    }
    function detail(){
        $productModel = new ProductsModel();
        $product = $productModel->get(['id' => $_GET['id']]);
        if(!$product) header("Location: /");
        $mediaModel = new MediasModel();
        $productDetailModel = new ProductdetailModel();
        $commentModel = new CommentsModel();

        $productModel->update([ //tăng view
            'view' => $productModel->get([
                'id' => $_GET['id']])['view'] + 1
        ], $_GET['id']);

        // Lấy data
        $allComment = $commentModel->getByProductId($_GET['id']);
        $quantity_product = $productDetailModel->countByProductId($_GET['id'])['count'];
        $allImage = $mediaModel->getByProductId($_GET['id']);
        $detail = $productDetailModel->getByProductId($_GET['id']);
        $colors = [];
        foreach($productDetailModel->getColor($_GET['id']) as $color){
            $colors[] = $color['color'];
        }
        $sizes = [];
        foreach($productDetailModel->getSize($_GET['id']) as $size){
            $sizes[] = $size['size'];
        }

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
        ]);
    }
    function cart(){
        $cartModel = new CartsModel();

        $productInCart = [];
        if(isset($_SESSION['user']))
            $productInCart = $cartModel->getAllInforByAccountId($_SESSION['user']['id']);

        $this->render([
            "view" => "user/cart",
            "page" => "home",
            "title" => "Giỏ hàng",
            "allCategory" => $this->allCategory,
            "numberOfCart" => $this->numberOfCart,
            "productInCart" => $productInCart,
        ]);
    }
}





?>
