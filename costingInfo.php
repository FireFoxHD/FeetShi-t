<?php

    include './scripts/utils.php';
    session_start();
    if(!isVendorAuth()) header("Location: ./login.php");

    echo 'PATH: '. $_SESSION['imgPath'];
    echo 'PATH: '. $_SESSION['productImagePath'];
    
    // if(
    //     !isset($_SESSION['productName']) || 
    //     !isset($_SESSION['productCategory']) || 
    //     !isset($_SESSION['productBrand']) ||
    //     !isset($_SESSION['productDesc'])||
    //     !isset($_SESSION['imgPath'])){
    //         header("Location: ../addProduct.php");
    //         exit();
    // }
	
	if(isset($_SESSION['errors'])){
		unset($_SESSION['errors']);		
	}else{
        // Field values
        $_SESSION['productCostPrice'] = "";
        $_SESSION['productSalePrice'] = "";
        $_SESSION['productStockQuantity'] = "";

        //Error field values
        $_SESSION['errProductCostPrice'] = "";
        $_SESSION['errProductSalePrice'] = "";
        $_SESSION['errProductStockQuantity'] = "";


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
    <?php require './components/header_vendor.php'; ?>
    <div class="flex flex-col items-center justify-center">
    
        <div class="flex flex-col items-center justify-center mt-12">
            <h1 class="font-bold text-gray-700 text-2xl p-4">Add Product Cost</h1>
            <p class="text-gray-500 text-md text-center">Here you can input the pricing details details of the products.<br/> Complete the form where with the required information.</p>
        </div>

        <div class="flex items-center justify-center">
            <form class="flex flex-col items-center justify-center my-6" action="./scripts/cost_script.php" method="POST" enctype="multipart/form-data">

                <div class="m-2 w-full">
                   
                    <div class="flex">
                        <label class="text-blueGray-600 font-bold mb-2">Product Unit Cost</label>
                        <?php echo $_SESSION['errProductCostPrice']; ?>
                    </div>
                    <input name="productCostPrice" type="text"  class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm  ocus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" autocomplete="off">
                    
                </div>

                <div class="m-2 w-full">
                    <div class="flex">
                        <label class="text-blueGray-600 font-bold mb-2" >Product Sales Price</label>
                        <?php echo $_SESSION['errProductSalePrice']; ?>
                    </div>
                    <input name="productSalePrice" type="text" class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm focus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" autocomplete="off">
                    
                </div>

                <div class="m-2 w-full">
                    <div class="flex">
                        <label class=" text-blueGray-600 font-bold mb-2" >Quantity in Stock</label>
                        <?php echo $_SESSION['errProductStockQuantity']; ?>
                    </div>
                    <input name="productStockQuantity" type="text"  class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm focus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" autocomplete="off">
                    
                </div>

                <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 w-32 rounded my-4" id="saveForm" type="submit" name="submit" value="Submit" />

            </form>
        </div>
    </div>
</body>
</html>