<!DOCTYPE html>
<html>
<head>
    <link href="style.css" rel="stylesheet">
    <link href="test-style.css" rel="stylesheet">
    <link href="exam-style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src = "jQuery/jquery.js"> </script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <style>
        table input[type="text"]:read-only {
        border: none;
        width: 40%;
        }

        .saveButton {
        display: none;
        }
    </style>
    
<script>

    function save(i) {
        document.getElementById("save"+i).style.display = "block";
        var fields = document.querySelectorAll("table input[type='text']");
        for (var i = 0; i < fields.length; i++) {
            fields[i].readOnly = false;
        }
    }

    function changeSeatNo(i) {
        var data = {};
        data.seat_no = document.getElementById("seat_no"+i).value;
        data.t_id = document.getElementById("seat_no"+i).name;

        var fields = document.querySelectorAll("table input[type='text']");
            for (var i = 0; i < fields.length; i++) {
                fields[i].readOnly = true;
        }       
        
        $.post({
            type: 'POST',
            url: 'student_seat_no.php',
            data: {seat_no: data.seat_no, t_id: data.t_id},
            success: function(data) {
                location.reload();
                // document.write(data);
                // window.location.href = "student_test_info.php";
               
            }
        });
    }
</script>
</head>
<body>
   
<?php
        $conn = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
        session_start();
        $fId = $_SESSION['fId'];
                
        $s_id = $_GET['s_id']; // get id through query string
        
        $_SESSION['s_id'] = $s_id;

        $sql = "SELECT f_fname, f_lname FROM faculty WHERE f_id='$fId'";
        $selectResult = mysqli_query($conn,$sql);
        $studentDetails = mysqli_fetch_assoc($selectResult);  
        $fName = $studentDetails["f_fname"];
        $flName = $studentDetails["f_lname"];


        $test_sql = "SELECT * FROM student WHERE s_id='$s_id'";
        $Result = mysqli_query($conn,$test_sql);
        $Name = mysqli_fetch_assoc($Result);  
        $s_fname = $Name["s_fname"];
        $s_lname = $Name["s_lname"];
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
    <h3 id="test"><?php echo "{$s_fname} {$s_lname}"; ?></h3>
    <br>

        <div class="table-responsive">
            <form method="POST">
            <table class="table table-hover table-striped"  style="width: 60%;  font-size: 23px;" >
                <thead style="background-color: #2765C1; color: white; font-size: 26px; ">
                    <tr>
                        <th>Test Name</th>
                        <th>Seat no.</th>
                        <th>Edit Seat No</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php  
                        $i=0;
                        $db = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
                        $records = mysqli_query($db,"SELECT s.s_fname, t.*, stm.seat_no 
                                                        FROM faculty_test_map ftm, student_test_map stm, student s, test t 
                                                        WHERE ftm.f_id='$fId' AND ftm.t_id=stm.t_id AND stm.s_id='$s_id' 
                                                        AND s.s_id='$s_id' AND t.t_id =stm.t_id "); // fetch data from database
                        while($result = mysqli_fetch_array($records))
                        {
                            echo " 
                            <tr>
                                <td>".$result['t_name']."</td>
                                <td><input type='text' name=".$result['t_id']."  id='seat_no".$i."' value='".$result['seat_no']."' readOnly /></td>
                                <td>
                                    <input name='edit' id='edit".$i."' type='button' onclick='save(".$i.")' value='EDIT'>
                                </td>
                                <td>
                                <input name='edit' class='saveButton' id='save".$i."' type='button' onclick='changeSeatNo(".$i.")' value='SAVE' style='display:none'>
                                </td>
                                <td>
                                   <a href='delete-student-access.php?t_id=".$result['t_id']."'><img src='dustbin.png'  id='icon'></a>
                                </td>
                            </tr> ";
                            $i=$i+1;
                        }
                    ?>
                   
                </tbody>
            </table> 
            </form>
        </div>
        <br><br>
            <a href="student-info.php"><button name="submit" id="submit" type="submit">BACK</button></a>
            <br><br>
            <div id="results"></div>
    </center>
    <br><br> <br>
    <script>
        AOS.init({
        duration: 1500,
        })
        
        function goBack() {
             window.history.back();
        }
    </script>
</body>
</html>