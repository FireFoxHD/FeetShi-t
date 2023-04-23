<?php
    include './scripts/utils.php';
    session_start();
    // if(!isVendorAuth()) header("Location: ./login.php"); 
    // if(!isset($_SESSION['userId']))header("Location: ./login.php");  
    if(isset($_SESSION['errors'])) unset($_SESSION['errors']);
    if(!isset($_SESSION['cartProducts']) || count($_SESSION['cartProducts']) === 0) $_SESSION['cartProducts'] = array();
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
    <?php require './components/header_guest.php'; ?>

    <div class="flex flex-col my-16 w-full items-center justify-center">
        <h1 class="font-bold text-gray-700 text-4xl text-center my-4">Cart</h1> 
    </div>

    <div class="flex flex-col items-center justify-center w-full">
        
        <table class="text-center text-sm font-light w-2/3">
            <thead class="bg-neutral-800 font-medium text-white uppercase ">
                <tr>
                    <th scope="col" class="px-6 py-4">Name</th>
                    <th scope="col" class="px-6 py-4">Size</th>
                    <th scope="col" class="px-6 py-4">Sale Price</th>
                    <th scope="col" class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $cartProducts = $_SESSION['cartProducts'];

                    if (count($cartProducts) === 0){
                        echo '
                            <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-200">
                                <td colSpan="4" class="px-6 py-4 text-center">No items in cart</td>
                            </tr>
                        ';
                    }else{
                        include './scripts/dbConnection.php';

                        foreach($cartProducts as $productId => $size) {
                            $sql = "SELECT * FROM products WHERE id = '$productId'";
                            $result = $conn->query($sql);

                            if ($result !== false && $result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo '
                                        <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-200">  
                                            <td class="px-6 py-4">'.$row["name"].'</td>
                                            <td class="px-6 py-4">'.$size.'</td>
                                            <td class="px-6 py-4">'.'$ '.number_format($row["salePrice"],2 ).'</td> 
                                            <td class="py-4">
                                                <form action="./scripts/cart_script.php?id='.$productId.'" method="POST"> 
                                                    <button name="deleteItemBtn" value="'.$row["id"].'" class="px-4 py-2 rounded-lg bg-red-500  text-white hover:bg-red-600">
                                                        <i class="fa fa-trash text-white px-2" aria-hidden="true"></i>Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    ';
                                }
                            }
    
                        }
                        if ($conn) $conn-> close();
                    } 
                    
                ?>
            </tbody>
        </table>
        
    <div>


</body>
</html>