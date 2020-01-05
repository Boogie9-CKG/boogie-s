
<?php
	session_start();
	include("database.php");
	error_reporting(0);?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edit House</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<?php
	if($_POST['btnEdit'])
		{

				if(trim($_POST['summary']) =="" || trim($_POST['housename'])=="")
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
					$SQL2 = "UPDATE tblhouseinfo SET
          HouseName ='".trim($_POST['housename'])."',
          Summary = '".trim($_POST['summary'])."',
          Type = '".$_POST['type1']."',
          Type2 = '".$_POST['type2']."',
          Dedicated = '".$_POST['RadioGroup1']."',
          Accommodate = '".$_POST['accommodate']."',
          Bedrooms = '".$_POST['bedrooms']."',
          Beds = '".$_POST['beds']."',
          Bathrooms = '".$_POST['bathrooms']."',
					City = '".$_POST['city']."',
          LocationDescribe = '".$_POST['location']."',
          Essentials = '".$_POST['essentials']."',
          Wifi = '".$_POST['wifi']."',
          Toilet = '".$_POST['toilet']."',
          Closet = '".$_POST['closet']."',
          TV='".$_POST['tv']."',
          Heater='".$_POST['heater']."',
          AC='".$_POST['ac']."',
          Breakfast='".$_POST['breakfast']."',
          Desk='".$_POST['desk']."',
          Fireplace='".$_POST['fireplace']."',
          Iron='".$_POST['iron']."',
          HairDryer='".$_POST['hairdryer']."',
          Pool='".$_POST['Pool']."',
          Kitchen='".$_POST['Kitchen']."',
          LaundryWasher='".$_POST['Washer']."',
          LaundryDryer='".$_POST['Dryer']."',
					Parking='".$_POST['Parking']."',
          Elevator='".$_POST['Elevator']."',
          Hot='".$_POST['Tub']."',
          Gym='".$_POST['Gym']."',
          ForChildren='".$_POST['children1']."',
          ForInfant='".$_POST['children2']."',
          Forpet='".$_POST['pet']."',
          Smoking='".$_POST['smoke']."',
          Event='".$_POST['event']."',
          Stairs='".$_POST['stairs']."',
          Noise='".$_POST['noise']."',
          Pet='".$_POST['pet2']."',
          Surveillance='".$_POST['surve']."',
          NoParking='".$_POST['parking']."',
          Weapons='".$_POST['weapon']."',
					AdvanceBook='".$_POST['advancebook']."',
          StayMin='".$_POST['staymin']."',
          StayMax=	'".$_POST['staymax']."',
          Price='".$_POST['price']."'
          WHERE LodgingId = '".$_GET['houseid']."'";

					$Result2 = mysql_query($SQL2, $Link);

					$SQL3 = "UPDATE tblbook SET HouseName ='".trim($_POST['housename'])."' WHERE HouseId = '".$_GET['houseid']."'";
					$Result3 = mysql_query($SQL3, $Link);
					if($Result2 && $Result3)
					{
						echo "<script type='text/javascript'>alert('Edit successfully...');</script>";
					}

				}
		}
	?>

<?php
$SQL = "SELECT * FROM tblhouseinfo WHERE LodgingId = '".$_GET['houseid']."'";
$Result1 = mysql_query($SQL, $Link);
$Row = mysql_fetch_array($Result1);
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
					<li><a href="AddLodging.php">Add Lodging</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Response Booking</a></li>
                    <li><a href="#">Transaction Review</a></li>
                    <li><a href="#">Report</a></li>
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
    								<td align="center"> <label style="font-size:36px; font-weight:bold">Edit House</label></td>
  							</tr>
   							<tr>
      							<td>
														<div class="panel panel-default">
    															<div class="panel-heading">
        															<h3 class="panel-title">Place Type</h3>
    															</div>
    												<div class="panel-body">
        <label style="font-size:18px; font-weight:bold">What type of property is this? </label><br><select name="type1" style="width:477px; height:30px">
        <option value ="<?php echo $Row['Type']; ?>"><?php echo $Row['Type']; ?></option>
        <option value ="Home">Home</option>
        <option value ="Apartment">Apartment</option>
        <option value ="Townhouse">Townhouse</option>
        <option value ="Hotel">Hotel</option>
	 												</select>
    											</div>
    <div class="panel-body">
        <label style="font-size:18px; font-weight:bold">What will guests have? </label><br><select name="type2" style="width:477px; height:30px">
        <option value ="<?php echo $Row['Type2']; ?>"><?php echo $Row['Type2']; ?></option>
        <option value ="Entire House">Entire House</option>
        <option value ="Private Romm">Private Romm</option>
        <option value ="Shared Room">Shared Room</option>
        <option value ="Hotel Romm">Hotel Romm</option>
	 </select>
    </div>
    <div class="panel-body">
    <label style="font-size:18px; font-weight:bold">Is this set up as a dedicated guest space? </label>
          <label style="font-size:14px">
            <input type="radio" name="RadioGroup1" <?php if($Row['Dedicated'] =='Y'){ echo "checked ='true'";} ?> value="Yes, it’s primarily set up for guests" id="RadioGroup1_0" />
            Yes, it’s primarily set up for guests</label>
          <br />
          <label style="font-size:14px">
            <input type="radio" name="RadioGroup1"  <?php if($Row['Dedicated'] =='N'){ echo "checked ='true'";} ?> value="No, I keep my personal belongings here" id="RadioGroup1_1" />
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
          <option value ="<?php echo $Row['Accommodate']; ?>"><?php echo $Row['Accommodate']; ?></option>
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
      <option value ="<?php echo $Row['Bedrooms']; ?>"><?php echo $Row['Bedrooms']; ?></option>
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
      <option value ="<?php echo $Row['Beds']; ?>"><?php echo $Row['Beds']; ?></option>
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
      <option value ="<?php echo $Row['Bathrooms']; ?>"><?php echo $Row['Bathrooms']; ?></option>
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
          <option value ="<?php echo $Row['City']; ?>"><?php echo $Row['City']; ?></option>
					<option value="Sibu">Sibu</option>
					<option value="Kuching">Kuching</option>
					<option value="Bintulu">Bintulu</option>
					<option value="Miri">Miri</option>
				</select><br><br>
				<label style="font-size:18px; font-weight:bold ">Describe the exact location of this house</label>
				<textarea style="width:477px" name="location" cols="1" rows="5"><?php echo $Row['LocationDescribe']; ?></textarea>
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
		<tr><td><input name="essentials" <?php if($Row['Essentials'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check1" onclick="if(this.checked){myFunction()}" value=""  /><label style="font-size:15px">Essentials</label></td>
      <td><input name="wifi" <?php if($Row['Wifi'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check2" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Wifi</label></td></tr>
		<tr><td><input name="toilet" <?php if($Row['Toilet'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check3" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Toilet articles</label></td>
      <td><input name="closet" <?php if($Row['Closet'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check4" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Closet/drawers</label></td></tr>
		<tr><td><input name="tv" <?php if($Row['TV'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check5" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">TV</label></td>
      <td><input name="heater" <?php if($Row['Heater'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check6" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Heater</label></td></tr>
		<tr><td><input name="ac" <?php if($Row['AC'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check7" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Air condition</label></td>
      <td><input name="breakfast" <?php if($Row['Breakfast'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check8" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Breakfast</label></td></tr>
		<tr><td><input name="desk" <?php if($Row['Desk'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check9" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Desk/workspace</label></td>
      <td><input name="fireplace" <?php if($Row['Fireplace'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check10" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Fireplace</label></td></tr>
		<tr><td><input name="iron" <?php if($Row['Iron'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check11" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Iron</label></td>
      <td><input name="hairdryer" <?php if($Row['HairDryer'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check12" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">HairDryer</label></td></tr>
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
				<tr><td><input name="Pool" <?php if($Row['Pool'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check13" onclick="if(this.checked){myFunction()}" value="" /><label style="font-size:15px">Pool</label></td>
          <td><input name="Kitchen" <?php if($Row['Kitchen'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check14" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Kitchen</label></td></tr>
				<tr><td><input name="Washer" <?php if($Row['LaundryWasher'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check15" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Laundry – washer</label></td>
          <td><input name="Dryer" <?php if($Row['LaundryDryer'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check16" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Laundry – dryer</label></td></tr>
				<tr><td><input name="Parking" <?php if($Row['Parking'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check17" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Parking</label></td>
          <td><input name="Elevator" <?php if($Row['Elevator'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check18" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Elevator</label></td></tr>
				<tr><td><input name="Tub" <?php if($Row['Hot'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check19" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Hot tub</label></td>
          <td><input name="Gym" <?php if($Row['Gym'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check20" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Gym</label></td></tr>
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
								<textarea style="width:477px" name="summary" cols="1" rows="5"><?php echo $Row['Summary']; ?></textarea><br><br>
								<label style="font-size:18px; font-weight:bold ">Name your house</label>
								<input name="housename" style="width:477px; height:30px"  type="text" value="<?php echo $Row['HouseName']; ?>" />
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
						<tr><td><input name="children1" <?php if($Row['ForChildren'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check21" onclick="if(this.checked){myFunction()}"   value="" /><label style="font-size:15px">Suitable for children (2-12 years)</label></td>
              <td><input name="children2" <?php if($Row['ForInfant'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check22" onclick="if(this.checked){myFunction()}"   value="" /><label style="font-size:15px">Suitable for infants (Under 2 years)</label></td></tr>
						<tr><td><input name="pet" <?php if($Row['Forpet'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check23" onclick="if(this.checked){myFunction()}"   value="" /><label style="font-size:15px">Suitable for pets</label></td>
              <td><input name="smoke" <?php if($Row['Smoking'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check24" onclick="if(this.checked){myFunction()}"   value="" /><label style="font-size:15px">Smoking allowed</label></td></tr>
						<tr><td><input name="event" <?php if($Row['Event'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check25" onclick="if(this.checked){myFunction()}"   value="" /><label style="font-size:15px">Events or parties allowed</label></td></tr>
					</table>
					<div class="panel-body">
					<label style="font-size:18px; font-weight:bold ">  Details guests must know about your home</label>
					</div>
					<table class="table">
				<tr><td><input name="stairs" <?php if($Row['Stairs'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check26" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Must climb stairs</label></td>
          <td><input name="noise" <?php if($Row['Noise'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check27" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Potential for noise</label></td></tr>
				<tr><td><input name="parking" <?php if($Row['NoParking'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check28" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">No parking on property</label></td>
          <td><input name="pet2" <?php if($Row['Pet'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check29" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Pet(s) live on property</label></td></tr>
				<tr><td><input name="surve" <?php if($Row['Surveillance'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check30" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Surveillance or recording devices on property</label></td>
          <td><input name="weapon" <?php if($Row['Weapons'] =='Y'){ echo "checked ='true'";} ?> type="checkbox" id="check31" onclick="if(this.checked){myFunction()}"  value="" /><label style="font-size:15px">Weapons on property</label></td></tr>
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
                    <option value ="<?php echo $Row['AdvanceBook']; ?>"><?php echo $Row['AdvanceBook']; ?></option>
									<option value="Any time">Any time</option>
									<option value="3 months">3 months</option>
									<option value="6 months">6 months</option>
									<option value="9 months">9 months</option>
									<option value="1 year">1 year</option>
						</select><br><br>
							<label style="font-size:18px; font-weight:bold ">How long can guests stay?</label><br>
							<select name="staymin" style="width:233px; height:30px">
                <option value ="<?php echo $Row['StayMin']; ?>"><?php echo $Row['StayMin']; ?></option>
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
              <option value ="<?php echo $Row['StayMax']; ?>"><?php echo $Row['StayMax']; ?></option>
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
							<input name="price" style="width:477px; height:30px"  type="number" value="<?php echo $Row['Price']; ?>" />
						</div>
						</div>
						</td></tr>
						
						<tr><td align="center">  <input name="btnEdit" type="submit" class="btn btn-default" value="Save">
						</td></tr>
</table>


</form>
</div>
	</div>

</div>
</body>
</html>
