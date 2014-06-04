<?php

require_once('config.php');

//Array to store validation errors
	$errmsg_arr = array();
	
	//Validation error flag
	$errflag = false;
	
	//Function to sanitize values received from the form. Prevents SQL injection
	function clean($str) {
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return mysql_real_escape_string($str);
	}
	function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
// table name 
$tbl_name=temp_members_db;

// Random confirmation code 
$confirm_code=md5(uniqid(rand())); 

// values sent from form 
$name=$_POST['name'];
$email=$_POST['email'];
$phnumber=$_POST['phnumber'];
$password=$_POST['password'];

//Sanitize the POST values
	$name = clean($_POST['name']);
	$email = clean($_POST['email']);
	$phnumber = clean($_POST['phnumber']);
	$password = clean($_POST['password']);
	
//Input Validations
	if($name == '') {
		died('You cannot have an empty username. Please choose a username');
	}
	
	$arr = explode('@', $email);
if ($arr[1] != 'nitc.ac.in')
{
    died('please enter a valid nitc email id');
}
	if(!preg_match("/^[0-9]{10}$/", $phnumber)) {
	died('Please enter a valid 10 digit mobile number');
		
}
	if($password == '') {
	died('Please choose a Password');
		
	}
//Check for duplicate login ID
	if($name != '') {
		$qry = "SELECT * FROM registered_members WHERE username='$name'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'Login ID already in use';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	if($email != '') {
		$qry = "SELECT * FROM registered_members WHERE email='$email'";
		$result = mysql_query($qry);
		if($result) {
			if(mysql_num_rows($result) > 0) {
				$errmsg_arr[] = 'The email id is already registered... Please use that';
				$errflag = true;
			}
			@mysql_free_result($result);
		}
		else {
			die("Query failed");
		}
	}
	
	//If there are input validations, redirect back to the registration form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: signup.php");
		exit();
	}	

// Insert data into database 
$sql="INSERT INTO $tbl_name(confirm_code, username, password, email, phnumber)VALUES('$confirm_code', '$name', '$password', '$email', '$phnumber')";
$result=mysql_query($sql);

// if suceesfully inserted data into database, send confirmation link to email 
if($result){
// ---------------- SEND MAIL FORM ----------------

// send e-mail to ...
$to=$email;

// Your subject
$subject="Your confirmation link here";

// From
$header="from: ISTE Booksforum <istebookforum@gmail.com>";

// Your message
$message="Your Comfirmation link \r\n";
$message.="Click on this link to activate your account \r\n";
$message.="http://esharing.istenitc.org/confirmation.php?passkey=$confirm_code";

// send email
$sentmail = mail($to,$subject,$message,$header);
}

// if not found 
else {
echo "Not found your email in our database";
}

// if your email succesfully sent
if($sentmail){
echo "Your Confirmation link Has Been Sent To Your Email Address.";
}
else {
echo "Cannot send Confirmation link to your e-mail address";
}
?>