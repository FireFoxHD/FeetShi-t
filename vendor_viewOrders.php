<?php
    include './scripts/utils.php';
    session_start();

    if(!isset($_SESSION['userId']) || isGuest()){
         header("Location: ./login.php");  
         exit();
    }
   
    if(isset($_SESSION['errors'])) unset($_SESSION['errors']);

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
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/icons/favicon-16x16.png">
    <title>Feetsh*t</title>
</head>
<body>
    <?php 

        if(isVendorAuth()){ 
            require './components/header_vendor.php';
        }
    ?>

    <div class="flex flex-col my-16 w-full items-center justify-center">
        <h1 class="font-bold text-gray-700 text-4xl text-center my-4">View Order Details</h1> 
    </div>

    <div class="flex flex-col items-center justify-center w-full">
        
        <table class="text-center text-sm font-light w-2/3">
            <thead class="bg-neutral-800 font-medium text-white uppercase ">
                <tr>
                    <th scope="col" class="px-6 py-4">Order#</th>
                    <th scope="col" class="px-6 py-4">Name</th>
                    <th scope="col" class="px-6 py-4">Size</th>
                    <th scope="col" class="px-6 py-4">Cost</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include './scripts/dbConnection.php';
                    $vendor = $_SESSION['userId'];
                    $sql = "SELECT * FROM products WHERE vendorId = '$vendor'";
                    $result = $conn->query($sql);
                    if ($result!== false && $result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $prodId = $row["id"];
                            $prodName = $row["name"];
                            $prodCost = $row["salePrice"];
                            $sql_name = "SELECT * FROM productsordered WHERE productId = '$prodId'";
                            $result_name = $conn->query($sql_name);
                            if ($result_name!== false && $result_name->num_rows > 0) {
                                while($row_name = $result_name->fetch_assoc()) {
                                    echo '
                                        <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-200">
                                            <td class="px-6 py-4">'.$row_name["orderId"].'</td>
                                            <td class="px-6 py-4">'.$prodName.'</td>
                                            <td class="px-6 py-4">'.$row_name["shoeSize"].'</td>
                                            <td class="px-6 py-4">'.'$ '.number_format($prodCost, 2).'</td> 
                                        </tr>
                                                
                            
                                    ';
                                }
                            }
                        }
                    }else{
                        echo '
                        <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-200">
                            <td colSpan="4" class="px-6 py-4 text-center">No Results</td>
                        </tr>';
                    }
                    
                    if ($conn) $conn->close();
                ?>
            </tbody>
        </table>
        
    <div>


</body>
</html>