<?php
    include './scripts/utils.php';
    session_start();
    // if(!isVendorAuth()) header("Location: ./login.php"); 
    // if(!isset($_SESSION['userId']))header("Location: ./login.php");
    if(!isset($_SESSION['userId'])) $_SESSION['userId'] = "$$$$";  
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

    <div class="flex flex-col my-8 w-full items-center justify-center">
        <h1 class="font-bold text-gray-700 text-4xl text-center my-4">Confirm Order</h1> 
        <p class="font-bold text-gray-400 text-lg text-center my-2">#<?php $id = uniqid(); echo $id ?></h1> 
    </div>

    <div class="flex flex-row justify-center space-x-8 px-8">
        <table class="text-center text-sm font-light w-2/3">
            <thead class="bg-neutral-800 font-medium text-white uppercase ">
                <tr>
                    <th scope="col" class="px-6 py-4">Name</th>
                    <th scope="col" class="px-6 py-4">Size</th>
                    <th scope="col" class="px-6 py-4">Sale Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
    
                    include './scripts/dbConnection.php';

                    $cartProducts = $_SESSION['cartProducts'];
                    $userId = $_SESSION['userId'];
                    $total = 0;

                    foreach($cartProducts as $item) {
                        $size = $item["size"];
                        $productId = $item["productId"];

                        $sql = "SELECT * FROM products WHERE id = '$productId'";
                        $result = $conn->query($sql);
                    
                        if ($result !== false && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $total = $total + $row["salePrice"];
                                echo '
                                    <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-200">  
                                        <td class="px-6 py-4 text-lg font-bold">'.$row["name"].'</td>
                                        <td class="px-6 py-4 text-lg font-bold">'.$size.'</td>
                                        <td class="px-6 py-4 text-lg font-bold">'.'$ '.number_format($row["salePrice"], 2).'</td> 
                                    </tr>
                                ';
                            }
                        }

                    }
                    
                    $total = sprintf('%.2f', $total);
                    if ($conn) $conn-> close();
                          
                ?>
                 <td colSpan="3" class="px-6 py-4 text-center text-4xl font-bold bg-indigo-600 text-white">Total: $ <?php echo number_format($total, 2) ?></td>
            </tbody>
        </table>

        <form class="flex flex-col items-center justify-center w-1/3 h-full bg-gray-200 p-8" action="<?php echo "./scripts/checkout_script.php?id=$id&userId=$userId&total=$total"; ?>" method="POST"> 

            <div class="m-2 w-full">
                <div class="flex">
                    <label class="text-blueGray-600 font-bold mb-2">Full Name</label>
                </div>
                <input name="fullname" type="text" placeholder = "John Doe" class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm focus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" autocomplete="off">
            </div>

            <div class="m-2 w-full">
                <div class="flex">
                    <label class="text-blueGray-600 font-bold mb-2">Expiration date</label>
                </div>
                <input name="expiration" placeholder="MM/YYYY" type="text" class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm focus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" autocomplete="off">
            </div>

            <div class="m-2 w-full">
                <div class="flex">
                    <label class="text-blueGray-600 font-bold mb-2">Card Number</label>
                </div>
                <input name="cardNum" placeholder="378282246310005" type="text" class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm focus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" autocomplete="off">
            </div>

            <div class="m-2 w-full">
                <div class="flex">
                    <label class="text-blueGray-600 font-bold mb-2">CVV</label>
                </div>
                <input name="cvv" maxlength="3" placeholder="111" type="text" class="box-border border-solid border-2 border-slate-300 px-3 py-3 placeholder-blueGray-300 text-blueGray-600 bg-white rounded text-sm focus:outline-none focus:border-none focus:ring w-full ease-linear transition-all duration-150" autocomplete="off">
            </div>

            <div class="my-4">
                <input name="purchaseBtn" type="submit" value="Confirm Purchase" class="px-4 py-2 rounded-lg bg-green-500 text-md font-bold text-white hover:bg-green-600"/>
            </div>
        </form>
    </div>

    

   
       
    
    
</body>
</html>