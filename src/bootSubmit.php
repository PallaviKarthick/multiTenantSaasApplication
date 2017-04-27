
<!DOCTYPE html >
<html>

    <head>

  <title>Grade</title>

      <style>
      .login{position:relative;
      left:460px;
      border: 1px solid black;
      border-radius:5px;
      width:400px;
      padding:10px;}
      </style>

    </head>
    <body>

<?php
session_start();
extract($_POST);
$name = $_POST['username'];
$student_id = $_POST['userID'];
if($_POST['scale']){
$scale = $_POST['scale'];
}
if($_POST['points']){
$points = $_POST['points'];
}
if($_POST['completed']){
$complete = $_POST['completed'];
}

if($_POST['comments']){
$comments =$_POST['comments'];
}

// echo $name . "</br>";
// echo $student_id . "</br>";
// echo $scale . "</br>";
// echo $points . "</br>";

// echo $comments . "</br>";

// if ($complete == "completed"){
//     $complete =true;
// }
// else{
//  $complete =false;

// }
// echo $complete . "</br>";



$connection = mysqli_connect('127.0.0.1', 'root', 'root','test');
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}


$query = " INSERT INTO test.TENANT_A (USER_ID, USER_NAME, POINTS, SCALE, COMPLETE, COMMENTS) VALUES
($student_id,'$name', '$points' , '$scale','$complete', '$comments');";

//print("<h3> $query </h3>"); 
if (mysqli_query($connection ,$query)) {
    echo "<h3 style=\"text-align:center;\"> Grades submitted successfully !! </h3> ";
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
}
mysqli_close($connection);




?>
</body>
</html>