<?php
	include("connect.php");
	
	$cart = $_SESSION["cart"];
	$user = $_SESSION["username"];
	
	//	Create a new order and get its ID
	$new_order = mysqli_prepare($con, "insert into user_carts (username) values (?)");
	mysqli_stmt_bind_param($new_order, 's', $user);
	mysqli_stmt_execute($new_order);
	
	$order_no = mysqli_insert_id($con);
	
	//	Add products to the order's table along with quantity
	foreach ($cart as $item) {
		$add_item = mysqli_prepare($con, "insert into orders (cart_id, prod_id, qty) values (?, ?, ?)");
		$qty = 1;
		mysqli_stmt_bind_param($add_item, 'iii', $order_no, $item['product_id'], $qty);
		mysqli_stmt_execute($add_item);
	}
	
	mysqli_close($con);
	
	//	Reset cart and close.
	$_SESSION["cart"] = NULL;
	header("location: Online_Art_Gallery.html");
?>
