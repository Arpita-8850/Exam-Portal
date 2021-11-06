<html>
<head>
    <link href="style.css" rel="stylesheet">
    <link href="test-style.css" rel="stylesheet">
    <link href="exam-style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@700&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<?php
    $conn = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
    
    session_start();
    $fId = $_SESSION['fId'];
    $t_id = $_SESSION['t_id'];

    $_SESSION['t_id'] = $t_id; 

    $sql = "SELECT f_fname, f_lname FROM faculty WHERE f_id='$fId'";
    $selectResult = mysqli_query($conn,$sql);
    $studentDetails = mysqli_fetch_assoc($selectResult);  
    $fName = $studentDetails["f_fname"];
    $flName = $studentDetails["f_lname"];

    $query = $query = "SELECT t_name FROM test WHERE t_id='$t_id'";
    $selectResult = mysqli_query($conn,$query);
    $testName = mysqli_fetch_assoc($selectResult);  
    $t_name = $testName["t_name"];
?>

    <div class="ExamPortal">ExamPortal</div>
    <div class="Frame1">
        <a class="name"><?php echo " Welcome {$fName} {$flName}!"; ?></a>
        <a href="faculty-home.php" class='active'>HOME</a>
        <a href="student-info.php" class='passive'>STUDENTS</a>
        <a href="attendence.php" class='passive'>ATTENDENCE</a>
        <a href="addTest.php" class='passive'>ADD TEST</a>
        <a href="login.php" class='logout' id='logout'>LOGOUT</a>
    </div>

    <br><br> <br><br> <br><br> <br><br> 
    
        <center>
            <h3 data-aos="fade-up"  data-aos-once= "true" id="test"><?php echo "{$t_name}"; ?></h3>
            <table style="width:35%;">
                </tbody>
                <form method = "POST"> 
                    <?php
                        $db = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
                        $records = mysqli_query($db,"SELECT * FROM student"); // fetch data from database
                        $i=0;
                        while($data = mysqli_fetch_array($records))
                        {   
                            echo' 
                                <tr>
                                    <td style="padding: 10px; font-size: 25px;">
                                        <input type="checkbox" id='.$data['s_id'].' name="chk" value='.$data['s_fname'].'>
                                        <label for='.$data['s_id'].'>'.$data['s_fname'].' '.$data['s_lname'].'</label><br><br>
                                    </td>
                                </tr>    
                            ';
                        }
                    ?>
                    <tr>
                        <td>
                            <input type="button" onclick='selects()' value="Select All"/>  
                            <input type="button" onclick='deSelect()' value="Deselect All" style="margin-left: 20px;"/>  
                            <br><br>
                        </td>
                    </tr>
                </form>
                </tbody>
            </table>
            <br><br>
            <button name="submit" id="submit" type="submit" onclick="test()">SUBMIT</button>
            <button name="submit" id="submit" type="submit" onclick="goBack()">BACK</button>
            <br><br>
        </center>
        <div id="results"></div>

<script>
function test()
    {
        var results = document.getElementsByTagName('input');
        for(i=0; i<results.length; i++)
        {
            if(results[i].type == "checkbox")
            {
                if(results[i].checked)
                {   
                    var s_id = results[i].id
                   
                    // alert("ID: "+s_id+");
                    
                    $.post({
                        type: 'POST',
                        url: 'student_test_map_insert.php',
                        data: {s_id: s_id},
                        success: function(data) {
                            // document.write(data);
                            window.location.href = "faculty-home.php";
                        }
                    });
                }
            }
        }
    }

function goBack() {
  window.history.back();
}

function selects(){  
    var ele=document.getElementsByName('chk');  
    for(var i=0; i<ele.length; i++){  
        if(ele[i].type=='checkbox')  
            ele[i].checked=true;  
    }  
}  
function deSelect(){  
    var ele=document.getElementsByName('chk');  
    for(var i=0; i<ele.length; i++){  
        if(ele[i].type=='checkbox')  
            ele[i].checked=false;  
            
    }  
}             
</script>
</body>
</html>