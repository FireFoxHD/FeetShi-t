<?php

    session_start();
    if(
        !isset($_SESSION['productName']) || 
        !isset($_SESSION['productCode']) || 
        !isset($_SESSION['productCategory']) || 
        !isset($_SESSION['productBrand']) ||
        !isset($_SESSION['productDesc']) ||
        !isset($_SESSION['productCostPrice']) ||
        !isset($_SESSION['productSalePrice']) ||
        !isset($_SESSION['productStockQuantity'])
        ){ 
            header("Location: productinfo.php");
            exit;
    }
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
    <?php require './components/header_admin.php'; ?>

    

    <div class="flex flex-col items-center justify-center">
        <div class="flex flex-col items-center justify-center mt-12">
            <h1 class="font-bold text-gray-700 text-2xl p-4">Register Product</h1>
        </div>

        <div class="w-2/3">
            <div class="rounded shadow-md flex justify-around items-center my-2 p-6 bg-sky-800">
                <p class="font-bold text-xl text-slate-200"><?php echo $_SESSION['productName']?></p>
                <p class="font-semibold text-white"><?php echo $_SESSION['productCode']?></p>
            </div>

            <div class="flex justify-around">
                <div class="my-2 p-2 w-80">
                    <?php echo $_SESSION['productDesc']?>
                </div>
                <div class="flex flex-col my-2 items-start">
                    <div class="p-2">   
                        <p>Category: <?php echo $_SESSION['productCategory']?></p>
                        <p>Brand: <?php echo $_SESSION['productBrand']?></p>
                        <p>Quantity: <?php echo $_SESSION['productStockQuantity']?></p>
                    </div>

                    <div class="my-4 p-2">   
                        <p>Sales Price: <?php echo $_SESSION['productCostPrice']?></p>
                        <p>Cost Price: <?php echo $_SESSION['productSalePrice']?></p>   
                    </div>
                </div>
            </div>
            
        </div>

        <form method="POST" action="./scripts/registerProduct_script.php">
            <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 w-64 rounded my-4" type="submit" name="saveFile" value="Save Product to file"/>
        </form>
    
    </div>
</body>
</html>