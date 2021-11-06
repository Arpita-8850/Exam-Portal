<?php
    $conn = mysqli_connect("localhost", "root", "", "exam");
    
    if($conn === false){
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }

    // fetching fId from last page
    session_start();
    $fId = $_SESSION['fId'];

    $t_id = $_POST['t_id'];
    $tname = $_POST['tname'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $tmarks = $_POST['tmarks'];


    // inserting data into database
    $updateQuery = "UPDATE test 
                    SET 
                        t_name='$tname',
                        time='$time', 
                        date='$date', 
                        total_marks='$tmarks'
                    WHERE
                        t_id='$t_id'";

    if(mysqli_query($conn, $updateQuery)) {
        $queryResult = 'success';

    } else {
        $queryResult = 'fail';
    }

    echo $queryResult;
    mysqli_close($conn);   
?>