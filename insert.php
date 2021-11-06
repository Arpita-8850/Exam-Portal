<?php
    $conn = mysqli_connect("localhost", "root", "", "exam");
    
    if($conn === false){
        die("ERROR: Could not connect. "
            . mysqli_connect_error());
    }
    
    $first_name = $_REQUEST['fname'];
    $last_name = $_REQUEST['lname'];
    $contactNo = $_REQUEST["phone"];
    $gender = $_REQUEST['gender'];
    $email = $_REQUEST['email'];
    $password = $_REQUEST["password"];

    if(strtotime($_REQUEST["dob"])) {
        $dob = date('Y-m-d', strtotime($_REQUEST["dob"]));
    } 
    else {
        echo "Wrong date";
    }
    
    $hash = password_hash($password, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO student(s_fname, s_lname, s_phone, s_email,s_password, s_gender, s_dob) 
            VALUES ('$first_name','$last_name', '$contactNo', '$email','$hash','$gender','$dob')";
    
    if(mysqli_query($conn, $sql)){
        header("Location:Login.php");
    } 
    else{
        $target = "register.php";
        $linkname = "mylink";
        echo "Data not saved. Sign up again"; 
        link($target, $linkname);
    }
 
    mysqli_close($conn);   
?>

