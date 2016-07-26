<?php 
ob_start();
require('../conn/path.php');

if(($_REQUEST['status'] == 'approve'))
{
	if(isset($_REQUEST['email']))
	{
		$email = $_REQUEST['email'];
		$sql = mysql_query("select * from registration where email = '$email'");
		$row = mysql_fetch_array($sql);
		$sqlupdate = "update registration set status = '1' where email = '$email'";
		$result = mysql_query($sqlupdate);
		if($result)
		{
			usermail($row['email'],'patelarpita1991@gmail.com','Approved!!',$row['firstname'],'Sign-up');
		}
	}
}

if($_GET['status'] == 'disapprove')
{
	if(isset($_REQUEST['email']))
	{
		$email = $_REQUEST['email'];
		$sql = mysql_query("select * from registration where email = '$email'");
		$row = mysql_fetch_array($sql);
		if($row['status'] == '0' )
		{
			echo "User is already Dispproved";
		}
		else
		{
			$sqlupdate = "update registration set status = '0' where email = '$email'";
			$result = mysql_query($sqlupdate);
			if($result)
			{
				usermail($row['email'],'patelarpita1991@gmail.com','Disapproved!!',$row['firstname'],'Userdenied');
			}
		}
	}
}

if($_GET['status'] == 'approve')
{
	if(isset($_REQUEST['userid']))
	{
		if(isset($_REQUEST['randomnumber']))
		{
			$userid = $_REQUEST['userid'];
			$randomnumber = $_REQUEST['randomnumber'];
			$sql = mysql_query("select * from registration where id = '$userid'");
			$row = mysql_fetch_array($sql);
			$sqlupdate = "update video set status = '1' where userid = '$userid' and randnumber = '$randomnumber'";
			$result = mysql_query($sqlupdate);
			if($result)
			{
				usermail($row['email'],'patelarpita1991@gmail.com','Video has been Approved!!',$row['firstname'],'videoapprove');
			}
	   }
	}
}

if($_GET['status'] == 'disapprove')
{
	if(isset($_REQUEST['userid']))
	{
		if(isset($_REQUEST['randomnumber']))
		{
			$userid = $_REQUEST['userid'];
			$randomnumber = $_REQUEST['randomnumber'];
			$sql = mysql_query("select * from registration where id = '$userid'");
			$row = mysql_fetch_array($sql);
			$sqlupdate = "update video set status = '0' where userid = '$userid' and randnumber = '$randomnumber'";
			$result = mysql_query($sqlupdate);
			if($result)
			{
				usermail($row['email'],'patelarpita1991@gmail.com','Video Approval is denied!!',$row['firstname'],'videodenial');
			}
		}
	}
}

function usermail($to,$from,$status,$name,$reason)
{
		    $message = '<html><body>';          
            $message .= '<table cellpadding="10" border="0">';
            $message .= "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
            $message .= "<tr style='background: #eee;'><td colspan='2'><strong>Dear ".$name.",</strong></td></tr>";
			$message .= "<tr><td colspan='2'></td></tr>";
			$message .= "<tr><td colspan='2'>Thank you for taking interest in our website.</tr>"; 
	        if($reason == 'Sign-up')
			{
		    	$message .= "<tr><td colspan='2'>You are approved to use our website.</td></tr>";
			}
			elseif($reason == 'Userdenied')
			{
				$message .= "<tr><td colspan='2'>We are very sorry,but you are not allowed to use our website.</td></tr>";
			}
			elseif($reason == 'videoapprove')
			{
			    $message .= "<tr><td colspan='2'>You video has been published to our website.</td></tr>";
			}
			elseif($reason == 'videodenial')
			{
			   $message .= "<tr><td colspan='2'>We are very sorry,but you are not allowed to publish video on our website.</td></tr>";
			}
			$message .= "<tr><td>Please click here to redirect our website.<a href=https://mailerproject-arpitapatel.c9users.io/user/login.php>Conestoga college</a></td></tr>";
		    $message .= "<tr><td colspan='2'>Thank you.</tr>"; 
		    $message .= "</table>";             
            $message .= "</body></html>";   
            $headers = "From: " . $from . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			
						
			$result = mail($to, "$status", $message, "From:" . $headers);
			if($result)
			{
			 header('location:index.php');
			}
			else
			{
			  echo "Please Try again. User is not approved";
			}
}
?>