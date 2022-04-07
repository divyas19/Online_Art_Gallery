<?php

/*session_start();

require_once ("php/CreateDb.php");
require_once ("php/component.php");

$db = new CreateDb("art", "product");
*/
echo "If the product is available then only it will be delivered.Please wait for the confirmation after placing the order";
include("connect.php");

if (isset($_POST['remove'])){
  if ($_GET['action'] == 'remove'){
	  foreach ($_SESSION['cart'] as $key => $value){
		  if($value["product_id"] == $_GET['id']){
			  unset($_SESSION['cart'][$key]);
			  //echo "<script>alert('Product has been Removed...!')</script>";
			  echo "Product has been Removed...!";
			  //echo "<script>window.location = 'cart.php'</script>";
		  }
	  }
  }
}


?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Cart</title>

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.css" />

	<!-- Bootstrap CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <!-- <a class="navbar-brand" href="#">Php Login System</a> -->
  <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button> -->
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="Online_Art_Gallery.html">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Online_Art_Gallery.html">Logout</a> 
      </li>

      
     
    </ul>
  </div>

<?php
	require_once ('php/header.php');
?>

<div class="container-fluid">
	<div class="row px-5">
		<div class="col-md-7">
			<div class="shopping-cart">
				<h1>My Cart</h1>
				<hr>

				<?php

				$total = 0;
					if (isset($_SESSION['cart'])){
						$product_id = array_column($_SESSION['cart'], 'product_id');

						$result = getData();
						while ($row = mysqli_fetch_assoc($result)){
							foreach ($product_id as $id){
								if ($row['id'] == $id){
									cartElement($row['product_image'], $row['product_name'],$row['product_price'], $row['id']);
									$total = $total + (int)$row['product_price'];
								}
							}
						}
					}else{
						echo "<h5>Cart is Empty</h5>";
					}

				?>

			</div>
		</div>
		<div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25">

			<div class="pt-4">
				<h6>PRICE DETAILS</h6>
				<hr>
				<div class="row price-details">
					<div class="col-md-6">
						<?php
							if (isset($_SESSION['cart'])){
								$count	= count($_SESSION['cart']);
								echo "<h6>Price ($count items)</h6>";
							}else{
								echo "<h6>Price (0 items)</h6>";
							}
						?>
						<h6>Delivery Charges</h6>
						<hr>
						<h6>Amount Payable</h6>
					</div>
					
					<div class="col-md-6">
						<h6>$<?php echo $total;?></h6>
						<h6 class="text-success">FREE</h6>
						<hr>
						<h6>$<?php echo $total;?></h6>
					</div>
					<?php
						if ((isset($_SESSION['cart'])) and (count($_SESSION['cart']) > 0)) {
							echo '<a href="save.php" class="btn">Order Now</a>';
							
							//unset($_SESSION["cart"]);
						}
						
						else {
							echo '<a href="" class="btn disabled">Order Now</a>';
							//unset($_SESSION['cart']);
						}

					?>
				</div>
			</div>

		</div>
	</div>
</div>

<!-- unset($_SESSION["cart"]); -->
<!-- session_destroy(); -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
