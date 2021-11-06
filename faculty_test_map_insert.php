<?php
        $conn = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
        
        // fetching t_id and fId from last page
        session_start();
        $t_id = $_SESSION['t_id'];
        $fId = $_SESSION['fId'];
                
        $sql = "INSERT INTO faculty_test_map (f_id, t_id) VALUES ('$fId','$t_id')";   

        if(mysqli_query($conn, $sql)){
                header('Location:faculty-home.php');
        } 