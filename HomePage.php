<?php
	session_start();
	include("database.php");
	error_reporting(0);?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Host Home Page</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
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
										<li><a href="EditHouse.php">House Use Record</a></li>

				</ul>
			</li>
      	<li><a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
  	  </ul>
  </div>
</nav>
</div>

<div style="padding: 10px 190px ;">
<div class="panel panel-default">
			<div class="panel-heading">
				My Notification
			</div>
			<div class="panel-body">
			<?php
			$SQL = "SELECT * FROM tblbook WHERE HostEmail = '".$_SESSION['Email']."' AND Status = 'Pending host response'";
			$Result = mysql_query($SQL, $Link);
			$Row = mysql_fetch_array($Result);
			if($Row>0)
			{  ?>
				<a href = "Response.php"><span class="glyphicon glyphicon-ok"></span> You got new booking request. click here to make response.</a>
		<?php	}
			?>
			</div>
</div>

</div>
<div style="padding: 10px 190px 1000px;">
  <table >
    <tr>
    <td style="padding:0 15px 0 15px;">
<div class="panel panel-default" style="width:162px; height:200px" align="center">
    <div class="panel-body">
      <a href="HostInfo.php">
<img src="icons/account.png" style="width:110px; height:110px"  ><br><br>
				<label style="font-size:20px;color:black;  font-weight:bold">My Profile</label></a><br>
    </div>
</div>
		</td>

		<td style="padding:0 15px 0 15px;">
<div class="panel panel-default" style="width:162px; height:200px" align="center">
    <div class="panel-body">
      <a href="AddLodging.php">
<img src="icons/add.png" style="width:110px; height:110px"  ><br><br>
				<label style="font-size:20px;color:black; font-weight:bold">Add House</label></a><br>
    </div>
</div>
		</td>

		<td style="padding:0 15px 0 15px;">
<div class="panel panel-default" style="width:162px; height:200px" align="center">
    <div class="panel-body">
      <a href="Response.php">
<img src="icons/talk.png" style="width:110px; height:110px"  ><br><br>
				<label style="font-size:20px;color:black; font-weight:bold">Response</label></a><br>
    </div>
</div>
		</td>

		<td style="padding:0 15px 0 15px;">
<div class="panel panel-default" style="width:162px; height:200px" align="center">
    <div class="panel-body">
      <a href="EditHouse.php">
<img src="icons/home.png" style="width:110px; height:110px"  ><br><br>
				<label style="font-size:20px;color:black; font-weight:bold">House Management</label></a><br>
    </div>
</div>
		</td>

		<td style="padding:0 15px 0 15px;">
<div class="panel panel-default" style="width:162px; height:200px" align="center">
    <div class="panel-body">
      <a href="HouseUse.php">
<img src="icons/record.png" style="width:110px; height:110px"  ><br><br>
				<label style="font-size:20px;color:black; font-weight:bold">House Use Record</label></a><br>
    </div>
</div>
		</td>

</tr>
</table>
</div>

</body>
</html>
