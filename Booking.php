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
	<title>House Information</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
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
<?php
if($_POST['Book'])
{
	if($_SESSION['Balance']<$_SESSION['pay'])
	{
		?>
			<div style="padding: 10px 188px 10px;">
					<div id="myAlert" class="alert alert-warning" >
			<a class="close" data-dismiss="alert">&times;</a>
			<strong>Sorry. </strong>Your balance is insufficient.Please recharge.
					</div>
			</div>
				<?php
	}
	else{
		$id = uniqid();
		$indate = $_SESSION['indate'];
		$outdate = $_SESSION['outdate'];
		$stay = $_SESSION['diff2'];
		$person = $_SESSION['person'];
		$pay = $_SESSION['pay'] - $_SESSION['pay']*0.03 ;
		$pay1 = number_format($pay);
		$sf1 = number_format($_SESSION['sf']);
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
		$mail->Subject = "Hi. There is a guest wanted rent your house. Please make response as soon as poosible. Thanks";
		$mail->Body = "<strong>Booking detail:</strong>
									 <p><strong>Booking No:</strong> $id</p>
									 <p><strong>Check-in Date:</strong> $indate</p>
									 <p><strong>Check-out Date:</strong> $outdate</p>
									 <p><strong>Stay:</strong> $stay nights</p>
									 <p><strong>Number of guests:</strong> $person</p>
									 <p><strong>Service fee: </strong>RM $sf1</p>
									 <p><strong>Your expecting revenues: </strong>RM $pay1</p>
									 <p><strong>Status:</strong> Pending host response</p>
									 ";
		$mail->IsHTML(true);
		$mail->addAddress($_SESSION['HostEmail']);


	$_SESSION['Balance'] -= $_SESSION['pay'];
	$SQL2 = "UPDATE tblwallet SET Balance = '".trim($_SESSION['Balance'])."' WHERE Email = '".trim($_SESSION['Email'])."' ";
	$Result2 = mysql_query($SQL2, $Link);

	$SQL3 = "INSERT INTO tblcashflow(TransactionID, Email, OperationDate,OperationTime, Items, Method, Amount)
	VALUES ('".$id."','".trim($_SESSION['Email'])."',CURDATE(),CURTIME(), 'Booking', 'Balance','".$_SESSION['pay']."')";
	$Result3 = mysql_query($SQL3, $Link);


	$SQL = "INSERT INTO tblbook(TransactionID,HouseId,HouseName, HostEmail, GuestEmail,GuestName, BookingDate, BookingTime, InDate, OutDate, Stay, ServiceFee, Pay, Status)
	VALUES ('".$id."','".$_SESSION['index']."','".$_SESSION['hname']."','".$_SESSION['HostEmail']."','".$_SESSION['Email']."','".$_SESSION['Name']."',CURDATE(),CURTIME(), '".$_SESSION['indate']."',
	'".$_SESSION['outdate']."','".$_SESSION['diff2']."','".$_SESSION['sf']."','".$_SESSION['pay']."', 'Pending host response'
)";
	$Result = mysql_query($SQL, $Link);
	
	if($mail->send() && $Result && $Result2 && $Result3)
	{
		?>
			<div style="padding: 10px 188px 10px;">
					<div id="myAlert" class="alert alert-success" >
			<a class="close" data-dismiss="alert">&times;</a>
			<strong>Booking request has been send! </strong>Pending host response.
					</div>
			</div>
				<?php
	}}
}
?>
<div style="padding: 10px 350px 100px;">
	  <form action="" method="post" >
  <label align="center" style="font-size:27px">Booking Information</label>
	<table class="table" align="center"  >
<?php $date1=strtotime($_SESSION['indate']);
      $date2=strtotime($_SESSION['outdate']);
      $diff=$date2-$date1;
			$_SESSION['diff2']=floor($diff/(60*60*24));
      $pay =   $_SESSION['price'] * floor($diff/(60*60*24));
			$_SESSION['pay']=$pay;
			$sf = $pay*0.03;
			$_SESSION['sf']=$sf;
      ?>
<tr><td ><label style="font-size:15px">House ID: &nbsp;</label><?php echo $_SESSION['index']; ?></td></tr>
<tr><td ><label style="font-size:15px">House Name: &nbsp;</label><?php echo $_SESSION['hname']; ?></td></tr>
<tr><td ><label style="font-size:15px">Check-in date: &nbsp;</label><?php echo $_SESSION['indate']; ?></td></tr>
<tr><td><label style="font-size:15px">Check-out date: &nbsp;</label><?php echo $_SESSION['outdate']; ?></td></tr>
<tr><td><label style="font-size:15px">Total stay: &nbsp;</label><?php echo $_SESSION['diff2'].' nights'; ?></td></tr>
<tr><td><label style="font-size:15px">Price per night: &nbsp;</label><?php echo 'RM '.$_SESSION['price'].' per night'; ?></td></tr>
<tr><td><label style="font-size:15px">Number of guests: &nbsp;</label><?php echo $_SESSION['person']; ?></td></tr>
<tr><td><label style="font-size:15px">Service fee: &nbsp;</label><?php echo 'RM '.number_format($sf); ?></td></tr>
<tr><td><label style="font-size:15px">Total pay: &nbsp;</label><?php echo 'RM '.number_format($pay); ?></td></tr>
<tr><td align="center"><input name="Book" type="submit" class="btn btn-default" value="Book"></td></tr>
	</table>
</form>
</div>
</div>
</body>
</html>
