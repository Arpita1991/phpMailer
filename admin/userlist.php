<?php 
ob_start();
require('../conn/path.php');

$sql = "select * from registration order by id desc";
$result = mysql_query($sql);
if($result === FALSE) { 
    die(mysql_error()); 
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
<link  rel="stylesheet" href="../css/mycss.css" />
</head>
<body>

			<h2 align="center">User List</h2>
			<table border="1" align="center">
			<tr> 
				<td>ID</td>
				<td>Name</td>
				<td>Email</td>
				<td>Gender</td>
				<td>Address</td>
				<td>City</td>
				<td>Status</td>
				<td>Profile</td>
			</tr>
			<?php while($row = mysql_fetch_array($result))
			{	
			?>	
			<tr>
			<td><?php echo $row['id'];?></td>
			<td><?php echo $row['firstname'];?></td>
			<td><?php echo $row['email'];?></td>
			<td><?php echo $row['gender'];?></td>
			<td><?php echo $row['address'];?></td>
			<td><?php echo $row['city'];?></td>
			<td><?php
			if($row['status'] == '1')
			{
			echo "<a href='../user/userpermission.php?status=disapprove&email=".$row['email']."'>Approved</a>";
			}else
			{
			echo "<a href='../user/userpermission.php?status=approve&email=".$row['email']."'>Not Approved</a>";
			}
			 ?></td>
			<td><img src="../images/<?php echo $row['image'];?>" height="50" width="50"/></td>
			</tr>
			<?php 
			}?>
			</table>
	
</body>
</html>