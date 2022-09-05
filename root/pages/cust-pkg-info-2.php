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

   <!-- <section class="sub-header">
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
                $packageID = $_POST['pkg-id'];



                $sqlLost = "SELECT * FROM Tracking_Status WHERE Package_ID = ?;";
                $stmtLost = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmtLost, $sqlLost)){
                    header("location: ../pages/index-login.php?error=stmtfailed");
                    exit();   
                }
                mysqli_stmt_bind_param($stmtLost, "i", $packageID);
                mysqli_stmt_execute($stmtLost);

                $results  = mysqli_stmt_get_result($stmtLost);
                $rowsWithPkgID = mysqli_num_rows($results); // rows
                $output = mysqli_fetch_all($results); // columns

                $currentStatus = $output[$rowsWithPkgID - 1][1];






                //$packageIDConverted = (int) $packageID;
                $pkgLocation = "SELECT * FROM Tracking WHERE Package_ID = ?;";

    
                $stmtRKeys = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmtRKeys, $pkgLocation)){
                    header("location: ../pages/index-login.php?error=stmtfailed");
                    exit();   
                }
                
                mysqli_stmt_bind_param($stmtRKeys, "i", $packageID);
                mysqli_stmt_execute($stmtRKeys);

                
                $results  = mysqli_stmt_get_result($stmtRKeys);
                $rowsWithPkgID = mysqli_num_rows($results); // rows
                $output = mysqli_fetch_all($results); // columns

                $currentOfficeID = $output[$rowsWithPkgID - 1][1]; // stopNum not tracking office bc when and employee updates tracking stopnum will update to them which means it has arrived for sure. Tracking office will show where it's heading next / where it was sent

                $currentOfficeName = "";

                if ($currentOfficeID  === 1) {
                    $currentOfficeName = "Houston Branch";
                }
                elseif ($currentOfficeID  === 2) {
                    $currentOfficeName = "Austin Branch";
                } else {
                    $currentOfficeName = "Dallas Branch";
                }

                $dateArrived = $output[$rowsWithPkgID - 1][2]; // DateArrived col from tracking table
            ?>

            <div class="form-col">
                <div>
                    <i class="fa fa-dropbox" aria-hidden="true"></i>
                    <span>
                        <h5>Package Info For ID: <?php echo "$packageID" ?></h5>
                    </span>
                </div>

                <div>
                    <span>
                        <h2>Package Location</h2>
                    </span>
                </div>

                <div>
                    <span>
                        <?php
                                if (!isset($currentOfficeID)) {
                                    echo "<p id='display-info'> Package has not yet been dropped off at a Pink Pastel Post Office to begin delivery <?php echo '$currentOfficeID' ?></p>";
                                }
                                else {
                                    echo "<p id='display-info'>". $currentOfficeName ."<?php echo '$currentOfficeID' ?></p>";
                                }
                        ?>
                    </span>
                </div>

                <div>
                    <span>
                        <h2>Time Arrived At Current Post Office</h2>
                    </span>
                </div>

                <div>
                    <span>
                        <p id="display-info"><?php echo "$dateArrived" ?></p>
                    </span>
                </div>

                <?php 
                    if ($currentStatus === "lost") {
                        echo "<p style='color:red'> This package has been marked as lost by it's current package location. Please call one of our offices to see how to proceed.</p>";
                    }
                ?>

            </div> 

            <div class="location-history-list"> 
                    <h2>Package Location History</h2>
                  

                            <?php
                            include("../includes/dbh.inc.php");
                            ?>
                            <?php
                                //query Items row
                                $packageID = $_POST['pkg-id'];
                                //$packageIDConverted = (int) $packageID;
                                $pkgLocation = "SELECT * FROM Tracking WHERE Package_ID = ?;";

                    
                                $stmtRKeys = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($stmtRKeys, $pkgLocation)){
                                    header("location: ../pages/index-login.php?error=stmtfailed");
                                    exit();   
                                }
                                
                                mysqli_stmt_bind_param($stmtRKeys, "i", $packageID);
                                mysqli_stmt_execute($stmtRKeys);

                                $results  = mysqli_stmt_get_result($stmtRKeys);
                                $rowsWithPkgID = mysqli_num_rows($results); // rows
                                $output = mysqli_fetch_all($results); // columns
                                echo "<ul>";
                                for ($x = 0; $x <= $rowsWithPkgID-1; $x++) {
                                    //echo $output[$x][4];

                                    $postOfficeName = "";
                                    if ($output[$x][1]  === 1) {
                                        $postOfficeName = "Houston Branch";
                                    }
                                    elseif ($output[$x][1]  === 2) {
                                        $postOfficeName = "Austin Branch";
                                    } else {
                                        $postOfficeName = "Dallas Branch";
                                    }

                                    echo '<li><span>' .$x. '</span>' .$postOfficeName.'</li>'; // also changed to stopnum here 
                                    //echo '<li><span>' .$x. '</span>'. 'Post Office ' .$output[$x][4].'</li>';
                                  }
                                echo '</ul>';
                            ?>
            </div>

            <!-- TODO: can't remove: will mess up side bar, so just hide by using color white in css -->
            <p class="heading"> HEADING </p>
            <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>
            
        </div>

    </section>
    
</body>
</html>    