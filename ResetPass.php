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
	<title>Reset Password</title>
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.bootcss.com/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
  <?php
	if($_POST['btnSend'])
	{
		require 'PHPMailer-master/src/Exception.php';
		require 'PHPMailer-master/src/PHPMailer.php';
		require 'PHPMailer-master/src/SMTP.php';
		$_SESSION['code'] = rand(1000,9999);
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		$mail->Host ="smtp.gmail.com";
		$mail->Port=587;
		$mail->charSet = "big5";
		$mail->Username = "boogie9ob@gmail.com";
		$mail->Password = "q19961105";
		$mail->setFrom('boogie9ob@gmail.com', 'Boogie9 Online Booking');
		$mail->Subject = "This is your verification code.";
		$mail->Body = $_SESSION['code'];
		$mail->IsHTML(true);
		$mail->addAddress(trim($_POST['Email']));
		if($mail->send())
 		{?>
	<div style="padding: 10px 188px 10px;">
			<div id="myAlert" class="alert alert-success" >
	<a href="#" class="close" data-dismiss="alert">&times;</a>
	<strong>Successfully! </strong>Verification code has been sent
			</div>
	</div>
<?php
		}
		else {?>
			<div style="padding: 10px 188px 10px;">
					<div id="myAlert" class="alert alert-warning" >
			<a class="close" data-dismiss="alert">&times;</a>
			<strong>Error </strong>Verification code could not be sent.
					</div>
			</div>
				<?php
			}
	}
	?>

  <?php
  if($_POST['btnReset'])
  {
    if(trim($_POST['Pass']) != trim($_POST['Pass1']))
		{
			?>
				<div style="padding: 10px 188px 10px;">
						<div id="myAlert" class="alert alert-warning" >
				<a class="close" data-dismiss="alert">&times;</a>
				<strong>Error </strong>Password confirm failed.
						</div>
				</div>
					<?php
		}
		else if(trim($_POST['Email'])== "" ||trim($_POST['code'])== "" || trim($_POST['Pass']) == "" )
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
		else if ($_POST['code'] != $_SESSION['code'])
		 {
			 ?>
				 <div style="padding: 10px 188px 10px;">
						 <div id="myAlert" class="alert alert-warning" >
				 <a class="close" data-dismiss="alert">&times;</a>
				 <strong>Sorry </strong>Verification failed. Please check your verification code.
						 </div>
				 </div>
					 <?php
		}
    else
    {
     $SQL = "SELECT * FROM tbllogin WHERE Email = '".trim($_POST['Email'])."'";
    $Result = mysql_query($SQL,$Link);
    if(mysql_num_rows($Result) > 0)
		{
        $SQL2 = "UPDATE tbllogin SET Password = '".md5(trim($_POST['Pass']))."' WHERE Email = '".trim($_POST['Email'])."' ";
        $Result2 = mysql_query($SQL2, $Link);
      if( $Result2)
			{
				echo "<script>alert('Reset password Successfully...');</script>";
        session_destroy();
				echo "<script>location = 'LoginPage.php';</script>";
			}
      else{?>
        <div style="padding: 10px 188px 10px;">
            <div id="myAlert" class="alert alert-warning" >
        <a class="close" data-dismiss="alert">&times;</a>
        <strong>Error </strong>Reset password failed.
            </div>
        </div>
          <?php
           }
		}
		else
		{
      ?>
        <div style="padding: 10px 188px 10px;">
            <div id="myAlert" class="alert alert-warning" >
        <a class="close" data-dismiss="alert">&times;</a>
        <strong>Sorry </strong>There is no such account found. Please check again.
            </div>
        </div>
          <?php
		}
    }
  }

  ?>
  <div class="container" align="center">

  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="LoginPage.php">Boogie9</a>
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

      <tr>
        <td><form action="" method="post"><table width="100%" border="0">
    <tr>
      <td align="center"> <label style="font-size:36px; font-weight:bold">
        Reset Password
      </label>
        </td>
    </tr>
    <tr>
      <td ><label style="font-size:18px">E-Mail</label><br><input name="Email" style="width:300px; height:30px"  type="text" value="<?php if(isset($_POST['Email'])){echo $_POST['Email'];} ?>" /><br><br>
      <input name="btnSend" type="submit" class="btn btn-default" value="Send Verification Code" />    <br><br>
    </tr>
    <tr>
      <td ><label style="font-size:18px">Verification Code</label><br><input name="code" style="width:300px; height:30px"  type="number"  value="" /><br><br></td>
    </tr>
    <tr>
      <td ><label style="font-size:18px">Set New Password </label><br><input name="Pass" style="width:300px; height:30px"  type="password" value="" /><br><br></td>
    </tr>
    <tr>
      <td ><label style="font-size:18px">Confirm Password </label><br><input name="Pass1" style="width:300px; height:30px"  type="password" value="" /><br><br></td>
    </tr>

    <tr>
      <td align="center" ><input name="btnReset" type="submit" class="btn btn-default" value="Reset"></td>
    </tr>

  </table>


  </form>
  </div></div>
</div></div>
</body>
</html>
