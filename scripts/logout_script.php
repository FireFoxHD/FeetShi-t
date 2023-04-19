<?php
    session_start();
    include 'utils.php';
    echo $_SESSION['userId'];
    if(isset($_POST['logout'])){
        if(setInactive($_SESSION['userId'])){
            if(session_destroy()){
                header("Location: ../index.php");
            }else{
                echo "Unable to destroy session";
            }  
        }else{
            echo "Unable to log out";
        }      
    }

?>