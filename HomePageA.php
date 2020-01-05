<?php
	session_start();
	include("database.php");
	error_reporting(0);?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Administrator Page</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container" align="center">
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="HomePageA.php">Boogie9</a>
    </div>
  	  <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<?php echo $_SESSION['Name']; ?>
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="AdminBank.php">Cash Flow</a></li>
					<li><a href="AdminTran.php">Booking Record</a></li>
					<li><a href="AdminTranMoney.php">Transaction Record</a></li>
          <li><a href="ServiceFee.php">Service Charge</a></li>
				</ul>
			</li>
      	<li><a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
  	  </ul>
  </div>
</nav>
</div>

<div style="padding: 10px 190px ;">

</div>
<div style="padding: 10px 190px 1000px;">
  <table >
    <tr>
    <td style="padding:0 15px 0 15px;">
<div class="panel panel-default" style="width:162px; height:185px" align="center">
    <div class="panel-body">
      <a href="AdminBank.php"><img src="icons/cash.png" style="width:110px; height:110px"  >
				<label style="font-size:20px;color:black;  font-weight:bold">Cash Flow</label></a><br>
    </div>
</div>
		</td>
		<td>
<div class="panel panel-default" style="width:162px; height:185px" align="center">
    <div class="panel-body">
      <a href="AdminTran.php"><img src="icons/record.png" style="width:110px; height:110px"  >
				<label  style="font-size:20px;color:black;  font-weight:bold">Booking Record</label></a><br>
    </div>
</div>
		</td>
		<td style="padding:0 15px 0 15px;">
<div class="panel panel-default" style="width:162px; height:185px" align="center">
    <div class="panel-body">
      <a href="AdminTranMoney.php"><img src="icons/record.png" style="width:110px; height:110px"  >
				<label style="font-size:20px;color:black;  font-weight:bold">Transaction Record</label></a><br>
    </div>
</div>
		</td>

		<td style="padding:0 15px 0 15px;">
<div class="panel panel-default" style="width:162px; height:185px" align="center">
    <div class="panel-body">
      <a href="ServiceFee.php"><img src="icons/record.png" style="width:110px; height:110px"  >
				<label style="font-size:20px;color:black;  font-weight:bold">Service Charge</label></a><br>
    </div>
</div>
		</td>
		<td style="padding:0 15px 0 15px;">
		<div class="panel panel-default" style="width:162px; height:185px" align="center">
		<div class="panel-body">
			<a href="UserInfo.php"><img src="icons/record.png" style="width:110px; height:110px"  >
				<label style="font-size:20px;color:black;  font-weight:bold">User Information</label></a><br>
		</div>
		</div>
		</td>


</tr>
</table>
</div>

</body>
</html>
