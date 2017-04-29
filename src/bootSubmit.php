
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
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");
extract($_POST);
$student_name = $_POST['username'];
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
$tenant = $_SESSION['tenant'];

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



$connection = mysqli_connect("mysqldbinstance.csbagytacmtu.us-west-1.rds.amazonaws.com", 'admin', 'admin123','multiTenant') ; 
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if(strcmp($tenant,"Tenant A")){
$query = "INSERT INTO multiTenant.TENANT_DATA (TENANT_ID, TENANT_TABLE, STUDENT_ID, STUDENT_NAME,  COLUMN_1,COLUMN_2,COLUMN_3,COLUMN_4)
                            VALUES ('$tenant', '$tenant', '$student_id', '$student_name', '$scale','$points','$complete','$comments' ); ";
}
elseif(strcmp($tenant,"Tenant B")){
$query = "INSERT INTO multiTenant.TENANT_DATA (TENANT_ID, TENANT_TABLE, STUDENT_ID, STUDENT_NAME,  COLUMN_1,COLUMN_2,COLUMN_3)
                            VALUES ('$tenant', '$tenant', '$student_id', '$student_name', '$scale','$points','$comments' ); ";

}
elseif(strcmp($tenant,"Tenant C")){
$query = "INSERT INTO multiTenant.TENANT_DATA (TENANT_ID, TENANT_TABLE, STUDENT_ID, STUDENT_NAME,  COLUMN_1,COLUMN_2)
                            VALUES ('$tenant', '$tenant', '$student_id', '$student_name', '$scale','$comments' ); ";

}
else{
  $query = "INSERT INTO multiTenant.TENANT_DATA (TENANT_ID, TENANT_TABLE, STUDENT_ID, STUDENT_NAME,  COLUMN_1,COLUMN_2,COLUMN_3)
                            VALUES ('$tenant', '$tenant', '$student_id', '$student_name', '$scale','$complete','$comments' ); ";
  
}

//echo $query;
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