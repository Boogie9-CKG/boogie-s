<?php
	session_start();
	include("database.php");
	error_reporting(0);

	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Service Charge</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<?php
$SQL = "SELECT * FROM tblwallet WHERE Email = 'admin@income.com'";
$Result1 = mysql_query($SQL, $Link);
$Row = mysql_fetch_array($Result1);
	 ?>
<div class="container" align="center">
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand"  href='HomePageA.php'; >Boogie9</a>
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
			</li>
    </ul>
      	<li><a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
  	  </ul>
  </div>
</nav>

<div style="padding: 10px 200px 1000px;">

      <table align = "center">
        <tr><td><label style="font-size:18px">Current Service Fee Total: RM&nbsp;</label> </td><td><label style="font-size:28px"><?php
				echo number_format($Row['Balance']); ?></label> </td></tr>

      </table>
    <br><br><br>

		<table class="table table-striped">
  <caption><strong>Service Fee Record</strong></caption>
  <thead>
    <tr>
			<th><div align="center">User Account</div></th>
      <th><div align="center">Date</div></th>
      <th><div align="center">Time</div></th>
			<th><div align="center">Items</div></th>
			<th><div align="center">Method</div></th>
			<th><div align="center">Amount(RM)</div></th>
    </tr>
  </thead>
  <tbody>

		<?php
	  $SQL2 = "SELECT * FROM tblcashflow WHERE Email = 'admin@income.com' ORDER BY OperationDate DESC, OperationTime DESC";
		$Result2 = mysql_query($SQL2, $Link);
	  while($Row2 = mysql_fetch_array($Result2)) {
		 ?>
	    <tr>
				<td align="center"><?php echo $Row2['Email'] ?></td>
	      <td align="center"><?php echo $Row2['OperationDate'] ?></td>
				<td align="center"><?php echo $Row2['OperationTime'] ?></td>
				<td align="center"><?php echo $Row2['Items'] ?></td>
				<td align="center"><?php echo $Row2['Method'] ?></td>
				<td align="center"><?php echo number_format($Row2['Amount'])?></td>
	    </tr>
		<?php } ?>
		 </tbody>
	  </table>



</div>
</div>


</body>
</html>
