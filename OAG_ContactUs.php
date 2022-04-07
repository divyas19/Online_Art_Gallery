<?php
$insert =false;
if(isset($_POST['name'])){
    //Set connection variables
    $server ="localhost";
    $username ="root";
    $password ="";
    
    //Create a database connection
    $con =mysqli_connect($server,$username,$password);
    
    //Check for connection success
    if(!$con){
        die("connection to this database failed due to".mysqli_connect_error());
    
    }
    //echo "Success connecting to db";
    
    //Collect post variables
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];
    $sql="INSERT INTO `art`.`contact` (`name`, `email`, `phone`, `message`) VALUES ('$name', '$email', '$phone', '$message');";
    

   //Execute the query
    if($con->query($sql) == true){
        // echo "Successfully inserted";

        //flag for successful insertion
        $insert=true;
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }
    
    //Close the database connection
    $con->close();
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
    body {
            color: white;
            margin: 0px;
            padding: 0px;
            margin: 70px  640px;
            background-size: cover;
            background-color: grey;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 15px;
        }
        </style>
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="Online_Art_Gallery.html">Home <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>


    <section id="contact">
        <h1 class="h-primary center">Contact Us<br></h1>
        <div id="contact-box">
        <form action="OAG_ContactUs.php" method="post">
                <div class="form-group">
                    <label for="name"><b>Name: </b></label>
                    <input type="text" name="name" id="name" placeholder="Enter your name">
                    <p><br></p>
                </div>
                <div class="form-group">
                    <label for="email"><b>Email: </b></label>
                    <input type="email" name="email" id="email" placeholder="Enter your email">
                    <p><br></p>
                </div>
                <div class="form-group">
                    <label for="phone"><b>Phone Number: </b></label>
                    <input type="phone" name="phone" id="phone" placeholder="Enter your phone">
                </div>
                <div class="form-group">
                    <label for="message"><br><br><b>Message: </b><br></label>
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                    <p><br></p>
                </div>
                <button class="btn">Request</button> 
            </form>
        </div>
    </section>
</body>
</html>
