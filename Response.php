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
	<title>Response Booking</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<?php
if($_POST['refuse'])
{
	$_SESSION['tid'] = $_POST['tid'];

	$SQL3 = "UPDATE tblbook SET Status = 'Has been rejected' WHERE TransactionID = '".$_SESSION['tid']."'";
	$Result3 = mysql_query($SQL3, $Link);

	$SQL = "SELECT * FROM tblbook WHERE TransactionID = '".$_SESSION['tid']."'";
	$Result = mysql_query($SQL, $Link);
	$Row = mysql_fetch_array($Result);
	$_SESSION['gemail'] = $Row['GuestEmail'];
	$_SESSION['pay'] = $Row['Pay'];
	$id2 = $Row['TransactionID'];
	$indate = $Row['InDate'];
	$outdate = $Row['OutDate'];
	$stay = $Row['Stay'];
	$pay =  $Row['Pay'];
	$pay1 = number_format($pay);

	$id = uniqid();
	 $SQL4 = "INSERT INTO tblcashflow(TransactionID, Email, OperationDate,OperationTime, Items, Method, Amount)
	VALUES ('".$id."','".$_SESSION['gemail']."',CURDATE(),CURTIME(), 'Refund', 'Balance','".$_SESSION['pay']."')";
	$Result4 = mysql_query($SQL4, $Link);

 $SQL5 = "SELECT * FROM tblwallet WHERE Email = '".$_SESSION['gemail']."'";
	$Result5 = mysql_query($SQL5, $Link);
	$Row5 = mysql_fetch_array($Result5);
	$_SESSION['Balance'] = $Row5['Balance'];
	$_SESSION['Balance'] += $_SESSION['pay'];


	 $SQL6 = "UPDATE tblwallet SET Balance = '".trim($_SESSION['Balance'])."' WHERE Email = '".$_SESSION['gemail']."'";
	$Result6 = mysql_query($SQL6, $Link);

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
	$mail->Subject = "Sorry. Your booking request has been rejected.";
	$mail->Body = "
								 <p>Sorry. Your booking request has been rejected. your payment wll be refunded to your account balance soon.</p>
								 <strong>Booking detail</strong>
								 <p><strong>Booking No:</strong> $id2</p>
								 <p><strong>Check-in Date:</strong> $indate</p>
								 <p><strong>Check-out Date:</strong> $outdate</p>
								 <p><strong>Stay:</strong> $stay nights</p>
								 <p><strong>Your payment: </strong>RM $pay1</p>
								 <p><strong>Status:</strong> Has been rejected </p>
								 ";
	$mail->IsHTML(true);
	$mail->addAddress($_SESSION['gemail']);

	if( $mail->send() && $Result3 && $Result && $Result4 && $Result5 && $Result6 )
	{
		?>
			<div style="padding: 10px 188px 10px;">
					<div id="myAlert" class="alert alert-success" >
			<a class="close" data-dismiss="alert">&times;</a>
			<strong>Done </strong>The respnse will be send to guest soon.
					</div>
			</div>
				<?php
	}
}
if($_POST['accept'])
{
	$_SESSION['tid'] = $_POST['tid'];
  $_SESSION['tid'];
	$SQL3 = "UPDATE tblbook SET Status = 'Pending guest check-in' WHERE TransactionID = '".$_SESSION['tid']."'";
	$Result3 = mysql_query($SQL3, $Link);

	$SQL = "SELECT * FROM tblbook WHERE TransactionID = '".$_SESSION['tid']."'";
	$Result = mysql_query($SQL, $Link);
	$Row = mysql_fetch_array($Result);
	$_SESSION['gemail'] = $Row['GuestEmail'];
	$_SESSION['pay'] = $Row['Pay'];
	$id2 = $Row['TransactionID'];
	$indate = $Row['InDate'];
	$outdate = $Row['OutDate'];
	$stay = $Row['Stay'];
	$pay =  $Row['Pay'];
	$pay1 = number_format($pay);
  $sf = $Row['ServiceFee'];
	$sf1 =number_format($sf);
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
	$mail->Subject = "Congratulation! Your booking request has been accpted.";
	$mail->Body = "
								 <p>Congratulation! Your booking request has been accpted. Enjoy your travel.</p>
								 <strong>Booking detail</strong>
								 <p><strong>Booking No:</strong> $id2</p>
								 <p><strong>Check-in Date:</strong> $indate</p>
								 <p><strong>Check-out Date:</strong> $outdate</p>
								 <p><strong>Stay:</strong> $stay nights</p>
								 <p><strong>Service fee: </strong>RM $sf1</p>
								 <p><strong>Your payment: </strong>RM $pay1</p>
								 <p><strong>Status:</strong> Pending guest check-in </p>
								 ";
	$mail->IsHTML(true);
	$mail->addAddress($_SESSION['gemail']);

	if($mail->send() &&  $Result3 && $Result)
	{
		?>
			<div style="padding: 10px 188px 10px;">
					<div id="myAlert" class="alert alert-success" >
			<a class="close" data-dismiss="alert">&times;</a>
			<strong>Done </strong>The respnse will be send to guest soon.
					</div>
			</div>
				<?php
	}
}
if($_POST['rate'])
{
	$_SESSION['trid'] = $_POST['tid'];
	$_SESSION['hid'] = $_POST['hid'];
	$_SESSION['hname'] = $_POST['hname'];
	$_SESSION['gname'] = $_POST['gname'];
	$_SESSION['indate'] = $_POST['indate'];
	$_SESSION['outdate'] = $_POST['outdate'];

	echo "<script>location = 'RateGuest.php';</script>";
}
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
        </ul>
      	<li><a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
  	  </ul>
  </div>
</nav>
</div>

<div style="padding: 10px 120px 1000px;">
	 <form action="" method="post" >

		<table id="table" class="table table-bordered">
  <caption><strong>Response</strong></caption>
  <thead>
    <tr>
			<th><div align="center">Booking No</div></th>
      <th><div align="center">House ID</div></th>
      <th><div align="center">House Name</div></th>
			<th><div align="center">Guest Name</div></th>
			<th><div align="center">Guest Rate</div></th>
      <th><div align="center">Check-in Date</div></th>
			<th><div align="center">Check-out Date</div></th>
			<th><div align="center">Stay</div></th>
			<th><div align="center">Service Fee(RM)</div></th>
			<th><div align="center">Expecting Revenues(RM)</div></th>
      <th><div align="center">Status</div></th>
      <th><div align="center">Action</div></th>
    </tr>
  </thead>
  <tbody>

		<?php
	  $SQL2 = "SELECT * FROM tblbook WHERE HostEmail = '".$_SESSION['Email']."' ORDER BY BookingDate DESC, BookingTime DESC";
		$Result2 = mysql_query($SQL2, $Link);

		$SQL27 = "SELECT * FROM tblbook WHERE HostEmail = '".$_SESSION['Email']."' ORDER BY BookingDate DESC, BookingTime DESC";
		$Result27 = mysql_query($SQL27, $Link);

		$Rowg = mysql_fetch_array($Result27);
		$gemail = $Rowg['GuestEmail'];
		$total = 0;
		$SQL7 = "SELECT * FROM tblrateguest WHERE GuestEmail = '".$gemail."'";
		$Result7 = mysql_query($SQL7, $Link);
		$count = mysql_num_rows($Result7);
		while($Row7 = mysql_fetch_array($Result7)) {
			$total += $Row7['Average'];
		}
		$average = $total/$count;
		$ave = number_format((float)$average,1,'.','');

	  while($Row2 = mysql_fetch_array($Result2)) {
		 ?>
	    <tr>
				<td align="center" class="nr"><?php echo $Row2['TransactionID'];  ?></td>
	      <td align="center"><?php echo $Row2['HouseId'] ?></td>
        <td align="center"><?php echo $Row2['HouseName'] ?></td>
				<td align="center"><?php echo $Row2['GuestName'] ?></td>
				<td align="center"><?php echo $ave ?></td>
				<td align="center"><?php echo $Row2['InDate'] ?></td>
				<td align="center"><?php echo $Row2['OutDate'] ?></td>
				<td align="center"><?php
				if($Row2['Stay']==1){
				echo $Row2['Stay'].' night'; }
				else{
					echo $Row2['Stay'].' nights';
				}?></td>
				<td align="center"><?php echo number_format($Row2['ServiceFee']) ?></td>
        <td align="center"><?php echo number_format($Row2['Pay']-$Row2['Pay']*0.03) ?></td>
        <td align="center"><?php echo $Row2['Status']; ?></td>
				<?php if($Row2['Status']=='Pending host response'){ ?>
        <td align="center"><input name="accept" type="submit" class="btn btn-default" value="Accept">&nbsp;&nbsp;<input name="refuse"   type="submit" class="btn btn-default" value="Refuse">&nbsp;&nbsp;
				</td>
		<?php	}
					else if($Row2['Status']=='Has been checked-out and rated' || $Row2['Status']=='Has been checked-out')
					{ ?>
						<td align="center"><input name="rate"  type="submit" class="btn btn-default" value="Rate"></td>
					<?php }
					else{
?>
						  <td align="center"><input name="accept" disabled="true"  type="submit" class="btn btn-default" value="Accept">&nbsp;&nbsp;<input name="refuse" disabled="true"  type="submit" class="btn btn-default" value="Refuse"></td>
				<?php	}
				?>
	    </tr>
<?php }   ?>
		 </tbody>
	  </table>

		<script>
		$('.btn-default').click(function() {
			var a = $(this).closest('tr').find('td:nth-child(1)').text();
			var b = $(this).closest('tr').find('td:nth-child(10)').text();
			var c = $(this).closest('tr').find('td:nth-child(2)').text();
			var d = $(this).closest('tr').find('td:nth-child(3)').text();
			var e = $(this).closest('tr').find('td:nth-child(4)').text();
			var f = $(this).closest('tr').find('td:nth-child(6)').text();
			var g = $(this).closest('tr').find('td:nth-child(7)').text();
			document.getElementById("tid").value = a;
			document.getElementById("pay").value = b;
			document.getElementById("hid").value = c;
			document.getElementById("hname").value = d;
			document.getElementById("gname").value = e;
			document.getElementById("indate").value = f;
			document.getElementById("outdate").value = g;
	});


		</script>


		<input name="tid" type="hidden" id="tid">
		<input name="pay" type="hidden" id="pay">
		<input name="hid" type="hidden" id="hid">
		<input name="hname" type="hidden" id="hname">
		<input name="gname" type="hidden" id="gname">
		<input name="indate" type="hidden" id="indate">
		<input name="outdate" type="hidden" id="outdate">


</form>
</div>

</body>
</html>
