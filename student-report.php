<!DOCTYPE html>
<html>
<head>
    <link href="report-style.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@500&display=swap" rel="stylesheet">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
        $conn = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
        session_start();
        $sId = $_SESSION['sId'];
        $t_id = $_GET['t_id'];

        $sql = "SELECT s_fname, s_lname FROM student WHERE s_id='$sId'";
        $selectResult = mysqli_query($conn,$sql);
		
        $studentDetails = mysqli_fetch_assoc($selectResult); 
        $sName = $studentDetails["s_fname"];
        $slName = $studentDetails["s_lname"];

        $selectTestDetailsQuery = "SELECT t.*, stm.*
                                    FROM test t, student_test_map stm WHERE stm.s_id= '$sId'
                                    AND stm.t_id = ' $t_id'
                                    AND t.t_id= stm.t_id;";
        $data = mysqli_query($conn, $selectTestDetailsQuery);
        $total = mysqli_num_rows($data);
    ?>

 <div class="ExamPortal">ExamPortal</div>

    <br><br><br><br><br>
    <center>
    <h1 id="name"><?php echo "{$sName} {$slName}"; ?></h1>
    <br>

    <div class="container">        
        <table>
        <?php   
            while($result = mysqli_fetch_assoc($data)) 
            {
            echo " 
                <tr>
                    <td>Exam name</td>
                    <td>".$result['t_name']."</td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td>".$result['date']."</td>
                </tr>
                <tr>
                    <td>Time</td>
                    <td>".$result['time']."</td>
                </tr>
                <tr>
                    <td>Seat number</td>
                    <td>".$result['seat_no']."</td>
                </tr>
                <tr>
                    <td>Pass/Fail</td>
                    <td>".$result['pass_fail']."</td>
                </tr>        
                <tr>
                    <td>Total marks</td>
                    <td>".$result['total_marks']."</td>
                </tr>        
                <tr>
                    <td>Marks scored</td>
                    <td>".$result['marks_scored']."</td>
                </tr>       
                <tr>
                    <td>Percentage</td>
                    <td>".$result['percentage']."%</td>
                </tr>
                <tr>
                    <td>Total questions</td>
                    <td>".$result['total_ques']."</td>
                </tr>
                <tr>
                    <td>Wrong answers</td>
                    <td>".$result['wrong_answer']."</td>
                </tr>
                <tr>
                    <td>Right answers</td>
                    <td>".$result['right_answer']."</td>
                </tr>";
            }
            ?>
        </table>
    </div>
    <img src="circle1.png" id="circle1"/>
    <img src="book.png" id="book"/>
    <img src="circle2.png" id="circle2"/>
    <img src="board.png" id="board"/>
    <br><br><br><br><br><br><br><br><br>
    <input id="print" type="submit" value="Prtint Report" onclick="printpage()"/>  
    <br><br><br><br>
 </center>

 <script>
  function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("print");
        
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        
        //Print the page content
        window.print();
		setTimeout(1000);
        printButton.style.visibility = 'visible';
    }
</script>	
</body>
</html>