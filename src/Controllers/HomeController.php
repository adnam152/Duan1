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
        
        $productModel = new ProductsModel();
        $allProducts = $productModel->get();

        // get category
        $allCategory = $categoryModel->get();
         
               $this->render([
            "view" => "user/category",
            "page" => "user",
             "allProducts" => $allProducts,
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
        $categoryMap = array_column($allCategory, 'name', 'id');
        $filteredProducts = []; // get category
       

        foreach ($allProducts as $index => $product) {
            $productDetails = $productDetailModel->getByProductId($product['id']);
            $mediaLinks = $mediaModel->getByProductId($product['id']);

            $allProducts[$index]['category'] = $categoryMap[$product['category_id']];
            $allProducts[$index]['count'] = $productDetailModel->countByProductId($product['id'])['count'] ?? 0;
            $allProducts[$index]['detail'] = [];

            foreach ($mediaLinks as $link) {
                $allProducts[$index]['image'][$link['id']] = $link['link'];
            }
            foreach ($productDetails as $detail) {
                $allProducts[$index]['detail'][] = [
                    "id" => $detail['id'],
                    "color" => $detail['color'],
                    "size" => $detail['size'],
                    "quantity" => $detail['quantity'],
                    "price" => $detail['price'],
                ];
            }
            $filteredProducts[] = $allProducts[$index];
        }
// echo "<pre>";
// print_r($allProducts);
// echo "</pre>";



        $this->render([
            "view" => "user/component/product_list",
            "page" => "user",
            "allProducts" => $allProducts,
            "allCategory" => $allCategory,
           
       ]);
}

   }
