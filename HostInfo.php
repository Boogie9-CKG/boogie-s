<?php
	session_start();
	include("database.php");
	error_reporting(0);?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>User information</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<?php

if($_POST['btnEdit']){
	echo "<script>location = 'EditInfoH.php';</script>";
}

$SQL = "SELECT * FROM tbluserinfo WHERE Email='".trim($_SESSION['Email'])."'";
$Result1 = mysql_query($SQL, $Link);
$Row = mysql_fetch_array($Result1);
	 ?>
  <div class="container" align="center">
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="HomePage.php">Boogie9</a>
      </div>
    	  <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
  				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
  					<?php echo $_SESSION['Name']; ?>
  					<b class="caret"></b>
  				</a>
					<ul class="dropdown-menu">
						<li><a href="HostInfo.php">User Profile</a></li>
						<li><a href="AddLodging.php">Add House</a></li>
						<li><a href="Wallet.php">My Wallet</a></li>
	                    <li class="divider"></li>
	                    <li><a href="Response.php">Response Booking</a></li>
	                    <li><a href="EditHouse.php">House Management</a></li>
											<li><a href="HouseUse.php">House Use Record</a></li>
				</li>
	    </ul>
  			</li>
        	<li><a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    	  </ul>
    </div>
  </nav>
  <br><br>
  <div style="padding: 10px 200px 1000px;">
      <form action="" method="post" >
        <table class="table"  >
          <tr><td><label style="font-size:15px">Email</label></td><td><?php echo $_SESSION['Email'] ?></td></tr>
          <tr><td><label style="font-size:15px">First Name</label> </td><td><?php echo $Row['FirstName'] ?> </td></tr>
          <tr><td><label style="font-size:15px">Last Name</label> </td><td><?php echo $Row['LastName'] ?> </td></tr>
          <tr><td><label style="font-size:15px">Gender</label> </td><td><?php echo $Row['Gender'] ?></td></tr>
          <tr><td><label style="font-size:15px">Birthday</label> </td><td><?php echo $Row['DOB'] ?></td></tr>
          <tr><td><label style="font-size:15px">Contact Number</label> </td><td><?php echo $Row['PhoneNumber1'] ?> </td></tr>
          <tr><td><label style="font-size:15px">Contact Number2</label> </td><td><?php echo $Row['PhoneNumber2'] ?></td></tr>
          <tr><td><label style="font-size:15px">Address</label> </td><td><?php echo $Row['Address'] ?></td></tr>
				</table>

				<input name="btnEdit" type="submit" class="btn btn-default" value="Edit">
      </form>
  </div>
</div>
</body>
</html>
