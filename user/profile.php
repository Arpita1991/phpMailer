<?php 
ob_start();
require('../conn/path.php');
session_start();

if($_SESSION['id'] != '')
{
		$query = "select * from registration where firstname = '".$_SESSION['firstname']."' and id = '".$_SESSION['id']."'";
		$sql = mysql_query($query);	
		$row = mysql_fetch_array($sql);
}
else
{
	header('location:index.php');
}

if(isset($_REQUEST['submit']))
{
		$desc = $_REQUEST['desc'];
		
		if(isset($_FILES['file']['name']))
		{
			$randnumber = mt_rand(5, 15);
			$imagename = $_FILES['file']['name'];			
			$desc = $_REQUEST['desc'];
			$upload = move_uploaded_file($_FILES['file']['tmp_name'],"../video/".$_FILES['file']['name']);
			if($upload)
			{
				$query = "insert into video values('','$desc','$imagename','$randnumber','".$row['id']."','0')";
				$sql = mysql_query($query);
					if($query)
					{
					    $to = "patel_arpita1991@yahoo.com";
						$from = $row['email'];
						$Full_Name = $row['firstname'];
						$subject = $Full_Name. " has Uploaded Video";
						$message = '<html><body>';   
						$message .= '<table cellpadding="10" border="0">';
						$message .= '<tr><td colspan=2>&nbsp;</td></tr>';
						$message .= "<tr style='background: #eee;'><td colspan='2'><strong>Dear Admin,</strong></td></tr>";
						$message .= "<tr><td colspan='2'>A User <strong>" .$Full_Name. "</strong> has uploaded video with following information! </td></tr>";    
						$message .= '<tr><td colspan=2>&nbsp;</td></tr>';            
						$message .= "<tr><td colspna='2'> <a href='https://mailerproject-arpitapatel.c9users.io/video/$imagename'>Please click me and check the link</a> </td></tr>";

$message .= "<tr><td><video width='400' height='400' controls='controls'>
        <source src='https://mailerproject-arpitapatel.c9users.io/video/$imagename' type='video/mp4' />
        <a href='https://mailerproject-arpitapatel.c9users.io/video/$imagename'>
        <img src='https://mailerproject-arpitapatel.c9users.io/images/video.jpg' width='640' height='360' /></a></video></td></tr>";
        
						$message .= '<tr><td colspan=2>&nbsp;</td></tr>';
						$message .= "<tr><td colspan='2'>Please select one of the option to allow him/her to publish video</td></tr>";
						$message .= '<tr><td colspan=2>&nbsp;</td></tr>';
	  $message .= "<tr><td colspan=2 ><a href=https://mailerproject-arpitapatel.c9users.io/user/userpermission.php?status=approve&randomnumber=".$randnumber."&userid=".$_SESSION['id'].">Approve </a>
						&nbsp;&nbsp;<a href=https://mailerproject-arpitapatel.c9users.io/user/userpermission.php?status=disapprove&randomnumber=".$randnumber."&userid=".$_SESSION['id'].">Disapprove </a></td></tr>";
						$message .= "<tr><td colspan='2'>Thank you.</tr>"; 
						$message .= "</table>";             
						$message .= "</body></html>";   
						$headers = "From: " . $from . "\r\n";
						$headers .= "CC: patelarpita1991@gmail.com\r\n";
						$headers .= "MIME-Version: 1.0\r\n";
						$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
						
						//echo $message;
					
						 $result = mail($to, "$subject", $message, "From:" . $headers);
						
						 if($result)
						 {
						 header('location:profile.php');
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
		}
}

$videolist = mysql_query("select * from video where status = '1' and userid = '".$_SESSION['id']."'");
$list = mysql_num_rows($videolist);
?>
<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="../mycss.css" />
<script type='text/javascript'  src='https://code.jquery.com/jquery-git2.js'></script>
<script type='text/javascript'  src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.1.0/bootstrap.min.js"></script>
<script type='text/javascript'  src="https://eternicode.github.io/bootstrap-datepicker/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<style type='text/css'>
@import url('https://getbootstrap.com/dist/css/bootstrap.css');
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}


.active {
    background-color: #4CAF50;
}
</style>

</head>
<body>
<ul>
  <li><a class="active" href="#home">Home</a></li>
   <li style="float:right"><a href="logout.php">Logout</a></li>
</ul>


<h2>Welcome,<?php echo $row['firstname'];?></h2>
  <div class="container" style="margin-top:3%">
    <div class="row">
     <h3 style="margin-left: 10%;">Upload your video</h3>
			
	  <div class="col-md-5">
        <div class="panel panel-primary">
          <div class="panel-body">
		  
			<form role="form" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>Video Description:</label>
				<input type="text" name="desc"  />
				</div>
				<div class="form-group">
					<label>Upload video:</label>
				<input type="file" name="file" id="file"  accept="video/*" />
				</div>
				<div class="form-group">
				<input type="submit" name="submit" value="Upload" />
				</div>
			</form>
           </div>
        </div>
      </div>    
  </div>
  
  <?php 
  if($list > 0)
  {
  
  ?>
   <h3 style="margin-left: 10%;">Videos</h3>
  <div class="container">   
	<div class="row">
      <div class="col-md-5">
        
		<div class="panel panel-primary viddata">
          <div class="panel-body">
		  
		   <div class="panel-heading">
               </div>
			<?php while($r = mysql_fetch_array($videolist))
			{	
			?>
			<h3><?php echo $r['des'];?></h3>	
			<video id="video-help" width="400" controls>
				<source id="videoPath" src="../video/<?php echo $r['name'];?>" type="video/mp4">
			  </video>
			<?php 
			}?>
           </div>
        </div>
      </div>    
  </div>
<?php  } ?>
</body>
</html>