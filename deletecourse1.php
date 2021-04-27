<?php

require_once('login.php');

if(isset($_SESSION['email'])){
    
    $sql = "UPDATE courses SET course1 = '' WHERE email = '".$_SESSION['email']."'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<div class='container'><div class='alert alert-warning'><center><h3>SUCCESS!!! COURSES DELETED</h3><p> This Course has beeen Deleted.<i>Thank You!</i></p><a href='dashboard.php'><button class='btn btn-warning'>Back Home</button></a></center></div></div>";
    } else{
        
    }
}
?>