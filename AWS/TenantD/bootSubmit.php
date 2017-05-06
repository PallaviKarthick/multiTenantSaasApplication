
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
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<?php
$dir = sys_get_temp_dir();
session_save_path($dir);
session_start();
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");
extract($_POST);
$student_name = $_POST['username'];
$student_id = $_POST['userID'];
if(isset($_POST['scale'])){
$scale = $_POST['scale'];
}
if(isset($_POST['points'])){
$points = $_POST['points'];
}

if(isset($_POST['completed'])){
$complete= true;
if(strcmp($_POST['completed'],"notcompleted")==0){
    $complete=0;
}
}
if(isset($_POST['comments'])){
$comments =$_POST['comments'];
}
$tenant = $_SESSION['tenant'];
$testCase = $_SESSION['testCase'];
//echo "-testCase--".$testCase;
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

$query = "INSERT INTO MultiTenant_RDS.TENANT_DATA (TENANT_ID, TENANT_TABLE, STUDENT_ID, STUDENT_NAME,GRADER_NAME,TEST_CASE,  COLUMN_1,COLUMN_2,COLUMN_3,COLUMN_4)
                            VALUES ('TA', 'TENANT_A', '$student_id', '$student_name', 'PALLAVI','$testCase','$scale','$points','$complete','$comments' ); ";
}
elseif(strcmp($tenant,"Tenant B")==0){
$query = "INSERT INTO MultiTenant_RDS.TENANT_DATA (TENANT_ID, TENANT_TABLE, STUDENT_ID, STUDENT_NAME, GRADER_NAME,TEST_CASE, COLUMN_1,COLUMN_2,COLUMN_3)
                            VALUES ('TB', 'TENANT_B', '$student_id', '$student_name', 'PALLAVI','$testCase','$scale','$points','$comments' ); ";

}
elseif(strcmp($tenant,"Tenant C")==0){
$query = "INSERT INTO MultiTenant_RDS.TENANT_DATA (TENANT_ID, TENANT_TABLE, STUDENT_ID, STUDENT_NAME,GRADER_NAME,TEST_CASE,  COLUMN_1,COLUMN_2)
                            VALUES ('TC', 'TENANT_C', '$student_id', '$student_name','PALLAVI','$testCase', '$scale','$comments' ); ";

}
elseif(strcmp($tenant,"Tenant D")==0){
  $query = "INSERT INTO MultiTenant_RDS.TENANT_DATA (TENANT_ID, TENANT_TABLE, STUDENT_ID, STUDENT_NAME,GRADER_NAME, TEST_CASE, COLUMN_1,COLUMN_2,COLUMN_3)
                            VALUES ('TD', 'TENANT_D', '$student_id', '$student_name','PALLAVI','$testCase', '$scale','$complete','$comments' ); ";
  
}


  
 echo '<div class="jumbotron text-center">';
// echo $query;
//print("<h3> $query </h3>"); 
if (mysqli_query($connection ,$query)) {

   
    echo "<h3 > Grades submitted successfully !! </h3> ";
    echo "Server Name: " . $_SERVER['SERVER_NAME']  ;
	echo "<br/>" ;
	echo "Server IP:   " . $_SERVER['SERVER_ADDR'] ;
   
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($connection);
}

 echo "</div>";


mysqli_close($connection);

?>
<div class="container">
  <div class="row" >
  <a href=<?php echo "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/index.php";?> >  <h4 style="text-align:center;color:#5bc0de"> Please click to return back to Grader Login Page </h4> </a>
  </div>
</div>
</body>
</html>