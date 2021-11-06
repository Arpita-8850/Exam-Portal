<!DOCTYPE html>
<html>
<head>
    <link href="style.css" rel="stylesheet">
    <link href="exam-style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>
<body>
    <?php
        $conn = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
        session_start();
        $sId = $_SESSION['sId'];
        $t_id = $_GET['t_id'];

        $_SESSION['sId'] = $sId;
        $_SESSION['t_id'] = $t_id;

        $sql = "SELECT s_fname, s_lname FROM student WHERE s_id='$sId'";
        $selectResult = mysqli_query($conn,$sql);
        $studentDetails = mysqli_fetch_assoc($selectResult); 
        $sName = $studentDetails["s_fname"];
        $slName = $studentDetails["s_lname"];

        $query = "SELECT t_name, time FROM test WHERE t_id='$t_id'";
        $Result = mysqli_query($conn,$query);
        $testName = mysqli_fetch_assoc($Result); 
        $tName = $testName["t_name"];
        $time = $testName["time"];
    ?>

    <div class="ExamPortal">ExamPortal</div>
    <h4 class="time">   
                <span id="iTimeShow"><b>TIME LEFT: </b></span>
                <span id='timer'></span>
            </h4>
    <div class="Frame1">
           
            <a id="name" class="name" ><?php echo "Welcome {$sName} {$slName} !"; ?></a>

    </div>
    

    <br><br><br><br><br><br><br><br><br>

    <center>
        <h3 id="test" style="font-size: 70px; font-family: 'Secular One', sans-serif;"><?php echo "{$tName}"; ?></h3>
        <br>
        <form method = "POST"> 
            <table>
                <tbody>
                    <?php
                        $db = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
                        $records = mysqli_query($db,"SELECT t.*, q.* FROM test t, question q WHERE q.t_id = '$t_id 'AND t.t_id= q.t_id;"); // fetch data from database
                        $i=1;
                        if(mysqli_num_rows($records)>0)
                        {
                            while($data = mysqli_fetch_array($records)) 
                            {
                                echo'
                                    <tr>
                                        <th>
                                            <label><b>Question '.$i.':</b></label>
                                            <label id="question">'.$data['question'].'</label>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" id='.$data['answer'].' name='.$data['q_id'].' value="a">
                                            <label id="a'.$i.'">'.$data['a'].'</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" id='.$data['answer'].' name='.$data['q_id'].' value="b">
                                            <label id="b'.$i.'">'.$data['b'].'</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" id='.$data['answer'].' name='.$data['q_id'].' value="c">
                                            <label id="c'.$i.'">'.$data['c'].'</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="radio" id='.$data['answer'].' name='.$data['q_id'].' value="d">
                                            <label id="d'.$i.'">'.$data['d'].'</label>
                                            <br><br>
                                        </td>
                                    </tr>
                                ';
                                $i = $i+1;
                            }
                        }
                    ?>
                </tbody>
            </table>
            <br><br>
            <button name="submit" id="submit" type="submit" onclick="displayanswer()">SUBMIT</button>
            <div id="result"></div>
        </form>
        
        <br><br><br><br><br><br><br>
    </center>

    <?php

        if (isset($_POST["submit"])){
            $currentDateTime = new \DateTime();
            $currentDateTime->setTimezone(new \DateTimeZone('Asia/Kolkata'));
            
            $date = $currentDateTime->format('Y-M-D');
            $time = $currentDateTime->format('H:i:s');

            $updatequery = "UPDATE `student_test_map` 
                            SET `attendence`='Yes',`date`='$date',`time`='$time' WHERE t_id= '$t_id' and s_id='$sId'";
            mysqli_query($conn, $updatequery);
        }
    ?>
        
<script>
   <?php
       echo "var c ='$time'*60;";
   ?>
    function timedCount()
	{
		var hours = parseInt( c / 3600 ) % 24;
		var minutes = parseInt( c / 60 ) % 60;
		var seconds = c % 60;
		var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);            
		$('#timer').html(result);
		
		if(c == 0 )
		{
            alert('Test Time Completed!');  
            displayanswer();
            return false;			
		}
		c = c - 1;
		t = setTimeout(function()
		{
			timedCount()
		},1000);
	}
    timedCount();

    
    function displayanswer()
    {
        var results = document.getElementsByTagName('input');
        for(i=0; i<results.length; i++)
        {
            if(results[i].type == "radio")
            {
                if(results[i].checked)
                {   
                    var ans = results[i].value
                    var q_id = results[i].name
                    var cans = results[i].id
                    
                    // alert("ID: "+q_id+", Your answer: "+ans+", Correct answer: "+cans);
                    
                    $.post({
                        type: 'POST',
                        url: 'insert-answer.php',
                        data: { ans: ans, q_id: q_id, cans:cans},
                        success: function(data) {
                            // document.write(data);
                            window.location.href = "exam-end.php";
                        }
                    });
                }
            }
        }
    }
</script>
</body>
</html>