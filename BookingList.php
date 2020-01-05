<?php
	session_start();
	include("database.php");
	error_reporting(0);
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>My Booking</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<?php
	if($_POST['btnIn'])
	{
		$_SESSION['tid'] = $_POST['tid'];
		$SQL3 = "UPDATE tblbook SET Status = 'Pending guest check-out' WHERE TransactionID = '".$_SESSION['tid']."'";
		$Result3 = mysql_query($SQL3, $Link);

		if($Result3 )
		{
			?>
				<div style="padding: 10px 188px 10px;">
						<div id="myAlert" class="alert alert-success" >
				<a class="close" data-dismiss="alert">&times;</a>
				<strong>Done </strong>You have been check-in successfully.
						</div>
				</div>
					<?php
		}
	}
	if($_POST['btnOut'])
	{
		$SQL = "SELECT * FROM tblbook WHERE TransactionID = '".$_SESSION['tid']."'";
		$Result = mysql_query($SQL, $Link);
		$Row = mysql_fetch_array($Result);
		$_SESSION['hemail'] = $Row['HostEmail'];
		$_SESSION['tid'] = $_POST['tid'];
		$_SESSION['hid'] = $_POST['hid'];
		$_SESSION['pay'] = $_POST['pay'];
	  $_SESSION['aincome'] = $_SESSION['pay']*0.03;
	  $_SESSION['hincome'] = $_SESSION['pay'] - $_SESSION['aincome'];

		$SQL3 = "UPDATE tblbook SET Status = 'Has been checked-out' WHERE TransactionID = '".$_SESSION['tid']."'";
		$Result3 = mysql_query($SQL3, $Link);

		$id = $_POST['tid'];
		$pay1 = $_POST['pay'];
		$stay = $_SESSION['diff2'];
	  $sf1 = $_SESSION['aincome'];
    $rental = $pay1/$stay;
		require 'PHPMailer-master/src/Exception.php';
		require 'PHPMailer-master/src/PHPMailer.php';
		require 'PHPMailer-master/src/SMTP.php';
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Host ="smtp.gmail.com";
		$mail->Port=587;
		$mail->charSet = "big5";
		$mail->Username = "boogie9ob@gmail.com";
		$mail->Password = "q19961105";
		$mail->setFrom('boogie9ob@gmail.com', 'Boogie9 Online Booking');
		$mail->Subject = "Hi. You have been check-out successfully. this is your receipt.";
		$mail->Body = "<strong>Receipt</strong>
									 <p><strong>Booking No:</strong> $id</p>
									 <p><strong>Stay:</strong> $stay nights</p>
									 <p><strong>Rental:</strong>RM $rental Per night</p>
									 <p><strong>Service fee: </strong>RM $sf1</p>
									 <p><strong>Total pay: </strong>RM $pay1</p>
									 <p><strong>Status:</strong> Has been check-out</p>
									 ";
		$mail->IsHTML(true);
		$mail->addAddress($_SESSION['Email']);

		$id = uniqid();
		$id1 = md5(uniqid(rand(), true));
		 $SQL4 = "INSERT INTO tblcashflow(TransactionID, Email, OperationDate,OperationTime, Items, Method, Amount)
		VALUES ('".$id."','".$_SESSION['hemail']."',CURDATE(),CURTIME(), 'Income', 'Admin Bank','".$_SESSION['hincome']."')";
		$Result4 = mysql_query($SQL4, $Link);

		  $SQL5 = "INSERT INTO tblcashflow(TransactionID, Email, OperationDate,OperationTime, Items, Method, Amount)
	 VALUES ('".$id1."','admin@income.com',CURDATE(),CURTIME(), 'Service Fee', 'Admin Bank','".$_SESSION['aincome']."')";
	 $Result5 = mysql_query($SQL5, $Link);

	 $SQL6 = "SELECT * FROM tblwallet WHERE Email = '".$_SESSION['hemail']."'";
		$Result6 = mysql_query($SQL6, $Link);
		$Row6 = mysql_fetch_array($Result6);
		$_SESSION['Balance'] = $Row6['Balance'];
		$_SESSION['Balance'] += $_SESSION['hincome'];

		$SQL7 = "UPDATE tblwallet SET Balance = '".trim($_SESSION['Balance'])."' WHERE Email = '".$_SESSION['hemail']."'";
 	$Result7 = mysql_query($SQL7, $Link);

	$SQL10 = "SELECT * FROM tblhouseinfo WHERE LodgingId = '".$_SESSION['hid']."'";
	 $Result10 = mysql_query($SQL10, $Link);
	 $Row10 = mysql_fetch_array($Result10);
	 $_SESSION['houseincome'] = $Row10['Income'];
	 $_SESSION['houseincome'] += $_SESSION['hincome'];

	 $SQL11 = "UPDATE tblhouseinfo SET Income = '".trim($_SESSION['houseincome'])."' WHERE LodgingId = '".$_SESSION['hid']."'";
 $Result11 = mysql_query($SQL11, $Link);

	$SQL8 = "SELECT * FROM tblwallet WHERE Email = 'admin@income.com'";
	 $Result8 = mysql_query($SQL8, $Link);
	 $Row8 = mysql_fetch_array($Result8);
	 $_SESSION['Balance2'] = $Row8['Balance'];
	 $_SESSION['Balance2'] += $_SESSION['aincome'];

	 $SQL9 = "UPDATE tblwallet SET Balance = '".trim($_SESSION['Balance2'])."' WHERE Email = 'admin@income.com'";
	$Result9 = mysql_query($SQL9, $Link);
		if($Result3&& $mail->send() )
		{
			?>
				<div style="padding: 10px 188px 10px;">
						<div id="myAlert" class="alert alert-success" >
				<a class="close" data-dismiss="alert">&times;</a>
				<strong>Done </strong>You have been check-out successfully.
						</div>
				</div>
					<?php
		}
	}
	if($_POST['btnRate'] )
	{
		$_SESSION['tid'] = $_POST['tid'];
		$_SESSION['hid'] = $_POST['hid'];
		$_SESSION['hname'] = $_POST['hname'];

		echo "<script>location = 'RateHouse.php';</script>";
	}

	?>
<div class="container" align="center">
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
			</li>
    </ul>
      	<li><a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
  	  </ul>
  </div>
</nav>
</div>

<div style="padding: 10px 80px 1000px;">
<form action="" method="post" >

		<table class="table table-striped">
  <caption><strong>Booking List</strong></caption>
  <thead>
    <tr>
			<th><div align="center">Booking No</div></th>
      <th><div align="center">House ID</div></th>
      <th><div align="center">House Name</div></th>
      <th><div align="center">Check-in Date</div></th>
			<th><div align="center">Check-out Date</div></th>
			<th><div align="center">Stay</div></th>
			<th><div align="center">Service Fee(RM)</div></th>
			<th><div align="center">Pay(RM)</div></th>
      <th><div align="center">Status</div></th>
			<th><div align="center">Action</div></th>
    </tr>
  </thead>
  <tbody>

		<?php
		$SQL2 = "SELECT * FROM tblbook WHERE GuestEmail = '".$_SESSION['Email']."' ORDER BY BookingDate DESC, BookingTime DESC";
		$Result2 = mysql_query($SQL2, $Link);
	  while($Row2 = mysql_fetch_array($Result2)) {
		 ?>
	    <tr>
				<td align="center"><?php echo $Row2['TransactionID'] ?></td>
	      <td align="center"><?php echo $Row2['HouseId'] ?></td>
        <td align="center"><?php echo $Row2['HouseName'] ?></td>
				<td align="center"><?php echo $Row2['InDate'] ?></td>
				<td align="center"><?php echo $Row2['OutDate'] ?></td>
				<td align="center"><?php
				if($Row2['Stay']==1){
				echo $Row2['Stay'].' night'; }
				else{
					echo $Row2['Stay'].' nights';
				}?></td>
				<td align="center"><?php echo number_format($Row2['ServiceFee']) ?></td>
        <td align="center"><?php echo $Row2['Pay'] ?></td>
        <td align="center"><?php echo $Row2['Status'] ?></td>
				<td align="center"><input name="btnIn"  <?php if($Row2['Status'] != 'Pending guest check-in'){echo "disabled='true'";} ?> type="submit"  class="btn btn-default" value="Check-In">&nbsp;&nbsp;
					<input name="btnOut"  <?php if($Row2['Status'] != 'Pending guest check-out'){echo "disabled='true'";} ?>  type="submit" class="btn btn-default" value="Check-Out">&nbsp;&nbsp;
					<input name="btnRate" <?php if($Row2['Status'] != 'Has been checked-out'){echo "disabled='true'";}?>   type="submit" class="btn btn-default" value="Rate"></td>
	    </tr>
<?php } ?>
		 </tbody>
	  </table>

		<script>
		$('.btn-default').click(function() {
		var a = $(this).closest('tr').find('td:nth-child(1)').text();
		var b = $(this).closest('tr').find('td:nth-child(8)').text();
		var c = $(this).closest('tr').find('td:nth-child(2)').text();
		var d = $(this).closest('tr').find('td:nth-child(3)').text();
		document.getElementById("tid").value = a;
		document.getElementById("pay").value = b;
		document.getElementById("hid").value = c;
		document.getElementById("hname").value = d;
		});

		</script>

		<input name="tid" type="hidden" id="tid">
		<input name="pay" type="hidden" id="pay">
		<input name="hid" type="hidden" id="hid">
		<input name="hname" type="hidden" id="hname">
	</form>
</div>

</body>
</html>
