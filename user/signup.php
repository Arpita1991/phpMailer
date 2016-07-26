<?php 
ob_start();
require('../conn/path.php');

if(isset($_REQUEST['submit']))
{
	$username = $_REQUEST['username'];
	$email = $_REQUEST['email'];
	$password = $_REQUEST['pwd'];
	$gender = $_REQUEST['gender'];
	$city = $_REQUEST['city'];
	$address = $_REQUEST['address'];
		
		if(isset($_FILES['image']['name']))
		{
		move_uploaded_file($_FILES['image']['tmp_name'],"../images/".$_FILES['image']['name']);
		$imagename = $_FILES['image']['name'];
		}		
		else
		{
		$imagename = " ";
		}
		
		$query = "insert into registration(id,firstname,password,email,gender,address,city,image,status)           
		values('','$username','$password','$email','$gender','$address','$city','$imagename','0')";
		 
		$sql = mysql_query($query);
		 
			if($sql)
			{
		        $to = "patel_arpita1991@yahoo.com";
				$from = $email;
				$Full_Name = $username;
				$subject = $Full_Name. " has Signed up";
				$message = '<html><body>';   
				$message .= '<table cellpadding="10" border="0">';
				$message .= '<tr><td colspan=2>&nbsp;</td></tr>';
				$message .= "<tr style='background: #eee;'><td colspan='2'><strong>Dear Admin,</strong></td></tr>";
				$message .= "<tr><td colspan='2'>A User <strong>" .$Full_Name. "</strong> has signed up with following information! </td></tr>";                
				$message .= "<tr><td align='center'>
				<img src='https://mailerproject-arpitapatel.c9users.io/images/$imagename' alt=".$imagename." height='100' width='100' /></td></tr>";
				$message .= '<tr><td colspan=2>&nbsp;</td></tr>';
				$message .= "<tr><td ><strong>Name:</strong>" . $Full_Name  . "</td></tr>";
				$message .= "<tr><td ><strong>city:</strong>" . $city  . "</td></tr>";
				$message .= "<tr><td colspan='2'>Please select one of the option to allow him/her to use your site</td></tr>";
				$message .= '<tr><td colspan=2>&nbsp;</td></tr>';
				$message .= "<tr><td colspan=2 ><a href=https://mailerproject-arpitapatel.c9users.io/user/userpermission.php?status=approve&email=".$from.">Approve </a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=https://mailerproject-arpitapatel.c9users.io/user/userpermission.php?status=disapprove&email=".$from.">Disapprove </a></td></tr>";
				$message .= "<tr><td colspan='2'>Thank you.</tr>"; 
				$message .= "</table>";             
				$message .= "</body></html>";   
				$headers = "From: " . $from . "\r\n";
				$headers .= "CC: patelarpita1991@gmail.com\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
				 $result = mail($to, "$subject", $message, "From:" . $headers);
				
				 if($result)
				 {
				 header('location:usermessage.php');
				 }
				 else
				 {
				 echo "We couldn't send mail to admin";
				 }
			}
			 else
			 {
			 die(mysql_error()); 
			 }
}

?>
<!DOCTYPE html>
<html>
<head>
<script type='text/javascript'  src='https://code.jquery.com/jquery-git2.js'></script>
<script type='text/javascript'  src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.1.0/bootstrap.min.js"></script>
<script type='text/javascript'  src="https://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<style type='text/css'>
@import url('https://getbootstrap.com/dist/css/bootstrap.css');
</style>
<link  rel="stylesheet" href="../mycss.css" />
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-5">
        <div class="panel panel-primary">
          <div class="panel-heading" align="center">
            <h1>Join Me!!</h1>
          </div>
          <div class="panel-body">
            <form role="form" method="post" enctype="multipart/form-data">
			  <h3>Login Detail</h3>
				<div class="form-group">
				  <label>Email:</label>
				  <input type="email" class="form-control" name="email" placeholder="arpita@gmail.com">
				</div>
			
				<div class="form-group">
				  <label for="pwd">Password:</label>
				  <input type="password" class="form-control" name="pwd" placeholder="Enter password">
				</div>
				
			   <h3>Personal Detail</h3>
			   	<div class="form-group">
				  <label>User Name:</label>
				  <input type="text" class="form-control" name="username" placeholder="Apatel921">
				</div>
				<div class="form-group">
				  <label>Gender:</label><br />
				  <input type="radio" name="gender" value="Male"  />Male
				  <input type="radio" name="gender" value="Female"  />Female
				</div>
			<div class="form-group">
				  <label>City:</label><br />
				 	<select name="city">
					<option value="0">select city</option>
					<option value="Kitchener">Kitchener</option>
					<option value="Waterloo">Waterloo</option>
					<option value="Guelph">Guelph</option>
					</select>
				</div>
				
				
				<div class="form-group">
				  <label>Address:</label><br />
				 <textarea name="address"></textarea>
				</div>
								
				<div class="form-group">
				  <label>Upload Image:</label>
				  <input type="file" name="image" />
				</div>
				
				<div class="form-group" align="center">
				<input type="submit" name="submit" value="Submit" class="btn btn-default" />
				
				</div>
				
			  </form>
           </div>
        </div>
      </div>
    
  </div>
</body>
</html>