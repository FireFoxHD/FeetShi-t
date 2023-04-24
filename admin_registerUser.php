<?php
    include './scripts/utils.php';
	session_start();
    if(!isAdminAuth()) header("Location: ./login.php");
    
    if(!isset(
        $_SESSION['username'],
        $_SESSION['firstname'],
        $_SESSION['lastname'],
        $_SESSION['email'],
        $_SESSION['password_1'],
        $_SESSION['password_2'],
        $_SESSION['phone']) && isset($_SESSION['errors'])
    ){
        $_SESSION['username'] = "";
        $_SESSION['firstname'] = "";
        $_SESSION['lastname'] = "";
        $_SESSION['email'] = "";
        $_SESSION['password_1'] = "";
        $_SESSION['password_2'] = "";
        $_SESSION['phone'] = "";
        $_SESSION['errUsername'] = "";
        $_SESSION['errFirstname'] = "";
        $_SESSION['errLastname'] = "";
        $_SESSION['errEmail'] = "";
        $_SESSION['errPassword'] = "";
        $_SESSION['errPhone'] = "";
    }
    
	if(isset($_SESSION['errors'])){
        //to persist values after form submission in case use made an error
        $username = $_SESSION['username'];
        $firstname = $_SESSION['firstname'];
        $lastname =  $_SESSION['lastname'];
        $email = $_SESSION['email'];
        $password_1 = $_SESSION['password_1'];
        $password_2 = $_SESSION['password_2'];
        $phone = $_SESSION['phone'];
		unset($_SESSION['errors']);		
	}else{
        // Field values
        $_SESSION['username'] = "";
        $_SESSION['firstname'] = "";
        $_SESSION['firstname'] = "";
        $_SESSION['lastname'] = "";
        $_SESSION['email'] = "";
        $_SESSION['password_1'] = "";
        $_SESSION['password_2'] = "";
        $_SESSION['phone'] = "";
        $username = "";
        $firstname = "";
        $lastname =  "";
        $email = "";
        $password_1 = "";
        $password_2 = "";
        $phone = "";

        //Error field values
        $_SESSION['errUsername'] = "";
        $_SESSION['errFirstname'] = "";
        $_SESSION['errLastname'] = "";
        $_SESSION['errEmail'] = "";
        $_SESSION['errPassword'] = "";
        $_SESSION['errPhone'] = "";

    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/icons/favicon-32x32.png">
    <title>Feetsh*t</title>
</head>

<body>
    <?php require './components/header_admin.php'; ?>
    <div class="flex flex-col items-center justify-center">
        <div class="flex flex-col items-center justify-center mt-12">
            <h1 class="font-bold text-gray-700 text-2xl p-4">Create Account</h1>
            <p class="text-gray-500 text-md text-center">Enter user details to create their account</p>
        </div>

        <div class="flex items-center justify-center w-1/4">
            <form class="flex flex-col items-center justify-center my-6 w-full" action="./scripts/registerUser_script.php" method="POST">
                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Username</label><?php echo $_SESSION['errUsername']; ?>
                    <input name="username" type="text" value="<?php echo $username?>" class="bg-white border-2 border-slate-300 text-gray-900 text-sm rounded focus:ring-blue-500 placeholder-blueGray-300 block w-full p-2.5" autocomplete="off">
                    
                </div>

                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">First name</label><?php echo $_SESSION['errFirstname']; ?>
                    <input name="firstname" type="text" value="<?php echo $firstname?>" class="bg-white border-2 border-slate-300 text-gray-900 text-sm rounded focus:ring-blue-500 placeholder-blueGray-300 block w-full p-2.5" autocomplete="off">
                    
                </div>
    
                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Last name</label><?php echo $_SESSION['errLastname']; ?>
                    <input name="lastname" type="text" value="<?php echo $lastname?>" class="bg-white border-2 border-slate-300 text-gray-900 text-sm rounded focus:ring-blue-500 placeholder-blueGray-300 block w-full p-2.5" autocomplete="off">
                    
                </div>

                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Phone number</label> <?php echo $_SESSION['errPhone']; ?>
                    <input name="phone" type="text" placeholder="111-111-1111" value="<?php echo $phone?>"  class="bg-white border-2 border-slate-300 text-gray-900 text-sm rounded focus:ring-blue-500 placeholder-blueGray-300 block w-full p-2.5" autocomplete="off">
            
                </div> 
    
                <div class="m-2 w-full">
                    <label class=" text-blueGray-600 font-bold mb-2">Email</label><?php echo $_SESSION['errEmail']; ?>
                    <input name="email" type="text" class="bg-white border-2 border-slate-300 text-gray-900 text-sm rounded focus:ring-blue-500 placeholder-blueGray-300 block w-full p-2.5" autocomplete="off">
                </div>
    
                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Password</label> <?php echo $_SESSION['errPassword']; ?>
                    <input name="password_1" type="password" value="<?php echo $password_1?>"  class="bg-white border-2 border-slate-300 text-gray-900 text-sm rounded focus:ring-blue-500 placeholder-blueGray-300 block w-full p-2.5" autocomplete="off">
                
                </div>

                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Confirm Password</label>
                    <input name="password_2" type="password" value="<?php echo $password_2?>"  class="bg-white border-2 border-slate-300 text-gray-900 text-sm rounded focus:ring-blue-500 placeholder-blueGray-300 block w-full p-2.5" autocomplete="off">
                
                </div>

                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Account type</label>
                    <select name="accType" class="bg-white border-2 border-slate-300 text-gray-900 text-sm rounded focus:ring-blue-500 placeholder-blueGray-300 block w-full p-2.5" required>
                        <option value="" selected disabled hidden>Select Account Type</option>
                        <option value="admin">Admin</option>
                        <option value="vendor">Vendor</option>
                        <option value="guest">Guest</option>
                    </select>
                </div> 

                
    
    
                <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 w-32 rounded my-4" id="saveForm" type="submit" name="submit" value="Sign up" />
    
            </form>
        </div>
    </div>
</body>

</html>