<?php
	//Start session
	session_start();
	
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
		return $str;
	}
	
	//Sanitize the POST values
	$name = clean($_POST['name']);
	$password = clean($_POST['password']);
	
	//Input Validations
	if($name == '') {
		$errmsg_arr[] = 'Login ID missing';
		$errflag = true;
	}
	if($password == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	
	//If there are input validations, redirect back to the login form
	if($errflag) {
		$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
		session_write_close();
		header("location: index.html");
		exit();
	}
	
	//Check whether the query was successful or not
	if($name=='admin' && $password='istenitc@admin99') 
		{
			//Login Successful
			session_regenerate_id();
			$_SESSION['SESS_MEMBER_ID'] = 'administrator';
			session_write_close();
			header("location: index2.php");
			exit();
		}else {
			//Login failed
			header("location: login-failed.php");
			exit();
		}
?>