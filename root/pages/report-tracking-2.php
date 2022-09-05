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
       <?php
            include_once '../includes/dbh.inc.php';

            $prio = $_POST['prio-num'];
            $type = $_POST['type'];

            if(empty($_POST['prio-num']))
            {
                $prio = '%';
            }
            if(empty($_POST['type']))
            {
                $type = '%';
            }

            //Set min date
            $min_date = $_POST['min_date'];
            $min_date = $min_date . "-01 00:00:00";
            $min_date = new DateTime($min_date);
            $min_date = $min_date->format('Y-m-d H:i:s');

            //Set max date
            $max_date = $_POST['max_date'];
            $max_date = $max_date . "-01 00:00:00";
            $max_date = new DateTime($max_date);
            $max_date = $max_date->format('Y-m-d H:i:s');

            //Start monthly loop
                    //$interval = DateInterval::createFromDateString('1 month');
                    //$period = new DatePeriod($min_date, $interval, $max_date);

            
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
        <!-- REPORT SUMMARY-->
        <div class="content">

            <div class="form-col">
            <div>
            <i class="fa fa-database" aria-hidden="true"></i>
                    <span>
                        <?php
                        echo "<h5>Package Report from " . substr($min_date, 0, 10) . " to " . substr($max_date, 0, 10) . "</h5>"
                        ?>
                    </span>
                </div>
             <table class="content-table">
                <thead>
                    <tr>
                        <!--HEADINGS-->
                        
                        <th>Packages Delivered</th>
                        <th>Value of Delivered Packages</th>

                        <th>Packages in Circulation</th>
                        <th>Value of Circulating Packages</th>

                        <th>Packages Lost</th>
                        <th>Value of Lost Packages</th>

                        <th>Total Packages</th>
                        <th>Total Value</th>
                        <th>Average Package Price</th>
                        <!--<th>Average Delivery Time</th>-->
                    </tr>
                </thead>
                <tbody>
                <!--My query-->
                <?php

                    //Get Total Value of delivered Packages and Avg per Package
                    $sqlDeliverRevenue = "SELECT SUM(Price) as totalDeliverRevenue
                    FROM Tracking_Summary JOIN
                    (SELECT Tracking.Package_ID, MAX(StopNum) AS location 
                    FROM Tracking GROUP BY Package_ID) AS T
                    ON Tracking_Summary.Package_ID = T.Package_ID 
                    AND Tracking_Summary.StopNum = T.location
                    WHERE DateArrived between ? AND ? AND Tracking_Summary.Package_Status = 'delivered'
                    AND Tracking_Summary.Priority LIKE ? AND Tracking_Summary.Package_Type LIKE ?;";
                    
                    $stmtDeliverRevenue = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtDeliverRevenue, $sqlDeliverRevenue))
                    {
                        header("location: ../pages/index.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmtDeliverRevenue, "ssss", $min_date, $max_date, $prio, $type);
                    mysqli_stmt_execute($stmtDeliverRevenue);
                    
                    $revenueDeliverResult = mysqli_stmt_get_result($stmtDeliverRevenue);
                    $revenueDeliverResultCheck = mysqli_num_rows($revenueDeliverResult);

                    if($revenueDeliverResultCheck > 0)
                    {
                        $row1 = mysqli_fetch_assoc($revenueDeliverResult);
                        $revenueDeliverTotal = $row1['totalDeliverRevenue'];
                    }

                    //Get Total Value of circulating Packages and Avg per Package
                    $sqlActiveRevenue = "SELECT SUM(Price) as totalActiveRevenue
                    FROM Tracking_Summary JOIN 
                    (SELECT Tracking.Package_ID, MAX(StopNum) AS location FROM Tracking GROUP BY Package_ID) AS T
                    ON Tracking_Summary.Package_ID = T.Package_ID AND Tracking_Summary.StopNum = T.location
                    WHERE (Tracking_Summary.Package_Status = 'office' OR Tracking_Summary.Package_Status = 'transit')
                    AND Tracking_Summary.DateArrived BETWEEN ? AND ?
                    AND Tracking_Summary.Priority LIKE ? AND Tracking_Summary.Package_Type LIKE ?;";
                    
                    $stmtActiveRevenue = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtActiveRevenue, $sqlActiveRevenue))
                    {
                        header("location: ../pages/index.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmtActiveRevenue, "ssss", $min_date, $max_date, $prio, $type);
                    mysqli_stmt_execute($stmtActiveRevenue);
                    
                    $revenueActiveResult = mysqli_stmt_get_result($stmtActiveRevenue);
                    $revenueActiveResultCheck = mysqli_num_rows($revenueActiveResult);

                    if($revenueActiveResultCheck > 0)
                    {
                        $row1 = mysqli_fetch_assoc($revenueActiveResult);
                        $revenueActiveTotal = $row1['totalActiveRevenue'];
                    }
                    
                    //Get Total Value of lost Packages and Avg per Package
                    $sqlLostRevenue = "SELECT SUM(Price) as totalLostRevenue
                    FROM Tracking_Summary JOIN
                    (SELECT Tracking.Package_ID, MAX(StopNum) AS location 
                    FROM Tracking GROUP BY Package_ID) AS T
                    ON Tracking_Summary.Package_ID = T.Package_ID 
                    AND Tracking_Summary.StopNum = T.location
                    WHERE DateArrived between ? and ? 
                    AND Tracking_Summary.Package_Status = 'lost'
                    AND Tracking_Summary.Priority LIKE ? AND Tracking_Summary.Package_Type LIKE ?;";
                    
                    $stmtLostRevenue = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtLostRevenue, $sqlLostRevenue))
                    {
                        header("location: ../pages/index.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmtLostRevenue, "ssss", $min_date, $max_date, $prio, $type);
                    mysqli_stmt_execute($stmtLostRevenue);
                    
                    $revenueLostResult = mysqli_stmt_get_result($stmtLostRevenue);
                    $revenueLostResultCheck = mysqli_num_rows($revenueLostResult);

                    if($revenueLostResultCheck > 0)
                    {
                        $row1 = mysqli_fetch_assoc($revenueLostResult);
                        $revenueLostTotal = $row1['totalLostRevenue'];
                        if($revenueLostTotal == NULL)
                        {
                            $revenueLostTotal = floatval(0.00);
                        }
                    }

                    //Get Total Value of Packages and Avg per Package
                    $sqlRevenue = "SELECT SUM(Price) as totalRevenue, 
                    TRUNCATE(AVG(Price),2) as meanTotalRevenue
                    FROM Tracking_Summary JOIN
                    (SELECT Tracking.Package_ID, MAX(StopNum) AS location 
                    FROM Tracking GROUP BY Package_ID) AS T
                    ON Tracking_Summary.Package_ID = T.Package_ID 
                    AND Tracking_Summary.StopNum = T.location
                    WHERE DateArrived between ? and ?
                    AND Tracking_Summary.Priority LIKE ? AND Tracking_Summary.Package_Type LIKE ?;";
                    
                    $stmtRevenue = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtRevenue, $sqlRevenue))
                    {
                        header("location: ../pages/index.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmtRevenue, "ssss", $min_date, $max_date, $prio, $type);
                    mysqli_stmt_execute($stmtRevenue);
                    
                    $revenueTotalResult = mysqli_stmt_get_result($stmtRevenue);
                    $revenueTotalResultCheck = mysqli_num_rows($revenueTotalResult);

                    if($revenueTotalResultCheck > 0)
                    {
                        $row1 = mysqli_fetch_assoc($revenueTotalResult);
                        $revenueTotal = $row1['totalRevenue'];
                        $revenueAverage = $row1['meanTotalRevenue'];
                    }
                  
                    //Get Total delivered packages
                    $sqlDeliver = 'SELECT COUNT(*) as totalDelivered
                    FROM Tracking_Summary JOIN 
                    (SELECT Tracking.Package_ID, MAX(StopNum) AS location 
                    FROM Tracking GROUP BY Package_ID) AS T
                    ON Tracking_Summary.Package_ID = T.Package_ID AND Tracking_Summary.StopNum = T.location
                    WHERE Tracking_Summary.Package_Status = "delivered"
                    AND DateArrived between ? and ?
                    AND Tracking_Summary.Priority LIKE ? AND Tracking_Summary.Package_Type LIKE ?;';

                    $stmtDeliver = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtDeliver, $sqlDeliver))
                    {
                        header("location: ../pages/index.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmtDeliver, "ssss", $min_date, $max_date, $prio, $type);
                    mysqli_stmt_execute($stmtDeliver);

                    $deliverResult = mysqli_stmt_get_result($stmtDeliver);
                    $deliverResultCheck = mysqli_num_rows($deliverResult);

                    if($deliverResultCheck > 0)
                    {
                        $row1 = mysqli_fetch_assoc($deliverResult);
                        $deliveryTotal = $row1['totalDelivered'];
                    }

                    //Get Lost Packages
                    $sqlLost = 'SELECT COUNT(Tracking_Summary.Package_ID) as totalLost
                    FROM Tracking_Summary JOIN 
                    (SELECT Tracking.Package_ID, MAX(StopNum) AS location 
                    FROM Tracking GROUP BY Package_ID) AS T
                    ON Tracking_Summary.Package_ID = T.Package_ID 
                    AND Tracking_Summary.StopNum = T.location
                    WHERE Tracking_Summary.Package_Status = "lost"
                    AND DateArrived between ? and ?
                    AND Tracking_Summary.Priority LIKE ? AND Tracking_Summary.Package_Type LIKE ?;';

                    $stmtLost = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtLost, $sqlLost))
                    {
                        header("location: ../pages/index.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmtLost, "ssss", $min_date, $max_date, $prio, $type);
                    mysqli_stmt_execute($stmtLost);

                    $LostResult = mysqli_stmt_get_result($stmtLost);
                    $LostResultCheck = mysqli_num_rows($LostResult);

                    if($LostResultCheck > 0)
                    {
                        $row1 = mysqli_fetch_assoc($LostResult);
                        $LostTotal = $row1['totalLost'];
                    }

                    //Get Circulating Packages
                    $sqlActive = 'SELECT COUNT(Tracking_Summary.Package_ID) as totalActive
                    FROM Tracking_Summary JOIN 
                    (SELECT Tracking.Package_ID, MAX(StopNum) AS location 
                    FROM Tracking GROUP BY Package_ID) AS T
                    ON Tracking_Summary.Package_ID = T.Package_ID 
                    AND Tracking_Summary.StopNum = T.location
                    WHERE (Tracking_Summary.Package_Status = "office" OR Tracking_Summary.Package_Status = "transit")
                    AND DateArrived between ? and ?
                    AND Tracking_Summary.Priority LIKE ? AND Tracking_Summary.Package_Type LIKE ?;';

                    $stmtActive = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtActive, $sqlActive))
                    {
                        header("location: ../pages/index.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmtActive, "ssss", $min_date, $max_date, $prio, $type);
                    mysqli_stmt_execute($stmtActive);

                    $ActiveResult = mysqli_stmt_get_result($stmtActive);
                    $ActiveResultCheck = mysqli_num_rows($ActiveResult);

                    if($ActiveResultCheck > 0)
                    {
                        $row1 = mysqli_fetch_assoc($ActiveResult);
                        $ActiveTotal = $row1['totalActive'];
                    }

                    //Get Total Packages
                    $sqlPkgs = 'SELECT COUNT(Tracking_Summary.Package_ID) as totalPkgs
                    FROM Tracking_Summary JOIN 
                    (SELECT Tracking.Package_ID, MAX(StopNum) AS location 
                    FROM Tracking GROUP BY Package_ID) AS T
                    ON Tracking_Summary.Package_ID = T.Package_ID 
                    AND Tracking_Summary.StopNum = T.location
                    WHERE DateArrived between ? and ?
                    AND Tracking_Summary.Priority LIKE ? AND Tracking_Summary.Package_Type LIKE ?;';

                    $stmtPkgs = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtPkgs, $sqlPkgs))
                    {
                        header("location: ../pages/index.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmtPkgs, "ssss", $min_date, $max_date, $prio, $type);
                    mysqli_stmt_execute($stmtPkgs);

                    $PkgsResult = mysqli_stmt_get_result($stmtPkgs);
                    $PkgsResultCheck = mysqli_num_rows($PkgsResult);

                    if($PkgsResultCheck > 0)
                    {
                        $row1 = mysqli_fetch_assoc($PkgsResult);
                        $totalPkgs = $row1['totalPkgs'];
                    }


                    //Print total values HEADINGS
                    echo "<tr> 
                            <td>" . $deliveryTotal . "</td>
                            <td>" . $revenueDeliverTotal . "</td>
            
                            <td>" . $ActiveTotal . "</td>
                            <td>" . $revenueActiveTotal . "</td>

                            <td>" . $LostTotal . "</td>
                            <td>" . $revenueLostTotal. "</td>

                            <td>" . $totalPkgs . "</td>
                            <td>" . $revenueTotal. "</td>
                            <td>" . $revenueAverage. "</td>

                            </tr>";
                    
                ?>
                
                </tbody>
            </table>

            <!--Raw Data Form-->
            <table class="content-table">
                <div>
                    <span>
                        <h5>Raw Data</h5>
                    </span>
                </div>
                <thead>
                    <tr>
                        <!--Package_ID, StopNum, DateArrived, DateSent, Tracking_Office_ID-->
                        
                        <th>Package_Id</th>
                        <th>Packages Status</th>
                        <th>Destination Office</th>
                        <th>Date Arrived</th>
                        <th>Date Sent</th>
                        <th>StopNum</th>
                        <th>Package Type</th>
                        <th>Package Weight</th>
                        <th>Priority Level</th>
                        <th>Price</th>
                    </tr>
                </thead>

                <tbody>
                <!--My query-->
                <?php
                    //Get Raw Data
                    $sqlRaw = "SELECT * FROM Tracking_Summary 
                    WHERE Tracking_Summary.DateArrived BETWEEN ? AND ?
                    AND Tracking_Summary.Priority LIKE ? AND Tracking_Summary.Package_Type LIKE ?
                    ORDER BY Package_ID, StopNum;";

                    $stmtRaw = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtRaw, $sqlRaw))
                    {
                        header("location: ../pages/index.php?error=stmtfailed");
                        exit();
                    }                  
                    mysqli_stmt_bind_param($stmtRaw, "ssss", $min_date, $max_date, $prio, $type);
                    mysqli_stmt_execute($stmtRaw);

                    $resultRaw = mysqli_stmt_get_result($stmtRaw);
                    $resultRawCheck = mysqli_num_rows($resultRaw);

                    if($resultRawCheck > 0)
                    {
                        //Fill row
                        while($rawRow = mysqli_fetch_assoc($resultRaw))
                        {
                            echo "<tr> 
                                    <td>" . $rawRow['Package_ID'] . "</td>
                                    <td>" . $rawRow['Package_Status'] . "</td>
                                    <td>" . $rawRow['Destination_Office'] . "</td>
                                    <td>" . $rawRow['DateArrived'] . "</td>
                                    <td>" . $rawRow['DateSent'] . "</td>
                                    <td>" . $rawRow['StopNum'] . "</td>
                                    <td>" . $rawRow['Package_Type'] . "</td>
                                    <td>" . $rawRow['Package_Weight'] . "</td>
                                    <td>" . $rawRow['Priority'] . "</td>
                                    <td>" . $rawRow['Price'] . "</td>
                                
                                    </tr>";
                        }
                    }
                    
                ?>
                </tbody>
            </table>
                <!-- TODO: can't remove: will mess up side bar, so just hide by using color white in css -->
                <p class="heading"> HEADING </p>
                <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>
            </div> 
            
        </div>

    </section>
    
</body>
</html>    