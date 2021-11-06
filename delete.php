<?php

$db = mysqli_connect("localhost","root","","exam");

if(!$db)
{
    die("Connection failed: " . mysqli_connect_error());
}
$id = $_GET['t_id']; // get id through query string

$del = mysqli_query($db,"delete from test where t_id = '$id'"); // delete query

if($del)
{
    mysqli_close($db); // Close connection
    header("location:faculty-home.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>