<?php 
    include 'utils.php';
    session_start();

    if(isset($_POST['purchaseBtn'])){
        $orderid = $_GET['id'];
        $customerId = $_GET['userId'];
        $totalCost = (float)$_GET['total'];
        $email = "";
        include 'dbConnection.php';
        $sql = "SELECT * FROM users WHERE id = '$customerId'";
        $result = $conn->query($sql);
    
        if ($result !== false && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $email = $row["email"];
            }
        }else{
            $_SESSION['errors'] = true;
            echo "Problems adding orders";
            if ($conn)$conn->close();
        }
        if ($conn)$conn->close();

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
            if (preg_match("/^((0[1-9])|(1[0-2]))\/(\d{4})$/",$expiration)){
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
        if (isset($_SESSION['errors']) && $_SESSION['errors']){
            header("Location: ../checkout.php");
        }else{
            include 'dbConnection.php';
            //hash the password
            $cartProducts = $_SESSION['cartProducts'];
        
            $mysqltime = date('Y-m-d H:i:s');
            $insert_query = "INSERT INTO orders (id, customerId, fullname, totalCost, cardNumber, cvv, expiration, purchasedOn)
                VALUES ( '$orderid', '$customerId','$fullname','$totalCost','$cardNum','$cvv', '$expiration', '$mysqltime')";
           
            $result = $conn->query($insert_query);
            
            if ($result === TRUE){
                echo "<span style='color:green;text-align:left;'>Data Inserted Successfully!</span> <br>";
            }else{
                echo "<span style='color:red;text-align:left;'>Data Insertion Failed!</span> <br>";
            }

            foreach($cartProducts as $item) { 
                $size = $item["size"];
                $productId = $item["productId"];
                $id = uniqid("ITEM-");
                $insert_query = "INSERT INTO productsordered (id, orderId, productId, shoeSize)
                    VALUES ( '$id', '$orderid', '$productId', '$size')";
            
                echo $insert_query."<br/>";
                $result = $conn->query($insert_query);
                
                if ($result !== TRUE) $_SESSION['errors'] = true;   
            }

            if (isset($_SESSION['errors']) && $_SESSION['errors']){
                echo "Problems adding orders";
                if ($conn)$conn->close();
                exit();
            }else{

                $email = "";
                $subject = "Your Order From Feetsh*t - #".$orderid;
                $header = "From:store@feetsh*t.com \r\n";
                $header .= "CC: khamalipowell@gmail.com \r\n";
                $header .= "MIME-Version: 1.0\r\n";
                $header .= "Content-type: text/html\r\n";
                $message = "
                    <p> Order will be available for pickup in 5-10day pleave visit us at 5 Fairmont Dr, Kingston, Jamaica. </p><br/> 
                    <p> Please remebr to walk with valid ID and your used to make this order for verification. </p>
                ";

                //create new page to display order results

                // if(mail($email,$subject,$message,$header) === true ) {
                //    echo "Message sent successfully...";
                // }else {
                //    echo "Message could not be sent...";
                // }
                // echo "Order Success";
            }
            //close connection
            if ($conn)$conn->close();
            unset($_SESSION['cartProducts']);
            header("Location: ../guest.php");
        }


    }

   
        
     


?>