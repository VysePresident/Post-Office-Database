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
        <?php
            include_once '../a-sidebar.php';
        ?>


        
        <!-- content -->
        <div class="content">
        <?php
             // grab all packages in transit who's destination is this office
            /*
            $incomingSql = "SELECT Package.Package_ID, Package.Customer_ID
            FROM PostOffice.Package
                LEFT JOIN PostOffice.Tracking_Status ON Package.Package_ID = Tracking_Status.Package_ID
            WHERE Destination_Office = ? AND Package_Status = ?;";
            */

            $incomingSql = "SELECT subQuery.Package_ID, subQuery.Customer_ID, Customer.email From 
            (SELECT Package.Package_ID, Package.Customer_ID
            FROM PostOffice.Package
                LEFT JOIN PostOffice.Tracking_Status ON Package.Package_ID = Tracking_Status.Package_ID
            WHERE Destination_Office = ? AND Package_Status = ?) AS subQuery
                LEFT JOIN PostOffice.Customer ON subQuery.Customer_ID = Customer.Customer_ID;";

            $stmtIncoming = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmtIncoming, $incomingSql)){
                header("location: ../pages/index-login.php?error=stmtfailed");
                exit();   
            }

            $pkgStatus = 'transit';
            mysqli_stmt_bind_param($stmtIncoming, "is", $_SESSION["officeID"], $pkgStatus);
            mysqli_stmt_execute($stmtIncoming);

            $results  = mysqli_stmt_get_result($stmtIncoming);
            $allRows = mysqli_num_rows($results); // rows
            $output = mysqli_fetch_all($results); // columns
        ?>


            <div class="form-col">
                    <div>
                        <i class="fa fa-truck" aria-hidden="true"></i>
                        <span>
                            <h5>Mark Packages Recieved</h5>
                        </span>
                    </div>

                    <form method="post" action="emp-recieved-pkg-2.php" autocomplete="off">
                        <div>
                            <span>
                                <h2>Package ID</h2>
                            </span>
                        </div>
                        <input type="text" name="package-id" placeholder="Select Package ID From Table Below" list="possible-ids">
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
                    <button type="submit" class="hero-btn red-btn" id="mark-recieved-btn">Mark Recieved</button>

                    <!----------------------------------------------------->
                    <br></br>
                    <div>
                        <h5>Incoming Packages</h5>
                    </div>
                    <p>The following packages are expected to be incoming and should be marked as recieved upon their arrival.</p>
                    
                    <table class="content-table">
                        <thead>
                            <tr> 
                                <th>Package ID</th>
                                <th>Customer ID</th>
                                <th>Customer Email</th>
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