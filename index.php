<?php
	session_start();
	include './scripts/utils.php';
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

<body class="flex flex-col min-h-screen">
	<?php
		if(isGuest()){
			require './components/header_guest.php';
		}else{
			require './components/header.php';
		}
		
	 ?>
	<?php require './scripts/dbConnection.php'; ?>

	<div class=" flex flex-col my-16 container mx-auto">
		<h1 class="font-bold text-gray-700 text-6xl text-center my-4">Welcome to Feetsh*t</h1>
	</div>

	<div class="container grid grid-cols-4 gap-2 mx-auto">
		<?php
			$sql = "SELECT id, imgPath FROM products";
			$result = $conn->query($sql);
			if ($result !== false && $result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					echo '
						<div class="aspect-square overflow-hidden">
							<a href="product.php?id='.$row["id"].'">
								<img  
									class="h-full w-full object-cover transition-all duration-300 hover:scale-125"
									src='.$row["imgPath"].' 
								/>
							</a>
						</div>
					';
				}
			}
			if ($conn) $conn-> close();
		?>
    </div>
	<?php require './components/footer.php'; ?>
</body>

</html>