//    $filteredProducts = [];
//    foreach ($allCategory as $category) {
//        $categoryMap[$category['id']] = $category['name'];
//    }
//    foreach ($allProducts as $index => $product) {
//        if ($categoryId === null || $product['category_id'] == $categoryId) {
//            $filteredProducts[] = $product;
//        }
//        $product_id = $product['id'];
//        $allDetails = $productDetailModel->getByProductId($product_id); // get price by product id
//        $allLinks = $mediaModel->getByProductId($product_id); // get image by product id

//        $allProducts[$index]['category'] = $categoryMap[$product['category_id']];
//        $allProducts[$index]['count'] = $productDetailModel->countByProductId($product_id)['count'] ?? 0;
//        $allProducts[$index]['detail'] = [];

//        $allProducts[$index]['image'] = [];
//        foreach ($allLinks as $link) {
//            $allProducts[$index]['image'][$link['id']] = $link['link'];
//        }
//        foreach ($allDetails as $detail) {
//            $allProducts[$index]['detail'][] = [
//                "id" => $detail['id'],
//                "color" => $detail['color'],
//                "size" => $detail['size'],
//                "quantity" => $detail['quantity'],
//                "price" => $detail['price'],
//            ];
//        }
//    }