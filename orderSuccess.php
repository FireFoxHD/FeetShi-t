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
        session_start();
        include './scripts/utils.php';
        include './scripts/dbConnection.php';
        $order = $_GET['id'];
        $sql = "SELECT * FROM orders WHERE id = '$order'";
        $result = $conn->query($sql);
        if ($result === false || $result->num_rows == 0) {
            header("Location: 404.php");
        }
        if ($conn)$conn->close();
        require './components/header_guest.php';
	 ?>
    
	<div class=" flex flex-col my-16 container mx-auto">
		<h1 class="font-bold text-gray-700 text-6xl text-center my-4">Your order has been successfully placed</h1>
        <p class="text-gray-500 text-4xl text-center font-bold my-4">Order number: #<?php echo $order;?></p>
        <div class="flex flex-col item-center justify-center p-8">
            <p class="text-neutral-700 text-2xl text-center font-medium">Order will be available for pickup within 5-10 days. <br> Please visit us at 5 Fairmont Dr, Kingston, Jamaica.</p>
            <p class="text-neutral-700 text-2xl text-center font-medium my-4">Please remember to walk with valid ID and <br> your card used to make this order for verification.</p>
        </div>
    </div>

	<?php require './components/footer.php'; ?>
</body>

</html>