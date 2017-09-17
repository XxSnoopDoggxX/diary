<?php 

	session_start();

	if($_SESSION['email']){

		echo "You have logged in as ".$_SESSION['email'];
	}
	else{

		header("Location: index.php");
	}
 
?>