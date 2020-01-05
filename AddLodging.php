<?php
	session_start();
	include("database.php");
	error_reporting(0);?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Add lodging</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<?php
	if($_POST['btnSave'])
		{
			if(trim($_POST['summary']) =="" || trim($_POST['housename'])=="" || $_FILES['image1']['size'] == 0)
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
				$hid = uniqid();
				$uploadOk = 1;
				$allowed =  array('png' ,'jpg','jpeg');
				$FolderName = $_SESSION['Email'];
				mkdir("images/$FolderName", 0777);
				mkdir("images/$FolderName/$hid", 0777);
				$upload_folder = "images/$FolderName/$hid/";
				$img1 = $_FILES['image1']['name'];
				$ext1 = pathinfo($img1, PATHINFO_EXTENSION);
				$img2 = $_FILES['image2']['name'];
				$ext2 = pathinfo($img2, PATHINFO_EXTENSION);
				$img3 = $_FILES['image3']['name'];
				$ext3 = pathinfo($img3, PATHINFO_EXTENSION);
				$img4 = $_FILES['image4']['name'];
				$ext4 = pathinfo($img4, PATHINFO_EXTENSION);
				$img5 = $_FILES['image5']['name'];
				$ext5 = pathinfo($img5, PATHINFO_EXTENSION);
				$img6 = $_FILES['image6']['name'];
				$ext6 = pathinfo($img6, PATHINFO_EXTENSION);
				$img7 = $_FILES['image7']['name'];
				$ext7 = pathinfo($img7, PATHINFO_EXTENSION);
				$img8 = $_FILES['image8']['name'];
				$ext8 = pathinfo($img8, PATHINFO_EXTENSION);

				if($_FILES['image1']['size'] != 0  ){
					if( in_array($ext1,$allowed)){
				$unipic1 = '1'.".".$_FILES['image1']['type'];
				$unipic1 = str_replace("image/","",$unipic1);
				move_uploaded_file($_FILES['image1']['tmp_name'], $upload_folder.$unipic1);}
				else {
					?>
						<div style="padding: 10px 188px 10px;">
								<div id="myAlert" class="alert alert-warning" >
						<a class="close" data-dismiss="alert">&times;</a>
						<strong>Error </strong>Only png, jpg and jpeg format allowed.
								</div>
						</div>
							<?php
					$uploadOk = 0;
				}}


				if($_FILES['image2']['size'] != 0   ){
					if( in_array($ext2,$allowed)){
				$unipic2 = '2'.".".$_FILES['image2']['type'];
				$unipic2 = str_replace("image/","",$unipic2);
				move_uploaded_file($_FILES['image2']['tmp_name'], $upload_folder.$unipic2);}
				else {
					?>
						<div style="padding: 10px 188px 10px;">
								<div id="myAlert" class="alert alert-warning" >
						<a class="close" data-dismiss="alert">&times;</a>
						<strong>Error </strong>Only png, jpg and jpeg format allowed.
								</div>
						</div>
							<?php
					$uploadOk = 0;
			}}

				if($_FILES['image3']['size'] != 0  ){
					if( in_array($ext3,$allowed) ){
				$unipic3 = '3'.".".$_FILES['image3']['type'];
				$unipic3 = str_replace("image/","",$unipic3);
				move_uploaded_file($_FILES['image3']['tmp_name'], $upload_folder.$unipic3);
		  	}else {
					?>
						<div style="padding: 10px 188px 10px;">
								<div id="myAlert" class="alert alert-warning" >
						<a class="close" data-dismiss="alert">&times;</a>
						<strong>Error </strong>Only png, jpg and jpeg format allowed.
								</div>
						</div>
							<?php
					$uploadOk = 0;
				}}

				if($_FILES['image4']['size'] != 0   ){
					if( in_array($ext4,$allowed)){
				$unipic4 = '4'.".".$_FILES['image4']['type'];
				$unipic4 = str_replace("image/","",$unipic4);
				move_uploaded_file($_FILES['image4']['tmp_name'], $upload_folder.$unipic4);
		  	}else {
					?>
						<div style="padding: 10px 188px 10px;">
								<div id="myAlert" class="alert alert-warning" >
						<a class="close" data-dismiss="alert">&times;</a>
						<strong>Error </strong>Only png, jpg and jpeg format allowed.
								</div>
						</div>
							<?php
					$uploadOk = 0;
				}}

				if($_FILES['image5']['size'] != 0  ){
					if( in_array($ext5,$allowed) ){
				$unipic5 = '5'.".".$_FILES['image5']['type'];
				$unipic5 = str_replace("image/","",$unipic5);
				move_uploaded_file($_FILES['image5']['tmp_name'], $upload_folder.$unipic5);
		  	}else {
					?>
						<div style="padding: 10px 188px 10px;">
								<div id="myAlert" class="alert alert-warning" >
						<a class="close" data-dismiss="alert">&times;</a>
						<strong>Error </strong>Only png, jpg and jpeg format allowed.
								</div>
						</div>
							<?php
					$uploadOk = 0;
				}}

				if($_FILES['image6']['size'] != 0  ){
					if( in_array($ext6,$allowed)){
				$unipic6 = '6'.".".$_FILES['image6']['type'];
				$unipic6 = str_replace("image/","",$unipic6);
				move_uploaded_file($_FILES['image6']['tmp_name'], $upload_folder.$unipic6);
		  	}else {
					?>
						<div style="padding: 10px 188px 10px;">
								<div id="myAlert" class="alert alert-warning" >
						<a class="close" data-dismiss="alert">&times;</a>
						<strong>Error </strong>Only png, jpg and jpeg format allowed.
								</div>
						</div>
							<?php
					$uploadOk = 0;
				}}

				if($_FILES['image7']['size'] != 0   ){
					if(in_array($ext7,$allowed)){
				$unipic7 = '7'.".".$_FILES['image7']['type'];
				$unipic7 = str_replace("image/","",$unipic7);
				move_uploaded_file($_FILES['image7']['tmp_name'], $upload_folder.$unipic7);
			  }else {
					?>
						<div style="padding: 10px 188px 10px;">
								<div id="myAlert" class="alert alert-warning" >
						<a class="close" data-dismiss="alert">&times;</a>
						<strong>Error </strong>Only png, jpg and jpeg format allowed.
								</div>
						</div>
							<?php
					$uploadOk = 0;
				}}

				if($_FILES['image8']['size'] != 0   ){
					if( in_array($ext8,$allowed)){
				$unipic8 = '8'.".".$_FILES['image8']['type'];
				$unipic8 = str_replace("image/","",$unipic8);
				move_uploaded_file($_FILES['image8']['tmp_name'], $upload_folder.$unipic8);
			  }else {
					?>
						<div style="padding: 10px 188px 10px;">
								<div id="myAlert" class="alert alert-warning" >
						<a class="close" data-dismiss="alert">&times;</a>
						<strong>Error </strong>Only png, jpg and jpeg format allowed.
								</div>
						</div>
							<?php
					$uploadOk = 0;
				}}

				if($uploadOk != 0){
					$SQL = "INSERT INTO tblhouseinfo(LodgingId,Email,HostName,HouseName,Summary,Type,Type2,Dedicated,Accommodate,Bedrooms,Beds,Bathrooms,
					City,LocationDescribe,Essentials,Wifi,Toilet,Closet,TV,Heater,AC,Breakfast,Desk,Fireplace,Iron,HairDryer,Pool,Kitchen,LaundryWasher,LaundryDryer,
					Parking,Elevator,Hot,Gym,ForChildren,ForInfant,Forpet,Smoking,Event,Stairs,Noise,Pet,Surveillance,NoParking,Weapons,
					AdvanceBook,StayMin,StayMax,Price,pic)
					VALUES ('".$hid."','".$_SESSION['Email']."','".$_SESSION['Name']."',
					'".trim($_POST['housename'])."','".trim($_POST['summary'])."','".$_POST['type1']."','".$_POST['type2']."','".$_POST['RadioGroup1']."',
					'".$_POST['accommodate']."','".$_POST['bedrooms']."','".$_POST['beds']."','".$_POST['bathrooms']."','".$_POST['city']."','".$_POST['location']."',
					'".$_POST['essentials']."','".$_POST['wifi']."','".$_POST['toilet']."','".$_POST['closet']."',
					'".$_POST['tv']."','".$_POST['heater']."','".$_POST['ac']."','".$_POST['breakfast']."','".$_POST['desk']."','".$_POST['fireplace']."','".$_POST['iron']."','".$_POST['hairdryer']."',
					'".$_POST['Pool']."','".$_POST['Kitchen']."','".$_POST['Washer']."','".$_POST['Dryer']."','".$_POST['Parking']."','".$_POST['Elevator']."','".$_POST['Tub']."','".$_POST['Gym']."',
					'".$_POST['children1']."','".$_POST['children2']."','".$_POST['pet']."','".$_POST['smoke']."','".$_POST['event']."',
					'".$_POST['stairs']."','".$_POST['noise']."','".$_POST['parking']."','".$_POST['pet2']."','".$_POST['surve']."','".$_POST['weapon']."',
					'".$_POST['advancebook']."','".$_POST['staymin']."','".$_POST['staymax']."','".$_POST['price']."','".$unipic1."'
				)";
					$Result = mysql_query($SQL, $Link);

					$SQL5 = "INSERT INTO tblimg(HouseID, Image1,Image2,Image3,Image4,Image5,Image6,Image7,Image8 )
					VALUES ('".$hid."','".$unipic1."','".$unipic2."','".$unipic3."','".$unipic4."','".$unipic5."','".$unipic6."','".$unipic7."','".$unipic8."')";
					$Result5 = mysql_query($SQL5, $Link);
				}
					if($Result &&$Result5)
					{
						echo "<script type='text/javascript'>alert('Save successfully...');</script>";
					}

				}
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
			</li>

      	<li><a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
  	  </ul>
  </div>
</nav>

<div class="panel panel-default" >
    <div class="panel-body" >
        <div style="padding: 10px 300px 1000px;">
						<form action="" method="post" enctype="multipart/form-data" >
    						<tr>
      							<td><table width="100%" border="0">
  							<tr>
    								<td align="center"> <label style="font-size:36px; font-weight:bold">Add House</label></td>
  							</tr>
   							<tr>
      							<td>
														<div class="panel panel-default">
    															<div class="panel-heading">
        															<h3 class="panel-title">Place Type</h3>
    															</div>
    												<div class="panel-body">
        <label style="font-size:18px; font-weight:bold">What type of property is this? </label><br><select name="type1" style="width:477px; height:30px">
        <option value ="Home">Home</option>
        <option value ="Apartment">Apartment</option>
        <option value ="Townhouse">Townhouse</option>
        <option value ="Hotel">Hotel</option>
	 												</select>
    											</div>
    <div class="panel-body">
        <label style="font-size:18px; font-weight:bold">What will guests have? </label><br><select name="type2" style="width:477px; height:30px">
        <option value ="Entire House">Entire House</option>
        <option value ="Private Room">Private Room</option>
        <option value ="Shared Room">Shared Room</option>
        <option value ="Hotel Room">Hotel Room</option>
	 </select>
    </div>
    <div class="panel-body">
    <label style="font-size:18px; font-weight:bold">Is this set up as a dedicated guest space? </label>
          <label style="font-size:14px">
            <input type="radio" name="RadioGroup1" value="Yes, it’s primarily set up for guests" id="RadioGroup1_0" />
            Yes, it’s primarily set up for guests</label>
          <br />
          <label style="font-size:14px">
            <input type="radio" name="RadioGroup1" value="No, I keep my personal belongings here" id="RadioGroup1_1" />
            No, I keep my personal belongings here</label>
</div></div>
 </td>
  </tr>
  <tr><td>
<div class="panel panel-default">
   <div class="panel-heading">
        <h3 class="panel-title">Bedrooms</h3>
    </div>
    <div class="panel-body">
        <label style="font-size:18px; font-weight:bold ">How many guests can your place accommodate?</label>
				<select name="accommodate" style="width:477px; height:30px">
          <?php
    	$subject = array("1","2","3","4","5","6","7","8","9","10","10+");
		for($i=0;$i<count($subject);++$i)
		{
			if($subject[$i]==1)
			echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]."  Guest"."</option>";
			else
			echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]."  Guests"."</option>";
		}?>
	</select><br><br>
    <label style="font-size:18px; font-weight:bold ">How many bedrooms can guests use?</label>
		<select name="bedrooms" style="width:477px; height:30px">
			<?php
	$subject = array("1","2","3","4","5","6","7","8","9","10","10+");
for($i=0;$i<count($subject);++$i)
{
	if($subject[$i]==1)
	echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]." Bedroom"."</option>";
	else
	echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]." Bedrooms"."</option>";
}?>
</select><br><br>
		<label style="font-size:18px; font-weight:bold ">How many beds can guests use?</label>
		<select name="beds" style="width:477px; height:30px">
			<?php
	$subject = array("1","2","3","4","5","6","7","8","9","10","10+");
for($i=0;$i<count($subject);++$i)
{
	if($subject[$i]==1)
	echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]." Bed"."</option>";
	else
	echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]." Beds"."</option>";
}?>
</select><br><br>
		<label style="font-size:18px; font-weight:bold ">How many bathrooms can guests use?</label>
		<select name="bathrooms" style="width:477px; height:30px">
			<?php
	$subject = array("1","2","3","4","5","6","7","8","9","10","10+");
for($i=0;$i<count($subject);++$i)
{
	if($subject[$i]==1)
	echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]." Bathroom"."</option>";
	else
	echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]." Bathrooms"."</option>";
}?>
</select>
</div>
</div>
  </td></tr>
<tr><td>
	<div class="panel panel-default">
	   <div class="panel-heading">
	        <h3 class="panel-title">Location</h3>
	    </div>
	    <div class="panel-body">
				<label style="font-size:18px; font-weight:bold ">City</label>
				<select name="city" style="width:477px; height:30px">
					<option value="Sibu">Sibu</option>
					<option value="Kuching">Kuching</option>
					<option value="Bintulu">Bintulu</option>
					<option value="Miri">Miri</option>
				</select><br><br>
				<label style="font-size:18px; font-weight:bold ">Describe the exact location of this house</label>
				<textarea style="width:477px" name="location" cols="1" rows="5"></textarea>
			</div>
	</div>
</td></tr>
<tr><td>
	<div class="panel panel-default">
	   <div class="panel-heading">
	        <h3 class="panel-title">Amenities</h3>
	    </div>
	    <div class="panel-body">
				<label style="font-size:18px; font-weight:bold ">What amenities do you offer?</label>
			</div>
			<table class="table">
		<tr><td><input name="essentials" type="checkbox" id="check1" onclick="if(this.checked){myFunction()}" value=""  /><label style="font-size:15px">Essentials</label></td><td><input name="wifi" type="checkbox" id="check2" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Wifi</label></td></tr>
		<tr><td><input name="toilet" type="checkbox" id="check3" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Toilet articles</label></td><td><input name="closet" type="checkbox" id="check4" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Closet/drawers</label></td></tr>
		<tr><td><input name="tv" type="checkbox" id="check5" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">TV</label></td><td><input name="heater" type="checkbox" id="check6" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Heater</label></td></tr>
		<tr><td><input name="ac" type="checkbox" id="check7" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Air condition</label></td><td><input name="breakfast" type="checkbox" id="check8" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Breakfast</label></td></tr>
		<tr><td><input name="desk" type="checkbox" id="check9" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Desk/workspace</label></td><td><input name="fireplace" type="checkbox" id="check10" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Fireplace</label></td></tr>
		<tr><td><input name="iron" type="checkbox" id="check11" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Iron</label></td><td><input name="hairdryer" type="checkbox" id="check12" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">HairDryer</label></td></tr>
		<script>
		function myFunction() {
			for($j=1; $j<32;++$j)
			{
				$temp = "check"+$j;
				document.getElementById($temp).value = "Y";
			}
		}
		</script>
	</table>
	</div>
		</td></tr>
		<tr><td>
			<div class="panel panel-default">
			   <div class="panel-heading">
			        <h3 class="panel-title">Shared spaces</h3>
			    </div>
			    <div class="panel-body">
						<label style="font-size:18px; font-weight:bold ">What spaces can guests use?</label>
					</div>
					<table class="table">
				<tr><td><input name="Pool" type="checkbox" id="check13" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Pool</label></td><td><input name="Kitchen" type="checkbox" id="check14" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Kitchen</label></td></tr>
				<tr><td><input name="Washer" type="checkbox" id="check15" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Laundry – washer</label></td><td><input name="Dryer" type="checkbox" id="check16" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Laundry – dryer</label></td></tr>
				<tr><td><input name="Parking" type="checkbox" id="check17" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Parking</label></td><td><input name="Elevator" type="checkbox" id="check18" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Elevator</label></td></tr>
				<tr><td><input name="Tub" type="checkbox" id="check19" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Hot tub</label></td><td><input name="Gym" type="checkbox" id="check20" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Gym</label></td></tr>
			</table>
			</div>
				</td></tr>
				<tr><td>
					<div class="panel panel-default">
					   <div class="panel-heading">
					        <h3 class="panel-title">Description</h3>
					    </div>
					    <div class="panel-body">
								<label style="font-size:18px; font-weight:bold ">Summary</label>
								<textarea style="width:477px" name="summary" cols="1" rows="5"></textarea><br><br>
								<label style="font-size:18px; font-weight:bold ">Name your house</label>
								<input name="housename" style="width:477px; height:30px"  type="text" value="" />
							</div>
					</div>
				</td></tr>
				<tr><td>
					<div class="panel panel-default">
						 <div class="panel-heading">
									<h3 class="panel-title">Other information</h3>
							</div>
							<div class="panel-body">
								<label style="font-size:18px; font-weight:bold ">Set house rules for your guests</label>
							</div>
							<table class="table">
						<tr><td><input name="children1" type="checkbox" id="check21" onclick="if(this.checked){myFunction()}"   value="" /><label style="font-size:15px">Suitable for children (2-12 years)</label></td><td><input name="children2" type="checkbox" id="check22" onclick="if(this.checked){myFunction()}"   value="" /><label style="font-size:15px">Suitable for infants (Under 2 years)</label></td></tr>
						<tr><td><input name="pet" type="checkbox" id="check23" onclick="if(this.checked){myFunction()}"   value="" /><label style="font-size:15px">Suitable for pets</label></td><td><input name="smoke" type="checkbox" id="check24" onclick="if(this.checked){myFunction()}"   value="" /><label style="font-size:15px">Smoking allowed</label></td></tr>
						<tr><td><input name="event" type="checkbox" id="check25" onclick="if(this.checked){myFunction()}"   value="" /><label style="font-size:15px">Events or parties allowed</label></td></tr>
					</table>
					<div class="panel-body">
					<label style="font-size:18px; font-weight:bold ">  Details guests must know about your home</label>
					</div>
					<table class="table">
				<tr><td><input name="stairs" type="checkbox" id="check26" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Must climb stairs</label></td><td><input name="noise" type="checkbox" id="check27" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Potential for noise</label></td></tr>
				<tr><td><input name="parking" type="checkbox" id="check28" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">No parking on property</label></td><td><input name="pet2" type="checkbox" id="check29" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Pet(s) live on property</label></td></tr>
				<tr><td><input name="surve" type="checkbox" id="check30" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Surveillance or recording devices on property</label></td><td><input name="weapon" type="checkbox" id="check31" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Weapons on property</label></td></tr>
			</table>
				</div>
						</td></tr>
						<tr><td>
						<div class="panel panel-default">
						 <div class="panel-heading">
									<h3 class="panel-title">Booking</h3>
							</div>
							<div class="panel-body">
									<label style="font-size:18px; font-weight:bold ">How far in advance can guests book?</label>
									<select name="advancebook" style="width:477px; height:30px">
									<option value="Any time">Any time</option>
									<option value="3 months">3 months</option>
									<option value="6 months">6 months</option>
									<option value="9 months">9 months</option>
									<option value="1 year">1 year</option>
						</select><br><br>
							<label style="font-size:18px; font-weight:bold ">How long can guests stay?</label><br>
							<select name="staymin" style="width:233px; height:30px">
								<option>No limit</option>
								<?php
							$subject = array("1","2","3","4","5","6","7","8","9","10");
							for($i=0;$i<count($subject);++$i)
							{
							if($subject[$i]==1)
							echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]." night min"."</option>";
							else
							echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]." nights min"."</option>";
							}?>
						</select>
						<select name="staymax" style="width:233px; height:30px">
							<option>No limit</option>
							<?php
						$subject = array("1","2","3","4","5","6","7","8","9","10");
						for($i=0;$i<count($subject);++$i)
						{
						if($subject[$i]==1)
						echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]." night max"."</option>";
						else
						echo "<option value=\"".substr($subject[$i],0,3)."\">".$subject[$i]." nights max"."</option>";
						}?>
					</select>
						<br><br>
							<label style="font-size:18px; font-weight:bold ">Set up the price(RM) for each night</label>
							<input name="price" style="width:477px; height:30px"  type="number" value="" />
						</div>
						</div>
						</td></tr>
						<tr><td>
						<div class="panel panel-default">
						 <div class="panel-heading">
									<h3 class="panel-title">Set the scene</h3>
							</div>
							<div class="panel-body">
									<label style="font-size:18px; font-weight:bold ">Upload your house photo</label>
									<label style="font-size:14px; font-weight:bold ">Only png, jpg and jpeg format allowed.</label>
									<script>
									function myFunction2() {
    document.getElementById("i2").type = "file";
		document.getElementById("add2").type = "hidden";
		document.getElementById("add3").type = "button";
}
		function myFunction3() {
				document.getElementById("i3").type = "file";
				document.getElementById("add3").type = "hidden";
				document.getElementById("add4").type = "button";
				}
				function myFunction4() {
						document.getElementById("i4").type = "file";
						document.getElementById("add4").type = "hidden";
						document.getElementById("add5").type = "button";
						}
						function myFunction5() {
								document.getElementById("i5").type = "file";
								document.getElementById("add5").type = "hidden";
								document.getElementById("add6").type = "button";
								}
								function myFunction6() {
										document.getElementById("i6").type = "file";
										document.getElementById("add6").type = "hidden";
										document.getElementById("add7").type = "button";
										}
										function myFunction7() {
												document.getElementById("i7").type = "file";
												document.getElementById("add7").type = "hidden";
												document.getElementById("add8").type = "button";
												}
												function myFunction8() {
														document.getElementById("i8").type = "file";
														document.getElementById("add8").type = "hidden";
														}

									</script>
<input name="image1" class="btn btn-default" value="Save" type="file" ><br>

<input name="image2" id="i2"  class="btn btn-default" value="Save" type="hidden" ><br>
<input name="image3" id="i3"  class="btn btn-default" value="Save" type="hidden" ><br>
<input name="image4" id="i4"  class="btn btn-default" value="Save" type="hidden" ><br>
<input name="image5" id="i5"  class="btn btn-default" value="Save" type="hidden" ><br>
<input name="image6" id="i6"  class="btn btn-default" value="Save" type="hidden" ><br>
<input name="image7" id="i7"  class="btn btn-default" value="Save" type="hidden" ><br>
<input name="image8" id="i8"  class="btn btn-default" value="Save" type="hidden" ><br>

<input name="add2" id="add2" onclick="myFunction2()" type="button" class="btn btn-default" value="Add">
<input name="add3" id="add3" onclick="myFunction3()" type="hidden" class="btn btn-default" value="Add">
<input name="add4" id="add4" onclick="myFunction4()" type="hidden" class="btn btn-default" value="Add">
<input name="add5" id="add5" onclick="myFunction5()" type="hidden" class="btn btn-default" value="Add">
<input name="add6" id="add6" onclick="myFunction6()" type="hidden" class="btn btn-default" value="Add">
<input name="add7" id="add7" onclick="myFunction7()" type="hidden" class="btn btn-default" value="Add">
<input name="add8" id="add8" onclick="myFunction8()" type="hidden" class="btn btn-default" value="Add">

						</div>
							</td></tr>
						<tr><td align="center">  <input name="btnSave" type="submit" class="btn btn-default" value="Save">
						</td></tr>
</table>


</form>
</div>
	</div>

</div>
</body>
</html>
