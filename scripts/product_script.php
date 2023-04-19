<?php

    include 'utils.php';
    session_start();
    $_SESSION['errors'] = false;

    if (isset($_POST["submit"])) {
        //validate and store form values in session
        $productName = trim($_POST["productName"]);
        $productCode = trim($_POST["productCode"]);
        $productCategory = trim($_POST["productCategory"]);
        $productBrand = trim($_POST["productBrand"]);
        $productDesc = trim($_POST["productDescription"]);

        //check empty
        //category should not have numbers

        if(empty($productName)){
            createError($productName, 'errProductName', 'Cannot be empty!');
        }else{
            $_SESSION['productName'] = $productName;
            $_SESSION['errProductName'] = "";
        }

        if(empty($productCode)){
            createError($productCode, 'errProductCode', 'Cannot be empty!');
        }else{
            $_SESSION['productCode'] = $productCode;
            $_SESSION['errProductCode'] = "";
        }

        if(empty($productBrand)){
            createError($productBrand, 'errProductBrand', 'Cannot be empty!');
        }else{
            $_SESSION['productBrand'] = $productBrand;
            $_SESSION['errProductBrand'] = "";
        }

        if(empty($productDesc)){
            createError($productDesc, 'errProductDesc', 'Cannot be empty!');
        }else{
            $_SESSION['productDesc'] = $productDesc;
            $_SESSION['errProductDesc'] = "";
        }

        if(empty($productCategory)){
            createError($productCategory, 'errProductCategory', 'Cannot be empty!');
        }else{
            if (preg_match("/^[a-zA-Z]*$/", $productCategory)) {
                $_SESSION['productCategory'] = $productCategory;
                $_SESSION['errProductCategory'] = "";
            } else {
                createError($productCategory, 'errProductCategory', 'Can only contain letters!');
            }
        }

        //redirect to cost page if no errors
        if ($_SESSION['errors']){
            header("Location: ../productinfo.php");
        }else{
            header("Location: ../costingInfo.php");
        }
        
    }
?>