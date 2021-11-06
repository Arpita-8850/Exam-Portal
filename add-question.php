<html>
<head>
    <link href="style.css" rel="stylesheet">
    <link href="test-style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
        $conn = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
        session_start();
        $fId = $_SESSION['fId'];
        $mcq = $_SESSION['mcq'];
        $tname = $_SESSION['tname'];
        
        // fetching faculty first and last name from database
        $sql = "SELECT f_fname, f_lname FROM faculty WHERE f_id='$fId'";
        $selectResult = mysqli_query($conn,$sql);
        $studentDetails = mysqli_fetch_assoc($selectResult);  
        $fName = $studentDetails["f_fname"];
        $flName = $studentDetails["f_lname"];

        // fetching t_id from database
        $idsql = "SELECT t_id FROM test WHERE t_name='$tname'";
        $Result = mysqli_query($conn,$idsql);
        $Testid = mysqli_fetch_assoc($Result);  
        $t_id = $Testid["t_id"];
        
        // sending t_id and fId to next page
        $_SESSION['t_id'] = $t_id;
        $_SESSION['fId'] = $fId;
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
        <h3 data-aos="fade-up"  data-aos-once= "true" id="test"><?php echo "{$tname} TEST"; ?></h3>
        <form method="post" action="insert-question.php">
            <table>
                <tbody>
                <?php
                    for ($x = 1; $x <=$mcq ; $x++) {
                ?>
                    <tr>
                        <td><label><?php echo " Question: {$x}"; ?></label><br><br><br></td>
                        <td><input type="text" placeholder="Enter The Question" name="ques[]" style="width:700px;"required><br><br><br></td>
                    </tr>
                    <tr>
                        <td><label>Marks</label><br><br><br></td>
                        <td><input type="number" placeholder="Enter Marks" name="marks[]" style="width:600px;" required><br><br><br></td>
                    </tr>
                    <tr>
                        <td><label>Option A</label><br><br><br></td>
                        <td><input type="text" placeholder="Enter Option A" name="a[]" style="width:600px;" required><br><br><br></td>
                    </tr>
                    <tr>
                        <td><label>Option B</label><br><br><br></td>
                        <td><input type="text" placeholder="Enter Option B" name="b[]" style="width:600px;" required><br><br><br></td>
                    </tr>
                    <tr>
                        <td><label>Option C</label><br><br><br></td>
                        <td><input type="text" placeholder="Enter Option C" name="c[]" style="width:600px;" required><br><br><br></td>
                    </tr>
                    <tr>
                        <td><label>Option D</label><br><br><br></td>
                        <td><input type="text" placeholder="Enter Option D" name="d[]" style="width:600px;" required><br><br><br></td>
                    </tr>
                    <tr>
                        <td><label>Correct Answer</label><br><br><br><br><br><br></td>
                        <td>
                            <select name="ans[]" style="width:600px;" required>
                                <option value="" disabled selected>Choose Answer</option>
                                <option value="a">Option A</option>
                                <option value="b">Option B</option>
                                <option value="c">Option C</option>
                                <option value="d">Option D</option>
                            </select>
                            <br><br><br><br><br><br>
                        </td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
            <br><br><br><br>
            <input id="next" type="submit" value="SUBMIT"> 
            <br><br><br><br><br><br>
        </form>
    </center>
</body>
</html>