
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
//echo $tenant;
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

$connection = mysqli_connect("oregon-rds.c3rzzh20ahsw.us-west-2.rds.amazonaws.com", 'admin', 'admin123','MultiTenant_RDS') ; 
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if(strcmp($tenant,"Tenant A")==0){

$query = "INSERT INTO MultiTenant_RDS.TENANT_DATA (TENANT_ID, TENANT_TABLE, STUDENT_ID, STUDENT_NAME,GRADER_NAME,  COLUMN_1,COLUMN_2,COLUMN_3,COLUMN_4)
                            VALUES ('TA', 'TENANT_A', '$student_id', '$student_name', 'PALLAVI',$scale','$points','$complete','$comments' ); ";
}
elseif(strcmp($tenant,"Tenant B")==0){
$query = "INSERT INTO MultiTenant_RDS.TENANT_DATA (TENANT_ID, TENANT_TABLE, STUDENT_ID, STUDENT_NAME, GRADER_NAME, COLUMN_1,COLUMN_2,COLUMN_3)
                            VALUES ('TB', 'TENANT_B', '$student_id', '$student_name', 'PALLAVI','$scale','$points','$comments' ); ";

}
elseif(strcmp($tenant,"Tenant C")==0){
$query = "INSERT INTO MultiTenant_RDS.TENANT_DATA (TENANT_ID, TENANT_TABLE, STUDENT_ID, STUDENT_NAME,GRADER_NAME,  COLUMN_1,COLUMN_2)
                            VALUES ('TC', 'TENANT_C', '$student_id', '$student_name','PALLAVI', '$scale','$comments' ); ";

}
elseif(strcmp($tenant,"Tenant D")==0){
  $query = "INSERT INTO MultiTenant_RDS.TENANT_DATA (TENANT_ID, TENANT_TABLE, STUDENT_ID, STUDENT_NAME,GRADER_NAME,  COLUMN_1,COLUMN_2,COLUMN_3)
                            VALUES ('TD', 'TENANT_D', '$student_id', '$student_name','PALLAVI', '$scale','$complete','$comments' ); ";
  
}


  
 echo "<div class=\"jumbotron text-center\">";
//echo $query;
//print("<h3> $query </h3>"); 
if (mysqli_query($connection ,$query)) {
   
    echo "<h1 style='text-align:center;'> Grades submitted successfully !! </h1> ";

} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
}
echo "</div>";
mysqli_close($connection);

?>
</body>
</html>