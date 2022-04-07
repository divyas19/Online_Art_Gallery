<?php
$insert = false;
if(isset($_POST['name'])){
$server = "localhost";
$username = "root";
$password = "";
$dbname="art";

$con = mysqli_connect($server, $username, $password, $dbname);


if($con->connect_error){
    echo("connection to this database failed due to".$con->connect_error);
}

    $name = $_POST['name']; 
    $email = $_POST['email']; 
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $username = $_POST['username']; 
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];


if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
        echo"$username_err";
    }
    


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
    echo"$password_err";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
    echo"$password_err";
}
elseif(strlen(trim($_POST['password'])) > 20){
  $password_err = "Password cannot be more than 10 characters ";
  echo($password_err);
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['cpassword'])){
    $password_err = "Passwords should match";
    echo"$password_err";
}


else{

  $sql = "SELECT username FROM artists WHERE username = '$username'";
  $stmt = mysqli_query($con, $sql);
  $row = mysqli_num_rows($stmt);
  if($row>0){
      echo "Error, Username already exists. Try something else.";
  }
  else 
  {
      if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
      // $password=password_hash($password,PASSWORD_DEFAULT);
  $sql = "INSERT INTO `art`.`artists`(`name`, `email`,  `phone`, `gender`, `address`, `city`, `state`, `username`, `password`) VALUES ('$name', '$email', '$phone', '$gender', '$address', '$city', '$state', '$username', '$password');";
      $stmt = mysqli_query($con, $sql);
          if($stmt)
          {   
               echo "Thanks for submitting.";
          }
      }

  }   

}

mysqli_close($con);
}
} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="L&R_Register.css">
</head>     
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="Online_Art_Gallery.html">Home <span class="sr-only">(current)</span></a>
      </li>
  
    </ul>
  </div>
</nav>
    <div class="container">
        <h1>Artist Registration Form</h1>
        <p>Enter your deatils and submit the form to confirm your registration.</p>
        <?php
        if($insert == true){
            echo "<p class='submitMsg'>Thanks for submitting your form.We are happy to see you joining us for the Nandi Hills trip.</p>";
        }
        ?>
        <form action="L&R_RegisterA.php" method="post">
        <input type="name" name="name" id="name" placeholder="Enter your name"> 
        <input type="email" name="email" id="email" placeholder="Enter your email">
        <input type="phone" name="phone" id="phone" placeholder="Enter your phone">
        <input type="gender" name="gender" id="gender" placeholder="Enter your gender">
        <textarea name="address" id="address" cols="30" rows="3" placeholder="Enter yor address here"></textarea>
        <input type="city" name="city" id="city" placeholder="Enter your city">
        <input type="state" name="state" id="state" placeholder="Enter your state">
        <input type="username" name="username" id="username" placeholder="Enter your username">
        <input type="password" name="password" id="password" placeholder="Enter your password">
        <input type="password" name="cpassword" id="cpassword" placeholder="Enter your password to confirm">
        <button class="btn">Submit</button>
        <!-- <button class="btn">Reset</button> -->
        </form>
    </div>
    <script src="index.js"> </script>
    
</body>
</html>
