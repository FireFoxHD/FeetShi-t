<?php

	session_start();
	if(isset($_SESSION['errors'])){
        //to persist values after form submission in case use made an error
        $productName = $_SESSION['productName'];
        $productCode =  $_SESSION['productCode'];
        $productCategory = $_SESSION['productCategory'];
        $productBrand = $_SESSION['productBrand'];
        $productDesc = $_SESSION['productDesc'];
		unset($_SESSION['errors']);		
	}else{
        // Field values
        $_SESSION['productName'] = "";
        $_SESSION['productCode'] = "";
        $_SESSION['productDesc'] = "";
        $_SESSION['productCategory'] = "";
        $_SESSION['productBrand'] = "";
        $productName = "";
        $productCode =  "";
        $productCategory = "";
        $productBrand = "";
        $productDesc = "";

        //Error field values
        $_SESSION['errProductName'] = "";
        $_SESSION['errProductCode'] = "";
        $_SESSION['errProductDesc'] = "";
        $_SESSION['errProductCategory'] = "";
        $_SESSION['errProductBrand'] = "";

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
            <h1 class="font-bold text-gray-700 text-2xl p-4">Add Product</h1>
            <p class="text-gray-500 text-md text-center">Here you can input the details of the products.<br/> Complete the form where with the required information.</p>
        </div>

        <div class="flex items-center justify-center">
            <form class="flex flex-col items-center justify-center my-6 w-full" action="./scripts/product_script.php" method="POST">
                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Product Name</label><?php echo $_SESSION['errProductName']; ?>
                    <input name="productName" type="text" value="<?php echo $productName?>" class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm  ocus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" autocomplete="off">
                    
                </div>
    
                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Product Code</label><?php echo $_SESSION['errProductCode']; ?>
                    <input name="productCode" type="text" value="<?php echo $productCode?>" class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm focus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" autocomplete="off">
                    
                </div>
    
                <div class="m-2 w-full">
                    <label class=" text-blueGray-600 font-bold mb-2">Category</label><?php echo $_SESSION['errProductCategory']; ?>
                    <input name="productCategory" type="text" value="<?php echo $productCategory?>"  class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm focus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" autocomplete="off">
                </div>
    
                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Brand</label> <?php echo $_SESSION['errProductBrand']; ?>
                    <input name="productBrand" type="text" value="<?php echo $productBrand?>"  class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm focus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" autocomplete="off">
                
                </div>
    
                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Description</label> <?php echo $_SESSION['errProductDesc']; ?>
                    <input name="productDescription" type="text" value="<?php echo $productDesc?>"  class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm focus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" autocomplete="off">
                
                </div>
    
                <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 w-32 rounded my-4" id="saveForm" type="submit" name="submit" value="Submit" />
    
            </form>
        </div>
    </div>
</body>

</html>