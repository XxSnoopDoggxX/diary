<?php

	session_start();

	if((array_key_exists('email', $_POST)) OR (array_key_exists('email', $_POST)) ){

		$link = mysqli_connect('shareddb1a.hosting.stackcp.net', 'cl18-users-skf', 'pokefire1', 'cl18-users-skf');

		if(mysqli_connect_error())
		{
			die("Connection Failed");
		}

		if($_POST['email'] == ''){
			echo "<p>Email is required</p>";
		}

		else if($_POST['password'] == ''){
			echo "<p>Password is required</p>";
		}
		else{
			
			$query = "SELECT `id` FROM `Users` WHERE email = '".mysqli_real_escape_string($link,$_POST['email'])."'";

			$result = mysqli_query($link,$query);

			if(mysqli_num_rows($result)>0){
				echo "<p>Email has been taken</p>";
			}
			else{

				$query = "INSERT INTO `Users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";

				if(mysqli_query($link,$query)){

					$_SESSION['email'] = $_POST['email'];

					header("Location: session.php");
				}
				else{

					echo"Failed";
				}
			}
		}
	}
?>

<form method = 'post'>
	<input name='email' type='text' placeholder='Email Address'>
	<input name='password' type='password' placeholder='Password'>
	<input type='submit' value='Sign Up'>
</form>
