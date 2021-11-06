<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
<style>
    #container{
        background-color: #F7F9FD; 
        box-shadow: 5px 5px 10px rgb(194, 194, 194);
        border: 1px solid #dddfe2 ;
        width: 50%;
        margin-top: 3%;
        padding: 40px 100px 40px 100px; 
        font-size: 35px;
        font-family: 'Secular One', sans-serif;        
        font-style: normal;
        line-height: 40px;

    }
</style>
</head>
<body>
    <?php
           $conn = mysqli_connect("localhost", "root", "", "exam");
    
           if($conn === false){
               die("ERROR: Could not connect. "
                   . mysqli_connect_error());
           }
       
           // fetching sId, t_id and q_id from last page
           session_start();
           $s_id = $_SESSION['s_id'];
           $t_id = $_SESSION['t_id'];
           $q_id = $_SESSION['q_id'];

            // Creating variables   
            $correct_no=0;
            $wrong_no=0;
            $marks_scored=0;
            
            // fetching everything from student_answer table
            $db = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
            $records = mysqli_query($db,"SELECT * FROM student_answer WHERE t_id='$t_id' AND s_id='$s_id'");
            while($data = mysqli_fetch_array($records)) 
            {              
                if ($data['answer'] == $data['sans']) //checking answers
                {
                    $correct_no = $correct_no + 1 ; //counting numbers of correct answers
                    $correct_qid = $data['q_id'];  //fetching correct answer q_id
                      
                    //fetching marks for the correct answer through correct answer q_id
                    $db = mysqli_connect("localhost", "root", "", "exam") or die(mysqli_error($conn));  
                    $query = mysqli_query($db,"SELECT q_id, marks FROM question WHERE q_id='$correct_qid'"); 
                    while($data = mysqli_fetch_array($query)) 
                    {
                        $marks = $data['marks'];  //fetching marks for each answer in string format
                        intval($marks);  //converting marks from string to integer format
                        $marks = $marks + $marks_scored; //adding the marks
                        $marks_scored = $marks;  //storing the data in the final variable                
                    }
                }
                
                else 
                {
                    $wrong_no= $wrong_no+1; //counting wrong answers
                }
            }

                // fetching total marks of the test from test table
                $fetch = "SELECT total_marks FROM test WHERE t_id='$t_id'"; 
                $Result = mysqli_query($conn,$fetch);
                $marks = mysqli_fetch_assoc($Result); 
                $total_marks = $marks["total_marks"];
                
                // counting the percentage of marks scored
                $percentage = ($marks_scored/ $total_marks) * 100;
                $percentage = number_format($percentage, 2);  //limiting the float digits to 2
                
                // deciding Pass/Fail from the function
                function pass_fail($percentage) 
                {
                    if ( $percentage >30 )  //if percentage is above 30% then student has passed
                    {
                        $pass = 'Pass';
                        return $pass;
                    }
                    else                    //if percentage is below 30% then student has failed
                    {
                        $fail= 'Fail';
                        return $fail;
                    }
                }
                
                $pass_fail = pass_fail($percentage); //taking output of the function in a variable
                
                // echo "PASS/FAIL: {$pass_fail}";
                // echo '<br>'; 
                // echo "TOTAL MARKS: {$total_marks}";
                // echo '<br>';
                // echo "MARKS SCORED: {$marks_scored}";
                // echo '<br>'; 
                // echo "PERCENTAGE: {$percentage}";
                // echo '<br>';
                // echo"CORRECT: {$correct_no} and WRONG: {$wrong_no}";


                // updating all the data in the table
                $updateQuery = "UPDATE student_test_map 
                                SET 
                                    marks_scored = '$marks_scored',
                                    pass_fail = '$pass_fail',
                                    wrong_answer = '$wrong_no',
                                    right_answer = '$correct_no',
                                    percentage = '$percentage'
                                WHERE
                                    t_id='$t_id'
                                AND
                                    s_id = '$s_id'";

                if(mysqli_query($conn, $updateQuery)) {
                //    echo '<br>SUCCESS';

                } else {
                    // echo 'FAIL';
                }
    ?>



    <center>
        <div id="container">
            <h2> Your Answers has been Recorded.</h2>
            <h2> Thank Your !</h2>
            <p>(Please Close This Tab)</p>
        </div>
    </center>
</body>
</html>