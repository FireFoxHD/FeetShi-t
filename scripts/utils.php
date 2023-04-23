<?php
    function createError($variableName, $errorName, $msg){
        $_SESSION[$errorName] = '<span class="ml-6 text-red-500 font-semibold italic "><i class="fa fa-exclamation-triangle text-red-500" aria-hidden="true"></i>'.' '.$msg.'</span> <br>';
        $_SESSION['errors'] = true;
        $_SESSION[$variableName] = "";
    }

    function setErrorMsg($errorName, $msg){
        $_SESSION[$errorName] = '<span class="text-red-500 font-semibold italic "><i class="fa fa-exclamation-triangle text-red-500" aria-hidden="true"></i>'.' '.$msg.'</span> <br>';
    }

    function isLoggedIn($id){
        if(!isset($conn))
            include 'dbConnection.php';

        if(isset($conn)){
            $sql = "SELECT * FROM users WHERE id ='$id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if($row["status"] == "active")
                       return true;
                    return false;
                }
            }
            if ($conn) $conn->close();
        }
    }

    function getAccType($id){
        if(!isset($conn))
            include 'dbConnection.php';
        
        $sql = "SELECT * FROM users WHERE id ='$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                return $row["accType"];
            }
        }
        if ($conn) $conn->close();
    }

    function setActive($id){
        if(!isset($conn))
            include 'dbConnection.php';

        if(isset($id)){
            $sql = "UPDATE users SET status='active' WHERE id='$id'";
            if ($conn->query($sql) === TRUE) 
                return true;
            return false;
            if ($conn) $conn->close();
        }
    }

    function setInactive($id){
        if(!isset($conn))
            include 'dbConnection.php';

        if(isset($id)){
            $sql = "UPDATE users SET status='inactive' WHERE id='$id'";
            if ($conn->query($sql) === TRUE) 
                return true;
            return false;
            if ($conn) $conn->close();
        }
    }

    function logConsole($msg){
        //works only in structure files
        echo "<script>console.log('$msg')</script>";
    }

    function isAdminAuth(){
        if(session_status() === PHP_SESSION_NONE) session_start();
        if(!isset($_SESSION['userId']) or !isLoggedIn($_SESSION['userId']) or !(getAccType($_SESSION['userId']) == "admin")){
            return false;
        }
        return true;
    }

    function isVendorAuth(){
        if(session_status() === PHP_SESSION_NONE) session_start();
        if(!isset($_SESSION['userId']) or !isLoggedIn($_SESSION['userId']) or !(getAccType($_SESSION['userId']) == "vendor")){
            return false;
        }
        return true;
    }
?>