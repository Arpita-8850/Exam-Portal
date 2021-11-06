<!DOCTYPE html>
<html>
<head>
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body>

    <?php
        $conn = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
        session_start();
        $sId = $_SESSION['sId'];
                
        $sql = "SELECT s_fname, s_lname FROM student WHERE s_id='$sId'";
        $selectResult = mysqli_query($conn,$sql);
		
        $studentDetails = mysqli_fetch_assoc($selectResult);  // retrieving single row returned by query in studentDetails
        // retrieving s_fname and s_lname from studentDetails
        $sName = $studentDetails["s_fname"];
        $slName = $studentDetails["s_lname"];
    ?>

    <div class="ExamPortal">ExamPortal</div>

    <div class="Frame1">
        <a href="student-home.php" class='passive'>HOME</a>
        <a href="student-history.php" class='active'>HISTORY</a>
        <a class="name"><?php echo " Welcome {$sName} {$slName} !"; ?></a>
        <a href="login.php" class='logout'>LOGOUT</a>
        
    </div>
    
    <br><br> <br><br> <br><br> <br><br> 
    <center>
        <div class="table-responsive" data-aos="fade-up"  data-aos-once= "true">
            <table class="table table-hover table-striped"  style="width: 80%;  font-size: 23px;" >
                <thead style="background-color: #2765C1; color: white; font-size: 26px; ">
                    <tr>
                        <th>Exam name</th>
                        <th>Date</th>
                        <th>Total Marks</th>
                        <th>Marks Scored</th>
                        <th>Pass / Fail</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                        $db = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
                        $records = mysqli_query($db," SELECT t.*, stm.* FROM test t, student_test_map stm WHERE stm.s_id= '$sId' AND t.t_id= stm.t_id AND stm.attendence IS NOT NULL"); // fetch data from database
                        while($data = mysqli_fetch_array($records))
                        {
                        ?>

                        <tr>
                            <td><?php echo $data['t_name']; ?></td>
                            <td><?php echo $data['date']; ?></td>
                            <td><?php echo $data['total_marks']; ?></td> 
                            <td><?php echo $data['marks_scored']; ?></td>
                            <td><?php echo $data['pass_fail']; ?></td>  
                            <td><a href="student-report.php?t_id=<?php echo $data['t_id']; ?>" target="_blank"><input type='submit' value='Report' id='report'></a></td>
                        </tr>	
                        <?php
                            }
                        ?>
                </tbody>
            </table>
        </div>
    </center>

    <script>
        AOS.init({
        duration: 1500,
        })
    </script>
</body>
</html>