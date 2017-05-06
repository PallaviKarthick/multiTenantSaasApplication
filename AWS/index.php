<!DOCTYPE html>
<html lang="en">
<head>
  <title>Grader Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="jumbotron text-center">
  <h1>Grader Login</h1>
  <?php
		echo "Server Name: " . $_SERVER['SERVER_NAME']  ;
		echo "<br/>" ;
		echo "Server IP:   " . $_SERVER['SERVER_ADDR'] ;
	?>
</div>
  
<div class="container">
  <div class="row">
    
    <div class="col-sm-3">
      <form action="TenantA/bootUpload.php" class="form-inline" method="POST">
      <input id='submit' type='submit' name = 'tenantA'    value = 'Tenant A' class="btn btn-lg btn-info">
      </form>
    </div>
    <div class="col-sm-3">
      <form action="TenantB/bootUpload.php" class="form-inline" method="POST">
      <input id='submit' type='submit' name = 'tenantB'    value = 'Tenant B' class="btn btn-lg btn-info">
      </form>   
    </div>
    <div class="col-sm-3">
      <form action="TenantC/bootUpload.php" class="form-inline" method="POST">
      <input id='submit' type='submit' name = 'tenantC'    value = 'Tenant C' class="btn btn-lg btn-info">
      </form>   
    </div>
     <div class="col-sm-3">
       <form action="TenantD/bootUpload.php" class="form-inline" method="POST">
       <input id='submit' type='submit' name = 'tenantD'    value = 'Tenant D' class="btn btn-lg btn-info">
       </form>
      </div>
  </div>
</div>


</body>
</html>
