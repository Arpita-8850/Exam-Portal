<html>
<head>
    <link href="style.css" rel="stylesheet">
    <link href="test-style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src = "jQuery/jquery.js"> </script>
    <script type="text/javascript">
        function updateQuestion(quId, i) {
            var qId = quId;
            var ques = document.getElementById("question"+i).value;
            var optA = document.getElementById("a"+i).value;
            var optB = document.getElementById("b"+i).value;
            var optC = document.getElementById("c"+i).value;
            var optD = document.getElementById("d"+i).value;
            var ans = document.getElementById("answer"+i).value;
            var mks = document.getElementById("marks"+i).value;
            var t_id = document.getElementById("t_id"+i).value;
            $.post(
                "update-question.php",
                {
                    quesId: qId, 
                    question: ques, 
                    a: optA, 
                    b: optB, 
                    c: optC, 
                    d: optD, 
                    answer: ans, 
                    marks: mks,
                    t_id: t_id
                },
                function(queryResult) {
                    if(queryResult=='success') {
                        alert("Question updated successfully");
                        return;
                    } else {
                        alert("Question update failed. Please try again");
                        return;
                    }
                }
            );
        }


        function updateTest(t_id) {
            var t_id = t_id;
            var tname = document.getElementById("tname").value;
            var date = document.getElementById("date").value;
            var time = document.getElementById("time").value;
            var tmarks = document.getElementById("tmarks").value;
            $.post(
                "update-test.php",
                {
                    t_id: t_id, 
                    tname: tname, 
                    date: date, 
                    time: time, 
                    tmarks: tmarks
                },
                function(queryResult) {
                    if(queryResult=='success') {
                        alert("Updated successfully");
                        return;
                    } else {
                        alert("Update failed. Please try again");
                        return;
                    }
                }
            );
        }
    </script>
</head>
<body>
    <?php
        $conn = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
        
        $t_id = $_GET['t_id']; // get id through query string

        session_start();
        $fId = $_SESSION['fId'];
      
        $_SESSION['fId'] = $fId; 
        $_SESSION['t_id'] = $t_id; 
                
        $sql = "SELECT f_fname, f_lname FROM faculty WHERE f_id='$fId'";
        $selectResult = mysqli_query($conn,$sql);	
        $studentDetails = mysqli_fetch_assoc($selectResult);  
        $fName = $studentDetails["f_fname"];
        $flName = $studentDetails["f_lname"];


        $test_sql = "SELECT t_name FROM test WHERE t_id='$t_id'";
        $Result = mysqli_query($conn,$test_sql);
        $testName = mysqli_fetch_assoc($Result);  
        $tname = $testName["t_name"];                
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
        <form method = "POST"> 
        <table>
            <tbody>
                <?php
                    $db = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
                    $records = mysqli_query($db,"SELECT * FROM test WHERE t_id='$t_id'"); // fetch data from database
                    while($data = mysqli_fetch_array($records))
                    {   
                        echo'
                            <tr>
                                <td><label>Test Name:</label><br><br><br></td>
                                <td><input type="text" placeholder="Enter Test Name" id="tname" value="'.$data['t_name'].'" required><br><br><br></td>
                            </tr>
                            <tr>
                                <td><label>Date</label><br><br><br></td>
                                <td><input type="date" id="date" value="'.$data['date'].'" required><br><br><br></td>
                            </tr>
                            <tr>
                                <td><label>Time</label><br><br><br></td>
                                <td><input type="number" id="time" value="'.$data['time'].'" required><br><br><br></td>
                            </tr>
                            <tr>
                                <td><label>Total Marks</label><br><br><br></td>
                                <td><input type="number" placeholder="Enter total marks" id="tmarks" value="'.$data['total_marks'].'" required><br><br><br></td>
                            </tr>
                            <tr>
                                <td>
                                    <br><br>
                                    <input id="update" 
                                            type="submit" value="UPDATE" style="float: right; width: 130px;"
                                            onclick="updateTest('.$data['t_id'].')">
                                    <br><br>
                                </td>
                            </tr>
                        ';
                    }
                ?>
            </tbody>
        </table>
        </form>

        <br><br><br><br> 
        
        <form method = "POST"> 
        <table>
            <tbody>
                <?php
                    $db = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
                    $records = mysqli_query($db,"SELECT * FROM question WHERE t_id='$t_id'"); // fetch data from database
                    $i=0;
                    while($data = mysqli_fetch_array($records))
                    {   
                        echo'
                            <tr>
                                <td><label>Question:</label><br><br><br></td>
                                <td><input type="text" placeholder="Enter The Question" id="question'.$i.'" value="'.$data['question'].'" style="width:700px;"required><br><br><br></td>
                            </tr>
                            <tr>
                                <td><label>Marks</label><br><br><br></td>
                                <td><input type="number" placeholder="Enter Marks" id="marks'.$i.'" value="'.$data['marks'].'" style="width:600px;" required><br><br><br></td>
                            </tr>
                            <tr>
                                <td><label>Option A</label><br><br><br></td>
                                <td><input type="text" placeholder="Enter Option A" id="a'.$i.'" value="'.$data['a'].'" style="width:600px;" required><br><br><br></td>
                            </tr>
                            <tr>
                                <td><label>Option B</label><br><br><br></td>
                                <td><input type="text" placeholder="Enter Option B" id="b'.$i.'" value="'.$data['b'].'" style="width:600px;" required><br><br><br></td>
                            </tr>
                            <tr>
                                <td><label>Option C</label><br><br><br></td>
                                <td><input type="text" placeholder="Enter Option C" id="c'.$i.'" value="'.$data['c'].'" style="width:600px;" required><br><br><br></td>
                            </tr>
                            <tr>
                                <td><label>Option D</label><br><br><br></td>
                                <td><input type="text" placeholder="Enter Option D" id="d'.$i.'" value="'.$data['d'].'" style="width:600px;" required><br><br><br></td>
                            </tr>
                            <tr>
                                <td><br><label>Correct Answer</label><br><br></td>
                                <td>
                                    <select id="answer'.$i.'" style="width:600px;" required>
                                        <option value="a">Option A</option>
                                        <option value="b">Option B</option>
                                        <option value="c">Option C</option>
                                        <option value="d">Option D</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="hidden" id="t_id'.$i.'" value="'.$data['t_id'].'">                                
                                    <br><br><br>
                                    <input id="update'.$i.'" type="submit" value="UPDATE" style="float: right; width: 130px;"
                                            onclick="updateQuestion('.$data['q_id'].','.$i.')">
                                    <br><br><br><br><br><br>
                                </td>
                            </tr>
                        ';
                        $i = $i+1;
                    }
                ?>
            </tbody>
        </table>
        </form>
        <br><br><br>
        <a href="faculty-home.php"><input type="submit" value="SUBMIT" style="width: 130px;">
        <a href="student_edit.php"><input type="submit" value="STUDENTS ACCESS" style="width: 300px; margin-left: 20px;"></a>
        <br><br><br>
    </center>

    
</body>
</html>