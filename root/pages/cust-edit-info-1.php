<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Self Services</title>
<link rel="stylesheet" href="../css/customer-services.css">
<!-- font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,600,700&display=swap" rel="stylesheet">
<!-- icons -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
    include("../includes/dbh.inc.php");
?>
<section class="sub-header">
    <?php
        include_once '../header.php';
    ?>
</section>
    <!-- This section replaced with universal header above
    <section class="sub-header">
        <nav>
           
            <a href=""><img src="../images/pinkpostlogo.png"></a>
            <div class="nav-links" id="navLinks">  
                <ul>
                    <li><a href="">HOME</a></li>
                    <li><a href="">CONTACT</a></li>
                    <li><a href="customer-services.php">CUSTOMER SELF SERVICES</a></li>
                    <li><a href="">LOGOUT</a></li>
                </ul>
            </div>
        </nav>
            <h1></h1>
    </section> -->

    <!-- Side Bar -->
    <section class="side-bar-container">
        <div class="side-bar" id="sidebar">
            <div class="list">
                <a href="customer-services.php"><div class="icons"><i class="fa fa-user" aria-hidden="true"></i><p id="icon-txt">Customer Information</p></div></a>
                <a href="cust-pkg-info-1.php"><div class="icons"><i class="fa fa-dropbox" aria-hidden="true"></i><p id="icon-txt">Package Information</p></div></a>
                <a href="cust-snd-pkg-1.php"><div class="icons"><i class="fa fa-truck" aria-hidden="true"></i><p id="icon-txt">Create a Package</p></div></a>
                <a href="cust-report-lost-1.php"><div class="icons"><i class="fa fa-user-secret" aria-hidden="true"></i><p id="icon-txt">Report Lost</p></div></a>
                <!-- <a href="cust-shop.php"><div class="icons"><i class="fa fa-book" aria-hidden="true"></i><p id="icon-txt">Shop</p></div></a> -->
            </div>
        </div>

        

        <!-- content -->
        <div class="content">
        <?php 
            $getAddrSql = "SELECT Building_Num, Street_Name, City, State, Zipcode 
                            FROM PostOffice.Address
                            WHERE Address_Key = ?;";
            $stmtGetAddr = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmtGetAddr, $getAddrSql)) {
                header("location: ../pages/index-login.php?error=stmtfailed");
                exit();   
            }
            mysqli_stmt_bind_param($stmtGetAddr,"i",$_SESSION["custAddressKey"]);
            mysqli_stmt_execute($stmtGetAddr);

            $resultAddr =  mysqli_stmt_get_result($stmtGetAddr);
            $resultAddrCheck = mysqli_num_rows($resultAddr);

            if ($resultAddrCheck > 0){
                while($check=mysqli_fetch_assoc($resultAddr)){
                    $holdBNum = $check['Building_Num'];
                    $holdStreet = $check['Street_Name'];
                    $holdCity = $check['City'];
                    $holdState = $check['State'];
                    $holdZip = $check['Zipcode'];
                }
            }
        ?>

            <div class="form-col">
                    <div>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>
                        <h5>EDIT Customer Information</h5>
                    </span>
                    </div>

                    <form method="post" action="cust-edit-info-2.php">
                    <div>
                        <span>
                            <h2>First Name</h2>
                        </span>
                    </div>
                    <input type="text" name="fname" placeholder="<?php
                                if (isset($_SESSION["firstName"]))
                                {
                                    echo $_SESSION["firstName"];
                                    
                                }
                            ?>">

                    <div>
                        <span>
                            <h2>Last Name</h2>
                        </span>
                    </div>
                    <input type="text" name="lname" placeholder="<?php
                                if (isset($_SESSION["lastName"]))
                                {
                                    echo $_SESSION["lastName"];
                                    
                                }
                            ?>">
                    <div>
                        <span>
                            <h2>Email</h2>
                        </span>
                    </div>
                    <input type="text" name="email" placeholder="<?php
                                if (isset($_SESSION["useruid"]))
                                {
                                    echo $_SESSION["useruid"];
                                    
                                }
                            ?>">

                            

                    <div>
                        <span>
                            <h2>Building #</h2>
                        </span>
                    </div>
                    <input type="text" name="building-num" placeholder="<?php echo $holdBNum ?>">

                    <div>
                        <span>
                            <h2>Street Name</h2>
                        </span>
                    </div>
                    <input type="text" name="street-name" placeholder="<?php echo $holdStreet ?>" maxlength="25">

                    <div>
                        <span>
                            <h2>City</h2>
                        </span>
                    </div>
                    <input type="text" name="city" placeholder="<?php echo $holdCity ?>" maxlength="20">
                    
                    <div>
                        <span>
                            <h2>State</h2>
                        </span>
                    </div>
                    <input type="text" name="state" placeholder="<?php echo $holdState ?>">

                    <div>
                        <span>
                            <h2>Zipcode</h2>
                        </span>
                    </div>
                    <input type="text" name="zip" placeholder="<?php echo $holdZip ?>">

                    <div>
                        <span>
                            <h2>Phone Number</h2>
                        </span>
                    </div>
                    <input type="text" name="phone-number" placeholder="<?php
                                if (isset($_SESSION["custpnum"]))
                                {
                                    echo $_SESSION["custpnum"];
                                    
                                }
                            ?>">
                    
                    <button type="submit" class="hero-btn red-btn" id="emp-save-info-btn">Save Information</button>

                    <p class="heading"> HEADING </p>
                    <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>

                    </form>
            </div> 
            
        </div>

    </section>
    
</body>
</html>    