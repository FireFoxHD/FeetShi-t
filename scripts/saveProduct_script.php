<?php 
			
    include 'utils.php';
    session_start();
    if(!isVendorAuth()) header("Location: ./login.php");
    $_SESSION['errors'] = false;	// Set to no errors 

    if (isset($_POST['saveProduct'])){ 
        
            include 'dbConnection.php';

            $id = uniqid();
            $user = $_SESSION['userId'];
            $productName = $_SESSION['productName'];
            $productCategory = $_SESSION['productCategory'];
            $productBrand = $_SESSION['productBrand'];
            $productDesc = $_SESSION['productDesc'];

            $productCostPrice = $_SESSION['productCostPrice'];
            $productSalePrice = $_SESSION['productSalePrice'];
            $productStockQuantity = $_SESSION['productStockQuantity'];
            $imgPath = $_SESSION['imgPath'];

            $insert_query = "INSERT INTO products (id, vendorId, name, description, category, brand, unitCost, salePrice, quantity, imgPath)
                VALUES ('$id', '$user','$productName','$productDesc','$productCategory', '$productBrand' , '$productCostPrice', '$productSalePrice', '$productStockQuantity', $imgPath)";
            echo $insert_query."<br>";
            $result = $conn->query($insert_query);

            //TODO: FEEDBACK TO USER SUCCESSFUL PRODUCT ADD
            
            if ($result === TRUE){
                echo "<span style='color:green;text-align:left;'>Data Inserted Successfully!</span> <br>";
            }else{
                echo "<span style='color:red;text-align:left;'>Data Insertion Failed!</span> <br>";
            }

            //close connection
            if ($conn)$conn->close();
            session_destroy();
        
        
}

