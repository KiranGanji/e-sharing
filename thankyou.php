<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if($_SESSION['SESS_MEMBER_ID']!='administrator') {
		header("location: access-denied.php");
		exit();
	}
?>
thank you for the contribution.<br/>Want to upload more <a href="index2.php">Click here</a> <br/>
Want to logout <a href="logout.php">Click here</a>