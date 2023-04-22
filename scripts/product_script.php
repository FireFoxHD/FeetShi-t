<?php

    include 'utils.php';
    session_start();
    $_SESSION['errors'] = false;
  

    if (isset($_POST["productSubmit"])) {
        //validate and store form values in session
        $productName = trim($_POST["productName"]);
        $productCategory = trim($_POST["productCategory"]);
        $productDesc = trim($_POST["productDescription"]);

        //check empty
        //category should not have numbers

        if(empty($productName)){
            createError($productName, 'errProductName', 'Cannot be empty!');
        }else{
            $_SESSION['productName'] = $productName;
            $_SESSION['errProductName'] = "";
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
            header("Location: ../addProduct.php");
            exit();
        }else{
            header("Location: ../confirmProduct.php");
            exit();
        }
            
    }


    if (isset($_POST['saveProduct'])){ 
        $target_file = "../productImages/".basename($_FILES["productImg"]["name"]);
        $imgPath = "./productImages/".basename($_FILES["productImg"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["productImg"]["tmp_name"]);
        if($check === false) {
            setErrorMsg('uploadStatus', 'File is not an image');
            $_SESSION['errors'] = true;
        }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            setErrorMsg('uploadStatus', 'File already exists');
            $_SESSION['errors'] = true;
        }

        // Check file size
        if ($_FILES["productImg"]["size"] > 500000) {
            setErrorMsg('uploadStatus', "Sorry, your file is too large.");
            $_SESSION['errors'] = true;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            setErrorMsg('uploadStatus', "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            $_SESSION['errors'] = true;
        }

        
        include 'dbConnection.php';

        $id = uniqid();
        $user = $_SESSION['userId'];
        $productName = $_SESSION['productName'];
        $productCategory = $_SESSION['productCategory'];
        $productDesc = $_SESSION['productDesc'];

        $productCostPrice = $_SESSION['productCostPrice'];
        $productSalePrice = $_SESSION['productSalePrice'];
        $productStockQuantity = $_SESSION['productStockQuantity'];

        //image upload
        if (!$_SESSION['errors']){
        
            if (move_uploaded_file($_FILES["productImg"]["tmp_name"], $target_file)) {
                $_SESSION['uploadStatus'] = "";
                $insert_query = "INSERT INTO products (id, vendorId, name, description, category, unitCost, salePrice, quantity, imgPath)
                VALUES ('$id', '$user','$productName','$productDesc','$productCategory', '$productCostPrice', '$productSalePrice', '$productStockQuantity', '$imgPath')";
                         
                if ($conn->query($insert_query)=== TRUE){
                    $_SESSION['uploadStatus'] = "<span style='color:green;text-align:left;'>Data Inserted Successfully!</span> <br>";
                }else{
                    if (file_exists($target_file)) unlink($target_file);
                    $_SESSION['uploadStatus'] = "<span style='color:red;text-align:left;'>Data Insertion Failed!</span> <br>";
                }

            } else {
                setErrorMsg('uploadStatus', "Sorry, your file was not uploaded.");
                $_SESSION['errors'] = true;
            }
        }

        if ($conn)$conn->close();
        unset($_POST["productSubmit"]);
        unset($_POST["costSubmit"]);
        unset($_POST["saveProduct"]);
        header("Location: ../confirmProduct.php");
    
    }

?>