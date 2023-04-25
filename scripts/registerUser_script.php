<?php 
			
    include 'utils.php';
    session_start();
    $_SESSION['errors'] = false;	// Set to no errors 

    // Get the data from the form
    if (isset($_POST["submit"])){

        $username = trim($_POST["username"]);
        $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);


        
        // validate first name
        if (empty($username)){					
            createError("username", "errUsername", "Your First Name is required!"); 
        }else{
            
            if (preg_match("/^[a-zA-Z]*$/",$username)){
                //check if exists in db
                include 'dbConnection.php';
            
                $sql = "SELECT * FROM users WHERE username = '$username'";
                $result = $conn->query($sql);

                if ($result == false || $result->num_rows == 0) {
                    $_SESSION['username'] = $username;
                    $_SESSION['errUsername'] = "";
                }else{
                    createError("username", "errUsername", "Username Already exists"); 
                }
                if ($conn)$conn->close();
            }else{
                createError("username", "errUsername", "Your Username can only contain letters!"); 
            }
        }
        
        $firstname = trim($_POST["firstname"]);
        $lastname = trim($_POST["lastname"]);
        $firstname = filter_var($_POST["firstname"], FILTER_SANITIZE_STRING);
        $lastname= filter_var($_POST["lastname"], FILTER_SANITIZE_STRING);

        
        // validate first name
        if (empty($firstname)){					
            createError("firstname", "errFirstname", "Your First Name is required!"); 
        }else{
            if (preg_match("/^[a-zA-Z]*$/",$firstname)){
                $_SESSION['firstname'] = $firstname;
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
                $_SESSION['lastname'] = $lastname;
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

                if ($result == false || $result->num_rows == 0) {
                    $_SESSION['email'] = $email;
                    $_SESSION['errEmail'] = "";
                }else{
                    createError("email", "errEmail", "Email Already exists"); 
                }
                if ($conn)$conn->close();
              
            }else{    
                createError("email", "errEmail", "Your email address is not valid!"); 
            }
        }

        $phone = trim($_POST["phone"]);
        $phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);

        
        if (empty($phone)) {
            createError("phone", "errPhone", "Your phone number is required!"); 
        }else{
            if (preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/",$phone)){
                $_SESSION['phone'] = $phone;
                $_SESSION['errPhone'] = "";
            }else{
                createError("phone", "errPhone", "Your phone number is not valid!"); 
            }
        }

        $password_1 = trim($_POST["password_1"]);
        $password_2 = trim($_POST["password_2"]);
        $password_1= filter_var($_POST["password_1"], FILTER_SANITIZE_STRING);
        $password_2= filter_var($_POST["password_2"], FILTER_SANITIZE_STRING);

        $password_length = strlen($password_1);
        if (empty ($password_1) || empty ($password_2)){
            empty ($password_1) ? createError("password_1", "errPassword", "Your passwords are required!") : "" ;
            empty ($password_2) ? createError("password_2", "errPassword", "Your passwords are required!") : "" ;
        }else{
        
            if ($password_1 == $password_2){
                if (preg_match("/^(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[a-zA-Z]).*$/",$password_1)){
                    $_SESSION['password_1'] = $password_1;
                    $_SESSION['password_2'] = $password_2;
                    $_SESSION['errPassword'] = ""; 
                }else{
                    createError("password_1", "errPassword", "Your password must be at least 8 characters long and contain at least one number and one special character!");
                    createError("password_2", "errPassword", "Your password must be at least 8 characters long and contain at least one number and one special character!");  
                }

            }else{
                createError("password_1", "errPassword", "Your passwords do not match!"); 
                createError("password_2", "errPassword", "Your passwords do not match!");
            }
        }

        $accType = isset($_POST["accType"]) && !empty($_POST["accType"]) ? $_POST["accType"] : "guest";
        
        if ($_SESSION['errors']){
            header("Location: ../register.php");
            exit(); 
        }else{
            include 'dbConnection.php';
            
            //hash the password
            $hashed_pwd = hash('sha256', $password_1);
            $id = uniqid();
            $insert_query = "INSERT INTO users (id, username, firstname, lastname, email, hashed_pwd, phone, accType, status)
                VALUES ('$id', '$username', '$firstname','$lastname','$email','$hashed_pwd','$phone', '$accType', 'inactive')";
           
            $result = $conn->query($insert_query);
            
            if ($result === TRUE){
                echo "<span style='color:green;text-align:left;'>Data Inserted Successfully!</span> <br>";
            }else{
                //set error
                $_SESSION['errors'] = true;
                if ($conn)$conn->close();
                header("Location: ../register.php");
                exit();
                // echo "<span style='color:red;text-align:left;'>Data Insertion Failed!</span> <br>";
            }

            //close connection
            if ($conn)$conn->close();
            header("Location: ../admin.php");
        }
}
