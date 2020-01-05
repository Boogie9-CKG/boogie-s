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
	<title>Bank</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<?php
$SQL = "SELECT * FROM tblwallet WHERE Email = 'admin@pass.com'";
$Result1 = mysql_query($SQL, $Link);
$Row = mysql_fetch_array($Result1);

	 ?>

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
 $SQL2 = "SELECT * FROM tblcashflow WHERE (Items = 'Add' OR Items = 'Withdraw')    ";

if(isset($_POST['btnSearch']))
{
	$searchinfo = mysql_escape_string($_POST['search']);
	if($searchinfo != "")
	{
  	$SQL2 .= " AND (Email LIKE '%".trim($searchinfo)."%') ";
	}
	if($_POST['method'] != "")
	{
  	$SQL2 .= " AND (Method LIKE '%".trim($_POST['method'])."%') ";
	}
	if($_POST['fromdate'] != "" && $_POST['todate'] == "" )
	{
		$SQL2 .= " AND (OperationDate >= '".$_POST['fromdate']."') ";
	}
	if($_POST['item'] != ""  )
	{
		$SQL2 .= " AND (Items = '".$_POST['item']."') ";
	}
	if($_POST['fromdate'] == "" && $_POST['todate'] != "" )
	{
		$SQL2 .= " AND (OperationDate <= '".$_POST['todate']."') ";
	}
	if($_POST['fromdate'] != "" && $_POST['todate'] != "" )
	{
		$SQL2 .= " AND (OperationDate >= '".$_POST['fromdate']."' AND OperationDate <= '".$_POST['todate']."') ";
	}
}
 $SQL2 .="ORDER BY OperationDate DESC, OperationTime DESC";
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
<div style="padding: 10px 120px 1000px;">

      <table align = "center">
        <tr><td><label style="font-size:18px">Current Bank balance: RM&nbsp;</label> </td><td><label style="font-size:28px"><?php
				echo number_format($Row['Balance']); ?></label> </td></tr>

      </table>
    <br><br>
		<table class="table table-striped">
  <caption><strong>Cash Flow Record</strong></caption>

  <thead>
		<tr>
			<form method="POST" action="">
			<label style="font-size:15px">From:</label>&nbsp;<input name="fromdate" style="width:130px; height:30px"  type="date"  />&nbsp;
			<label style="font-size:15px">To:</label>&nbsp;<input name="todate" style="width:130px; height:30px"  type="date"  />&nbsp;
			<label style="font-size:15px">Item:</label>&nbsp;<select name="item" style="width:100px; height:30px">
				<option> </option>
				<option value='Add'>Add</option>
				<option value='Withdraw'>Withdraw</option>
			</select>&nbsp;<br>
			<input name="method" value="<?php if(isset($_POST['method'])){echo $_POST['method'];} ?>" style="width:300px; height:30px"  type="text" placeholder="Enter a payment method" />&nbsp;
			<input name="search" value="<?php if(isset($_POST['search'])){echo $_POST['search'];} ?>" style="width:300px; height:30px"  type="text" placeholder="Enter a user account" />&nbsp;
			<input name="btnSearch" type="submit" class="btn btn-default" value="Search">

			</form>
		</tr>
		<p>
    <tr>
			<th><div align="center">User Account</div></th>
      <th><div align="center">Date</div></th>
      <th><div align="center">Time</div></th>
			<th><div align="center">Items</div></th>
			<th><div align="center">Method</div></th>
			<th><div align="center">Amount(RM)</div></th>
    </tr>
  </thead>
  <tbody>
		<?php
	  while($Row2 = mysql_fetch_array($Result2)) {
		 ?>
	    <tr>
				<td align="center"><?php echo $Row2['Email'] ?></td>
	      <td align="center"><?php echo $Row2['OperationDate'] ?></td>
				<td align="center"><?php echo $Row2['OperationTime'] ?></td>
				<td align="center"><?php echo $Row2['Items'] ?></td>
				<td align="center"><?php echo $Row2['Method'] ?></td>
				<td align="center"><?php
				if($Row2['Items']=='Withdraw'){
					$out += $Row2['Amount'];
			echo '('.number_format($Row2['Amount']).')';}
				else{
					$in += $Row2['Amount'];
					echo number_format($Row2['Amount']);
					 }
				} ?></td>
	    </tr>

		 </tbody>
	  </table>
<?php $_SESSION['in']+=$in;
			$_SESSION['out']+=$out;
 ?>
 <tr><td><label style="font-size:18px">Total In: RM&nbsp;</label> </td><td><label style="font-size:28px"><?php
 echo number_format($_SESSION['in']); ?></label> </td></tr>&nbsp;&nbsp;&nbsp;&nbsp;
 <tr><td><label style="font-size:18px">Total Out: RM&nbsp;</label> </td><td><label style="font-size:28px"><?php
 echo number_format($_SESSION['out']); ?></label> </td></tr>

</div>
</div>


</body>
</html>
