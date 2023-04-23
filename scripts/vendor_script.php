<?php 
    include 'utils.php';
    session_start();
    if(!isVendorAuth()) header("Location: ./login.php");
    
    $_SESSION['errors'] = false;	// Set to no errors

    if (isset($_POST["editProductBtn"])){
        $prodId = $_POST['editProductBtn'];
        header("Location: ../vendor_editProduct.php?id='$prodId'");
    }

    if (isset($_POST["deleteProductBtn"])){
        include 'dbConnection.php';

        $prodId = $_POST['deleteProductBtn'];
        $sql = "DELETE FROM products WHERE id = '$prodId'";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['actionMsg'] = 'Product Deleted';
        }else{
            $_SESSION['actionMsg'] = 'Error deleting product';
        }

        if ($conn)$conn->close();
        header("Location: ../vendor.php");
    } 

        
    
    
    if (isset($_POST["editUserSubmit"])){
        //from edit user page
    }