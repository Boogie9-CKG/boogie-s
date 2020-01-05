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
  	<title>Rate House</title>
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
              <li><a href="AddLodging.php">Transaction Review</a></li>
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
		$average = ($_POST['acc'] + $_POST['location'] + $_POST['communication'] + $_POST['checkin'] +$_POST['clean']+$_POST['value'])/6;
    $ave = number_format((float)$average,1,'.','');
    $SQL = "INSERT INTO tblratehouse(TransactionID,HouseNo,HouseName,GuestEmail,GuestName,Accuracy,Location,
      Communication,CheckIn,Cleanliness,Value,Average,Review) VALUES ('".$_SESSION['tid']."','".$_SESSION['hid']."','".$_SESSION['hname']."',
      '".$_SESSION['Email']."','".$_SESSION['Name']."','".$_POST['acc']."','".$_POST['location']."','".$_POST['communication']."',
      '".$_POST['checkin']."','".$_POST['clean']."','".$_POST['value']."','".$ave."','".$_POST['review']."')";
      $Result = mysql_query($SQL, $Link);
			$SQL3 = "UPDATE tblbook SET Status = 'Has been checked-out and rated' WHERE TransactionID = '".$_SESSION['tid']."'";
			$Result3 = mysql_query($SQL3, $Link);

      if($Result && $Result3)
      {
        echo "<script type='text/javascript'>alert('Rate successfully...');</script>";
				echo "<script>location = 'HomePageG.php';</script>";
      }
  }
 ?>
<div style="padding: 10px 50px 1000px;" align="center">
  <form action="" method="post"  >
  <label style="font-size:36px; ">Rate House</label><br>
  <label style="font-size:18px">House ID:</label> <?php echo $_SESSION['hid']; ?>&nbsp;
          <label style="font-size:18px">House Name:</label> <?php echo $_SESSION['hname']; ?>
    <table width="10%" border="0">
      <tr>
        <td><label style="font-size:20px">Accuracy</label></td>
        <td> <select name="acc" id="s1"  style="width:50px; height:30px"><?php
    $subject = array("10","9","8","7","6","5","4","3","2","1");
  for($i=0;$i<count($subject);++$i)
  {
    echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]."</option>";
  }?></select></td>
      </tr>
      <tr>
        <td><label style="font-size:20px;">Location</label></td>
        <td><select name="location" id="s2"  style="width:50px; height:30px"><?php
    $subject = array("10","9","8","7","6","5","4","3","2","1");
  for($i=0;$i<count($subject);++$i)
  {
    echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]."</option>";
  }?></select></td>
      </tr>
      <tr>
        <td><label style="font-size:20px;">Communication</label></td>
        <td><select name="communication" id="s3"  style="width:50px; height:30px"><?php
    $subject = array("10","9","8","7","6","5","4","3","2","1");
  for($i=0;$i<count($subject);++$i)
  {
    echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]."</option>";
  }?></select></td>
      </tr>
      <tr>
        <td><label style="font-size:20px; ">Check In</label></td>
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
        <td><label style="font-size:20px;">Value</label></td>
        <td><select name="value" id="s6"  style="width:50px; height:30px"><?php
    $subject = array("10","9","8","7","6","5","4","3","2","1");
  for($i=0;$i<count($subject);++$i)
  {
    echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]."</option>";
  }?></select></td>
      </tr>
      <tr align="center">
      <td colspan="4">
      <br>
        <label style="font-size:32px; font-weight:bold">
          Review
        </label>
      </td>
      </tr>
      <tr align="center">
      <td colspan="4">
        <textarea style="width:500px" name="review" cols="1" rows="5"></textarea>
      </td>
      </tr>

    </table><p><p>
     <input name="btnSubmit" type="submit" class="btn btn-default" value="Submit">
</form >
</div>
  </body>
