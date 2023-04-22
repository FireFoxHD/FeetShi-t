<?php

    include './scripts/utils.php';
    session_start();
    if(!isVendorAuth()) header("Location: ./login.php");

    if(
        !isset(
            $_SESSION['productName'],
            $_SESSION['productCategory'],
            $_SESSION['productDesc'],
            $_SESSION['productCostPrice'],
            $_SESSION['productSalePrice'],
            $_SESSION['productStockQuantity']
        )){ 
            header("Location: addProduct.php");
            exit();
    }

    if(!isset($_SESSION['uploadStatus'])) $_SESSION['uploadStatus'] = "";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/icons/favicon-32x32.png">
    <title>Feetsh*t</title>
</head>
<body>
    <?php require './components/header_vendor.php'; ?>

    <div class="flex flex-col items-center justify-center">
        <div class="flex flex-col items-center justify-center mt-12">
            <h1 class="font-bold text-gray-700 text-2xl p-4">Register Product</h1>
        </div>
        <form action="./scripts/product_script.php" method="POST" enctype="multipart/form-data">
            <div class="w-2/3">
                <div class="rounded shadow-md flex justify-around items-center my-2 p-6 bg-sky-800">
                    <p class="font-bold text-xl text-slate-200"><?php echo $_SESSION['productName']?></p>
                </div>

                <div class="flex justify-around">
                    <div class="m-2 w-full">
                        <label class="text-blueGray-600 font-bold mb-2">Upload image</label> <?php echo $_SESSION['errProductImg']; ?>
                        <input name="productImg" type="file" class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm focus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150">
                    
                    </div>
                    <div class="flex flex-col my-2 items-start">
                        <div class="p-2">   
                            <p>Category: <?php echo $_SESSION['productCategory']?></p>
                            <p>Quantity: <?php echo $_SESSION['productStockQuantity']?></p>          
                        </div> 

                        <div class="my-4 p-2">   
                            <p>Sales Price: <?php echo $_SESSION['productCostPrice']?></p>
                            <p>Cost Price: <?php echo $_SESSION['productSalePrice']?></p>   
                        </div>
                    </div>
                </div>

                <p><?php echo $_SESSION['uploadStatus']?></p>
                
            </div>

        
            
            <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 w-64 rounded my-4" type="submit" name="saveProduct" value="Save Product"/>
        </form>
    
    </div>
</body>
</html>