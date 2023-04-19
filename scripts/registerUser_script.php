<?php 
			
    include 'utils.php';
    session_start();
    $_SESSION['errors'] = false;	// Set to no errors 

    // Get the data from the form
    if (isset($_POST["submit"])){
        
        $firstname = trim($_POST["firstname"]);
        $lastname = trim($_POST["lastname"]);
        
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
                $_SESSION['email'] = $email;
                $_SESSION['errEmail'] = "";
            }else{    
                createError("email", "errEmail", "Your email address is not valid!"); 
            }
        }

        $phone = trim($_POST["phone"]);
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
        $password_length = strlen($password_1);
        if (empty ($password_1) || empty ($password_2)){
            empty ($password_1) ? createError("password_1", "errPassword", "Your passwords are required!") : "" ;
            empty ($password_2) ? createError("password_2", "errPassword", "Your passwords are required!") : "" ;
        }else{
        
            if ($password_1 == $password_2){
           
                if (preg_match("/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/",$password_1)){
                    $_SESSION['password_1'] = $password_1;
                    $_SESSION['errPassword'] = ""; 
                }else{
                    createError("password_1", "errPassword", "Your password must be at least 8 characters long and contain at least one number and one special character!"); 
                }
                
            }else{
                createError("password_1", "errPassword", "Your passwords do not match!"); 
                createError("password_2", "errPassword", "Your passwords do not match!");
            }
        }

        $dob = trim($_POST["dob"]);
        if (empty($dob)){
            createError("dob", "errDob", "Your date of birth is required!"); 
        }else{
            $_SESSION['dob'] = $dob;
            $_SESSION['errDob'] = '';
        }
        
        if ($_SESSION['errors']){
            header("Location: ../addUsers.php");
        }else{
            include 'dbConnection.php';
            //hash the password
            $hashed_pwd = hash('sha256',$password_1);
            $id = uniqid();
            $insert_query = "INSERT INTO users (id, firstname, lastname, email, hashed_pwd,  dob, phone, accType)
                VALUES ( '$id', '$firstname','$lastname','$email','$hashed_pwd','$dob', '$phone' , '$accType', 'inactive')";
            echo $insert_query."<br>";
            $result = $conn->query($insert_query);
            
            if ($result === TRUE){
                echo "<span style='color:green;text-align:left;'>Data Inserted Successfully!</span> <br>";
            }else{
                echo "<span style='color:red;text-align:left;'>Data Insertion Failed!</span> <br>";
            }

            //close connection
            if ($conn)$conn->close();
            session_destroy();
        }
}
