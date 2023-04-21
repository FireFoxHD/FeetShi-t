<?php
    session_start();
	if(isset($_SESSION['errors'])){
        //to persist values after form submission in case use made an error
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];
    
		unset($_SESSION['errors']);		
	}else{

        if(isset($_SESSION['userId'])){
            include './scripts/utils.php';
            if(setInactive($_SESSION['userId'])){
                session_destroy();
            }
              
        }
    
        if(session_status() === PHP_SESSION_NONE) session_start();
        // Field values
        $_SESSION['email'] = "";
        $_SESSION['password'] = "";
    
        $email = "";
        $password =  "";
       
        //Error field values
        $_SESSION['errEmail'] = "";
        $_SESSION['errPassword'] = "";
        $_SESSION['errLogin'] = "";

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
    <?php require './components/header.php'; ?>
    
    <div class="flex flex-col items-center justify-center">
        <div class="flex flex-col items-center justify-center mt-12">
            <h1 class="font-bold text-gray-700 text-2xl p-4">Login</h1>
            <p class="text-gray-500 text-md text-center">Welcome back you degenerate!</p>
        </div>

        <div class="mt-2"> <?php echo $_SESSION['errLogin']; ?> </div>

        <div class="flex items-center justify-center w-1/4">
            <form class="flex flex-col items-center justify-center my-6 w-full" action="./scripts/login_script.php" method="POST">
                
                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Email</label><?php echo $_SESSION['errEmail']; ?>
                    <input name="email" type="text" value="<?php echo $email?>" class="bg-white border-2 border-slate-300 text-gray-900 text-sm rounded focus:ring-blue-500 placeholder-blueGray-300 block w-full p-2.5" autocomplete="off">
                </div>
    
                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Password</label><?php echo $_SESSION['errPassword']; ?>
                    <input name="password" type="text" value="<?php echo $password?>" class="bg-white border-2 border-slate-300 text-gray-900 text-sm rounded focus:ring-blue-500 placeholder-blueGray-300 block w-full p-2.5" autocomplete="off">                
                </div>
    
                <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 w-32 rounded my-4" id="saveForm" type="submit" name="login" value="Login" />
    
            </form>
        </div>
    </div>
</body>

</html>