<!DOCTYPE html>
<html>
<head>
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body>
   
<?php
        $conn = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
        session_start();
        $t_id = $_GET['t_id'];
        $fId = $_SESSION['fId'];
                
        $sql = "SELECT f_fname, f_lname FROM faculty WHERE f_id='$fId'";
        $selectResult = mysqli_query($conn,$sql);
        $studentDetails = mysqli_fetch_assoc($selectResult);  
        $fName = $studentDetails["f_fname"];
        $flName = $studentDetails["f_lname"];


        $test_sql = "SELECT t_name FROM test WHERE t_id='$t_id'";
        $Result = mysqli_query($conn,$test_sql);
        $testName = mysqli_fetch_assoc($Result);  
        $tname = $testName["t_name"];

        $selectTestDetailsQuery = "SELECT DISTINCT t.t_name, s.*, stm.* FROM test t, student s, faculty_test_map ftm, student_test_map stm WHERE ftm.f_id='$fId' AND stm.t_id= $t_id AND t.t_id= $t_id AND stm.s_id=s.s_id";
        $data = mysqli_query($conn, $selectTestDetailsQuery);
        $total = mysqli_num_rows($data);
    ?>

    <div class="ExamPortal">ExamPortal</div>

    <div class="Frame1">
        <a class="name"><?php echo " Welcome {$fName} {$flName}!"; ?></a>
        <a href="faculty-home.php" class='passive'>HOME</a>
        <a href="student-info.php" class='passive'>STUDENTS</a>
        <a href="attendence.php" class='active'>ATTENDENCE</a>
        <a href="addTest.php" class='passive'>ADD TEST</a>
        <a href="login.php" class='logout' id='logout'>LOGOUT</a>
    </div>

    <br><br> <br><br> <br><br> <br><br> 


    <center>
    <h3 data-aos="fade-up"  data-aos-once= "true" id="test"><?php echo "{$tname}"; ?></h3>
    <br>

        <div class="table-responsive" data-aos="fade-up"  data-aos-once= "true">
            <table class="table table-hover table-striped"  style="width: 90%;  font-size: 23px;" >
                <thead style="background-color: #2765C1; color: white; font-size: 26px; ">
                    <tr>
                        <th>Student Name</th>
                        <th>Seat no.</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Pass/Fail</th>
                        <th>Marks Scored</th>
                        <th>Wrong Answers</th>
                        <th>Right Answers</th>
                        <th>Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                        
                        while($result = mysqli_fetch_assoc($data)) 
                        {
                            echo " <tr>
                            <td>".$result['s_fname']." ".$result['s_lname']."</td>
                            <td>".$result['seat_no']."</td>
                            <td>".$result['date']."</td>
                            <td>".$result['time']."</td>
                            <td>".$result['pass_fail']."</td>
                            <td>".$result['marks_scored']."</td>
                            <td>".$result['wrong_answer']."</td>
                            <td>".$result['right_answer']."</td>
                            <td>".$result['percentage']."%</td>
                            </tr> ";
                        }
                    ?>
                   
                </tbody>
            </table> 
        </div>
    </center>
    <br><br> <br>
    <script>
        AOS.init({
        duration: 1500,
        })
    </script>
</body>
</html>