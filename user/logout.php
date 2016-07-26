<?php
ob_start();

session_start();

session_destroy();


?>
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
<body onload="history.go(+1)">
 <div class="container">
    <div class="row">
      <div class="col-md-5">
        <div class="panel panel-primary usersignup">
          <div class="panel-body">
           <h3>Your session has been Expired.</h3>
		   <div><a href="index.php">Go Back</a></div>
           </div>
        </div>
      </div>
  </div>

</body>
</html>