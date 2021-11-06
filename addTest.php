<html>
<head>
    <link href="style.css" rel="stylesheet">
    <link href="test-style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@700&display=swap" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
        $conn = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
        session_start();
        $fId = $_SESSION['fId'];
                
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
        <a href="student-info.php" class='passive'>STUDENTS</a>
        <a href="attendence.php" class='passive'>ATTENDENCE</a>
        <a href="addTest.php" class='active'>ADD TEST</a>
        <a href="login.php" class='logout' id='logout'>LOGOUT</a>
    </div>

    <br><br> <br><br> <br><br> <br><br> <br><br> 

    <center>
        <form method="post" action="insert-test.php">
            <table>
                <tbody>
                    <tr>
                        <td><label>Test Name</label><br><br><br></td>
                        <td><input type="text" placeholder="Enter Test Name" id="tname" name="tname" required><br><br><br></td>
                    </tr>
                    <tr>
                        <td><label>Date</label><br><br><br></td>
                        <td><input type="date" id="tdate" name="tdate" required><br><br><br></td>
                    </tr>
                    <tr>
                        <td><label>Time Limit</label><br><br><br></td>
                        <td><input type="number" placeholder="Enter Time Limit in Minutes"id="time" name="time" required><br><br><br></td>
                    </tr>
                    <tr>
                        <td><label>Number of MCQ</label><br><br><br></td>
                        <td><input type="number" placeholder="Enter Number of questions" id="mcq" name="mcq" required><br><br><br></td>
                    </tr>
                    <tr>
                        <td><label>Total Marks</label><br><br><br></td>
                        <td><input type="number" placeholder="Enter total marks" id="marks" name="marks" required><br><br><br></td>
                    </tr>
                </tbody>
            </table>
            <br><br><br><br>
            <input id="next" type="submit" value="NEXT"> 
            <br><br><br><br><br><br>
        </form>
    </center>
</body>
</html>