<?php
	session_start();
	include("database.php");
	error_reporting(0);

	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>House Management</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<?php

	 ?>
<div class="container" align="center">
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand"  href='HomePage.php'; >Boogie9</a>
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
      	<li><a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
  	  </ul>
  </div>
</nav>

<div style="padding: 10px 200px 1000px;">


    <br><br><br>

		<table class="table table-striped">
  <caption><strong>House List</strong></caption>
  <thead>
    <tr>
			<th><div align="center">House No</div></th>
      <th><div align="center">House Name</div></th>
			<th><div align="center">Income(RM)</div></th>

    </tr>
  </thead>
  <tbody>

		<?php
    $SQL = "SELECT * FROM tblhouseinfo WHERE Email = '".$_SESSION['Email']."'";
    $Result1 = mysql_query($SQL, $Link);





	  while($Row = mysql_fetch_array($Result1)) {
		 ?>
	    <tr <?php echo "onClick=\"location='info.php?housename=".$Row['HouseName']."'\"";?>>
				<td align="center" ><?php echo $Row['LodgingId'] ?></td>
	      <td align="center"><?php echo $Row['HouseName'] ?></td>
				<td align="center"><?php echo number_format($Row['Income']) ?></td>
	    </tr>
		<?php } ?>
		 </tbody>
	  </table>



</div>
</div>


</body>
</html>
