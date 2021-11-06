<?php
    $conn = mysqli_connect("localhost", "root", "", "exam");
    
    if($conn === false){
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }

    $data = $_POST;
    $count =  count($_POST['ques']);

    // fetching t_id and fId from last page
    session_start();
    $t_id = $_SESSION['t_id'];
    $fId = $_SESSION['fId'];

    // inserting data into database
    for($i = 0; $i<$count ; $i++) {
         $sql = "INSERT INTO question (question, a, b, c, d, answer, marks, t_id)  
                VALUES ('{$_POST['ques'][$i]}','{$_POST['a'][$i]}','{$_POST['b'][$i]}','{$_POST['c'][$i]}','{$_POST['d'][$i]}','{$_POST['ans'][$i]}','{$_POST['marks'][$i]}', '$t_id')";

        if(mysqli_query($conn, $sql)){
                $_SESSION['t_id'] = $t_id; // sending t_id to next page
                $_SESSION['fId'] = $fId;   // sending fId to next page
                header('Location:faculty_test_map_insert.php');
        } 
        else {
            echo "Data not saved. Try Again"; 
        }
    }
    mysqli_close($conn);   
?>