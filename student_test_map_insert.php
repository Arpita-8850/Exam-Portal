<?php
    $conn = mysqli_connect("localhost", "root", "", "exam");
    
    if($conn === false){
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }

    // fetching sId from last page through session
    session_start();
    $t_id = $_SESSION['t_id'];
    $s_id = $_POST['s_id'];

    echo "Student id: $s_id <br>Test Id:  $t_id<br><br>";

    $sql = "INSERT INTO student_test_map(s_id,t_id) VALUES ('$s_id','$t_id')";

    mysqli_query($conn, $sql);
    
    mysqli_close($conn);   
?>