<?php

	if((array_key_exists('email', $_POST))OR(array_key_exists('password', $_POST))){

		$link= mysqli_connect('shareddb1a.hosting.stackcp.net', 'cl18-users-skf', 			'pokefire1', 'cl18-users-skf');

		if(mysqli_connect_error()){
			die('Connection Failed');
		}

		$error = '';

				if($error == ''){
			header("Location:login.php");
		}
		else{
			echo "$error";
		}

		if($_POST['stay']){
			setcookie("customerId","123",time()+60*60*24);
		}

	    if($_POST['signUp']){

			if($_POST['signUpEmail'] == ''){
				$error = 'Please enter a valid email';
			}
			else if($_POST['signUpPassword'] == ''){
				$error = 'Please enter a valid password';
			}
			else{

				$query = 'SELECT `id` FROM `Users` WHERE `email`= 					"'.mysqli_real_escape_string($link,$_POST['signUpEmail']).'"';

				$result = mysqli_query($link,$query);

				if(mysqli_num_rows($result)>0){
					$error ='Email is taken';
				}
				else{

					$pass = password_hash($_POST["signUpPassword"],PASSWORD_DEFAULT);

					$query = "INSERT INTO `Users` (`email`, `password`) VALUES 						('".mysqli_real_escape_string($link,$_POST					['signUpEmail'])."','".mysqli_real_escape_string($link,$pass)."')";

					mysqli_query($link,$query);
				}
			}
		}

		else if($_POST['Logins']){

			if($_POST['email'] == ''){
				$error = 'Please enter your email';
			}
			else if($_POST['password'] == ''){
				$error = 'Please enter your password';
			}
			else{

				$query = 'SELECT `id` FROM `Users` WHERE `email`= 					"'.mysqli_real_escape_string($link,$_POST['email']).'"';

				$result = mysqli_query($link,$query);

				if(mysqli_num_rows($result) == 1){
					
					$query = 'SELECT `password` FROM `Users` WHERE `email`= 					"'.mysqli_real_escape_string($link,$_POST['email']).'"';

					$result = mysqli_query($link,$query);

					$val = implode('',mysqli_fetch_row($result));

					if(!password_verify($_POST['password'],$val)){
						$error = 'Password Incorrect';
					}
				}
				else{
					$error = 'Incorrect Email';
				}
			}
		}

	}
?>



<form method= 'POST'>

	<input name='email' type='text' placeholder='Email Address'>
	<input name='password' type='password' placeholder='Password'>
	<input type='submit' name='Logins' value="Login">

	<br>
	<br>

	<input name='signUpEmail' type='text' placeholder='Email Address'>
	<input name='signUpPassword' type='password' placeholder='Password'>
	<input type='submit' name='signUp' value="Sign Up">

	<br>
	<br>

	<p><input type="checkbox" name="stay">Stay Signed In</p>

</form>
