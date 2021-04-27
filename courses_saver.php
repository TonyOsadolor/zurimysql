<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<style>body{background-color: aliceblue;}</style>

<?php
//Starting PHP Session

session_start();

//Establishing Connection to Database
require_once ('config/config.php');

if(isset($_POST["save"])){
    $surname = $_POST["surname"];
    $othernames = $_POST["othernames"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $course1 = $_POST["course1"];
    $course2 = $_POST["course2"];
    $course3 = $_POST["course3"];
    $course4 = $_POST["course4"];
    $course5 = $_POST["course5"];
    $agreement = $_POST["agreement"];
    
    //Checking if Student has previous updated their Courses
    $checkdup = "SELECT * FROM courses WHERE phone = '$phone' or email = '$email'";
    
    $result = mysqli_query ($conn, $checkdup);
    
    if(mysqli_num_rows($result) > 0){
        
        while($rows = mysqli_fetch_assoc($result)){
            
            $dbphone = $rows["phone"];
            $dbemail = $rows["email"];
            $dbsurname = $rows["surname"];
            $dbothernames = $rows["othernames"];
            $dbselected = $rows["selected"];
        }
        
        if($agreement == "Yes1"){
            //Updating Record on Database
            $sql = "UPDATE courses SET course1 = '$course1', course2 = '$course2', course3 = '$course3', course4 = '$course4', course5 = '$course5' WHERE phone = '$dbphone'";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='container'><div class='alert alert-success'><center><h3>SUCCESS!!! COURSES UPDATED</h3><p> You have Successfully Updated Your Courses as: <b><i>$course1, $course2, $course3, $course4 and $course5.</i></b><i>Thank You!</i></p><a href='dashboard.php'><button class='btn btn-success'>Back Home</button></a></center></div></div>";
            } else{
                echo "<div class='container'><div class='alert alert-danger'><center><h3>ERROR!!! DATA ERROR</h3><p>Sorry, your courses were not saved. <br>Kindly Contact the Site Admin.<br><i>Thank You!</i></p><a href='dashboard.php'><button class='btn btn-danger'>Back Home</button></a></center></div></div>";

                echo "<br><br>Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            
            $selected = "Yes";
            
            //Saving New Record to Database
            $sql = "UPDATE courses SET course1 = '$course1', course2 = '$course2', course3 = '$course2', course4 = '$course4', course5 = '$course5', selected = '$selected' WHERE phone = '$dbphone'";
            
            if ($conn->query($sql) === TRUE) {
                echo "<div class='container'><div class='alert alert-success'><center><h3>SUCCESS!!! COURSES REGISTERED</h3><p> You have Successfully Registered Your Courses as: <b><i>$course1, $course2, $course3, $course4 and $course5.</i></b><i>Thank You!</i></p><a href='dashboard.php'><button class='btn btn-success'>Back Home</button></a></center></div></div>";
            } else{
                echo "<div class='container'><div class='alert alert-danger'><center><h3>ERROR!!! DATA ERROR</h3><p>Sorry, your courses were not saved. <br>Kindly Contact the Site Admin.<br><i>Thank You!</i></p><a href='dashboard.php'><button class='btn btn-danger'>Back Home</button></a></center></div></div>";
                
                echo "<br><br>Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}

?>