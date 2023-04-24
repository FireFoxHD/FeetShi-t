<?php 
    include 'utils.php';
    session_start();

    if(isset($_POST['purchaseBtn'])){
        $id = $_GET['id'];
        $customerId = $_GET['userId'];
        $totalCost = (float)$_GET['total'];

        $fullname = trim($_POST['fullname']);
        if (empty($fullname)) {
            createError("fullname", "errFullname", "Your name is required!"); 
        }else{
            //doesnt need to be space sperated
            if (preg_match("/^[a-zA-z ,.'-]+$/",$fullname)){
                $_SESSION['fullname'] = $fullname;
                $_SESSION['errFullname'] = "";
            }else{
                createError("fullname", "errFullname", "Enter the name found on your card!"); 
            }
        }

        $expiration = trim($_POST['expiration']);
        if (empty($expiration)) {
            createError("expiration", "errExpiration", "Your cards expiration date is required!"); 
        }else{
            //doesnt need to be space sperated
            if (preg_match("/^((0[1-9])|(1[0-2]))/(\d{4})$/",$expiration)){
                //check if expired
                $_SESSION['expiration'] = $expiration;
                $_SESSION['errExpiration'] = "";
            }else{
                createError("expiration", "errExpiration", "Enter the expiration date found on your card!"); 
            }
        }

        $cardNum = trim($_POST['cardNum']);
        if (empty($cardNum)) {
            createError("cardNum", "errCardNum", "Your card number is required!"); 
        }else{
            //doesnt need to be space sperated
            if (validate_cc($cardNum, "all")){
                $_SESSION['cardNum'] = $cardNum;
                $_SESSION['errCardNum'] = "";
            }else{
                createError("cardNum", "errCardNum", "Enter the number found on your card!"); 
            }
        }

        $cvv = trim($_POST['cvv']);
        if (empty($cvv)) {
            createError("cvv", "errCvv", "Your cards expiration date is required!"); 
        }else{
            $_SESSION['cvv'] = $expiration;
            $_SESSION['errCvv'] = "";
        }

        //redirect to cost page if no errors
        if ($_SESSION['errors']){
            header("Location: ../checkout.php");
        }else{
            include 'dbConnection.php';
            //hash the password
            
            $mysqltime = date('Y-m-d H:i:s');
            $insert_query = "INSERT INTO users (id, customerId, fullname, totalCost, cardNumber, cvv, expiration,  	purchasedOn)
                VALUES ( '$id', '$customerId','$fullname','$totalCost','$cardNum','$cvv', '$expiration', '$mysqltime')";
           
            $result = $conn->query($insert_query);
            
            if ($result === TRUE){
                echo "<span style='color:green;text-align:left;'>Data Inserted Successfully!</span> <br>";
            }else{
                echo "<span style='color:red;text-align:left;'>Data Insertion Failed!</span> <br>";
            }

            //close connection
            if ($conn)$conn->close();
            header("Location: ../admin.php");
        }


    }

   
        
     


?>