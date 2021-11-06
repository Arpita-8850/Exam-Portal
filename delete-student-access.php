<?php

    $db = mysqli_connect("localhost","root","","exam");

    if(!$db)
    {
        die("Connection failed: " . mysqli_connect_error());
    }

    session_start();
    $s_id = $_SESSION['s_id'];

    $t_id = $_GET['t_id']; // get id through query string

    // echo "$t_id<br>$s_id";

    $del = mysqli_query($db,"DELETE FROM student_test_map WHERE t_id = '$t_id' AND s_id='$s_id'"); // delete query
    
    mysqli_query($db, $del);
    
    mysqli_close($db);  

    // echo $s_id;
    header("location:student_test_info.php?s_id=".$s_id.""); 
    // header("Location: <a href='student_test_info.php'></a>");
   
?>