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
    
    $sql2 = "SELECT * FROM courses WHERE email = '$email'";
    
    $result2 = mysqli_query ($conn, $sql2);
    
    if(mysqli_num_rows($result2) > 0){
        
        while($rows2 = mysqli_fetch_assoc($result2)){
            $course1 = $rows2["course1"];
            $course2 = $rows2["course2"];
            $course3 = $rows2["course3"];
            $course4 = $rows2["course4"];
            $course5 = $rows2["course5"];
            $selected = $rows2["selected"];
        }
    }

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>My Zuri MySQL Dashboard</title>
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
                    <a href="dashboard.php" class="nav-link active">Home</a>
                </li>
                <li class="nav-item">
                    <a href="profile.php" class="nav-link">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">Logout</a>
                </li>
            </ul>
            <marquee behavior="" direction="" style="color:white;"><b><?php echo $othernames; ?></b> Welcome to your Profile</marquee>
        </nav>
		<div class="col-12">
		    <h2><center>Welcome Home</center></h2>
		</div>
		<div class="container">
		    <div class="row">
		        <div class="col-sm-6"><?php if($selected == "Yes"){?>
                    <div class="card" style="padding:5px;">
                        <div class="container">
                            <h3 class="alert alert-success text-center">HURRAY!!! You have Successfully Registered Your Courses</h3>
                            <div class="card-header" style="font-weight:bold;">
                                <span>You can Choose to Update your Course Selection.</span>
                                <ul class="list-group" style="margin-top:2%;">
                                    <form action="courses_saver.php" method="post">
                                        <li class="list-group-item" style="color:black;">
                                            Student Name:
                                            <div class="input-group mb-3">
                                                <input type="text" name="surname" value="<?php echo $surname; ?>" readonly>
                                                <input type="text" name="othernames" value="<?php echo $othernames; ?>" readonly>
                                            </div>
                                            Student Phone / Email:
                                            <div class="input-group mb-3">
                                                <input type="text" name="phone" value="<?php echo $phone; ?>" readonly>
                                                <input type="text" name="email" value="<?php echo $email; ?>" readonly>
                                            </div>
                                        </li>
                                        <li class="list-group-item" style="color:green;">
                                            General
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course1" id="course1" value="English Language" required>
                                                <label class="form-check-label" for="course1">English Language</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course1" id="course1" value="Mathematics" required>
                                                <label class="form-check-label" for="course1">Mathematics</label>
                                            </div>
                                            <hr>
                                            <b>Previous Choice:</b>
                                            <div class="form-check" style="color:blue;">
                                                <input class="form-check-input" type="radio" name="course1" id="course1" value="<?php echo $course1; ?>" required checked>
                                                <label class="form-check-label" for="course1"><?php if($course1 == ""){echo "Deleted"; }else{ echo $course1;} ?></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item" style="color:red;">
                                            Sciences
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course2" id="course2" value="Biology" required>
                                                <label class="form-check-label" for="course2">Biology</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course2" id="course2" value="Chemistry" required>
                                                <label class="form-check-label" for="course2">Chemistry</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course2" id="course2" value="Physics" required>
                                                <label class="form-check-label" for="course2">Physics</label>
                                            </div>
                                            <hr>
                                            <b>Previous Choice:</b>
                                            <div class="form-check" style="color:blue;">
                                                <input class="form-check-input" type="radio" name="course2" id="course2" value="<?php echo $course2; ?>" required checked>
                                                <label class="form-check-label" for="course2"><?php if($course2 == ""){echo "Deleted"; }else{ echo $course2;} ?></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item" style="color:#fdbc0a;">
                                            Arts
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course3" id="course3" value="Literature in English" required>
                                                <label class="form-check-label" for="course3">Literature in English</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course3" id="course3" value="Government" required>
                                                <label class="form-check-label" for="course3">Government</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course3" id="course3" value="Bible Knowledge" required>
                                                <label class="form-check-label" for="course3">Bible Knowledge</label>
                                            </div>
                                            <hr>
                                            <b>Previous Choice:</b>
                                            <div class="form-check" style="color:blue;">
                                                <input class="form-check-input" type="radio" name="course3" id="course3" value="<?php echo $course3; ?>" required checked>
                                                <label class="form-check-label" for="course3"><?php if($course3 == ""){echo "Deleted"; }else{ echo $course3;} ?></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item" style="color:darkblue;">
                                            Social Science
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course4" id="course4"  value="Accounting"required>
                                                <label class="form-check-label" for="course2">Accounting</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course4" id="course4"  value="Economics"required>
                                                <label class="form-check-label" for="course2">Economics</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course4" id="course4" value="Commerce" required>
                                                <label class="form-check-label" for="course2">Commerce</label>
                                            </div>
                                            <hr>
                                            <b>Previous Choice:</b>
                                            <div class="form-check" style="color:blue;">
                                                <input class="form-check-input" type="radio" name="course4" id="course4" value="<?php echo $course4; ?>" required checked>
                                                <label class="form-check-label" for="cours42"><?php if($course4 == ""){echo "Deleted"; }else{ echo $course4;} ?></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item" style="color:purple;">
                                            Information Technology
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course5" id="course5" value="Technical Drawing" required>
                                                <label class="form-check-label" for="course5">Technical Drawing</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course5" id="course5" value="Computer Scienc" required>
                                                <label class="form-check-label" for="course5">Computer Science</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course5" id="course5" value="Further Mathematics" required>
                                                <label class="form-check-label" for="course5">Further Mathematics</label>
                                            </div>
                                            <hr>
                                            <b>Previous Choice:</b>
                                            <div class="form-check" style="color:blue;">
                                                <input class="form-check-input" type="radio" name="course5" id="course5" value="<?php echo $course5; ?>" required checked>
                                                <label class="form-check-label" for="course5"><?php if($course5 == ""){echo "Deleted"; }else{ echo $course5;} ?></label>
                                            </div>
                                        </li>
                                        <li class="list-group-item" style="color:purple;">
                                            Agreement
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="agreement" id="agreement" value="Yes1" required>
                                                <label class="form-check-label" for="agreement">Check Box to Agree</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="btn-group col-12" role="group" aria-label="Basic example">
                                              <button class="btn btn-success" type="submit" name="save" id="save">SUBMIT CHOICES</button>
                                              <button class="btn btn-warning" type="reset">RESET FORM</button>
                                            </div>
                                        </li>
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <?php // New Course Registration?>
                    <?php } else{?>
                    <div class="card" style="padding:5px;">
                        <div class="container">
                            <h3 class="text-center">Please Choose Your Courses</h3>
                            <div class="card-header" style="font-weight:bold;">
                                <span>You have to chose Five (5) Courses, One (1) from each category.</span>
                                <ul class="list-group" style="margin-top:2%;">
                                    <form action="courses_saver.php" method="post">
                                        <li class="list-group-item" style="color:black;">
                                            Student Name:
                                            <div class="input-group mb-3">
                                                <input type="text" name="surname" value="<?php echo $surname; ?>" readonly>
                                                <input type="text" name="othernames" value="<?php echo $othernames; ?>" readonly>
                                            </div>
                                            Student Phone / Email:
                                            <div class="input-group mb-3">
                                                <input type="text" name="phone" value="<?php echo $phone; ?>" readonly>
                                                <input type="text" name="email" value="<?php echo $email; ?>" readonly>
                                            </div>
                                        </li>
                                        <li class="list-group-item" style="color:green;">
                                            General
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course1" id="course1" value="English Language" required>
                                                <label class="form-check-label" for="course1">English Language</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course1" id="course1" value="Mathematics" required>
                                                <label class="form-check-label" for="course1">Mathematics</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item" style="color:red;">
                                            Sciences
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course2" id="course2" value="Biology" required>
                                                <label class="form-check-label" for="course2">Biology</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course2" id="course2" value="Chemistry" required>
                                                <label class="form-check-label" for="course2">Chemistry</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course2" id="course2" value="Physics" required>
                                                <label class="form-check-label" for="course2">Physics</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item" style="color:#fdbc0a;">
                                            Arts
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course3" id="course3" value="Literature in English" required>
                                                <label class="form-check-label" for="course2">Literature in English</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course3" id="course3" value="Government" required>
                                                <label class="form-check-label" for="course2">Government</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course3" id="course3" value="Bible Knowledge" required>
                                                <label class="form-check-label" for="course2">Bible Knowledge</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item" style="color:darkblue;">
                                            Social Science
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course4" id="course4"  value="Accounting"required>
                                                <label class="form-check-label" for="course2">Accounting</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course4" id="course4"  value="Economics"required>
                                                <label class="form-check-label" for="course2">Economics</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course4" id="course4" value="Commerce" required>
                                                <label class="form-check-label" for="course2">Commerce</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item" style="color:purple;">
                                            Information Technology
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course5" id="course5" value="Technical Drawing" required>
                                                <label class="form-check-label" for="course5">Technical Drawing</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course5" id="course5" value="Computer Science" required>
                                                <label class="form-check-label" for="course5">Computer Science</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="course5" id="course5" value="Further Mathematics" required>
                                                <label class="form-check-label" for="course5">Further Mathematics</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item" style="color:purple;">
                                            Agreement
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="agreement" id="agreement" value="Yes" required>
                                                <label class="form-check-label" for="agreement">Check Box to Agree</label>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="btn-group col-12" role="group" aria-label="Basic example">
                                              <button class="btn btn-success" type="submit" name="save" id="save">SUBMIT CHOICES</button>
                                              <button class="btn btn-warning" type="reset">RESET FORM</button>
                                            </div>
                                        </li>
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </div><?php }?>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h3>Your Selected Courses</h3>
                        </div>
                        <div class="card-body">
                            <div class="card">
                              <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>Course 1: </b><?php if($course1 == ""){ echo $course1 = "Not Selected Yet";}else{echo $course1 ."  <a href='deletecourse1.php?c_id=$course1' class='btn btn-warning' style='color:black;text-decoration:none;' class='card-link'>Delete Course</a>";} ?></li>
                                <li class="list-group-item"><b>Course 2: </b><?php if($course2 == ""){ echo $course2 = "Not Selected Yet";}else{echo $course2 ."  <a href='deletecourse2.php?c_id=$course1' class='btn btn-warning' style='color:black;text-decoration:none;' class='card-link'>Delete Course</a>";} ?></li>
                                <li class="list-group-item"><b>Course 3: </b><?php if($course3 == ""){ echo $course3 = "Not Selected Yet";}else{echo $course3 ."  <a href='deletecourse3.php?c_id=$course1' class='btn btn-warning' style='color:black;text-decoration:none;' class='card-link'>Delete Course</a>";} ?></li>
                                <li class="list-group-item"><b>Course 4: </b><?php if($course4 == ""){ echo $course4 = "Not Selected Yet";}else{echo $course4 ."  <a href='deletecourse4.php?c_id=$course1' class='btn btn-warning' style='color:black;text-decoration:none;' class='card-link'>Delete Course</a>";} ?></li>
                                <li class="list-group-item"><b>Course 5: </b><?php if($course5 == ""){ echo $course5 = "Not Selected Yet";}else{echo $course5 ."  <a href='deletecourse5.php?c_id=$course1' class='btn btn-warning' style='color:black;text-decoration:none;' class='card-link'>Delete Course</a>";} ?></li>
                              </ul>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <span><i>Success in Your Studies</i></span>
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