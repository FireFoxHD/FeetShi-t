<?php

    include 'utils.php';
    session_start();

    $_SESSION['errors'] = false;

    if (isset($_POST["submit"])) {
        //validate and store form values in session
        $productCostPrice = (is_numeric($_POST['productCostPrice']) ? (float)$_POST['productCostPrice'] : trim($_POST["productCostPrice"]));
        $productSalePrice = (is_numeric($_POST['productSalePrice']) ? (float)$_POST['productSalePrice'] : trim($_POST["productSalePrice"]));
        $productStockQuantity = (is_numeric($_POST['productStockQuantity']) ? (int)$_POST['productStockQuantity'] : trim($_POST["productStockQuantity"]));
        

        if(is_numeric($productCostPrice) && $productCostPrice > 0){
            $_SESSION['productCostPrice'] = $productCostPrice;
            $_SESSION['errProductCostPrice'] = "";
        }else{
            createError($productCostPrice, 'errProductCostPrice', 'Must be a numeric value greater than 0!');
        }

        if(is_numeric($productSalePrice) && $productSalePrice > 0){
            $_SESSION['productSalePrice'] = $productSalePrice;
            $_SESSION['errProductSalePrice'] = "";
        }else{
            createError($productSalePrice, 'errProductSalePrice', 'Must be a numeric value greater than 0!');
        }

        //will allow a user to enter 0 because they may be creating item with the intention of getting it in stock
        if(is_int($productStockQuantity)){
            $_SESSION['productStockQuantity'] = $productStockQuantity;
            $_SESSION['errProductStockQuantity'] = "";
        }else{ 
            createError($productStockQuantity, 'errProductStockQuantity', 'Must be an integer');
        }
        //redirect to cost page if no errors
        if ($_SESSION['errors']){
            header("Location: ../costingInfo.php");
        }else{
            header("Location: ../registerProduct.php");
        }
        
    }
?>