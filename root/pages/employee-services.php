<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Self Services</title>
<link rel="stylesheet" href="../css/employee-services.css">
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
                    <li><a href="employee-services.php">EMPLOYEE SELF SERVICES</a></li>
                    <li><a href="">LOGOUT</a></li>
                </ul>
            </div>
        </nav>
            <h1></h1>
    </section> 
    -->
    
    <!-- Side Bar -->
    <section class="side-bar-container">
        <?php
            include_once '../a-sidebar.php';
        ?>

        <!-- content -->
        <div class="content">
        
        <!-- Get Address components for display -->
        <?php 
            $getAddrSql = "SELECT Building_Num, Street_Name, City, State, Zipcode 
                            FROM PostOffice.Address
                            WHERE Address_Key = ?;";
            $stmtGetAddr = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmtGetAddr, $getAddrSql)) {
                header("location: ../pages/index-login.php?error=stmtfailed");
                exit();   
            }
            mysqli_stmt_bind_param($stmtGetAddr,"i",$_SESSION["empAddressKey"]);
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
                        <h5>Employee Information</h5>
                    </span>
                </div>

                <div>
                    <span>
                        <h2>First Name</h2>
                        <p id="display-info">
                            <?php
                                if (isset($_SESSION["firstName"]))
                                {
                                    echo $_SESSION["firstName"];
                                    
                                }
                            ?>
                        </p>
                    </span>
                </div>

                <div>
                    <span>
                        <h2>Last Name</h2>
                        <p id="display-info">
                            <?php
                                if (isset($_SESSION["lastName"]))
                                {
                                    echo $_SESSION["lastName"];
                                    
                                }
                            ?>
                        </p>
                    </span>
                </div>

                <div>

                </div>

                <div>
                    <span>
                        <h2>Employee ID</h2>
                        <p id="display-info">
                            <?php
                                if (isset($_SESSION["empid"]))
                                {
                                    echo $_SESSION["empid"];
                                    
                                }
                            ?>
                        </p>
                    </span>
                </div>
                
                <div>
                    <span>
                        <h2>Employee Email</h2>
                        <p id="display-info">
                            <?php
                                if (isset($_SESSION["useruid"]))
                                {
                                    echo $_SESSION["useruid"];
                                    
                                }
                            ?>
                        </p>
                    </span>
                </div>

                <div>
                    <span>
                        <h2>Building #</h2>
                    </span>
                </div>

                <div>
                    <span>
                        <p id="display-info">
                            <?php
                                if (isset($holdBNum))
                                {
                                    echo $holdBNum;
                                    
                                }
                            ?>
                        </p>
                    </span>
                </div>

                <div>
                    <span>
                        <h2>Street Name</h2>
                    </span>
                </div>

                <div>
                    <span>
                        <p id="display-info">
                            <?php
                                if (isset($holdStreet))
                                {
                                    echo $holdStreet;
                                    
                                }
                            ?>
                        </p>
                    </span>
                </div>
                
                <div>
                    <span>
                        <h2>City Name</h2>
                    </span>
                </div>

                <div>
                    <span>
                        <p id="display-info">
                            <?php
                                if (isset($holdCity))
                                {
                                    echo $holdCity;
                                    
                                }
                            ?>
                        </p>
                    </span>
                </div>
                
                <div>
                    <span>
                        <h2>State Name</h2>
                    </span>
                </div>

                <div>
                    <span>
                        <p id="display-info">
                            <?php
                                if (isset($holdState))
                                {
                                    echo $holdState;
                                    
                                }
                            ?>
                        </p>
                    </span>
                </div>

                <div>
                    <span>
                        <h2>Zipcode</h2>
                    </span>
                </div>

                <div>
                    <span>
                        <p id="display-info">
                            <?php
                                if (isset($holdZip))
                                {
                                    echo $holdZip;
                                    
                                }
                            ?>
                        </p>
                    </span>
                </div>


                <div>
                    <span>
                        <h2>Phone Number</h2>
                        <p id="display-info">   
                            <?php
                                if (isset($_SESSION["pnum"]))
                                {
                                    echo $_SESSION["pnum"];
                                    
                                }
                            ?>
                        </p>
                    </span>
                </div>

                <div>
                    <span>
                        <h2>Works At</h2>
                        <p id="display-info">   
                            <?php
                                if (isset($_SESSION["officeID"]))
                                {
                                    $tracksql = "SELECT * FROM Post_Office WHERE Office_ID = ?;";
                                    $stmtTrack = mysqli_stmt_init($conn);
                             
                                    if (!mysqli_stmt_prepare($stmtTrack, $tracksql)){
                                        header("location: ../pages/index-login.php?error=stmtfailed");
                                        exit();
                                    }
                                    mysqli_stmt_bind_param($stmtTrack, "i", $_SESSION["officeID"]);
                                    mysqli_stmt_execute($stmtTrack);
                                    
                                    $trackStartRow = mysqli_stmt_get_result($stmtTrack);
                                    $stmtTrack_check = mysqli_num_rows($trackStartRow);

                                    //echo $_SESSION['officeID'];

                                //Check for results
                                    if($stmtTrack_check > 0){
                                        while($check = mysqli_fetch_assoc($trackStartRow)){
                                            echo $check['Office_Name'];
                                        }
                                        
                                    }
                                }
                                else {
                                    echo "No PO found.";
                                }
                            ?>
                        </p>
                    </span>
                </div>

                <a href="emp-edit-info-1.php"><button class="hero-btn red-btn" id="emp-edit-info-btn">Edit Information</button></a>

                <!-- TODO: can't remove: will mess up side bar, so just hide by using color white in css -->
                <p class="heading"> HEADING </p>
                <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>
            </div> 
            
        </div>

    </section>
    
</body>
</html>    