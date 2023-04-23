<?php 
    include 'utils.php';
    session_start();
    $_SESSION['errors'] = false;	// Set to no errors

    if (isset($_POST["login"])){

        $email = trim($_POST["email"]);
        if (empty($email)){
            createError("email", "errEmail", "Your email address is required!"); 
        }else{
            $_SESSION['email'] = $email;
            $_SESSION['errEmail'] = "";
        }
   
        $password = trim($_POST["password"]);
        if (empty($password)){
            createError("password", "errPassword", "Your password is required!"); 
        }else{
            if (preg_match("/^(?=.*?[a-zA-Z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/",$password)){
                $_SESSION['password'] = $password;
                $_SESSION['errPassword'] = "";			
            }else{
                createError("password", "errPassword", "Your password is not valid!"); 
            }
        }
        
        if ($_SESSION['errors']){
            setErrorMsg("errLogin","Error logging in. Please Try again!");
            header("Location: ../login.php");
        }else{
        
            include 'dbConnection.php';
           
            $hashed_pwd = hash('sha256', $password);
            
            $sql = "SELECT * FROM users WHERE (email ='$email' or username='$email') and hashed_pwd = '$hashed_pwd'";
            $result = $conn->query($sql);
            $_SESSION['userId'] = "";
            $_SESSION['accType'] = "";

            if ($result !== false && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $_SESSION['accType'] = $row["accType"];
                    $_SESSION['userId'] = $row["id"];
                }

                $_SESSION['errLogin'] = "";
            } else {
                setErrorMsg("errLogin","Invalid Credentials");
            }

            setActive($_SESSION['userId']);
            
            if ($_SESSION['accType'] == "admin"){	
                header("Location: ../admin.php");
            }else if ($_SESSION['accType'] == "vendor"){
                header("Location: ../vendor.php");
            }else{
                setErrorMsg("errLogin",$_SESSION['userId']);
                header("Location: ../login.php");
            }
        }
    }else{
        header("Location: ../login.php");
    }
