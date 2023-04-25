<?php 
    include 'utils.php';
    session_start();
    $_SESSION['errors'] = false;	// Set to no errors

    if (isset($_POST["deleteOrderBtn"])){
        $order = $_POST["deleteOrderBtn"];
        include 'dbConnection.php';
        $sql = "SELECT * FROM productsordered WHERE orderId = '$order'";
        $result = $conn->query($sql);
        if ($result!== false && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $prod = $row["productId"];
                $sql_name = "SELECT * FROM products WHERE id = '$prod'";
                $result_name = $conn->query($sql_name);
                if ($result_name!== false && $result_name->num_rows > 0) {
                    while($row_name = $result_name->fetch_assoc()) {
                        $stock = $row_name['quantity']+1;
                        $sql = "UPDATE products SET quantity = $stock WHERE id = '$prod'";
                        if ($conn->query($sql) === TRUE) {
                            $sql = "DELETE FROM orders WHERE id = '$order'";

                            if ($conn->query($sql) === TRUE) {
                                //delete from products ordered
                                $sql = "DELETE FROM productsordered WHERE orderId = '$order'";

                                if ($conn->query($sql) === TRUE) {
                                    //delete from products ordered
                                    $_SESSION['actionMsg'] = 'Order deleted';
                                }else{
                                    $_SESSION['actionMsg'] = 'Error deleting order';
                                }
                            }else{
                                $_SESSION['actionMsg'] = 'Error deleting order';
                            }
                            
                        }else{
                            $_SESSION['actionMsg'] = 'Error deleting order';
                        }
                    }
                }  
            }
        }  

        if ($conn)$conn->close();
        header("Location: ../viewOrderDetails.php?id=".$order);
    }
?>