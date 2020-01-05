<?php

	$dbUsername = "username";
	$dbPass = "password";
	$host = "localhost";
	$dbName = "dbboogie";
	$TableList = array(
	"CREATE TABLE tbllogin(

		Email VARCHAR(40) PRIMARY KEY,
		Name VARCHAR(50),
		Password VARCHAR(32),
		AccType VARCHAR(10),
		Status CHAR(1)    )",
"CREATE TABLE tblcashflow(
		TransactionID  VARCHAR(40) PRIMARY KEY,
		Email VARCHAR(40),
		OperationDate DATE,
		OperationTime TIME,
		Items VARCHAR(40),
	  Method VARCHAR(10),
		Amount INT(10)
		  )",
"CREATE TABLE tblimg(
		HouseID  VARCHAR(40) PRIMARY KEY,
		Image1	VARCHAR(10),
		Image2	VARCHAR(10),
		Image3	VARCHAR(10),
		Image4	VARCHAR(10),
		Image5	VARCHAR(10),
		Image6	VARCHAR(10),
		Image7	VARCHAR(10),
		Image8	VARCHAR(10)
	)",
"CREATE TABLE tblbook(
		TransactionID  VARCHAR(40) PRIMARY KEY,
		HouseId VARCHAR(40),
		HouseName VARCHAR(40),
		HostEmail VARCHAR(40),
		GuestEmail VARCHAR(40),
		GuestName VARCHAR(40),
		BookingDate DATE,
		BookingTime TIME,
		InDate DATE,
		OutDate DATE,
		Stay INT(3),
		ServiceFee INT(9),
		Pay INT(9),
		Status VARCHAR(40))",
"CREATE TABLE tblwallet(
		Email VARCHAR(40) PRIMARY KEY,
		Balance INT(10)
			)",



"CREATE TABLE tbluserinfo(
	Email VARCHAR(40) PRIMARY KEY,
	AccountType VARCHAR(6),
	FirstName VARCHAR(50),
	LastName VARCHAR(50),
	Gender VARCHAR(10),
	DOB DATE,
	PhoneNumber1 VARCHAR(50),
	PhoneNumber2 VARCHAR(50),
	Rate FLOAT(2),
	Address VARCHAR(500)
)",
"CREATE TABLE tblratehouse(
	TransactionID VARCHAR(40) PRIMARY KEY,
	HouseNo VARCHAR(40),
	HouseName VARCHAR(40),
	GuestEmail VARCHAR(40),
	GuestName VARCHAR(40),
	Accuracy INT(2),
	Location INT(2),
	Communication	INT(2),
	CheckIn	INT(2),
	Cleanliness	INT(2),
	Value INT(2),
  Average FLOAT(2),
	Review VARCHAR(500)
)",
"CREATE TABLE tblrateguest(
	TransactionID VARCHAR(40) PRIMARY KEY,
	GuestEmail VARCHAR(40),
	GuestName VARCHAR(40),
	HostEmail VARCHAR(40),
	HostName VARCHAR(40),
	Friendly INT(2),
	Punctual INT(2),
	Noise	INT(2),
	Treasure	INT(2),
	Cleanliness	INT(2),
	Saving INT(2),
  Average FLOAT(2)
)",
	"CREATE TABLE tblhouseinfo(
		LodgingId VARCHAR(20) PRIMARY KEY,
		Email VARCHAR(40),
		HostName VARCHAR(50),
		HouseName VARCHAR(30),
		Summary VARCHAR(500),

		Type VARCHAR(30),
		Type2 VARCHAR(30),
		Dedicated CHAR(1),

		Accommodate VARCHAR(3),
		Bedrooms VARCHAR(3),
		Beds VARCHAR(3),
		Bathrooms VARCHAR(3),

		City VARCHAR(50),
		LocationDescribe VARCHAR(100),

		Essentials CHAR(1),
		Wifi CHAR(1),
		Toilet CHAR(1),
		Closet CHAR(1),
		TV CHAR(1),
		Heater CHAR(1),
		AC CHAR(1),
		Breakfast CHAR(1),
		Desk CHAR(1),
		Fireplace CHAR(1),
		Iron CHAR(1),
		HairDryer CHAR(1),

		Pool CHAR(1),
		Kitchen CHAR(1),
		LaundryWasher CHAR(1),
		LaundryDryer CHAR(1),
		Parking CHAR(1),
		Elevator CHAR(1),
		Hot CHAR(1),
		Gym CHAR(1),

		ForChildren CHAR(1),
		ForInfant CHAR(1),
		Forpet CHAR(1),
		Smoking CHAR(1),
		Event CHAR(1),

		Stairs CHAR(1),
		Noise CHAR(1),
		Pet CHAR(1),
		Surveillance CHAR(1),
		NoParking CHAR(1),
		Weapons CHAR(1),

		AdvanceBook VARCHAR(50),
		StayMin VARCHAR(30),
		StayMax VARCHAR(30),

		Price INT(7),
		pic VARCHAR(500),
		Income INT(9)
		)");

	$Link = mysql_connect($host, $dbUsername, $dbPass) or die(mysql_error());

	if($Link)
	{
		if(!mysql_select_db($dbName, $Link))
		{
			$SQL = "CREATE DATABASE ". $dbName;
			mysql_query($SQL,$Link);
		}
		mysql_select_db($dbName, $Link);
		//Create Table
		for($i = 0; $i<count($TableList);++$i)
		{
		//	echo $TableList[$i];
			mysql_query($TableList[$i], $Link);
		}
		//Check default user
		 $SQL = "SELECT * FROM tbllogin WHERE Email = 'admin@pass.com' AND Password = '".md5("pass")."' AND Status = 'A'";
		$Result = mysql_query($SQL,$Link);
		if(mysql_num_rows($Result) == 0)
		{
			$SQL = "INSERT INTO tbllogin(Email, Name, Password, AccType, Status) VALUES('admin@pass.com','ADMIN','".md5('pass')."','SYS_ADMIN','A')";
			$Result = mysql_query($SQL, $Link);

			$SQL3 = "INSERT INTO tbllogin(Email, Name, Password, AccType, Status) VALUES('admin@income.com','ADMIN','".md5('pass')."','SYS_ADMIN','A')";
			$Result3 = mysql_query($SQL3, $Link);

			$SQL2 = "INSERT INTO tblwallet(Email, Balance) VALUES('admin@income.com','0')";
			$Result2 = mysql_query($SQL2, $Link);

			$SQL4 = "INSERT INTO tblwallet(Email, Balance) VALUES('admin@pass.com','0')";
			$Result4 = mysql_query($SQL4, $Link);
		//Read
		/*	$Row = mysql_fetch_array($Result);
			$_SESSION['Username'] = $Row['Username'];
			$_SESSION['UserId'] = $Row['StudId'];
			$_SESSION['AccType'] = $Row['AccType'];   */
		}

	}
	else
	{

	}


?>
