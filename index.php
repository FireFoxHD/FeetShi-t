<?php

session_start();
if (isset($_SESSION['userId'])) {
	include './scripts/utils.php';
	if (setInactive($_SESSION['userId'])) {
		session_destroy();
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
	<?php require './components/header.php'; ?>
	<?php require './scripts/dbConnection.php'; ?>

	<div class=" flex flex-col my-16 container mx-auto">
		<h1 class="font-bold text-gray-700 text-6xl text-center my-4">Welcome to Feetsh*t</h1>
	</div>


	<p class="font-bold text-gray-700 text-3xl mx-12 my-2">Boots</p>

	<div class="container grid grid-cols-4 gap-2 mx-auto">
		<?php
			$sql = "SELECT id, imgPath FROM products";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					echo '
						<div class="aspect-square overflow-hidden">
							<a href="product.php/?id='.$row["id"].'">
								<img  
									class="h-full w-full object-cover transition-all duration-300 hover:scale-125"
									src='.$row["imgPath"].' 
								/>
							</a>
						</div>
					';
				}
			}

		?>

	</div>





</body>

</html>