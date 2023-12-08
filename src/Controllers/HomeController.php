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
        // Kiểm tra thanh toán qua VNPay
        $isPay = false;
        $isOnlinePay = false;
        if (isset($_GET['vnp_SecureHash']) && isset($_GET['vnp_ResponseCode'])) {
            $isOnlinePay = true;
            if ($_GET['vnp_ResponseCode'] == '00')
                $isPay = true;
        }
        // Nếu đã thanh toán thành công
        if ($isPay && $isOnlinePay){
            $totalPrice = 0;
            $details = [];
            if (!isset($_SESSION['user'])):
                foreach ($_SESSION['cart'] as $id => $cart) :
                    $temp = (new CartsModel)->getDetailBySession($id);
                    $totalPrice += $temp['price'] * $temp['quantity'] * (1 - $temp['discount'] / 100);
                    $details[] = array_merge($temp, ['id' => $cart['detail_id']]);
                endforeach;
            else :
                $details = (new CartsModel)->getAllInforByAccountId($_SESSION['user']['id']);
                foreach ($details as $detail) :
                    $totalPrice += $detail['price'] * $detail['quantity'] * (1 - $detail['discount'] / 100);
                endforeach;
            endif;

            // create bill
            $account_id = isset($_SESSION['user']) ? $_SESSION['user']['id'] : 0;
            (new BillsModel)->insert([
                "account_id" => $account_id,
                "total_price" => $totalPrice,
                "pay_method" => "Thanh toán online VNPay",
                "create_at" => date("Y-m-d H:i:s", time()),
                "fullname" => $_SESSION['user']['fullname'] ?? $_SESSION['temp_user']['fullname'],
                "address" => $_SESSION['user']['address'] ?? $_SESSION['temp_user']['address'],
                "phone_number" => $_SESSION['user']['phone_number'] ?? $_SESSION['temp_user']['phone_number'],
                "update_at" => date("Y-m-d H:i:s", time()),
                "status" => 1,
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
        }

        // -----------------------------------
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
            "isPay" => $isPay,
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



http://da1.abc:8080/cart?vnp_Amount=29750000&vnp_BankCode=NCB&vnp_BankTranNo=VNP14229359&vnp_CardType=ATM&vnp_OrderInfo=Thanh+to%C3%A1n+%C4%91%C6%A1n+h%C3%A0ng&vnp_PayDate=20231208210902&vnp_ResponseCode=00&vnp_TmnCode=GB9GXK63&vnp_TransactionNo=14229359&vnp_TransactionStatus=00&vnp_TxnRef=ilmsss&vnp_SecureHash=7ae19384b4cda68b0c16150f3c41a5f07a69305c7556c278aab9b51ddaa0dc6258482550eb0c814ad5692d3201957c9418255f5b604fa72728b96f885551949f