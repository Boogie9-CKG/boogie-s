<?php
	session_start();
	include("database.php");
	error_reporting(0);
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>My Wallet</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>


<div class="container" align="center">

		<?php if($_SESSION['AccType'] == "HOST"){?>
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
							</ul>
						</li>
			      	<li><a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
			  	  </ul>
			  </div>
			</nav>
		<?php }else{ ?>
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand" href="HomePageG.php">Boogie9</a>
					</div>
						<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<?php echo $_SESSION['Name']; ?>
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="GuestInfo.php">User Profile</a></li>
								<li><a href="Wallet.php">My Wallet</a></li>
								<li class="divider"></li>
								<li><a href="BookingList.php">My Booking</a></li>
							</ul>
						</li>
							<li><a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
						</ul>
				</div>
			</nav> <?php } ?>

<div style="padding: 10px 200px 1000px;">

      <table align = "center">
        <tr><td><label style="font-size:18px">Current Wallet balance: RM&nbsp;</label> </td><td><label style="font-size:28px"><?php
				echo number_format($_SESSION['Balance']); ?></label> </td></tr>
        <tr><td><a href="AddMoney.php"><input name="btnAdd" type="button" class="btn btn-default" value="Add"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="Withdraw.php"><input name="btnDraw" type="submit" class="btn btn-default" value="Withdraw"></a></td></tr>
      </table>
    <br><br><br>

		<table class="table table-striped">
  <caption><strong>Cash Flow Record</strong></caption>
  <thead>
    <tr>
      <th>Date</th>
      <th>Time</th>
			<th>Items</th>
			<th><div align="center">Payment Method</div></th>
			<th><div align="center">Amount(RM)</div></th>
    </tr>
  </thead>
  <tbody>

		<?php
		$SQL2 = "SELECT * FROM tblcashflow WHERE Email = '".trim($_SESSION['Email'])."' ORDER BY OperationDate DESC, OperationTime DESC";
		$Result2 = mysql_query($SQL2, $Link);
	  while($Row2 = mysql_fetch_array($Result2)) {
		 ?>
	    <tr>
	      <td><?php echo $Row2['OperationDate'] ?></td>
				<td><?php echo $Row2['OperationTime'] ?></td>
				<td><?php echo $Row2['Items'] ?></td>
				<td align="center"><?php echo $Row2['Method'] ?></td>
				<td align="center"><?php
				if($Row2['Items']=='Add' ||$Row2['Items']== 'Refund'||$Row2['Items']== 'Income'){
				echo number_format($Row2['Amount']); }
				else{
					echo '('.number_format($Row2['Amount']).')'; }
				} ?></td>
	    </tr>
	    <?php   ?>
		 </tbody>
	  </table>



</div>
</div>


</body>
</html>
