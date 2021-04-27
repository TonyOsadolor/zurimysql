<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<style>body{background-color: aliceblue;}</style>


<?php

//Importing Time Zone
date_default_timezone_set("Africa/Lagos");

require_once('config/config.php');

//Checking if the Submit Button was Clicked
if(isset($_POST["signup"])){
    //if it was, then Collect all the signupted Data and Store temporarily
    $surname = $_POST["surname"];
    $othernames = htmlspecialchars($_POST["othernames"], ENT_QUOTES);
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $squestion = $_POST["squestion"];
    $sanswer = htmlspecialchars($_POST["sanswer"], ENT_QUOTES);
    $password = $_POST["password1"];
    $password2 = $_POST["password2"];
    
    //Activating the Account
    $status = "Active";
    
    //Checking if Confirm Password Matches the Original
    if($password !== $password2){
        echo "<script>alert('Sorry Confirm Password Does not Match Original')</script>";
        echo "<script>location.href='index.php'</script>";
        return false;
    }
    
    $checkdup = "SELECT * FROM students WHERE phone = '$phone' or email = '$email'";
    
    $result = mysqli_query ($conn, $checkdup);
    
    if(mysqli_num_rows($result) > 0){
        
        while($rows = mysqli_fetch_assoc($result)){
            
            $dbphone = $rows["phone"];
            $dbemail = $rows["email"];
            $dbsurname = $rows["surname"];
            $dbothernames = $rows["othernames"];
        }
        
        if($dbemail == $email && $phone == $dbphone){
            //echo "Sorry, A User Already exist with the Supplied Phone/Email Address: $phone / $email";
            echo "<div class='container'><div class='alert alert-danger'><center><h3>ERROR!!! DUPLICATE REGISTRATION!</h3><p>Sorry, A User Already exist with the Supplied Phone/Email Address: $phone / $email. <br>Kindly Login to your Dashboard.<br><i>Thank You!</i></p><a href='index.php'><button class='btn btn-warning'>Back Home</button></a></center></div></div>";
            
            return false;
        
        } else if($dbemail == $email){
            //echo "Sorry, A User Already exist with the Supplied Email Address: $email";
            echo "<div class='container'><div class='alert alert-danger'><center><h3>ERROR!!! EMAIL ALREADY EXIST!</h3><p>Sorry, A User Already exist with the Supplied Email Address: $email. <br>Kindly Login to your Dashboard.<br><i>Thank You!</i></p><a href='index.php'><button class='btn btn-warning'>Back Home</button></a></center></div></div>";
            return false;

        } else if($phone == $dbphone){
            //echo "Sorry, A User Already exist with the Supplied Phone Number: $phone";
            echo "<div class='container'><div class='alert alert-danger'><center><h3>ERROR!!! PHONE ALREADY EXIST!</h3><p>Sorry, A User Already exist with the Supplied Phone Number: $phone. <br>Kindly Login to your Dashboard.<br><i>Thank You!</i></p><a href='index.php'><button class='btn btn-warning'>Back Home</button></a></center></div></div>";
            return false;
        }
    } else{
        //Saving New Record to Database
        $sql = "INSERT INTO students(surname, othernames, phone, email, squestion, sanswer, password, status) VALUES('$surname', '$othernames', '$phone', '$email', '$squestion', '$sanswer', '$password', '$status')";
    
        if ($conn->query($sql) === TRUE) {
            $selected = "No";
            $sql2 = "INSERT INTO courses(surname, othernames, phone, email, selected) VALUES('$surname', '$othernames', '$phone', '$email', '$selected')";
            if ($conn->query($sql2) === TRUE){
                echo "<div class='container'><div class='alert alert-success'><center><h3>SUCCESS!!! USER REGISTERED</h3><p>This User: <b>$surname, $othernames</b> with <i>$email</i> was Successfully Registered. <br>Kindly Login to Select your Courses.<br><i>Thank You!</i></p><a href='index.php'><button class='btn btn-success'>Back Home</button></a></center></div></div>";
            }else{echo "<br><br>Error: " . $sql . "<br>" . $conn->error;}
        } else{
            echo "<div class='container'><div class='alert alert-danger'><center><h3>ERROR!!! CONTACT ADMIN</h3><p>Sorry, this User: <b>$surname, $othernames</b> with <i>$email</i> could not be Registered. <br>Kindly Contact the Site Admin.<br><i>Thank You!</i></p><a href='index.php'><button class='btn btn-success'>Back Home</button></a></center></div></div>";

            echo "<br><br>Error: " . $sql . "<br>" . $conn->error;
        }
    }  
    
}

?>