<?php
	$conn = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$query = "SELECT f_password FROM faculty WHERE f_email = '$email'";
	$result = mysqli_query($conn,$query);
	
    if(mysqli_num_rows($result) == 0)
    {
        echo "<h1><center>Login failed. Invalid email or password.</center></h1>";  
	} 

    else 
    {
		$databasePassword = mysqli_fetch_assoc($result)["f_password"];
		
		if($password != $databasePassword) 
   		{
        	echo "<h1><center>Invalid Password.</center></h1>";  
		}
		else
        {	
			$selectQuery = "SELECT f_id FROM faculty WHERE f_email = '$email' AND f_password = '$password'";
			$selectResult = mysqli_query($conn,$selectQuery);
			$fId = mysqli_fetch_assoc($selectResult)["f_id"];

			session_start();
			$_SESSION['fId'] = $fId;


			header('Location:faculty-home.php');	
        }
	}
?>