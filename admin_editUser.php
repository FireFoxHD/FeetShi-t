<?php
    include './scripts/utils.php';
    session_start();
    if(!isAdminAuth()) header("Location: ./login.php");
    
    if(!isset(
        $_SESSION['errUsername'],
        $_SESSION['errFirstname'],
        $_SESSION['errLastname'],
        $_SESSION['errEmail'],
        $_SESSION['errPassword'],
        $_SESSION['errPhone'])
    ){
        $_SESSION['errUsername'] = "";
        $_SESSION['errFirstname'] = "";
        $_SESSION['errLastname'] = "";
        $_SESSION['errEmail'] = "";
        $_SESSION['errPassword'] = "";
        $_SESSION['errPhone'] = "";
    }


    if(isset($_GET['id'])){
        $user = $_GET['id'];
        include './scripts/dbConnection.php';
        $sql = "SELECT * FROM users WHERE id = '$user'";
        $result = $conn->query($sql);

        if ($result !== false && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $username = $row['username'];
                $firstname = $row['firstname'];
                $lastname =  $row['lastname'];
                $email = $row['email'];
                $phone = $row['phone'];
                $accType = $row['accType'];
            }
        }else{
            //redirect
        }
    
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
            <h1 class="font-bold text-gray-700 text-2xl p-4">Edit user</h1>
        </div>

        <div class="flex items-center justify-center w-1/4">
            <form class="flex flex-col items-center justify-center my-6 w-full" action="./scripts/admin_script.php" method="POST">
                
                <input name="userId" type="text" value="<?php echo $user?>" hidden>
            
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
                    <input name="email" type="text" value="<?php echo $email?>" class="bg-white border-2 border-slate-300 text-gray-900 text-sm rounded focus:ring-blue-500 placeholder-blueGray-300 block w-full p-2.5" autocomplete="off">
                </div>
    
                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Password</label> <?php echo $_SESSION['errPassword']; ?>
                    <input name="password" type="password" placeholder="(Optional)" class="bg-white border-2 border-slate-300 text-gray-900 text-sm rounded focus:ring-blue-500 placeholder-blueGray-300 block w-full p-2.5" autocomplete="off">
                </div>


                <div class="m-2 w-full">
                    <label class="text-blueGray-600 font-bold mb-2">Account type</label>
                    <select name="accType" class="bg-white border-2 border-slate-300 text-gray-900 text-sm rounded focus:ring-blue-500 placeholder-blueGray-300 block w-full p-2.5" required>
                        <option value="" disabled hidden>Select Account Type</option>
                        <option <?php if($accType == "admin") echo 'selected'?> value="admin">Admin</option>
                        <option <?php if($accType == "vendor") echo 'selected'?> value="vendor">Vendor</option>
                        <option <?php if($accType == "guest") echo 'selected'?> value="guest">Guest</option>
                    </select>
                </div> 
    
                <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 w-32 rounded my-4" id="saveForm" type="submit" name="updateUserBtn" value="Update User" />
    
            </form>
        </div>
    </div>
</body>

</html>