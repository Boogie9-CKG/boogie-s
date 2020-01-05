<?php
	session_start();
	include("database.php");
	error_reporting(0);

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
	<?php
	if($_SESSION['LoginStatus']!=true)
	{?>
			  <div class="container-fluid">
			    <div class="navbar-header">
			      <a class="navbar-brand"  href="index.php">Boogie9</a>
			    </div>
			  	  <ul class="nav navbar-nav navbar-right">
			      	<li><a href="SignupPage.php"><span class="glyphicon glyphicon-user"></span> Signup</a></li>
			      	<li><a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
			  	  </ul>
			  </div>
<?php	}
	else if($_SESSION['AccType']=='HOST'){?>
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
<?php }else{ ?>
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
<?php } ?>
</nav>
</div>
<?php
	if($_POST['btnEdit'])
	{

		echo "<script>location = 'EditInfo.php?houseid=".$_SESSION['index']."';</script>";
	}
?>


<?php
$SQL = "SELECT * FROM tblhouseinfo WHERE HouseName='".trim($_GET['housename'])."'";
$Result1 = mysql_query($SQL, $Link);
$Row = mysql_fetch_array($Result1);
$_SESSION['HostEmail'] = $Row['Email'];
$_SESSION['index']=$Row['LodgingId'];
$_SESSION['hname']=$Row['HouseName'];

$SQL4 = "SELECT * FROM tblimg WHERE HouseID='".trim($_SESSION['index'])."'";
$Result4 = mysql_query($SQL4, $Link);
$Row4 = mysql_fetch_array($Result4);


$SQL2 = "SELECT * FROM tbluserinfo WHERE Email='".trim($Row['Email'])."'";
$Result2 = mysql_query($SQL2, $Link);
$Row2 = mysql_fetch_array($Result2);

?>
      <div style="padding: 10px 190px 30px;">

				<div id="myCarousel" class="carousel slide">



					<div class="carousel-inner">
						<?php if($Row4['Image1'] != ''){ $img+=1; ?>
						<div class="item active">
							<?php echo "<img src='images/".$Row['Email']."/".$Row['LodgingId']."/".$Row4['Image1']."'  alt='First slide' >" ?>
						</div>
						<?php }?>
						<?php if($Row4['Image2'] != ''){ $img+=1; ?>
						<div class="item">
							<?php echo "<img src='images/".$Row['Email']."/".$Row['LodgingId']."/".$Row4['Image2']."'   alt='First slide' >" ?>
						</div>
						<?php }?>
						<?php if($Row4['Image3'] != ''){ $img+=1;?>
						<div class="item">
							<?php echo "<img src='images/".$Row['Email']."/".$Row['LodgingId']."/".$Row4['Image3']."'   alt='First slide' >" ?>
						</div>
						<?php }?>
						<?php if($Row4['Image4'] != ''){ $img+=1;?>
						<div class="item">
							<?php echo "<img src='images/".$Row['Email']."/".$Row['LodgingId']."/".$Row4['Image4']."'   alt='First slide' >" ?>
						</div>
					<?php }?>
					<?php if($Row4['Image5'] != ''){ $img+=1;?>
						<div class="item">
							<?php echo "<img src='images/".$Row['Email']."/".$Row['LodgingId']."/".$Row4['Image5']."'   alt='First slide' >" ?>
						</div>
					<?php }?>
					<?php if($Row4['Image6'] != ''){ $img+=1;?>
						<div class="item">
							<?php echo "<img src='images/".$Row['Email']."/".$Row['LodgingId']."/".$Row4['Image6']."'   alt='First slide' >" ?>
						</div>
					<?php }?>
					<?php if($Row4['Image7'] != ''){ $img+=1;?>
						<div class="item">
							<?php echo "<img src='images/".$Row['Email']."/".$Row['LodgingId']."/".$Row4['Image7']."'   alt='First slide' >" ?>
						</div>
					<?php }?>
					<?php if($Row4['Image8'] != ''){ $img+=1;?>
						<div class="item">
							<?php echo "<img src='images/".$Row['Email']."/".$Row['LodgingId']."/".$Row4['Image8']."'   alt='First slide' >" ?>
						</div>
					<?php }?>
					</div>
					<ol class="carousel-indicators">
						<?php
						for($i=1;$i<=$img;++$i){ ?>
						<li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>" <?php if($i==1){echo "class='active'"; } ?> ></li>
						<?php } ?>
					</ol>

					<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
				<br>
        <label style="font-size:22px; font-weight:bold"><?php echo $Row['Type2']; ?></label><br>
      <label style="font-size:40px; font-weight:bold" ><?php echo $_GET['housename']; ?></label><br>
			<label style="font-size:18px; font-weight:bold"><?php echo "RM ".$Row['Price']." Per night"; ?></label><br>
      <label style="font-size:18px; font-weight:bold"><?php echo $Row['LocationDescribe']; ?></label><br>
      <img src="icons/user.png" width="20" height="20" alt="user" /><label style="font-size:18px; "><?php echo $Row['Accommodate']; ?> guests</label>&nbsp;&nbsp;&nbsp;
      <img src="icons/bedroom.png" width="20" height="20" alt="bedroom" /><label style="font-size:18px; "><?php echo $Row['Bedrooms']; ?> bedrooms</label>&nbsp;&nbsp;&nbsp;
      <img src="icons/bed.png" width="20" height="20" alt="bed" /><label style="font-size:18px; "><?php echo $Row['Beds']; ?> beds</label>&nbsp;&nbsp;&nbsp;
      <img src="icons/bath.png" width="20" height="20" alt="bath" /><label style="font-size:18px; "><?php echo $Row['Bathrooms']; ?> baths</label>
      <div>
        <?php echo $Row['Summary']; ?>
      </div>
      <p>
      <div class="panel panel-default">
          <div class="panel-heading">
            <strong>Amenities</strong>
          </div>
      <div class="panel-body">
        <table  border="0">
        <?php if($Row['Essentials'] !="" ){ ?>
        <tr><td><label style="font-size:15px; ">Essentials (Towels, bed sheets, soap, and toilet paper)</label></td></tr>
      <?php } ?>
      <?php if($Row['Wifi'] !="" ){ ?>
      <tr><td><label style="font-size:15px; ">Wifi (Continuous access in the listing)</label></td></tr>
    <?php } ?>
    <?php if($Row['Toilet'] !="" ){ ?>
    <tr><td><label style="font-size:15px; ">Toilet</label></td></tr>
  <?php } ?>
  <?php if($Row['Closet'] !="" ){ ?>
  <tr><td><label style="font-size:15px; ">Closet</label></td></tr>
<?php } ?>
<?php if($Row['TV'] !="" ){ ?>
<tr><td><label style="font-size:15px; ">TV</label></td></tr>
<?php } ?>
<?php if($Row['Heater'] !="" ){ ?>
<tr><td><label style="font-size:15px; ">Heater (Central heating or a heater in the listing)</label></td></tr>
<?php } ?>
<?php if($Row['AC'] !="" ){ ?>
<tr><td><label style="font-size:15px; ">Air conditioning</label></td></tr>
<?php } ?>
<?php if($Row['Breakfast'] !="" ){ ?>
<tr><td><label style="font-size:15px; ">Breakfast</label></td></tr>
<?php } ?>
<?php if($Row['Desk'] !="" ){ ?>
<tr><td><label style="font-size:15px; ">Laptop friendly workspace (A table or desk with space for a laptop and a chair that’s comfortable to work in)</label></td></tr>
<?php } ?>
<?php if($Row['Fireplace'] !="" ){ ?>
<tr><td><label style="font-size:15px; ">Fireplace</label></td></tr>
<?php } ?>
<?php if($Row['Iron'] !="" ){ ?>
<tr><td><label style="font-size:15px; ">Iron</label></td></tr>
<?php } ?>
<?php if($Row['HairDryer'] !="" ){ ?>
<tr><td><label style="font-size:15px; ">HairDryer</label></td></tr>
<?php } ?>
  <?php if($Row['Pool'] !="" ){ ?>
  <tr><td><label style="font-size:15px; ">Swimming pool</label></td></tr>
  <?php } ?>
  <?php if($Row['Kitchen'] !="" ){ ?>
  <tr><td><label style="font-size:15px; ">Kitchen</label></td></tr>
  <?php } ?>
  <?php if($Row['LaundryWasher'] !="" ){ ?>
  <tr><td><label style="font-size:15px; ">LaundryWasher</label></td></tr>
  <?php } ?>
  <?php if($Row['LaundryDryer'] !="" ){ ?>
  <tr><td><label style="font-size:15px; ">LaundryDryer</label></td></tr>
  <?php } ?>
  <?php if($Row['Parking'] !="" ){ ?>
  <tr><td><label style="font-size:15px; ">Parking</label></td></tr>
  <?php } ?>
  <?php if($Row['Hot'] !="" ){ ?>
  <tr><td><label style="font-size:15px; ">Hot tub</label></td></tr>
  <?php } ?>
  <?php if($Row['Gym'] !="" ){ ?>
  <tr><td><label style="font-size:15px; ">Gym</label></td></tr>
  <?php } ?>
    </table>
      </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
      <strong>House Rules</strong>
    </div>
<div class="panel-body">
  <table  border="0">
    <?php if($Row['ForChildren'] =="" ){ ?>
    <tr><td><label style="font-size:15px; ">Not suitable for childrens (2-12 years)</label></td></tr>
    <?php } ?>
    <?php if($Row['ForInfant'] =="" ){ ?>
    <tr><td><label style="font-size:15px; ">Not suitable for infants (Under 2 years)</label></td></tr>
    <?php } ?>
    <?php if($Row['Forpet'] =="" ){ ?>
    <tr><td><label style="font-size:15px; ">Not pets</label></td></tr>
    <?php } ?>
    <?php if($Row['Smoking'] =="" ){ ?>
    <tr><td><label style="font-size:15px; ">No smoking</label></td></tr>
    <?php } ?>
    <?php if($Row['Event'] =="" ){ ?>
    <tr><td><label style="font-size:15px; ">No parties or events</label></td></tr>
    <?php } ?>
  </table>
  </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
      <strong>Other Information</strong>
    </div>
<div class="panel-body">
  <table  border="0">
    <?php if($Row['Stairs'] !="" ){ ?>
    <tr><td><label style="font-size:15px; ">Must climb stairs</label></td></tr>
    <?php } ?>
    <?php if($Row['Noise'] !="" ){ ?>
    <tr><td><label style="font-size:15px; ">Potential noise exists</label></td></tr>
    <?php } ?>
    <?php if($Row['Pet'] !="" ){ ?>
    <tr><td><label style="font-size:15px; ">No parking on property</label></td></tr>
    <?php } ?>
    <?php if($Row['Surveillance'] !="" ){ ?>
    <tr><td><label style="font-size:15px; ">Pet(s) live on property</label></td></tr>
    <?php } ?>
    <?php if($Row['NoParking'] !="" ){ ?>
    <tr><td><label style="font-size:15px; ">Surveillance or recording devices on property</label></td></tr>
    <?php } ?>
    <?php if($Row['Weapons'] !="" ){ ?>
    <tr><td><label style="font-size:15px; ">Weapons on property</label></td></tr>
    <?php } ?>
    <tr><td><label style="font-size:15px; ">At least stay: </label><?php echo " ".$Row['StayMin']." nights"; ?></td></tr>
    <tr><td><label style="font-size:15px; ">Maximum stay: </label><?php echo " ".$Row['StayMax']." nights"; ?></td></tr>
  </table>
  </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
      <strong>Calendar</strong>
    </div>
<div class="panel-body">
			<label style="font-size:15px; ">Has been booked: </label><br>
			<?php
			$SQL5 = "SELECT * FROM tblbook WHERE HouseId = '".trim($_SESSION['index'])."' AND Status != 'Has been rejected' AND Status != 'Has been check-out'";
			$Result5 = mysql_query($SQL5, $Link);
			if(mysql_num_rows($Result5) >0 ){
				while($Row5 = mysql_fetch_array($Result5))
				{
					echo  $Row5['InDate'].' to '.$Row5['OutDate']; ?><br> <?php
				}}
				else{
					echo "Not be booked.";
				}
			 ?>
  </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
      <strong>Host Information</strong>
    </div>
<div class="panel-body">
		<label style="font-size:15px; ">Host Name: </label><?php echo " ".$Row2['FirstName'].""; echo " ".$Row2['LastName']."";   ?><br>
		<label style="font-size:15px; ">Gender: </label><?php echo " ".$Row2['Gender']."";   ?><br>
  </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
      <strong>House Reviews</strong>
    </div>
<div class="panel-body">

	<?php $SQLr = "SELECT * FROM tblratehouse WHERE HouseName='".trim($_GET['housename'])."'";
				$Resultr = mysql_query($SQLr, $Link);
				$count = mysql_num_rows($Resultr);
				?>
				<label style="font-size:20px; "><?php echo $count ?> Reviews</label>&nbsp; <br>
				<?php
				while($Rowr = mysql_fetch_array($Resultr)) {
					$all += $Rowr['Average'];
				 ?>
			<div class="panel panel-default">
			<div class="panel-body">
 			<label style="font-size:15px; ">Guest Name: </label>&nbsp;<?php echo $Rowr['GuestName'] ?>&nbsp; <label style="font-size:15px; ">Satisfaction: </label>&nbsp;<?php echo $Rowr['Average'] ?> <br>
			<label style="font-size:14px; ">Accuracy: </label>&nbsp;<?php echo $Rowr['Accuracy'] ?>&nbsp;
			<label style="font-size:14px; ">Location: </label>&nbsp;<?php echo $Rowr['Location'] ?>&nbsp;
			<label style="font-size:14px; ">Communication: </label>&nbsp;<?php echo $Rowr['Communication'] ?>&nbsp;
			<label style="font-size:14px; ">Check-In: </label>&nbsp;<?php echo $Rowr['CheckIn'] ?>&nbsp;
			<label style="font-size:14px; ">Cleanliness: </label>&nbsp;<?php echo $Rowr['Cleanliness'] ?>&nbsp;
			<label style="font-size:14px; ">Value: </label>&nbsp;<?php echo $Rowr['Value'] ?>&nbsp;<br>
			<label style="font-size:14px; ">Review: </label>&nbsp;<?php echo $Rowr['Review'] ?>&nbsp;<br>
		</div>
	</div>


		<?php } $alls = $all / $count;

						?><label style="font-size:25px; ">Overall Satisfaction: <?php echo number_format((float)$alls,2,'.','') ?></label>&nbsp; <br>

  </div>
</div>

	</div>
<div style="padding: 10px 350px 100px;">
	<?php

	 	if($_POST['btnBook'])
		{
			$SQL3 = "SELECT * FROM tblbook WHERE HouseId = '".trim($_SESSION['index'])."' AND Status != 'Has been rejected' AND Status != 'Has been check-out'";
			$Result3 = mysql_query($SQL3, $Link);
			if(mysql_num_rows($Result3) >0 )
			{
				while($Row3 = mysql_fetch_array($Result3))
				{
					if($_POST['indate'] >= $Row3['InDate'] && $_POST['indate'] <= $Row3['OutDate']){
						?>
									<div id="myAlert" class="alert alert-warning" >
							<a class="close" data-dismiss="alert">&times;</a>
							<strong>Sorry </strong>Those date has been booked.&nbsp;<?php echo  $Row3['InDate'].' to '.$Row3['OutDate']; ?>
									</div>
								<?php
				}
				else if($_POST['outdate'] >= $Row3['InDate'] && $_POST['outdate'] <= $Row3['OutDate']){
					?>
								<div id="myAlert" class="alert alert-warning" >
						<a class="close" data-dismiss="alert">&times;</a>
						<strong>Sorry </strong>Those date has been booked.&nbsp;<?php echo  $Row3['InDate'].' to '.$Row3['OutDate']; ?>
								</div>
							<?php
						}
						else	if($_POST['indate'] >= $_POST['outdate'] )
							{
								?>
											<div id="myAlert" class="alert alert-warning" >
									<a class="close" data-dismiss="alert">&times;</a>
									<strong>Error </strong>Please select correct date.
											</div>
										<?php
							}

							else{
							$_SESSION['price']=$Row['Price'];
							$_SESSION['indate']=$_POST['indate'];
							$_SESSION['outdate']=$_POST['outdate'];
							$_SESSION['person']=$_POST['person'];

						  echo "<script>location = 'Booking.php';</script>";
						}

			}
		}
		else	if($_POST['indate'] >= $_POST['outdate'] )
			{
				?>
							<div id="myAlert" class="alert alert-warning" >
					<a class="close" data-dismiss="alert">&times;</a>
					<strong>Error </strong>Please select correct date.
							</div>
						<?php
			}

			else{
			$_SESSION['price']=$Row['Price'];
			$_SESSION['indate']=$_POST['indate'];
			$_SESSION['outdate']=$_POST['outdate'];
			$_SESSION['person']=$_POST['person'];

		  echo "<script>location = 'Booking.php';</script>";
		}
		}
	?>
	<?php if($_SESSION['AccType'] == "GUEST"){ ?>
			<form action="" method="post" >

				<div class="panel panel-default">
    <div class="panel-body">
				<table class="table"  >
					<tr><td><label style="font-size:18px; font-weight:bold"><?php echo "RM ".$Row['Price']." per night"; ?></label></td></tr>
					<tr><td><label style="font-size:15px">Check-in date:</label></td><td><input name="indate" style="width:200px; height:30px"  type="date" value="" /></td>
							<td><label style="font-size:15px">Check-out date:</label></td><td><input name="outdate"  style="width:200px; height:30px"  type="date" value="" /></td>
					</tr>
					<tr><td><label style="font-size:15px">How many guests?</label></td><td><select name="person" style="width:200px; height:30px">
						<?php
				$subject = array("1","2","3","4","5","6","7","8","9","10","10+");
			for($i=0;$i<count($subject);++$i)
			{
				if($subject[$i]==1)
				echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]." Guest"."</option>";
				else
				echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]." Guests"."</option>";
			}?>
			</select></td></tr>


				</table>

			<div align="center"><input name="btnBook" type="submit" class="btn btn-default" value="Book"></div>
			</div></div>
<script>
var today = new Date().toISOString().split('T')[0];
	 document.getElementsByName("indate")[0].setAttribute('min', today);
	 document.getElementsByName("outdate")[0].setAttribute('min', today);



</script>
			</form>
	<?php }
 else if ($_SESSION['AccType'] == "HOST"){ ?>
	 		<form action="" method="post" >
				<input name="btnEdit" type="submit" class="btn btn-default" value="Edit">
			</form><?php
 }
	?>
</div>

</body>
</html>
