<!DOCTYPE html>
<html>
<head>
    <link href="register-style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="ExamPortal">ExamPortal</div>
	
    <div class="Frame1">
        <a href="#" class='faculty'>FACULTY</a>
        <a href="login.php" class='student'>STUDENTS</a>
    </div>
    
	<img src="image2.png" width= 770px height= 650px class="img"/>

    <div class="Rectangle2">
        <center>    
            <br><br>
            <h1 class="Login">Student Sign Up</h1> <br>
            <form onsubmit="return registration() == true" method="POST" action="insert.php">
                
                <input type="text" id= "fname" name='fname' placeholder="First Name" > <br><br>
				<input type="text" id="lname" name='lname' placeholder="Last Name" > <br><br>

                <select name="gender" id="gender" >
                    <option value="" disabled selected>Gender</option>
                    <option value="Female">Female</option>
                    <option value="Male">Male</option>
                    <option value="others">Other</option>
                </select><br><br>

				<input type="number" id="phone" name="phone" placeholder="Mobile Number"><br><br>
                <input type="date" id="dob" name="dob" placeholder="Date of Birth"><br><br>
				
                <input type="email" id="email" name="email" placeholder="Email Address"><br><br>

				<input type="password" id="pwd" name="password" placeholder="Password" id="password"><br><br>
                
				<input type="password"  id="cpwd" placeholder="Confirm Password"><br><br><br>
                
                <input type="submit" value="Sign Up">
                <input type="reset" value="Clear Form" onclick="clearFunc()" id="res" class="btn"/>
            </form>
        </center>  
        <br><br><br><br><br><br>     
    </div>
    <br><br>

    <script>
    function registration()
	{
		var name= document.getElementById("fname").value;
		var lname= document.getElementById("lname").value;
		var gender= document.getElementById("gender").value;
		var phone= document.getElementById("phone").value;
		var dob= document.getElementById("dob").value;
		var email= document.getElementById("email").value;
		var pwd= document.getElementById("pwd").value;			
		var cpwd= document.getElementById("cpwd").value;
		
        //email id expression code
		var pwd_expression = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])/;
		var letters = /^[A-Za-z]+$/;
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		var regexPhoneNumber = /^[0-9]{10}$/;


			if(name=='')
			{
				alert('Please enter your first name.');
				return false;
			}

			else if(!letters.test(name)) {
				alert('First name should have only alphabets.');
				return false;
			}

			else if(lname=='')
			{
				alert('Please enter your last name.');
				return false;
			}

			else if(!letters.test(lname)) {
				alert('Last name should have only alphabets.');
				return false;
			}
			
			else if(gender=='')
			{
				alert('Please select your gender.');
				return false;
			}

			else if(phone=='')
			{
				alert('Please enter your phone number.');
				return false;
			}

			else if (!phone.match(regexPhoneNumber)) {
				alert('Invalid phone number.');
				return false;
			}

			else if(dob=='')
			{
				alert('Please select your date of birth.');
				return false;
			}
			
			else if(email=='')
			{
				alert('Please enter your email id.');
				return false;
			}

			else if (!filter.test(email)) {
				alert('Invalid email.');
				return false;
			}

			else if(pwd=='')
			{
				alert('Please enter your pasword.');
				return false;
			}

			else if(!pwd_expression.test(pwd)) {
				alert ('Password should contain Upper case, Lower case and Numbers.');
				return false;
			}

			else if(document.getElementById("pwd").value.length < 6 ) {
				alert ('Password minimum length should be 6.');
				return false;
			}
			
			else if(document.getElementById("pwd").value.length > 12) {
				alert ('Password maximum length should be 12.');
				return false;
			}  

			else if(cpwd=='')
			{
				alert('Please enter confirm pasword.');
				return false;
			}
			
			else if(pwd != cpwd) {
				alert ('Password not matched');
				return false;
			}

			else 			
			{
			alert('Thank You for Signing Up!');
			return true; 
			}
	}
	function clearFunc()
	{
		document.getElementById("fname").value="";
		document.getElementById("lname").value="";
		document.getElementById("gender").value="";
		document.getElementById("phone").value="";
		document.getElementById("dob").value="";
		document.getElementById("email").value="";
		document.getElementById("pwd").value="";
		document.getElementById("cpwd").value="";
	}
    </script>
</body>
</html>