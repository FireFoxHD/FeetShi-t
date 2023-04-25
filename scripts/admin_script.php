<?php 
    include 'utils.php';
    session_start();
    if(!isAdminAuth()) header("Location: ./login.php");
    
    $_SESSION['errors'] = false;	// Set to no errors

    if (isset($_POST["updateUserBtn"])){
        $userId = $_POST['userId'];
        $username = strtolower(trim($_POST["username"]));
        
        // validate first name
        if (empty($username)){					
            createError("username", "errUsername", "Your First Name is required!"); 
        }else{
            if (preg_match("/^[a-zA-Z]*$/",$username)){
                //check if exists in db
                include 'dbConnection.php';
            
                $sql = "SELECT * FROM users WHERE username = '$username'";
                $result = $conn->query($sql);

                if ($result !== false && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if($row['username'] == $username && $row['id'] == $userId){
                            $_SESSION['errUsername'] = "";
                        }else{

                            createError("", "errUsername", "belongs to another user"); 
                        }
                    }
                }else{
                    $_SESSION['errUsername'] = "";
                }

                if ($conn)$conn->close();
            }else{
                createError("username", "errUsername", "Your Username can only contain letters!"); 
            }
        }
        
        $firstname = trim($_POST["firstname"]);
        $lastname = trim($_POST["lastname"]);
        
        // validate first name
        if (empty($firstname)){					
            createError("firstname", "errFirstname", "Your First Name is required!"); 
        }else{
            if (preg_match("/^[a-zA-Z]*$/",$firstname)){
                $_SESSION['errFirstname'] = "";
            }else{
                createError("firstname", "errFirstname", "Your First Name can only contain letters!"); 
            }
        }
        
        // validate last name
        if (empty($lastname)){
            createError("lastname", "errLastname", "Your Last Name is required!"); 
        }else{
            if (preg_match("/^[a-zA-Z'-]*$/",$lastname)){
                $_SESSION['errLastname'] = "";
            }else{
                createError("lastname", "errLastname", "our Last Name must contain only letters, hyphen (-) and the apostrophe (')!"); 
            }
        }

        $email = trim($_POST["email"]);
        if (empty($email)) {
            createError("email", "errEmail", "Your email address is required!"); 
        }else{
            
            if (filter_var($email, FILTER_VALIDATE_EMAIL)){
                include 'dbConnection.php';
            
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = $conn->query($sql);

                if ($result !== false && $result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if($row['email'] == $email && $row['id'] == $userId){
                            $_SESSION['errEmail'] = "";
                        }else{
                            createError("", "errEmail", "Email belongs to another user"); 
                        }
                    }
                }else{
                    $_SESSION['errEmail'] = "";
                }
                
                if ($conn)$conn->close();
              
            }else{    
                createError("email", "errEmail", "Your email address is not valid!"); 
            }
        }

        $phone = trim($_POST["phone"]);
        if (empty($phone)) {
            createError("phone", "errPhone", "Your phone number is required!"); 
        }else{
            if (preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/",$phone)){
                $_SESSION['errPhone'] = "";
            }else{
                createError("phone", "errPhone", "Your phone number is not valid!"); 
            }
        }
        
        $accType = isset($_POST["accType"]) && !empty($_GET["accType"]) ? $_GET["accType"] : "guest";

       
            $password = $_POST["password"];
            include 'dbConnection.php';
        if (!empty($password)) {

            if (preg_match("/^(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[a-zA-Z]).*$/",$password)){
                $_SESSION['errPassword'] = ""; 
            }else{
                createError("", "errPassword", "Your password must be at least 8 characters long and contain at least one number and one special character!"); 
            }    
                //update /without pass
            $hashed_pwd = hash('sha256', $password);
            $sql = "UPDATE users SET username='$username', firstname='$firstname', lastname='$lastname', email='$email', phone='$phone', hashed_pwd='$hashed_pwd', accType='$accType' WHERE id = '$userId'";
        }else{
                //update /w pass
            $sql = "UPDATE users SET username='$username', firstname='$firstname', lastname='$lastname', email='$email', phone='$phone', accType='$accType' WHERE id = '$userId'";
        } 

        if(!$_SESSION['errors']){

            if ($conn->query($sql) === TRUE) {
                header("Location: ../admin.php");
            }else{
                //error updating
                header("Location: ../admin_editUser.php?id=".$userId);
            }
        }else{
            //errors in data entry
            header("Location: ../admin_editUser.php?id=".$userId);
        }

        
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