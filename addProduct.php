<?php
    include './scripts/utils.php';
    session_start();
    if(!isVendorAuth()) header("Location: ./login.php");

    if(!isset(
        $_SESSION['productName'],
        $_SESSION['productDesc'],
        $_SESSION['productCategory'],
        $_SESSION['productCostPrice'],
        $_SESSION['productSalePrice'],
        $_SESSION['productStockQuantity'] ,
        $_SESSION['errProductName'],
        $_SESSION['errProductDesc'],
        $_SESSION['errProductCategory'],
        $_SESSION['errProductCostPrice'],
        $_SESSION['errProductSalePrice'],
        $_SESSION['errProductStockQuantity']) || !isset($_SESSION['errors']))
    {
        $_SESSION['productName'] = "";
        $_SESSION['productDesc'] = "";
        $_SESSION['productCategory'] = "";
        $_SESSION['productCostPrice'] = "";
        $_SESSION['productSalePrice'] = "";
        $_SESSION['productStockQuantity'] = "";
        $_SESSION['errProductName'] = "";
        $_SESSION['errProductDesc'] = "";
        $_SESSION['errProductCategory'] = "";
        $_SESSION['errProductBrand'] = "";
        $_SESSION['errProductImg'] = "";
        $_SESSION['errProductCostPrice'] = "";
        $_SESSION['errProductSalePrice'] = "";
        $_SESSION['errProductStockQuantity'] = "";
     
    }

	if(isset($_SESSION['errors'])){
        //to persist values after form submission in case use made an error
        $productName = $_SESSION['productName'];
        $productCategory = $_SESSION['productCategory'];
        $productDesc = "";
		unset($_SESSION['errors']);		
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
            <h1 class="font-bold text-gray-700 text-2xl p-4">Add Product</h1>
            <p class="text-gray-500 text-md text-center">Here you can input the details of the products.<br/> Complete the form where with the required information.</p>
        </div>

        <div class="flex items-center justify-center">
            <form class="flex flex-col items-center justify-center my-6 w-full" action="./scripts/product_script.php" method="POST" enctype="multipart/form-data">
                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Product Name</label><?php echo $_SESSION['errProductName']; ?>
                    <input name="productName" type="text" value="<?php echo $_SESSION['productName']?>" class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm  ocus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" autocomplete="off">
                    
                </div>
    
                
                <div class="m-2 w-full">
                    <label class=" text-blueGray-600 font-bold mb-2">Category</label><?php echo $_SESSION['errProductCategory']; ?>
                    <select name="productCategory" class="bg-white border-2 border-slate-300 text-gray-900 text-sm rounded focus:ring-blue-500 placeholder-blueGray-300 block w-full p-2.5" required>
                        <option value="" selected disabled hidden>Select Shoe Type</option>
                        <option value="boot">Boots</option>
                        <option value="sneaker">Sneakers</option>
                        <option value="athletic">Athletic shoes</option>
                        <option value="loafer">Loafers</option>
                        <option value="slipper">Slippers</option>
                        <option value="sandals">Sandals</option>
                        <option value="heel">Heels</option>
                        <option value="flat">Flats</option>
                        <option value="other">Other</option>
                    </select>
                </div>
    
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
    
                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Description</label> <!-- Sanitize in backend -->
                    <textarea name="productDescription" type="text" value="<?php echo $_SESSION['productDesc']?>" class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm focus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" placeholder="Optional"></textarea>
                
                </div>
    
                <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 w-32 rounded my-4" id="saveForm" type="submit" name="productSubmit" value="Submit" />
    
            </form>
        </div>
    </div>
</body>

</html>