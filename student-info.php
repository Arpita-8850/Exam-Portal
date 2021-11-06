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
        $fId = $_SESSION['fId'];

        $_SESSION['fId'] = $fId; 
                
        $sql = "SELECT f_fname, f_lname FROM faculty WHERE f_id='$fId'";
        $selectResult = mysqli_query($conn,$sql);
		
        $studentDetails = mysqli_fetch_assoc($selectResult);  
        $fName = $studentDetails["f_fname"];
        $flName = $studentDetails["f_lname"];
    ?>

    <div class="ExamPortal">ExamPortal</div>

    <div class="Frame1">
        <a class="name"><?php echo " Welcome {$fName} {$flName}!"; ?></a>
        <a href="faculty-home.php" class='passive'>HOME</a>
        <a href="student-info.php" class='active'>STUDENTS</a>
        <a href="attendence.php" class='passive'>ATTENDENCE</a>
        <a href="addTest.php" class='passive'>ADD TEST</a>
        <a href="login.php" class='logout' id='logout'>LOGOUT</a>
    </div>

    <br><br> <br><br> <br><br> <br><br> 
    <center>
        <div class="table-responsive" data-aos="fade-up"  data-aos-once= "true">
            <table class="table table-hover table-striped"  style="width: 80%;  font-size: 23px;" >
                <thead style="background-color: #2765C1; color: white; font-size: 26px; ">
                    <tr>
                        <th>Student name</th>
                        <th>Gender</th>
                        <th>Phone number</th>
                        <th>Date of birth</th>
                        <th>Email id</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $db = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
                        $records = mysqli_query($db,"SELECT DISTINCT s.* FROM student s, faculty_test_map ftm, student_test_map stm WHERE ftm.f_id='$fId' AND stm.t_id= ftm.t_id AND stm.s_id=s.s_id"); // fetch data from database
                        while($data = mysqli_fetch_array($records))
                        {
                    ?>
                    <tr>
                        <td><?php echo $data['s_fname']; ?></td>
                        <td><?php echo $data['s_gender']; ?></td>
                        <td><?php echo $data['s_phone']; ?></td> 
                        <td><?php echo $data['s_dob']; ?></td> 
                        <td><?php echo $data['s_email']; ?></td> 
                        <td><a href="student_test_info.php?s_id=<?php echo $data['s_id']; ?>"><input type='submit' style="width: 80%;" value='View More' id='attendence'></a></td>
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