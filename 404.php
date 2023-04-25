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

<body class="flex flex-col min-h-screen">
	<?php
        include './scripts/utils.php';
		if(isGuest()){
             require './components/header_guest.php';
        }else if(isAdminAuth()){
            require './components/header_admin.php';
        }else if(isVendorAuth()){ 
            require './components/header_vendor.php';
        }else{
            require './components/header.php';
        }	
	 ?>

	<div class=" flex flex-col my-16 container mx-auto">
		<h1 class="font-bold text-gray-700 text-9xl text-center my-4">404</h1>
        <p class="text-gray-500 text-2xl text-center my-4">Page not found</p>
	</div>

	<?php require './components/footer.php'; ?>
</body>

</html>