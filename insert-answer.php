<?php
    $conn = mysqli_connect("localhost", "root", "", "exam");
    
    if($conn === false){
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }

    // fetching sId and t_id  from last page through session
    session_start();
    $s_id = $_SESSION['sId'];
    $t_id = $_SESSION['t_id'];

    // fetching q_id, student answer and correct answer from last page through POST
    $sans = $_POST['ans'];
    $q_id = $_POST['q_id'];
    $cans = $_POST['cans'];

    // sending s_id t_id and q_id to next page through session
    $_SESSION['s_id'] = $s_id;
    $_SESSION['t_id'] = $t_id;
    $_SESSION['q_id'] = $q_id;
    // $_POST['q_id'] = $q_id;


    // echo "Student id: $s_id <br>Test Id:  $t_id<br>Question id: {$q_id}<br>Student answer: {$sans}<br>Correct Answer: {$cans}<br><br>";

    $sql = "INSERT INTO student_answer(t_id, q_id, answer, sans, s_id) VALUES ('$t_id','$q_id', '$cans', '$sans', '$s_id')";

    mysqli_query($conn, $sql);

    mysqli_close($conn);   
?>