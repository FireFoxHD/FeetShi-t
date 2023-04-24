<?php 
    include 'utils.php';
    session_start();

    if(isset($_POST['addToCart'])){
       
        if(!isGuest()){
            header("Location: ../login.php");
            exit();
        }

        include 'dbConnection.php';

        if(!isset($_SESSION['cartProducts']) || count($_SESSION['cartProducts']) === 0) $_SESSION['cartProducts'] = array();
        $productId = $_GET['id'];
        $size = $_POST['shoeSize'];

        $sql = "SELECT * FROM products WHERE id = '$productId'";
        $result = $conn->query($sql);
        if ($result!== false && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $stock = $row['quantity'] - 1;
                $sql = "UPDATE products SET quantity = $stock WHERE id = '$productId'";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['cartProducts'][] = 
                        array(
                            "productId" => $productId,
                            "size"=> $size
                        )
                    ;
                    // $_SESSION['actionMsg'] = 'Product added to Cart';
                }else{
                    // $_SESSION['actionMsg'] = 'Failed to add to Cart';
                }
            }
        }

        if ($conn) $conn-> close();
        unset($_POST["addToCart"]);
        header("Location: ../product.php?id=".$productId);
    
    }

    if (isset($_POST["deleteItemBtn"])){
      
        if(!isset($_SESSION['cartProducts']) || count($_SESSION['cartProducts']) === 0) {
            $_SESSION['cartProducts'] = array();
            header("Location: ../cart.php");
        }

        $productId = $_GET['id'];
        
        foreach ($_SESSION['cartProducts'] as $items => $key){
            if($key['productId'] == $productId) {
                unset($_SESSION['cartProducts'][$items]);
                break;
            }
        }

        include 'dbConnection.php';
        $sql = "SELECT * FROM products WHERE id = '$productId'";
        $result = $conn->query($sql);
        if ($result!== false && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $stock = $row['quantity']+1;
                $sql = "UPDATE products SET quantity = $stock WHERE id = '$productId'";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['actionMsg'] = 'Product Deleted';
                }else{
                    $_SESSION['actionMsg'] = 'Error removing product from cart';
                }
            }
        }

        if ($conn) $conn-> close();
        unset($_POST["deleteItemBtn"]);
        header("Location: ../cart.php");
        
    } 


?>