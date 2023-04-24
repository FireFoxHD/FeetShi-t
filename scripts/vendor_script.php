<?php 
    include 'utils.php';
    session_start();
    if(!(isVendorAuth()||isAdminAuth())) header("Location: ./login.php");
   
    
    $_SESSION['errors'] = false;	// Set to no errors

    //TODO: this
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
        unset($_POST["deleteProductBtn"]);
        if(isVendorAuth()){
            header("Location: ../vendor.php");
            exit();
        }

        if(isAdminAuth()){
            header("Location: ../admin_viewProducts.php");
            exit();
        }

        
    } 

        
    
    
    if (isset($_POST["editUserSubmit"])){
        //from edit user page
    }