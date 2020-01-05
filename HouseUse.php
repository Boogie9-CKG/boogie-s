<?php
	session_start();
	include("database.php");
	error_reporting(0);
	$tincome = 0;
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>House Use Record</title>
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
				</ul>
			</li>
      	<li><a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
  	  </ul>
  </div>
</nav>
<?php
 $SQL2 = "SELECT * FROM tblbook WHERE (HostEmail = '".$_SESSION['Email']."') AND ";

if(isset($_POST['btnSearch']))
{
	$searchinfog = mysql_escape_string($_POST['searchg']);
	if($searchinfog != "")
	{
  	$SQL2 .= "  (GuestEmail LIKE '%".trim($searchinfog)."%') AND ";
	}
	if($_POST['hid'] != "")
	{
		$SQL2 .= "  (HouseId LIKE '%".trim($_POST['hid'])."%') AND ";
	}
	if($_POST['hname'] != "")
	{
  	$SQL2 .= "  (HouseName LIKE '%".trim($_POST['hname'] )."%') AND ";
	}


	if($_POST['status'] != ""  )
	{
		$SQL2 .= " (Status = '".$_POST['status']."') AND ";
	}

	if($_POST['fromdate'] != "" && $_POST['todate'] == "" )
	{
		$SQL2 .= " (BookingDate >= '".$_POST['fromdate']."') AND ";
	}

	if($_POST['fromdate'] == "" && $_POST['todate'] != "" )
	{
		$SQL2 .= " (BookingDate <= '".$_POST['todate']."') AND ";
	}
	if($_POST['fromdate'] != "" && $_POST['todate'] != "" )
	{
		$SQL2 .= " (BookingDate >= '".$_POST['fromdate']."' AND BookingDate <= '".$_POST['todate']."') AND ";
	}

 $SQL2 .="ORDER BY BookingDate DESC, BookingTime DESC";
 $SQL2 = str_replace("AND ORDER","ORDER",$SQL2);
$Result2 = mysql_query($SQL2, $Link);
$count = mysql_num_rows($Result2);
if($count == 0)
	{
		?>
			<div style="padding: 10px 188px 10px;">
					<div id="myAlert" class="alert alert-warning" >
			<a class="close" data-dismiss="alert">&times;</a>
			<strong>Sorry </strong>There was no such record found.
					</div>
			</div>
		<?php
	}
}
?>

<div style="padding: 10px 0px 1000px;">
		<table class="table table-striped">
  <caption><strong>House Use Record</strong></caption>
  <thead>
		<tr>
			<form method="POST" action="">
			<label style="font-size:15px">From:</label>&nbsp;<input name="fromdate" style="width:130px; height:30px"  type="date"  />&nbsp;
			<label style="font-size:15px">To:</label>&nbsp;<input name="todate" style="width:130px; height:30px"  type="date"  />&nbsp;
			<label style="font-size:15px">Status:</label>&nbsp;<select name="status" style="width:200px; height:30px">
				<option value =''> </option>
				<option value='Pending host response'>Pending host response</option>
				<option value='Has been rejected'>Has been rejected</option>
				<option value='Pending guest check-in'>Pending guest check-in</option>
				<option value='Pending guest check-out'>Pending guest check-out</option>
				<option value='Has been checked-out'>Has been checked-out</option>
				<option value='Has been checked-out and rated'>Has been checked-out and rated</option>
			</select>&nbsp;<br>
			<input name="hid" value="<?php if(isset($_POST['hid'])){echo $_POST['hid'];} ?>" style="width:200px; height:30px"  type="text" placeholder="Enter a house ID" />&nbsp;
			<input name="hname" value="<?php if(isset($_POST['hname'])){echo $_POST['hname'];} ?>" style="width:200px; height:30px"  type="text" placeholder="Enter a house name" />&nbsp;
			<input name="searchg" value="<?php if(isset($_POST['searchg'])){echo $_POST['searchg'];} ?>" style="width:200px; height:30px"  type="text" placeholder="Enter a guest account" />&nbsp;
			<input name="btnSearch" type="submit" class="btn btn-default" value="Search">
			</form>
		</tr>
		<p>
    <tr>
			<th><div align="center">Transaction ID</div></th>
      <th><div align="center">House ID</div></th>
      <th><div align="center">House Name</div></th>
			<th><div align="center">Guest Email</div></th>
			<th><div align="center">Booking Date</div></th>
      <th><div align="center">Booking Time</div></th>
      <th><div align="center">Check-in Date</div></th>
      <th><div align="center">Check-out Date</div></th>
      <th><div align="center">Total Stay</div></th>
			<th><div align="center">Service Charge(RM)</div></th>
      <th><div align="center">Income(RM)</div></th>
      <th><div align="center">Status</div></th>
    </tr>
  </thead>
  <tbody>
		<?php
	  while($Row2 = mysql_fetch_array($Result2)) {
		 ?>
	    <tr>
				<td align="center"><?php echo $Row2['TransactionID'] ?></td>
	      <td align="center"><?php echo $Row2['HouseId'] ?></td>
				<td align="center"><?php echo $Row2['HouseName'] ?></td>

				<td align="center"><?php echo $Row2['GuestEmail'] ?></td>
				<td align="center"><?php echo $Row2['BookingDate'] ?></td>
        <td align="center"><?php echo $Row2['BookingTime'] ?></td>
        <td align="center"><?php echo $Row2['InDate'] ?></td>
        <td align="center"><?php echo $Row2['OutDate'] ?></td>
        <td align="center"><?php
				if($Row2['Stay']==1){
				echo $Row2['Stay'].' night';}
				else{echo $Row2['Stay'].' nights'; } ?></td>
				<td align="center"><?php echo $Row2['Pay']*0.03 ?></td>
        <td align="center"><?php
				$income = $Row2['Pay']-$Row2['Pay']*0.03;
			 echo	 number_format($income);
				 if($Row2['Status'] == "Has been checked-out" || $Row2['Status'] == "Has been checked-out and rated")
				 {
					 $tincome += $income;
				 }
				  ?></td>
        <td align="center"><?php echo $Row2['Status'] ?></td>
	    </tr>
<?php echo $tincome; } ?>
		 </tbody>
	  </table>
		<tr><td><label style="font-size:18px">Total Income: RM&nbsp;</label> </td><td><label style="font-size:28px"><?php
		echo number_format($tincome); ?></label> </td></tr><br>


</div>
</div>
</body>
</html>
