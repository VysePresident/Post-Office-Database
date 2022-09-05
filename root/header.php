<?php
    session_start();
?> 

<nav>
    <a href="index.php"><img src="../images/pinkpostlogo.png"></a>
    <div class="nav-links" id="navLinks">
        <ul>
            <li><a href="../pages/index.php">HOME</a></li>
            <li><a href="../pages/index-contact.php">CONTACT</a></li>
            <?php
                if (isset($_SESSION["useruid"]))
                {
                    if(Isset($_SESSION["role"]) && ($_SESSION["role"] == "employee"))
                    {
                        echo '<li><a href="../pages/employee-services.php">Employee Services</a></li>';
                    }
                    else if(Isset($_SESSION["role"]) && ($_SESSION["role"] == "customer"))
                    {
                        
                        echo '<li><a href="../pages/customer-services.php">Customer Services</a></li>';
                    }
                    else if(Isset($_SESSION["role"]) && ($_SESSION["role"] == "manager"))
                    {
                        
                        echo '<li><a href="../pages/admin-services-addPerm.php">Manager Services</a></li>';
                    }
                    else if(Isset($_SESSION["role"]) && ($_SESSION["role"] == "hq manager"))
                    {
                        
                        echo '<li><a href="../pages/admin-services-addPerm.php">Manager Services</a></li>';
                    }
                    echo '<li><a href="../includes/logout.inc.php">Log out</a></li>';
                }
                else
                {
                    //echo '<li><a href="index-employee-signup.php">EMPLOYEE REGISTRATION</a></li>';
                    // echo '<li><a href="index-login.php">REGISTER / SIGN IN</a></li>';
                    echo '<li><a href="../pages/index-login.php">REGISTER / SIGN IN</a></li>';
                }
            ?>
        </ul>
    </div>
</nav>
