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
  	<title>Rate Guest</title>
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
    										<li><a href="HouseUse.php">House Use Record</a></li>
    			</li>
        </ul>
          	<li><a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      	  </ul>
      </div>
    </nav>
    </div>

<?php
  if($_POST['btnSubmit'])
  {
    $SQL = "SELECT * FROM tblbook WHERE TransactionID = '".$_SESSION['trid']."'";
    $Result = mysql_query($SQL, $Link);
    $Row = mysql_fetch_array($Result);
    $gemail = $Row['GuestEmail'];
    $average = ($_POST['acc'] + $_POST['location'] + $_POST['communication'] + $_POST['checkin'] +$_POST['clean']+$_POST['value'])/6;
    $ave = number_format((float)$average,1,'.','');
    $SQL2 = "INSERT INTO tblrateguest(TransactionID,GuestEmail,GuestName,HostEmail,HostName,Friendly,Punctual,
      Noise,Treasure,Cleanliness,Saving,Average) VALUES ('".$_SESSION['trid']."','".$gemail."','".$_SESSION['gname']."',
      '".$_SESSION['hid']."','".$_SESSION['Name']."','".$_POST['acc']."','".$_POST['location']."','".$_POST['communication']."',
      '".$_POST['checkin']."','".$_POST['clean']."','".$_POST['value']."','".$ave."')";
      $Result2 = mysql_query($SQL2, $Link);
			$hostname = $_SESSION['Name'];
			$id2 = $_SESSION['trid'];
			$indate = $_SESSION['indate'];
			$outdate = $_SESSION['outdate'];
			$r1 = $_POST['acc'];
			$r2 = $_POST['location'];
			$r3 = $_POST['communication'];
			$r4 = $_POST['checkin'];
			$r5 = $_POST['clean'];
			$r6 = $_POST['value'];
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
			$mail->Subject = "Hi. You have got a rate.";
			$mail->Body = "
										 <p>Dear guest, You have got a rate from the host: $hostname.</p>
										 <strong>Booking detail</strong>
										 <p><strong>Booking No:</strong> $id2</p>
										 <p><strong>Check-in Date:</strong> $indate</p>
										 <p><strong>Check-out Date:</strong> $outdate</p>
										 <p>____________________________________________</p>
										 <p><strong>Your Rate as follow:</strong></p>
										 <p><strong>Friendly: </strong>$r1 </p>
										 <p><strong>Punctual: </strong>$r2 </p>
										 <p><strong>Noise: </strong> $r3</p>
										 <p><strong>Treasure: </strong> $r4</p>
										 <p><strong>Cleanliness: </strong>$r5 </p>
										 <p><strong>Saving: </strong>$r6 </p>
										 <p><strong>Average: </strong> $ave</p>
										 ";
			$mail->IsHTML(true);
			$mail->addAddress($gemail);

      if($mail->send() && $Result2)
      {
        echo "<script type='text/javascript'>alert('Rate successfully...');</script>";
      }
  }
 ?>
<div style="padding: 10px 50px 1000px;" align="center">
  <form action="" method="post"  >
  <label style="font-size:36px; ">Rate Guest</label><br>
  <label style="font-size:18px">House ID:</label> <?php echo $_SESSION['hid']; ?>&nbsp;
  <label style="font-size:18px">House Name:</label> <?php echo $_SESSION['hname']; ?>&nbsp;
  <label style="font-size:18px">Guest Name:</label> <?php echo $_SESSION['gname']; ?><br>
  <label style="font-size:18px">Check-in Date:</label> <?php echo $_SESSION['indate']; ?>&nbsp;
  <label style="font-size:18px">Check-out Date:</label> <?php echo $_SESSION['outdate']; ?>&nbsp;
    <table width="10%" border="0">
      <tr>
        <td><label style="font-size:20px">
Friendly</label></td>
        <td> <select name="acc" id="s1"  style="width:50px; height:30px"><?php
    $subject = array("10","9","8","7","6","5","4","3","2","1");
  for($i=0;$i<count($subject);++$i)
  {
    echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]."</option>";
  }?></select></td>
      </tr>
      <tr>
        <td><label style="font-size:20px;">Punctual</label></td>
        <td><select name="location" id="s2"  style="width:50px; height:30px"><?php
    $subject = array("10","9","8","7","6","5","4","3","2","1");
  for($i=0;$i<count($subject);++$i)
  {
    echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]."</option>";
  }?></select></td>
      </tr>
      <tr>
        <td><label style="font-size:20px;">Noise</label></td>
        <td><select name="communication" id="s3"  style="width:50px; height:30px"><?php
    $subject = array("10","9","8","7","6","5","4","3","2","1");
  for($i=0;$i<count($subject);++$i)
  {
    echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]."</option>";
  }?></select></td>
      </tr>
      <tr>
        <td><label style="font-size:20px; ">Treasure</label></td>
        <td><select name="checkin" id="s4"  style="width:50px; height:30px"><?php
    $subject = array("10","9","8","7","6","5","4","3","2","1");
  for($i=0;$i<count($subject);++$i)
  {
    echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]."</option>";
  }?></select></td>
      </tr>
      <tr>
        <td><label style="font-size:20px; ">Cleanliness</label></td>
        <td><select name="clean" id="s5"  style="width:50px; height:30px"><?php
    $subject = array("10","9","8","7","6","5","4","3","2","1");
  for($i=0;$i<count($subject);++$i)
  {
    echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]."</option>";
  }?></select></td>
      </tr>
      <tr>
        <td><label style="font-size:20px;">Saving</label></td>
        <td><select name="value" id="s6"  style="width:50px; height:30px"><?php
    $subject = array("10","9","8","7","6","5","4","3","2","1");
  for($i=0;$i<count($subject);++$i)
  {
    echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]."</option>";
  }?></select></td>
      </tr>




    </table><p><p>
     <input name="btnSubmit" type="submit" class="btn btn-default" value="Submit">
</form >
</div>
  </body>
