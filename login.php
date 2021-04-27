<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<style>body{background-color: aliceblue;}</style>

<?php
//Starting PHP Session

session_start();

//Establishing Connection to Database
require_once ('config/config.php');


//Checking to see if the Submit Button was clicked
if(isset($_POST["login"])){
    //if it was, then Collect all the submitted Data and Store temporarily
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    //Check for User Exists
    $login = "SELECT * FROM students WHERE email = '$email'";
    
    $result = mysqli_query ($conn, $login);
    
    if(mysqli_num_rows($result) > 0){
        
        while($rows = mysqli_fetch_assoc($result)){
            
            //Storing Data from Database
            $dbphone = $rows["phone"];
            $dbemail = $rows["email"];
            $dbpassword = $rows["password"];
            $dbstatus = $rows["status"];
        }
        
        //Checking if Account Password Match or Not
        if($password !== $dbpassword){
            
            echo "<script>alert('Sorry, You have supplied the Wrong Password')</script>";
            
            echo "<div class='container'><div class='alert alert-danger'><center><h3>ERROR!!! WRONG PASSWORD</h3><p>Sorry, You have supplied the Wrong Password. <br>Please try again using the Right Password.<br><i>Thank You!</i></p><a href='index.php'><button class='btn btn-warning'>Back Home</button></a></center></div></div>";
            
            session_destroy();
            
            //Check if the Account is Disabled
        } else if($dbstatus == "Disabled") {
            
            echo "<script>alert('Sorry, This Account Has been Disabled!')</script>";
            
            echo "<div class='container'><div class='alert alert-danger'><center><h3>ERROR!!! ACCOUNT DISABLED</h3><p>Sorry, This Account Has been Disabled! <br>Kindly Contact Admin for Reset.<br><i>Thank You!</i></p><a href='index.php'><button class='btn btn-warning'>Back Home</button></a></center></div></div>";
            
            session_destroy();
            
        } else {
            
            //If the Accounts Details match and it is not disabled, then log User in            
            echo "<script>alert('Welcome to your Dashobard')</script>";
            
            echo "<script>location.href='dashboard.php'</script>";
            
            //Storing the Session ID to be used througout, while User stays logged in
            $_SESSION["email"] = $email;
            
        }
        
    } else{
        
        //If User does not meet any of the above Condition, kindly redirect to home page and kill Session
        echo "<script>alert('Sorry, Account with ($email) Not Found!')</script>";
        
        echo "<div class='container'><div class='alert alert-danger'><center><h3>ERROR!! ACCOUNT NOT FOUND!</h3><p>Sorry, No Account with <i>($email)</i> was found on our Database. <br>Kindly Supply the right Email.<br><i>Thank You!</i></p><a href='index.php'><button class='btn btn-warning'>Back Home</button></a></center></div></div>";
        
        session_destroy();
    }
}
    

?>