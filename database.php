<?php
	$conn = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	
	$query = "SELECT s_password FROM student WHERE s_email = '$email'";
	$result = mysqli_query($conn,$query);
	
    if(mysqli_num_rows($result) == 0)
    {
        echo "<h1><center>Login failed. Invalid email or password.</center></h1>";  
	} 

    else 
    {
		$databasePassword = mysqli_fetch_assoc($result)["s_password"];
		$verify = password_verify($password, $databasePassword);
		
		if($verify) 
   		{
        	$selectQuery = "SELECT s_id FROM student WHERE s_email = '$email' AND s_password = '$databasePassword'";
			$selectResult = mysqli_query($conn,$selectQuery);
			$sId = mysqli_fetch_assoc($selectResult)["s_id"];
			session_start();
			$_SESSION['sId'] = $sId;
			header('Location:student-home.php');				
		}
		else
        {	
			echo "<h1><center>Invalid Password.</center></h1>";  	
        }
	}
?>
