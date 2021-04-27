<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<style>body{background-color: aliceblue;}</style>


<?php

//Establishing Database Connection
require_once ('config/config.php');


//Checking if the Submit Button was Clicked
if(isset($_POST["reset"])){
    //Defining Variables and Saving the posted information to it
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $squestion = $_POST["squestion"];
    $sanswer = $_POST["sanswer"];
    $password = $_POST["password1"];
    $password2 = $_POST["password2"];
    
    //Ensuring the New Password matches the Confirm Password
    if($password !== $password2){
        echo "<script>alert('Sorry, Confirm Password Not Match with Original')</script>";
        echo "<script>location.href='resetpassword.php'</script>";
        return false;
    }
    
    //Checking Database for User
    $reset = "SELECT * FROM students WHERE email = '$email'";
    
    $result = mysqli_query ($conn, $reset);
    
    $rows = mysqli_fetch_assoc($result);
    
    //Saving Information from Database
    $dbid = $rows["id"];
    $dbemail = $rows["email"];
    $dbphone = $rows["phone"];
    $dbquestion = $rows["squestion"];
    $dbanswer = $rows["sanswer"];
    
    
    //Checking for Matching Data
    if($email == $dbemail && $phone == $dbphone && $squestion == $dbquestion && $sanswer == $dbanswer){
        
        //Writing new password to the student Profile on Database
        $sql = "UPDATE students SET password = '$password' WHERE id = '$dbid'";
        
        //If truly Password was updated, then display a success message
        if ($conn->query($sql) === TRUE) {
            
            echo "<div class='container'><div class='alert alert-success'><center><h3>SUCCESS!!! PASSWORD CHANGED</h3><p>Password Updated Successfully </b> for Account: <i>$email</i> You will now be redirected to Login.<br><i>Thank You!</i></p><a href='logout.php'><button class='btn btn-warning'>Back Home</button></a></center></div></div>";
            
        //If Password was not updated then, display an Error Message    
        }else {
            
            echo "<div class='container'><div class='alert alert-success'><center><h3>ERROR!!! NOT SUCCESSFUL</h3><p>Password Not Updated Successfully </b> for Account: <i>$email</i> Information Supplied Does not Match the record on our database, you will now be redirected to Login.<br><i>Thank You!</i></p><a href='logout.php'><button class='btn btn-warning'>Back Home</button></a></center></div></div>";
        }
        //If this user wasn't found at all, then display the error message
    } else {
        
        //Redirecting to Login Page, if the Password is Wrong
        echo "<script>alert('Sorry, User: $email Not Found on our Database')</script>";
        
        echo "<div class='container'><div class='alert alert-success'><center><h3>ERROR!!! USER NOT FOUND</h3><p>Sorry, User: <b>$email</b> Not Found on our Database Information Supplied Does not Match the record on our database, you will now be redirected to Login.<br><i>Thank You!</i></p><a href='logout.php'><button class='btn btn-warning'>Back Home</button></a></center></div></div>";
        
            
        return false;
    }
}

?>