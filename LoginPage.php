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
	 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log In</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>
<?php
	if($_POST['btnLogin'])
	{
		//Check default user
		 $SQL = "SELECT * FROM tbllogin WHERE Email = '".trim($_POST['txtEmail'])."' AND Password = '".md5(trim($_POST['txtPassword']))."' AND Status = 'A'";
		$Result = mysql_query($SQL,$Link);

		$SQL3 = "SELECT * FROM tblwallet WHERE Email = '".trim($_POST['txtEmail'])."'";
		$Result3 = mysql_query($SQL3, $Link);
		$Row3 = mysql_fetch_array($Result3);
		$_SESSION['Balance'] = $Row3['Balance'];

		if(mysql_num_rows($Result) > 0)
		{
		//Read
			$Row = mysql_fetch_array($Result);
			$_SESSION['Email'] = $Row['Email'];
			$_SESSION['Name'] = $Row['Name'];
			$_SESSION['AccType'] = $Row['AccType'];
			$_SESSION['LoginStatus'] = true;
			if($_SESSION['AccType'] == "SYS_ADMIN")
			{
				echo "<script>location = 'HomePageA.php?user=administrator';</script>";
			}
		else if($_SESSION['AccType'] == "GUEST")
			{
				echo "<script>location = 'HomePageG.php?user=".$Row['Name']."';</script>";
				$_SESSION['Email'] = $Row['Email'];
				$_SESSION['Name'] = $Row['Name'];
			}
			else if($_SESSION['AccType'] == "HOST")
			{
				echo "<script>location = 'HomePage.php?user=".$Row['Name']."';</script>";
				$_SESSION['Email'] = $Row['Email'];
				$_SESSION['Name'] = $Row['Name'];
			}
		}
		else
		{
			echo "<script>alert('Invalid Login. Please try again'); </script>";
		}

	}
?>
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

	<div class="panel panel-default" >
    	<div class="panel-body" >
        <div style="padding: 10px 380px 10px;">
<form action="" method="post" >
    <label style="font-size:36px; font-weight:bold">
      Log in
    </label>
    <div class="input-group">
			<span class="input-group-addon">E-mail</span>
			<input name="txtEmail" type="text" class="form-control" align="center" style="width:300px; height:30px">
	</div>
    <br>
	<div class="input-group">
			<span class="input-group-addon">Password</span>
			<input name="txtPassword" type="password" class="form-control" align="center" style="width:278px; height:30px">
	</div><br>
    <input name="btnLogin" type="submit" class="btn btn-default" value="Log in"><br><br>
    <a href="ResetPass.php" style="font-size:16px; color:#E57066">Forgot password?</a><br>
	<label style="font-size:16px">Don’t have an account? </label><a href="SignupPage.php" style="color:#E57066; font-size:23px">Sign up</a>
</form>
<div style="padding: 100px 100px 100px;">
		</div>
	</div>
</div></div>
</body>
</html>
