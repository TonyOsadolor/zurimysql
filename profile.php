<?php

require_once('login.php');

date_default_timezone_set("Africa/Lagos");

//Checking to see if this Session is set
if(isset($_SESSION['email'])){
    
    $sql = "SELECT * FROM students WHERE email = '".$_SESSION['email']."'";
    
    $result = mysqli_query ($conn, $sql);
    
    $rows = mysqli_fetch_assoc($result);
    
    $surname = $rows["surname"];
    $othernames = $rows["othernames"];
    $phone = $rows["phone"];
    $email = $rows["email"];
    $status = $rows["status"];


?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>My Zuri MySQL Profile</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/styles.css">
	</head>
	<style>
        body{
            background-color: aliceblue;
        }
        .nav-tabs{
            padding: 5px;
        }
        .nav-link{
            margin-left: 5%;
            align-content: center;
        }
        .nav-item a{
            color:white;
            font-weight: bold;
            text-decoration: none;
        }
        .overlay{
           margin: 2%; 
        }
    </style>
	<body>
        <nav class="navbar navbar-dark bg-dark">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="profile.php" class="nav-link active">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">Logout</a>
                </li>
            </ul>
            <marquee behavior="" direction="" style="color:white;"><b><?php echo $othernames; ?></b> Welcome to your Profile</marquee>
        </nav>
		<div class="container">
		    <div class="row">
		        <div class="overlay"></div>
		        <div class="col-12">
		            <div class="container">
		                <div class="card text-center">
		                    <div class="card-header">
		                        <h2><?php echo $surname ." ". $othernames; ?></h2>
		                    </div>
		                    <div class="card-body">
		                        <h4 class="card-title"><?php echo $phone; ?></h4>
		                        <h4 class="card-title"><?php echo $email; ?></h4>
		                        <p class="card-text">Account Status: <?php echo $status?></p>
		                        <a href="resetpassword.php" class="btn btn-primary">Reset Password</a>
		                    </div>
		                    <div class="card-footer text-muted">My Zuri MySQL Assignment</div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
	</body>
</html>


<?php
    
    
}

else{
    echo "<script>alert('Please, kindly Login')</script>";
    
    echo "<script>location.href='index.php'</script>";
    
    return false;
}

?>