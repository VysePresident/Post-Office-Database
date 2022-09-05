<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Self Services</title>
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
    <!--
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

        <?php 
            $incomingSql = "SELECT Package.Package_ID, Package.Package_Type, Package.Package_Weight, Package.Package_Volume, Package.Priority 
            FROM PostOffice.Package
                LEFT JOIN PostOffice.Tracking_Status ON Package.Package_ID = Tracking_Status.Package_ID
            WHERE Package_Status = ?;";

            $stmtIncoming = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmtIncoming, $incomingSql)){
                header("location: ../pages/index-login.php?error=stmtfailed");
                exit();   
            }
            
            $pkgStatus = 'delivered';
            mysqli_stmt_bind_param($stmtIncoming, "s", $pkgStatus);
            mysqli_stmt_execute($stmtIncoming);

            $results  = mysqli_stmt_get_result($stmtIncoming);
            $allRows = mysqli_num_rows($results); // rows
            $output = mysqli_fetch_all($results); // columns
        ?>
        
        <!-- content -->
        <div class="content">

            <div class="form-col">
                    <div>
                        <i class="fa fa-user-secret" aria-hidden="true"></i>
                        <span>
                            <h5>Report Lost Package</h5>
                        </span>
                    </div>

                    <form method="post" action="cust-report-lost-2.php" autocomplete="off">
                        <div>
                            <span>
                                <h2>Package ID</h2>
                            </span>
                        </div>
                        <!-- <input type="text" name="package-id" placeholder="Enter package id to report as lost"> -->
                        <!-- <input type="text" name="pkg-id" placeholder="Enter package's id"> -->
                    <input type="text" name="pkg-id" placeholder="Select Package ID From Table Below" list="possible-ids">
                    <datalist id="possible-ids"> 
                        <?php

                            // 0 and 1 refer to the items in the select
                            $enteredLoop = 0;
                            for ($x = 0; $x <= $allRows-1; $x++) {
                                echo "<option>". $output[$x][0] ."</option>";
                                $enteredLoop = 1;
                            }
                            if ($enteredLoop === 0) {
                                echo "<option> None </option>";
                            }
                        ?>
                    </datalist>



                    <button type="submit" class="hero-btn red-btn" id="mark-lost-btn">Report</button>

                    <!----------------------------------------------------->
                    <br></br>
                    <div>
                        <h5>Delivered Packages</h5>
                    </div>
                    <p>The following packages were marked as delieverd. If the destined address never recieved the package, please report it above using the unique package ID</p>
                    
                    <table class="content-table">
                        <thead>
                            <tr> 
                                <th>Package ID</th>
                                <th>Type</th>
                                <th>Weight</th>
                                <th>Volume</th>
                                <th>Priority</th>
                            </tr>    
                        </thead>
                        <tbody>
                            <?php
                            // 0 and 1 refer to the items in the select
                            for ($x = 0; $x <= $allRows-1; $x++) {
                                echo "<tr>
                                    <td>" . $output[$x][0] . "</td>
                                    <td>" . $output[$x][1] . "</td>
                                    <td>" . $output[$x][2] . "</td>
                                    <td>" . $output[$x][3] . "</td>
                                    <td>" . $output[$x][4] . "</td>
                                    </tr>";
                            }

                            ?>
                        </tbody>    
                    </table>              
            </div> 
            
            <div class="form-col">
                    <!-- TODO: can't remove: will mess up side bar, so just hide by using color white in css -->
                    <p class="heading"> HEADING </p>
                    <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>
            </div> 

        </div>

    </section>
    
</body>
</html>    