<?php
    session_start();
    $productObj = new stdClass();
    $productCostObj = new stdClass();
    $productObj->productName = $_SESSION['productName'];
    $productObj->productCode = $_SESSION['productCode'];
    $productObj->productDesc = $_SESSION['productDesc'];
    $productObj->productCategory = $_SESSION['productCategory'];
    $productObj->productBrand = $_SESSION['productBrand'];


    $productCostObj->productCode = $_SESSION['productCode'];
    $productCostObj->productCostPrice = $_SESSION['productCostPrice'];
    $productCostObj->productSalePrice = $_SESSION['productSalePrice'];
    $productCostObj->productStockQuantity = $_SESSION['productStockQuantity'];
    
    $productJSON = json_encode($productObj);
    $costJSON = json_encode($productCostObj);

    file_put_contents('product.txt', $productJSON, FILE_APPEND);
    file_put_contents('cost.txt', $costJSON, FILE_APPEND);
    session_destroy();
    
?>
       