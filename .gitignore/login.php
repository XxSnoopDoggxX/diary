<?php 

	if($_POST["logout"]){
		header('Location:diary.php');
	}

		echo 'Logged In';



?>


<form method='post'>
	
	<input type='submit' name='logout' value="Log Out">

</form>
