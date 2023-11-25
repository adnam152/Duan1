<?php

namespace MVC\Controllers;
use MVC\Controller;
use MVC\Models\CategoriesModel;
use MVC\Models\ProductsModel;
use MVC\Models\ProductdetailModel;
use MVC\Models\MediasModel;


class HomeController extends Controller
{
    public function index()
    {

        $this->render([

            "view" => "user/index",
            "page" => "user",


        ]);
    }
    public function category()
    {
        $categoryModel = new CategoriesModel();

        // get category
        $allCategory = $categoryModel->get();

        $this->render([
            "view" => "user/category",
            "page" => "user",
            "allCategory" => $allCategory,
        ]);
    }
    public function allproduct()
    {
   
        $productModel = new ProductsModel();
        $allProducts = $productModel->get();
        $productDetailModel = new ProductdetailModel();
        $categoryModel = new CategoriesModel();
        $mediaModel = new MediasModel();
       
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
        // echo "<pre>";
        // print_r($allProducts);
        // echo "</pre>";



        $this->render([
            "view" => "user/product_list",
            "page" => "user",
            "allProducts" => $allProducts,
       ]);
}
}
