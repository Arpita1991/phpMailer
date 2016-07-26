<?php 
ob_start();
require('../conn/path.php');
session_start();

if(isset($_REQUEST['submit']))
{
	$email = $_REQUEST['email'];
	$password = $_REQUEST['pwd'];
		
	 $query = "select * from registration where email = '$email' and password = '$password'";
		$sql = mysql_query($query);	
		$row = mysql_fetch_array($sql);
		if($row['status'] == '1')
		{
		$_SESSION['id'] = $row['id'];
		$_SESSION['firstname'] = $row['firstname'];
		
		header('location:profile.php');	    
		}
		else
		{
		header('location:usermessage.php');	    
		}
}

?>
<!DOCTYPE html>
<html>
<head>
<script type='text/javascript'  src='http://code.jquery.com/jquery-git2.js'></script>
<script type='text/javascript'  src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.1.0/bootstrap.min.js"></script>
<script type='text/javascript'  src="http://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<style type='text/css'>
@import url('http://getbootstrap.com/dist/css/bootstrap.css');
</style>
<link  rel="stylesheet" href="../mycss.css" />
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <div class="panel panel-primary log">
          <div class="panel-heading" align="center">
            <h1>User Login</h1>
          </div>
          <div class="panel-body">
            <form role="form" method="post" enctype="multipart/form-data">
				<div class="form-group">
				  <label>Email:</label>
				  <input type="email" class="form-control" name="email" placeholder="arpita@gmail.com">
				</div>
			
				<div class="form-group">
				  <label for="pwd">Password:</label>
				  <input type="password" class="form-control" name="pwd" placeholder="Enter password">
				</div>
				
				<div class="form-group" align="center">
				<input type="submit" name="submit" value="Submit" class="btn btn-default" />
				</div>
				<div class="form-group" align="center">
				<a href="signup.php" class="userlink">Sign Up</a>
				</div>
			  </form>
           </div>
        </div>
      </div>
  </div>
  
</body>
</html>