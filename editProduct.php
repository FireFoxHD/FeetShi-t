<?php
    include './scripts/utils.php';
    session_start();

    $var1 = isGuest();
    $var2 = isAdminAuth();
    $var3 = isVendorAuth();
    $var4 = (!isVendorAuth() && !isAdminAuth());
    
    if(!isVendorAuth() && !isAdminAuth()) header("Location: ./login.php");

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

	if(isset($_GET['id'])){
        $product = $_GET['id'];
        include './scripts/dbConnection.php';
        $sql = "SELECT * FROM products WHERE id = '$product'";
        $result = $conn->query($sql);

        if ($result !== false && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $productName = $row['name'];
                $productDesc = $row['description'];
                $productSalePrice = $row['salePrice'];
                $productStockQuantity = $row['quantity'];
            }
        }else{
            //redirect
        }
    
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
    <?php
        if(isGuest()){
            require './components/header_guest.php';
        }else if(isAdminAuth()){
            require './components/header_admin.php';
        }else if(isVendorAuth()){ 
            require './components/header_vendor.php';
        }else{
            require './components/header.php';
        } 
    ?>
    <div class="flex flex-col items-center justify-center">
        <div class="flex flex-col items-center justify-center mt-12">
            <h1 class="font-bold text-gray-700 text-2xl p-4">Edit Product</h1>
            <p class="text-gray-500 text-md text-center">Here you can input the details of the products.<br/> Complete the form where with the required information.</p>
        </div>

        <div class="flex items-center justify-center">
            <form class="flex flex-col items-center justify-center my-6 w-full" action="./scripts/product_script.php" method="POST" enctype="multipart/form-data">
                
                <input name="productId" type="text" value="<?php echo $product?>" hidden>

                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Product Name</label><?php echo $_SESSION['errProductName']; ?>
                    <input required name="productName" type="text" value="<?php echo $productName ?>" class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm  ocus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" autocomplete="off">
                </div>

                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2" >Product Sales Price</label> <?php echo $_SESSION['errProductSalePrice']; ?>
                    <input required name="productSalePrice" type="text" value="<?php echo $productSalePrice ?>"class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm focus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" autocomplete="off">
                </div>

                <div class="m-2 w-full">
                    <label class=" text-blueGray-600 font-bold mb-2" >Quantity in Stock</label><?php echo $_SESSION['errProductStockQuantity']; ?>
                    <input required name="productStockQuantity" type="text" value="<?php echo $productStockQuantity ?>" class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm focus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" autocomplete="off"> 
                </div>
    
                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Description</label> <!-- Sanitize in backend -->
                    <textarea name="productDescription" type="text" class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm focus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" placeholder="Optional"><?php echo $productDesc ?></textarea>
                
                </div>
    
                <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 w-32 rounded my-4" id="saveForm" type="submit" name="updateProductBtn" value="Submit" />
    
            </form>
        </div>
    </div>
</body>

</html>