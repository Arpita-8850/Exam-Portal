<!DOCTYPE html>
<html>
<head>
    <link href="login-style.css" rel="stylesheet">
    <link href="popup-style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@700&display=swap" rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="Frame" id="blur">
    
    <div class="ExamPortal">ExamPortal</div>
    
    <div class="Frame1">
        <a href="#" class='faculty' onclick="toggle()">FACULTY</a>
        <a href="login.php" class='student'>STUDENTS</a>
    </div>
    <img src="image.png" width= 512px height= 512px style="left: 197px; top: 159px;" data-aos="fade"  data-aos-once= "true"/>

        <div class="Rectangle2" data-aos="fade"  data-aos-once= "true">
                <center>
                  <form action="database.php" method="post">
                        <br><br>
                        <h1 class="Login" id="Login">Login</h1>
                        <p>Sign in to your account</p><br>
                        <input type="email" id="email" name="email" placeholder="Email" required><br><br><br>
                        <input type="password" id="name" name="password" placeholder="Password" required><br><br><br>
                        <a><input type="submit" value="Login"></a><br>
                    </form>
                    <p>Forget password? <a href="#">Click here.<a></p>
                    <hr><br>
                    <a href="register.php"><input type="submit" value="Register"></a>
                </center>
        </div>
        <br><br>
</div>


<div id="popup">
    <img src="close.png"  id="close-bt" onclick="toggle()" style="cursor: pointer;">
    <div class="container">
      <div id="Login">Sign In</div>
        <center><p>Sign in to your account</p><br></center>
        <form action="faculty_database.php" method="post">
          
          <div class="data">
            <label>Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your Email" required><br><br>
          </div>
        
          <br>
          <div class="data">
            <label>Password</label>
            <input type="password" id="name" name="password" placeholder="Enter your Password" required>
          </div>

          <br><br>
          <center>
            <div class="btn">  
              <div class="inner"</div>
              <input type="submit" value="Sign In">
            </div>
          
            <br>
            <a>Forgot <a href="#" style="text-decoration:none">Password?</a></div>
          </center>
        </form>
     </div>
  </div>

<script>
    function toggle(){
        var blur = document.getElementById('blur');
        blur.classList.toggle('active');
        var popup = document.getElementById('popup');
        popup.classList.toggle('active');
    }

    AOS.init({
        duration: 1500,
    })
</script>
</body>
</html>