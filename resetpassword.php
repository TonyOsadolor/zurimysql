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
    $squestion = $rows["squestion"];
    $sanswer = $rows["sanswer"];
    
    //Condition for Security Questions to display
    if($squestion == "q1"){
        $squestion2 = "Who is your Favourite Uncle?";
    } else if($squestion == "q2"){
        $squestion2 = "Who was your High School Crush?";
    } else if($squestion == "q3"){
        $squestion2 = "What is the name of your first Pet?";
    }


?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Zuri MySQL Reset Profile Password</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/styles.css">
	</head>
	<style>
        body{
            background-color: aliceblue;
        }
        .login-form{
            margin: 3% auto;
            max-width: 80%;
        }
        .btn-login{
            width: 100%;
            margin: 2% auto;
        }
        .form-body{
            background-color: #abe3e3;
            padding: 10px;
            border: 2px solid darkblue;
            text-align: center;
            font-weight: bold;
            line-height: 15px;
        }
    </style>
	<body>
		<div class="container">
		    <div class="row">
		        <div class="col-12">
		            <div class="login-form">
		                <form action="reset_processor.php" method="post" autocomplete="off" class="form-body">
		                    <div class="form-row">
                                <div class="col-12">
                                    <h4><center>Fill the Details Correctly to Reset Your Password</center></h4>
                                </div>
		                        <div class="col-12">
		                            <h4 class="label">Email:</h4>
		                            <input type="email" name="email"id="email" class="form-control" value="<?php echo $email; ?>" required readonly>
		                        </div>
                                <div class="col-12">
                                    <h4 class="label">Phone:</h4>
                                    <input type="tel" name="phone" class="form-control" value="<?php echo $phone; ?>" required readonly>
                                </div>
                                <div class="form-group col-12">
                                    <h4 class="label">Security Question:</h4>
                                    <select name="squestion" id="squestion" class="form-select" required readonly>
                                        <option value="<?php echo $squestion; ?>" selected><?php echo $squestion2; ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-12">
		                            <h4 class="label">Security Answer:</h4>
		                            <input type="text" name="sanswer" id="sanswer" class="form-control" required>
		                        </div>
		                        <div class="form-group col-12">
		                            <h4 class="label">New Password:</h4>
		                            <input type="password" name="password1" class="form-control" required>
		                        </div>
		                        <div class="form-group col-12">
		                            <h4 class="label">Confirm Password::</h4>
		                            <input type="password" name="password2" class="form-control" required>
		                        </div>
		                        <div class="col-12">
		                            <button class="btn btn-success btn-login" name="reset" type="submit">RESET PASSWORD</button>
		                        </div>
		                    </div>
		                </form>
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