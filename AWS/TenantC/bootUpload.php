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
  <h3> Test Parser</h3>
    <?php
		echo "Server Name: " . $_SERVER['SERVER_NAME']  ;
		echo "<br/>" ;
		echo "Server IP:   " . $_SERVER['SERVER_ADDR'] ;
	?>
</div>
  
<div class="container">
  <div class="row" >
      <?php
      $dir = sys_get_temp_dir();
      session_save_path($dir);
     session_start();
     header("Cache-Control: no cache");
     session_cache_limiter("private_no_expire");
     extract($_POST);
     $tenant;
     if(isset($_POST['tenantA'])){
     $tenant = $_POST['tenantA'];
    // echo $tenant;
     }
     elseif(isset($_POST['tenantB'])){
     $tenant = $_POST['tenantB'];
    // echo $tenant;
     }
     elseif(isset($_POST['tenantC'])){
     $tenant = $_POST['tenantC'];
    // echo $tenant;
     }
     elseif(isset($_POST['tenantD'])){
     $tenant = $_POST['tenantD'];
     }
     if($tenant){
     $_SESSION['tenant']=$tenant;
     }
  
    //  print_r($_SESSION);
      ?>
      

    
     <form enctype="multipart/form-data" name='grade' action='bootUnzip.php' method='POST' accept-charset='UTF-8'> 
     <p style="width:100px;"><input  style="width:400px;"  type="file" name="zip_file" /></p>
      <p><button  type="submit" style="align:right;width:100px;" class="btn btn-sm btn-primary">Upload</button><br></p>
      </form>
  

</body>
</html>
