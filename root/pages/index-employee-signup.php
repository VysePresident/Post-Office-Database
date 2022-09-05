<?php
//Temporary registration page
//Either move code to manager-services.php when available, or make into an include file

?>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,600,700&display=swap" rel="stylesheet">
    <!-- use style.css -->
    <link rel="stylesheet" href="../css/index-login.css">
</head>
<body>
    <section class="header" style="background-image: linear-gradient(rgba(4,9,30,0.7),rgba(4,9,30,0.7)), url('../images/post.jpeg');">
        <?php
            include_once '../header.php';
        ?>
        <!--End General Header code-->
        <!-- Login Container inside of the header -->
        <div class="container">
            <div class="forms">
                <div class="form login">
                    <span class="title">Login</span>
                    
                    <!--Log In Form-->
                    <form action="../includes/login.inc.php" method="post">
                        <div class="input-field">
                            <input type="text" name="uid" placeholder="Enter your email" required>
                            <i class="uil uil-envelope icon"></i>
                        </div>
                        <div class="input-field">
                            <input type="password" name="pwd" class="password" placeholder="Enter your password" required>
                            <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>
    
                        <div class="checkbox-text">
                            <div class="checkbox-content">
                                <input type="checkbox" id="logCheck">
                                <label for="logCheck" class="text">Remember me</label>
                            </div>
                            
                            <a href="#" class="text">Forgot password?</a>
                        </div>

                        <!--If a Login error occurs, inform the user on-screen-->
                        <?php
                            if(isset($_GET["error"]))
                            {
                                if($_GET["error"] == "emptyinput")
                                {
                                    echo "<p>Fill in all fields!</p>";
                                }

                                else if($_GET["error"] == "wronglogin1")
                                {
                                    echo "<p>Incorrect login information!</p>";
                                }
                                else if($_GET["error"] == "wronglogin2")
                                {
                                    echo "<p>Incorrect login information!</p>";
                                }
                            }
                        ?>
                        <!--Submit Button Here-->
                        <div class="input-field button">
                            <!--<input type="button" value="Login Now">-->
                            <button type="submit" name="submit">Login now</button>
                        </div>
                    </form>
    
                    <div class="login-signup">
                        <span class="text">Not a member?
                            <a href="#" class="text signup-link">Signup now</a>
                        </span>
                    </div>
                </div>
    
                <!-- Registration Form that appears upon clicking -->
                <div class="form signup">
                    <span class="title">Employee Registration</span>
    
                    <form action="../includes/employee-signup.inc.php" method="post">
                        <div class="input-field">
                            <input type="text" name="fname" placeholder="Enter first name" required>
                            <i class="uil uil-user"></i>
                        </div>
                        <div class="input-field">
                            <input type="text" name="lname" placeholder="Enter last name" required>
                            <i class="uil uil-user"></i>
                        </div>
                        <div class="input-field">
                            <input type="text" name="email" placeholder="Enter your email" required>
                            <i class="uil uil-envelope icon"></i>
                        </div>
                        <div class="input-field">
                            <input type="password" name="pwd" class="password" placeholder="Create a password" required>
                            <i class="uil uil-lock icon"></i>
                        </div>
                        <div class="input-field">
                            <input type="password" name="pwdrepeat" class="password" placeholder="Confirm a password" required>
                            <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>
    
                        <div class="checkbox-text">
                            <div class="checkbox-content">
                                <input type="checkbox" id="sigCheck">
                                <label for="sigCheck" class="text">Remember me</label>
                            </div>
                            
                            <a href="#" class="text">Forgot password?</a>
                        </div>
    
                        <div class="input-field button">
                            <!--<input type="button" value="Login Now">-->
                            <button type="submit" name="submit">Sign up</button>
                        </div>
                    </form>
                    
                    <!--If a Registration error occurs, inform the user on-screen-->
                    <?php
                            if(isset($_GET["error"]))
                            {
                                if($_GET["error"] == "emptyinput")
                                {
                                    echo "<p>Fill in all fields!</p>";
                                }

                                else if($_GET["error"] == "invaliduid")
                                {
                                    echo "<p>Choose a proper username!</p>";
                                }

                                else if($_GET["error"] == "invalidemail")
                                {
                                    echo "<p>Choose a proper email!</p>";
                                }

                                else if($_GET["error"] == "passwordsdontmatch")
                                {
                                    echo "<p>Passwords don't match!</p>";
                                }

                                else if($_GET["error"] == "stmtfailed")
                                {
                                    echo "<p>Something went wrong, try again!</p>";
                                }

                                else if($_GET["error"] == "usernametaken")
                                {
                                    echo "<p>Username already taken!</p>";
                                }

                                else if($_GET["error"] == "none")
                                {
                                    echo "<p>You have signed up!</p>";
                                }

                            }
                        ?>
    
                    <div class="login-signup">
                        <span class="text">Already a member?
                            <a href="#" class="text login-link">Login now</a>
                        </span>                    
                    </div>
                </div>
            </div>
        </div>
    </section> 

    <!-- source code for login -->
    <script src="../scripts/index-login.js"></script>

</body>
</html>
