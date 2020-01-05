<?php
	session_start();
	include("database.php");
	error_reporting(0);
	$in = 0;
	$out = 0;
	$_SESSION['in'] = 0;
	$_SESSION['out'] = 0;
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>User Info</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>


<div class="container" align="center">
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand"  href='HomePageA.php'; >Boogie9</a>
    </div>
  	  <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<?php echo $_SESSION['Name']; ?>
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="AdminBank.php">Cash Flow</a></li>
					<li><a href="AdminTran.php">Booking Record</a></li>
					<li><a href="AdminTranMoney.php">Transaction Record</a></li>
					<li><a href="ServiceFee.php">Service Charge</a></li>
			</li>
    </ul>
      	<li><a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
  	  </ul>
  </div>
</nav>
<?php
 $SQL2 = "SELECT * FROM tbluserinfo WHERE ";

if(isset($_POST['btnSearch']))
{
	$searchinfo = mysql_escape_string($_POST['search']);
	if($searchinfo != "")
	{
  	$SQL2 .= "  ( Email LIKE '%$searchinfo%' OR FirstName LIKE '%$searchinfo%'
		OR LastName LIKE '%$searchinfo%' OR PhoneNumber1 LIKE '%$searchinfo%' OR PhoneNumber2 LIKE '%$searchinfo%' OR Address LIKE '%$searchinfo%' ) AND ";
	}
	if($_POST['type'] != ""  )
	{
		$SQL2 .= " (AccountType = '".$_POST['type']."') AND ";
	}
	if($_POST['gender'] != ""  )
	{
		$SQL2 .= " (Gender = '".$_POST['gender']."') AND ";
	}
	if($_POST['fromdate'] != "" && $_POST['todate'] == "" )
	{
		$SQL2 .= " (DOB >= '".$_POST['fromdate']."') AND ";
	}

	if($_POST['fromdate'] == "" && $_POST['todate'] != "" )
	{
		$SQL2 .= " (DOB <= '".$_POST['todate']."') AND ";
	}
	if($_POST['fromdate'] != "" && $_POST['todate'] != "" )
	{
		$SQL2 .= " (DOB >= '".$_POST['fromdate']."' AND DOB <= '".$_POST['todate']."') AND ";
	}
}
$SQL2 .="ORDER BY DOB DESC";
$SQL2 = str_replace("AND ORDER","ORDER",$SQL2);
$SQL2 = str_replace("WHERE ORDER BY DOB DESC","",$SQL2);
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
?>
<div style="padding: 10px 50px 1000px;">


    <br><br>
		<table class="table table-striped">
  <caption><strong>User List</strong></caption>

  <thead>
		<tr>
			<form method="POST" action="">
			<label style="font-size:15px">From:</label>&nbsp;<input name="fromdate" style="width:130px; height:30px"  type="date"  />&nbsp;
			<label style="font-size:15px">To:</label>&nbsp;<input name="todate" style="width:130px; height:30px"  type="date"  />&nbsp;
			<label style="font-size:15px">Type:</label>&nbsp;<select name="type" style="width:100px; height:30px">
				<option> </option>
				<option value='Guest'>Guest</option>
				<option value='Host'>Host</option>
			</select>&nbsp;
			<label style="font-size:15px">Gender:</label>&nbsp;<select name="gender" style="width:100px; height:30px">
				<option> </option>
				<option value='Male'>Male</option>
				<option value='Female'>Female</option>
			</select>&nbsp;
			<br>

			<input name="search" value="<?php if(isset($_POST['search'])){echo $_POST['search'];} ?>" style="width:300px; height:30px"  type="text" placeholder="Enter a Email, Name, Phone or Address" />&nbsp;
			<input name="btnSearch" type="submit" class="btn btn-default" value="Search">

			</form>
		</tr>
		<p>
    <tr>
			<th><div align="center">Email</div></th>
      <th><div align="center">Account Type</div></th>
      <th><div align="center">First Name</div></th>
			<th><div align="center">Last Name</div></th>
			<th><div align="center">Gender</div></th>
			<th><div align="center">DOB</div></th>
			<th><div align="center">Phone1</div></th>
			<th><div align="center">Phone2</div></th>
			<th><div align="center">Address</div></th>
    </tr>
  </thead>
  <tbody>

		<?php


	  while($Row2 = mysql_fetch_array($Result2)) {
		 ?>
	    <tr>
				<td align="center"><?php echo $Row2['Email'] ?></td>
	      <td align="center"><?php echo $Row2['AccountType'] ?></td>
				<td align="center"><?php echo $Row2['FirstName'] ?></td>
				<td align="center"><?php echo $Row2['LastName'] ?></td>
				<td align="center"><?php echo $Row2['Gender'] ?></td>
				<td align="center"><?php echo $Row2['DOB'] ?></td>
				<td align="center"><?php echo $Row2['PhoneNumber1'] ?></td>
				<td align="center"><?php echo $Row2['PhoneNumber2'] ?></td>
				<td align="center"><?php echo $Row2['Address'] ?></td>

	    </tr>
<?PHP } ?>
		 </tbody>
	  </table>


</div>
</div>


</body>
</html>
