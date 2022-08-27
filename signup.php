<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signupcss.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="logincss.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php include 'links.php' ?>
    <?php include 'css/style.css' ?>
    
    <title>Signup</title>
</head>
<body>

   <!-- Navbar Start Here -->
   <div class="nav">
    <div class="nav-warper">
        <div>
            <ul>
                <li><a href="index.html"> Home </a></li>
                <li><a href="#about"> About </a></li>
                <li> <a href="contactus.html"> Contact Us </a> </li>
                <li> <a href="roadmaps.html"> Roadmaps </a> </li>
                <li> <a href="signup.html"> SignUp </a> </li>
                <li> <a href="login.html"> Login </a> </li>
                <li><i class="fa fa-fw fa-search"></i> </li>
            </ul>
        </div>
    </div>
</div>

<!-- Navbar End Here  -->


    <form style="border:1px solid #ccc" method="POST">
        <div class="container">
          <h1 style="height: 50px;">Sign Up</h1>
          <p>Please fill in this form to create an account.</p>
          <hr>
      
          <label for="email"><b>Email</b></label>
          <input type="text" placeholder="Enter Email" name="email" required>
      
          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" required>
      
          <label for="psw-repeat"><b>Repeat Password</b></label>
          <input type="password" placeholder="Repeat Password" name="password-repeat" required>
      
          <label>
            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
          </label>
      
          <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>
      
          <div class="clearfix">
            <button type="button" class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn" name="submit">Sign Up</button>
          </div>
        </div>
      </form>

      <!-- Footer -->
     <footer>
      <p>Copyright © 2022 All Rights Reserved<br>
          <a href="#" class="fa fa-facebook"></a>  
          <a href="#" class="fa fa-twitter"></a>  
          <a href="#" class="fa fa-linkedin"></a>  
          <a href="#" class="fa fa-instagram"></a>  
          <a href="#" class="fa fa-youtube"></a>  
          <a href="#" class="fa fa-pinterest"></a>  
          <a href="#" class="fa fa-google"></a>  
    </footer>
</body>
</html>

<?php
include 'connect.php';

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn,  $_POST['email']);
    $password = mysqli_real_escape_string($conn,  $_POST['password']);
    $r_password = mysqli_real_escape_string($conn,  $_POST['password-repeat']);

    // Password to encrypt by using BlowFish Algorithm
    $pass = password_hash ($password, PASSWORD_BCRYPT);
    $r_pass = password_hash ($r_password, PASSWORD_BCRYPT);

    // To check whether same mail id is already present in database or not
    $emailquery = "select * from signup_details where email ='$email'";
    $query = mysqli_query($conn, $emailquery );

    // Count email availability
    $emailcount = mysqli_num_rows($query);

    //if email count is greater then o then return email existes otherwise we'll check whether pass is matching os not then we'll insert the  user data into our database
    if($emailcount>0){

    ?> <script>
        alert('Email already exist!')
    </script>
    <?php
    } else{
        if($password ===$r_password){

            //Insert query
            $insertquery ="INSERT INTO signup_details (email, password, repeat_password) values('$email', '$pass' '$r_pass')";
            $iquery= mysqli_query($conn, $insertquery);
            if($iquery){

                ?>
                <script>
                    alert('Signup Successful');
                </script>
                <?php 
            } else{
                ?>
                <script>
                    alert('Oops, Something went wrong!');
                </script>
                <?php
            }

        } else{ 
            ?> <script>
                alert('Incorrect Password!')
            </script>
            <?php
        }
    }

}

?>
