<?php
	session_start();
	include("database.php");
	error_reporting(0);
	$_SESSION['LoginStatus'] = false;
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Boogie9 B&B Online Booking</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container" align="center">
	<nav class="navbar navbar-default" role="navigation">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand"  href="index.php">Boogie9</a>
	    </div>
	  	  <ul class="nav navbar-nav navbar-right">
	      	<li><a href="SignupPage.php"><span class="glyphicon glyphicon-user"></span> Signup</a></li>
	      	<li><a href="LoginPage.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
	  	  </ul>
	  </div>
	</nav>
</div>
<?php
 $SQL = "SELECT * FROM tblhouseinfo";

if(isset($_POST['btnSearch']))
{
	$searchinfo = mysql_escape_string($_POST['search']);
	 $SQL .= " WHERE City LIKE '%$searchinfo%'";
}
$Result1 = mysql_query($SQL, $Link);
$count = mysql_num_rows($Result1);
if($count == 0)
	{
		?>
			<div style="padding: 10px 188px 10px;">
					<div id="myAlert" class="alert alert-warning" >
			<a class="close" data-dismiss="alert">&times;</a>
			<strong>Sorry </strong>There was no such results.
					</div>
			</div>
		<?php
	}
?>

<form method="POST" action="">
	<div align = "center">
<input name="search" style="width:1050px; height:33px"  type="text" placeholder="What is your destination city?" />
<input name="btnSearch" type="submit" class="btn btn-default" value="Search">
</div>
</form>

<div style="padding: 10px 190px 1000px;">
  <table >
    <tr>
<?php for($i = 0; $i<mysql_num_rows($Result1);$i++)
{
    $Row = mysql_fetch_array($Result1);
    if($i % 3 ==0)
    {echo "<tr>";}
?>
    <td style="padding:0 15px 0 15px;" <?php
		$_SESSION['housename']=$Row['HouseName'];

		echo "onClick=\"location='info.php?housename=".$_SESSION['housename']."'\"";
		?>>

<div class="panel panel-default" style="width:335px; height:360px">
	<div class="panel-body">
		<?php echo "<img src='images/".$Row['Email']."/".$Row['LodgingId']."/".$Row['pic']."' class='img-thumbnail' >" ?>
	</div>
    <div class="panel-body">
      <label style="font-size:20px; font-weight:bold"><?php echo $Row['Type2']." · ".$Row['City']; ?></label><br>
      <label style="font-size:26px; font-weight:bold"><?php echo $Row['HouseName']; ?></label><br>
      <label style="font-size:16px; "><?php echo $Row['Price'] . " RM per night"; ?></label>
    </div>
</div>
</td>
<?php } ?>

</tr>
</table>
</div>

</body>
</html>
