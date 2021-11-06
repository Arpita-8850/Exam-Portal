<?php
    $conn = mysqli_connect("localhost", "root", "", "exam");
    
    if($conn === false){
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }

    // fetching fId from last page
    session_start();
    $fId = $_SESSION['fId'];

    $quesId = $_POST['quesId'];
    $question = $_POST['question'];
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $d = $_POST['d'];
    $answer = $_POST['answer'];
    $marks = $_POST['marks'];
    $t_id = $_POST['t_id'];

    // inserting data into database
    $updateQuery = "UPDATE question 
                    SET 
                        question='$question',
                        a='$a', 
                        b='$b', 
                        c='$c', 
                        d='$d',
                        answer='$answer',
                        marks='$marks'
                    WHERE
                        q_id='$quesId'";

    if(mysqli_query($conn, $updateQuery)) {
        $queryResult = 'success';

    } else {
        $queryResult = 'fail';
    }

    echo $queryResult;
    mysqli_close($conn);   
?>