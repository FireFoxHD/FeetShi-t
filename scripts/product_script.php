<?php

    include 'utils.php';
    session_start();
    $_SESSION['errors'] = false;

    if (isset($_POST["submit"])) {
        //validate and store form values in session
        $productName = trim($_POST["productName"]);
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

        if(empty($productBrand)){
            createError($productBrand, 'errProductBrand', 'Cannot be empty!');
        }else{
            $_SESSION['productBrand'] = $productBrand;
            $_SESSION['errProductBrand'] = "";
        }

        if(empty($productDesc)){
            $_SESSION['productDesc'] = "NO DESCRIPTION";
        }else{
            $_SESSION['productDesc'] = "$productDesc";
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

        $_SESSION['imgPath'] = "";
        include 'upload.php';

        //redirect to cost page if no errors
        if ($_SESSION['errors']){
            header("Location: ../addProduct.php");
        }else{
            header("Location: ../costingInfo.php");
        }
            
    }
?>