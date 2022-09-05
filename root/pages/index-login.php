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

                                else if($_GET["error"] == "wronglogin2")
                                {
                                    // echo "<p>Incorrect login information!</p>";
                                    echo "<br>";
                                    echo "<p style='color:red';>Incorrect login information!</p>";
                                }
                            }
                        ?>
                        <!--Submit Button Here-->
                        <div class="input-field button">
                            <!--<input type="button" value="Login Now">-->
                            <button type="submit" name="submit" id="login-btn">Login now</button>
                        </div>
                    </form>
    
                    <div class="login-signup">
                        <span class="text">Not a member?
                            <a href="#" class="text signup-link">Signup now</a>
                        </span>
                    </div>
                </div>


                <script type="text/javascript" language="JavaScript"> 
                // checks to see if passwords match in the registration form.                
                function checkPasswordMatch(theForm) {
                    if (theForm.pwd.value != theForm.pwdrepeat.value)
                    {
                        alert("Passwords don\'t match! Please resubmit registration form");
                        return false;
                    } else {
                        return true;
                    }
                }
                </script> 
    
                <!-- Registration Form that appears upon clicking -->
                <div class="form signup" id="sign-up-form">
                    <span class="title">Registration</span>
    
                    <form action="../includes/signup.inc.php" method="post" onsubmit="return checkPasswordMatch(this);">
                        <div class="input-field">
                            <input type="text" name="fname" placeholder="Enter first name" pattern="[a-zA-Z]+" title="Only characters allowed" maxlength="20" required>
                            <i class="uil uil-user"></i>
                        </div>
                        <div class="input-field">
                            <input type="text" name="lname" placeholder="Enter last name" pattern="[a-zA-Z]+" title="Only characters allowed" maxlength="20" required>
                            <i class="uil uil-user"></i>
                        </div>
                        <div class="input-field">
                            <input type="email" name="email" placeholder="Enter your email" pattern=".+@+.+\.com" title="email must end in .com" maxlength="40" required>
                            <i class="uil uil-envelope icon"></i>
                        </div>
                        
                        <div class="input-field">
                            <input type="text" name="pnum" placeholder="Enter Phone Number" pattern="[0-9]{10}" title="10 digit no characters" minlength="10" maxlength="10" required>
                            <i class="uil uil-phone icon"></i>
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

                        <div class="input-field">
                            <input type="number" name="bnum" placeholder="Building Number" placeholder="Enter building number" min="1">
                            <i class="uil uil-home icon"></i>
                        </div>
                        <div class="input-field">
                            <input type="text" name="street-name" placeholder="Street Name" pattern="[a-zA-Z]+" title="Only characters allowed" maxlength="25" required>
                            <i class="uil uil-home icon"></i>
                        </div>
                        <div class="input-field">
                            <input type="text" name="city" placeholder="City" pattern="[a-zA-Z]+" title="Only characters allowed" maxlength="20" required>
                            <i class="uil uil-home icon"></i>
                        </div>
                        <div class="input-field">
                            <input type="text" name="state" placeholder="State" pattern="[a-zA-Z]+" title="Only characters allowed" maxlength="12" required>
                            <i class="uil uil-home icon"></i>
                        </div>
                        <div class="input-field">
                            <input type="text" name="zip" placeholder="Zipcode" pattern="[0-9]{5}" title=" 5 digit zipcode" minlength="5" maxlength="5" required>
                            <i class="uil uil-home icon"></i>
                        </div>
    
                        <div class="checkbox-text">
                            <div class="checkbox-content">
                                <input type="checkbox" id="sigCheck">
                                <label for="sigCheck" class="text">Remember me</label>
                            </div>
                    
                        </div>
    
                        <div class="input-field button">
                            <!--<input type="button" value="Login Now">-->
                            <button type="submit" name="submit" id="sign-up-btn">Sign up</button>
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
                                    // echo "<p>Passwords don't match!</p>";
                                    echo "<script> location.href='index-login.php'; </script>";
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
