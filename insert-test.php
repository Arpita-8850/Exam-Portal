
<?php
    $conn = mysqli_connect("localhost", "root", "", "exam");
    
    if($conn === false){
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }

    $tname = $_POST['tname'];
    $tdate = $_POST['tdate'];
    $time = $_POST['time'];
    $mcq = $_POST['mcq'];
    $marks = $_POST['marks'];
    
    $sql = "INSERT INTO test(t_name, date, time, total_marks, total_ques) 
            VALUES ('$tname','$tdate', '$time', '$marks','$mcq')";
    
    if(mysqli_query($conn, $sql)){
        session_start();
			$_SESSION['mcq'] = $mcq;
            $_SESSION['tname'] = $tname;
            header('Location:add-question.php');
    } 

    else {
        $target = "addTest.php";
        $linkname = "mylink";
        echo "Data not saved. Try Again"; 
        link($target, $linkname);
    }
 
    mysqli_close($conn);   
?>