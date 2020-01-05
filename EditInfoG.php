<?php
	session_start();
	include("database.php");
	error_reporting(0);?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Edit Profile</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<?php
	$SQL2 = "SELECT * FROM tbluserinfo WHERE Email='".trim($_SESSION['Email'])."'";
	$Result1 = mysql_query($SQL2, $Link);
	$count = mysql_num_rows($Result1);
	$Row = mysql_fetch_array($Result1);
  if($_POST['btnSave']){
		if($count == 0 ){
	if(trim($_POST['name1']) =="" || trim($_POST['name2'])==""|| trim($_POST['number1'])==""||  trim($_POST['address'])=="")
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
		$SQL = "INSERT INTO tbluserinfo(Email, AccountType, FirstName, LastName, Gender, DOB, PhoneNumber1, PhoneNumber2, Address)
		VALUES ('".trim($_SESSION['Email'])."','Guest','".trim($_POST['name1'])."','".$_POST['name2']."','".$_POST['gender']."','".$_POST['dob']."',
		'".$_POST['number1']."','".$_POST['number2']."','".$_POST['address']."'
	)";
		$Result = mysql_query($SQL, $Link);
		if($Result)
		{
			echo "<script type='text/javascript'>alert('Save successfully...');</script>";
			echo "<script>location = 'GuestInfo.php';</script>";
		}}}
	else{
		$SQL = "UPDATE tbluserinfo SET
		FirstName='".trim($_POST['name1'])."',
		LastName='".$_POST['name2']."',
		Gender='".$_POST['gender']."',
		DOB='".$_POST['dob']."',
		PhoneNumber1='".$_POST['number1']."',
		PhoneNumber2='".$_POST['number2']."',
		Address='".$_POST['address']."'
		WHERE Email = '".$_SESSION['Email']."'";

		$Result = mysql_query($SQL, $Link);
		if($Result)
		{
			echo "<script type='text/javascript'>alert('Save successfully...');</script>";
			echo "<script>location = 'GuestInfo.php';</script>";
		}
	}
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
  			</li>
        	<li><a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    	  </ul>
    </div>
  </nav>
  <br><br>
  <div style="padding: 10px 200px 1000px;">
      <form action="" method="post" >
        <table class="table"  >
          <tr><td><label style="font-size:15px">Email</label></td><td><input name="email" disabled="disabled" style="width:477px; height:30px"  type="text" value="<?php echo $_SESSION['Email'] ?>" /></td></tr>
          <tr><td><label style="font-size:15px">First Name</label> </td><td><input name="name1" style="width:477px; height:30px"  type="text" value="<?php echo $Row['FirstName'] ?>" /></td></tr>
          <tr><td><label style="font-size:15px">Last Name</label> </td><td><input name="name2" style="width:477px; height:30px"  type="text" value="<?php echo $Row['LastName'] ?>" /></td></tr>
          <tr><td><label style="font-size:15px">Gender</label> </td><td><select name="gender" style="width:477px; height:30px"><option value="<?php echo $Row['Gender'] ?>"><?php echo $Row['Gender'] ?></option>
    <?php
    	$Gender = array("Female","Male");
		for($i=0;$i<count($Gender);++$i)
		{
			echo "<option value=\"".substr($Gender[$i],0,6)."\">".$Gender[$i]."</option>";
		}
		?>
    </select></td></tr>
          <tr><td><label style="font-size:15px">Birthday</label> </td><td><input name="dob" style="width:477px; height:30px"  type="date" value="<?php echo $Row['DOB'] ?>" /></td></tr>
          <tr><td><label style="font-size:15px">Contact Number</label> </td><td><input name="number1" style="width:477px; height:30px"  type="number" value="<?php echo $Row['PhoneNumber1'] ?>" /></td></tr>
          <tr><td><label style="font-size:15px">Contact Number2</label> </td><td> <input name="number2" style="width:477px; height:30px"  type="number" value="<?php echo $Row['PhoneNumber2'] ?>" /></td></tr>
          <tr><td><label style="font-size:15px">Address</label> </td><td><textarea style="width:477px" name="address" cols="1" rows="5"><?php echo $Row['Address'] ?></textarea></td></tr>
          <tr align="center" ><td colspan="2"><input name="btnSave" type="submit" class="btn btn-default" value="Save"></td></tr>
				</table>
      </form>
  </div>
</div>
</body>
</html>
