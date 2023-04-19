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
        $_SESSION['userId'] = $_POST['deleteUser'];
        header("Location: ../admin.php");
    }
    
    if (isset($_POST["editUserSubmit"])){
        //from edit user page
    }