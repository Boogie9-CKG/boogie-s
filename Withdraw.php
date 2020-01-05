<?php
	session_start();
	include("database.php");
	error_reporting(0);
	 $SQL3 = "SELECT * FROM tblwallet WHERE Email = 'admin@pass.com'";
	$Result3 = mysql_query($SQL3, $Link);
	 $Row3 = mysql_fetch_array($Result3);
	 $bank = $Row3['Balance'];

	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Withdraw</title>
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
</div>
<?php
	if($_POST['btnSubmit'])
	{
		if(trim($_POST['draw']) =="" || trim($_POST['card'])=="")
		{
			?>
				<div style="padding: 10px 188px 10px;">
						<div id="myAlert" class="alert alert-warning" >
				<a class="close" data-dismiss="alert">&times;</a>
				<strong>Error </strong>Please fill in all the information.
						</div>
				</div>
					<?php
		}
		else {
			$id = uniqid();
			$SQL = "INSERT INTO tblcashflow(TransactionID, Email, OperationDate,OperationTime, Items, Method, Amount)
			VALUES ('".$id."','".trim($_SESSION['Email'])."',CURDATE(),CURTIME(), 'Withdraw', 'Bank Card','".$_POST['draw']."')";
			$Result = mysql_query($SQL, $Link);

			$_SESSION['Balance'] -= $_POST['draw'];

			$SQL2 = "UPDATE tblwallet SET Balance = '".trim($_SESSION['Balance'])."' WHERE Email = '".trim($_SESSION['Email'])."' ";
			$Result2 = mysql_query($SQL2, $Link);

			$bank  -= $_POST['draw'];

			$SQL4 = "UPDATE tblwallet SET Balance = '".$bank."' WHERE Email = 'admin@pass.com'";
			$Result4 = mysql_query($SQL4, $Link);

			if($Result)
			{
				?>
					<div style="padding: 10px 188px 10px;">
							<div id="myAlert" class="alert alert-success" >
					<a class="close" data-dismiss="alert">&times;</a>
					<strong>Well done! </strong>Your money has been added successfully.
							</div>
					</div>
						<?php
			}
	}

}
 ?>
<div style="padding: 10px 200px 1000px;">
    <form action="" method="post" >
      <table align="center">
        <tr><td><label style="font-size:18px">Current Wallet balance: </label> </td><td><label style="font-size:18px">RM <?php echo number_format($_SESSION['Balance']); ?></label></td></tr>
        <tr><td ><label style="font-size:18px">Withdraw :</label></td><td><label style="font-size:18px">RM </label>&nbsp;&nbsp;<input name="draw" style="width:150px; height:30px"  type="number" value="" /> </td></tr>
				<tr><td ><label style="font-size:18px">Bank Card Number: </label></td><td>
					<input type="number" name="card" value="" style="width:186px"  />
				</td></tr> <tr><td></td><td>

					  <tr align="center" ><td colspan="2"><br><br><input name="btnSubmit" type="submit" class="btn btn-default" value="Submit"></td></tr>
		  </table>
    <br><br><br>
    </form>
</div>


</body>
</html>
