<!DOCTYPE html>
<html lang="en">
<head>
  <title>Test Parser</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h3> Grade</h3>
    <?php
		echo "Server Name: " . $_SERVER['SERVER_NAME']  ;
		echo "<br/>" ;
		echo "Server IP:   " . $_SERVER['SERVER_ADDR'] ;
	?>
</div>
  
<div class="container">
  <div class="row">
     <div class="col-sm-8">

<?php
$dir = sys_get_temp_dir();
session_save_path($dir);
session_start();
header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");
if($_FILES["zip_file"]["name"]) {
	$filename = $_FILES["zip_file"]["name"];
	$source = $_FILES["zip_file"]["tmp_name"];
	$type = $_FILES["zip_file"]["type"];
	
	// print_r($_FILES["zip_file"]);
    // echo "-------".$_POST["tenantId"];
    // echo "-------".$_FILES["tenantId"];
    // print_r($_SESSION);
	echo "</br>";
	
	$name = explode(".", $filename);
	$types = array('application/zip');
	foreach($types as $mime_type) {
		if($mime_type == $type) {
			break;
		} 
	}
	
	$continue = strtolower($name[1]) == 'zip' ? true : false;
	if(!$continue) {
		$message = "The file has to be of .zip type";
	}
    $pwd= getcwd();
	//echo "----pwd--:". $pwd;
	//echo "----filename--:". $filename;
	$target_path = $pwd."/".$filename;  // change this to the correct site path
	//echo "--target_path--" . $target_path ."</br>";
	//echo "---source-" . $source;
	$folderName = substr($filename, 0, -4);
    $pathName = $pwd."/".$folderName ;
	
if(move_uploaded_file($source, $target_path)) {
		$zip = new ZipArchive();
		$x = $zip->open($target_path);
		if ($x === true) {
			shell_exec('mkdir '.$folderName);
			$zip->extractTo($pwd."/".$folderName); // change this to the correct site path
			$zip->close();
	
			unlink($target_path);
		}
		$message = "The zip file was uploaded and unpacked";
        //shell_exec('rm -fr temp/*');
		//echo 'java -jar umlparser.jar ' .$pathName;

        shell_exec('java -jar umlparser.jar ' .$pathName .' '.$folderName.".png");
		$imgName = $folderName.".png";
       echo ' 


<img src="'.$folderName."/". $imgName.'"' .'title="uml-parser" alt="uml-parser" />
</div>
';
	} else {	
		$message = "There was a problem with the upload. Please try again.";
	}
}
$tenant =$_SESSION['tenant'];
$_SESSION['testCase']= $folderName;
//echo $tenant;

?>


 <div class="col-sm-4">
  
     <form name='grade' action='bootSubmit.php' method='POST' accept-charset='UTF-8'>
        <h3> <?php echo  $tenant; ?></h3> 
      <p>Student Name: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="username" value="" required></p>
     <p>Student ID: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="userID" value= "" required></p>
     <h3> Grading Attributes </h3>
          <p>
          Scale: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="scale" value=""></p>


          <p  
          style = <?php
          if($tenant=="Tenant C" or $tenant=="Tenant D"){
           echo   "display:none;";
          }
           ?> >
          Points &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <select name = "points">
                <option name="points" value="1">1</option>
                <option name="points" value="2">2</option>
                <option name="points" value="3">3</option>
                <option name="points" value="4">4</option>
                <option name="points" value="5">5</option>
            </select>
          </p>



          <p 
           style = <?php
          if($tenant=="Tenant B" or $tenant=="Tenant C"){
           echo   "display:none;";
          }
           ?> 
          
          >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          
              <input type="radio" name="completed" value="completed"> Completed
              <input type="radio" name="completed" value="notcompleted"> Not Completed
                    </p>
          <p>

          Comments: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="comments" rows="3" cols="18"></textarea></p>

           <p><button type="submit" style="align:right;width:100px;" class="btn btn-sm btn-primary">Submit</button><br></p>
    </form>

    </div>
    
    </form>
  </div>
</div>
