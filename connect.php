<?php
	session_start();
	
	try {
		$con = mysqli_connect("localhost:3306", "root", "", "art");	//	rename to "art"
		
		function getData() {
			global $con;
			$sql = "SELECT * FROM producttb";
			$result = mysqli_query($con, $sql);

			if (mysqli_num_rows($result) <= 0) {
				echo "<SCRIPT>console.log('The products table is empty!');</SCRIPT>";
			}
			
			return $result;
		};
		
		include("php/component.php");
	}
	
	catch (Exception $e) {
		die("Error: " . $e -> getMessage());
	}
	
	function show_error($error) {
	echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error:</strong> '.$error.'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>';
	}
?>
