<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if($_SESSION['SESS_MEMBER_ID']!='administrator') {
		header("location: access-denied.php");
		exit();
	}
?>
<html>
<head>
<title>ISTE|upload files</title>
<link href="stylee.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<div id="google_sign_in">
					<h2>Upload file</h2>
				</div>
				<div id="username_div">
					<form method="post" enctype="multipart/form-data" action="upload.php">
						<strong>Your Name</strong><br/>
						<input type="username" name="username" id="userid" value="" /><br/><br/>
						<input type="file" name="myFile"/><br/><br/>
						<input type="submit" id="google_submit" value="Upload" />
					</form>
					<a href="logout.php">Logout</a>
				</div>
</body>
</html>