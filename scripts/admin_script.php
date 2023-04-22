<?php 
    include 'utils.php';
    session_start();
    if(!isAdminAuth()) header("Location: ./login.php");
    
    $_SESSION['errors'] = false;	// Set to no errors

    if (isset($_POST["editUserBtn"])){
        $_SESSION['userId'] = $_POST['editUser'];
        header("Location: ../admin_editUser.php");
    }

    if (isset($_POST["deleteUserBtn"])){
        include 'dbConnection.php';

        $userId = $_POST['deleteUserBtn'];
        $sql = "DELETE FROM users WHERE id = '$userId'";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['actionMsg'] = 'User Deleted';
        }else{
            $_SESSION['actionMsg'] = 'Error deleting record';
        }

        if ($conn)$conn->close();
        header("Location: ../admin.php");
    } 

        
    
    
    if (isset($_POST["editUserSubmit"])){
        //from edit user page
    }