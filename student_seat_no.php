<?php
    $conn = mysqli_connect("localhost", "root", "", "exam");
    
    if($conn === false){
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }

    // fetching sId from last page through session
    session_start();
    $s_id = $_SESSION['s_id'];

    $seat_no = $_POST['seat_no'];
    $t_id = $_POST['t_id'];
  

    // $_SESSION['s_id'] = $s_id; 

    // echo "Student id: $s_id <br>Seat no:  $seat_no<br><br>T id:  $t_id<br><br>";

    $sql =  "UPDATE student_test_map SET seat_no='$seat_no' WHERE s_id='$s_id' AND t_id='$t_id'";

    mysqli_query($conn, $sql);
    
    mysqli_close($conn);  
    
    echo $s_id;
?>