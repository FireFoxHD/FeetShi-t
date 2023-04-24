<?php
     include './scripts/utils.php';
    session_start();
    if(!isAdminAuth()) header("Location: ./login.php");
    if(!isset($_POST["searchBtn"]) && !isset($_POST["search"]))
        header("Location: ./admin.php");
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
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/icons/favicon-16x16.png">
    <title>Feetsh*t</title>
</head>
<body>
    <?php require './components/header_admin.php'; ?>
    <?php include './scripts/dbConnection.php'; ?>

    <div class="flex flex-col mt-16 mb-4 w-full items-center justify-center">
        <h1 class="font-bold text-gray-700 text-4xl text-center my-4">View Users</h1> 

        <form class="flex items-center mt-4" action="./admin_userSearch.php" method="POST">   
            <label for="search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" name="search" class="pl-10 pr-2 h-10 w-full py-1 rounded-lg border border-gray-400 focus:border-gray-600 focus:outline-none focus:shadow-inner leading-none" placeholder="Search">
            </div>
            <button type="submit" class="h-10 px-5 mx-4 rounded-lg bg-indigo-600 focus:outline-none hover:bg-indigo-500 text-white text-md" name="searchBtn" type="submit" value="Search">
                Search
            </button>
        </form>

    </div>

    <div class="flex flex-col items-center justify-center w-full">
        <table class="text-center text-sm font-light w-2/3">
            <thead class="bg-neutral-800 font-medium text-white uppercase ">
                <tr>
                    <th scope="col" class="px-6 py-4">Firstname</th>
                    <th scope="col" class="px-6 py-4">Lastname</th>
                    <th scope="col" class="px-6 py-4">Account</th>
                    <th scope="col" class="px-6 py-4">Status</th>
                    <th scope="col" class="px-6 py-4">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    if(!isset($_POST['search'])){
                        echo '
                        <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-200">
                            <td colSpan="5" class="px-6 py-4 text-center">No Results</td>
                        </tr>';
                    }else{

                    

                        $search = mysqli_real_escape_string($conn, $_POST['search']);
                    
                        $sql = "SELECT * FROM users
                                WHERE firstname LIKE '%$search%' 
                                OR lastname LIKE '%$search%'
                                OR email LIKE '%$search%'
                                OR phone LIKE '%$search%'";

                        $result = $conn->query($sql);

                        if ($result!== false && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {

                            if ($row["status"] == 'inactive')
                                $colorStyle= 'bg-red-500';
                            else{
                                $colorStyle= 'bg-green-500';
                            }

                            echo '
                                <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-200">
                                    <td class="px-6 py-4">'.$row["firstname"].'</td>
                                    <td class="px-6 py-4">'.$row["lastname"].'</td>
                                    <td class="px-6 py-4">'.$row["accType"].'</td>
                                    <td class="px-6 py-4">
                                        <span class="px-4 py-2 rounded-lg text-white '.$colorStyle.'"> '.$row["status"].'</span>  
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="./scripts/admin_script.php" method="POST"> 
                                            <button name="editUser" value="'.$row["id"].'" class="px-4 py-2 rounded-lg bg-blue-500 text-white hover:bg-blue-600"">
                                                <i class="fa fa-pencil text-white px-2" aria-hidden="true"></i>Edit
                                            </button>
                                            <button  name="deleteUser" value="'.$row["id"].'" class="px-4 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600"">
                                                <i class="fa fa-trash text-white px-2" aria-hidden="true"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                    </td>
                                </tr>    
                            ';
                            }
                        }else{
                            echo '
                            <tr class="border-b transition duration-300 ease-in-out hover:bg-neutral-200">
                                <td colSpan="5" class="px-6 py-4 text-center">No Results</td>
                            </tr>';
                        }
                    
                        if ($conn) $conn-> close();
                    }
                ?>
            </tbody>
        </table>
        
    <div>


</body>
</html>