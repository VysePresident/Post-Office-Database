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
    <section class="sub-header">
        <?php
            include_once '../header.php';
        ?>
    </section>

    <?php
    include("../includes/dbh.inc.php");
    ?>

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

            <div class="form-col">
                <div>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span>
                        <h5>Employee Notifications</h5>
                    </span>
                </div>


                <div>
                    <span>
                        <h5>Item Notifications</h5>
                    </span>
                </div>
                <p> The following items should be restocked soon </p>
                <br>
                <table class="content-table">
                        <thead>
                            <tr>
                                
                                <th>Num</th>
                                <th>PO_ID</th>
                                <th>Item_Name</th>
                                <th>Item_Count</th>
                                <th>Item_Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // trigger: grabs the office id session and check the item_restock_notifications table
                                // if there's a low item in stock belonging to our post office it will show it in the front-end
                                // log in as digdug@gmail who belongs to office ID 1 and you'll see he gets back the item low in stock
                                // belonging to PO_ID 1.
                                $officeID = $_SESSION["officeID"];
                                if(Isset($_SESSION["role"]) && ($_SESSION["role"] == "hq manager")) {
                                    $tracksql = "SELECT * from Item_Restock_Notifications WHERE isNew = 1;";
                                } else{
                                    $tracksql = "SELECT * from Item_Restock_Notifications WHERE PO_ID = ? AND isNew = 1;";
                                }
                                $stmtTrack = mysqli_stmt_init($conn);
                             
                                    if (!mysqli_stmt_prepare($stmtTrack, $tracksql))
                                    {
                                        header("location: ../pages/index-login.php?error=stmtfailed");
                                        exit();
                                    }
                                if(Isset($_SESSION["role"]) && ($_SESSION["role"] == "hq manager")) {

                                } else{
                                    mysqli_stmt_bind_param($stmtTrack, "i", $officeID);
                                }
                                    mysqli_stmt_execute($stmtTrack);
                                    
                                    $trackStartRow = mysqli_stmt_get_result($stmtTrack);
                                    $stmtTrack_check = mysqli_num_rows($trackStartRow);



                                //Check for results
                                if($stmtTrack_check > 0){
                                    while($check = mysqli_fetch_assoc($trackStartRow)){

                                        echo "<tr> 
                                        <td>" . $check['Num'] . "</td>
                                        <td>" . $check['PO_ID'] . "</td>
                                        <td>" . $check['Item_Name'] . "</td>
                                        <td>" . $check['Item_Count'] . "</td>
                                        <td>" . $check['Item_Status'] . "</td>
                                        </tr>";

                                    }
                                }
                            ?>
                            
                        </tbody>
                    </table>



                    <div>
                    <span>
                        <h5>Package Notifications</h5>
                    </span>
                    </div>

                    <p> The following packages have been sitting at this office for too long.</p>
                    <br>

                    <table class="content-table">
                        <thead>
                            <tr>
                                
                                <th>Package_ID</th>
                                <th>DateArrived</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // trigger: grabs all of the packages based off the current session employee's office
                                // belonging. Tested this with digdug. When any package in his office arrived date > x
                                // then it will display it in his notifications tab which he should check every morning.
                                $officeID = $_SESSION["officeID"];
                                $tracksql = "SELECT * from Tracking WHERE Tracking_Office_ID = ?;";
                                $stmtTrack = mysqli_stmt_init($conn);
                             
                                    if (!mysqli_stmt_prepare($stmtTrack, $tracksql))
                                    {
                                        header("location: ../pages/index-login.php?error=stmtfailed");
                                        exit();
                                    }
                                    mysqli_stmt_bind_param($stmtTrack, "i", $officeID);
                                    mysqli_stmt_execute($stmtTrack);
                                    
                                    $trackStartRow = mysqli_stmt_get_result($stmtTrack);
                                    $stmtTrack_check = mysqli_num_rows($trackStartRow);

                                //Check for results
                                if($stmtTrack_check > 0){
                                    while($check = mysqli_fetch_assoc($trackStartRow)){
                                        
                                        /*
                                        date_default_timezone_set("America/Los_Angeles");
                                        $origin = new DateTime($check['DateArrived']);
                                        // $current = new DateTime(time());
                                        $current = new DateTime(date("Y-m-d H:i:s"));
                                        $interval = date_diff($origin, $current);
                                        $hoursPassed = intval($interval->format("%h"));
                                        */

                                        $now    = time();
                                        $target = strtotime($check['DateArrived']);
                                        $diff   = $now - $target;

                                        // 15 minutes = 15*60 seconds = 900
                                        if ($diff >= 32400) {
                                            echo "<tr> 
                                            <td>" . $check['Package_ID'] . "</td>
                                            <td>" . $check['DateArrived'] . "</td>
                                            </tr>";
                                        }

                                        /*
                                        if ($hoursPassed >= 9) {
                                            echo "<tr> 
                                            <td>" . $check['Package_ID'] . "</td>
                                            <td>" . $check['DateArrived'] . "</td>
                                            </tr>";
                                        }
                                        */

                                    }
                                }
                            ?>
                            
                        </tbody>
                    </table>

                </div>


                <!-- <a href="emp-edit-info-1.php"><button class="hero-btn red-btn" id="emp-edit-info-btn">Edit Information</button></a> -->

                <!-- TODO: can't remove: will mess up side bar, so just hide by using color white in css -->
                <p class="heading"> HEADING </p>
                <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>
            </div> 
            
        </div>

    </section>
    
</body>
</html>    