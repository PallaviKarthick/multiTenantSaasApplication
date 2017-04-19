<?php
session_start();
extract($_POST);
$name = $_POST['username'];
$student_id = $_POST['id'];
$task = $_POST['completed'];
$points = $_POST['points'];
$scale = $_POST['scale'];
$comments =$_POST['id'];


print("===="");
print($name);
print($student_id);
print($task);
print($points);
print($scale);
print($comments);




$connection = mysqli_connect('localhost', 'root', 'root');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'test');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}

?>
