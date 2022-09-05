<html>
<head>
<section class="sub-header">
    <?php
    include_once '../header.php';
    include_once '../includes/dbh.inc.php';
    include_once '../includes/functions.inc.php';
    $start = $_POST['start'];
    $end = $_POST['end'];
    $before = $_POST['before'];
    $after = $_POST['after'];
    $pID = $_POST['pID'];
    if(Isset($_SESSION["role"]) && ($_SESSION["role"] == "manager")){
        $pID = $_SESSION["officeID"];
    }
    if($before>$after){
        header("location: ../pages/admin-services-purchases1.php?error=befgaft");
        exit();
    }

    //Select all customers that have sent packages
    $sql = "Select Distinct Customer.Customer_ID From Customer, Package Where Customer.Customer_ID = Package.Customer_ID;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../pages/index-login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt);

    $results = mysqli_stmt_get_result($stmt);
    $rows = mysqli_num_rows($results);

    //As long ast there is one row run this for each row
    $activeCustomers = 0;
    if($rows > 0){
        $length = 0;
        while($row = mysqli_fetch_assoc($results)){
            $array[0][$length] = $row['Customer_ID'];
            $sql2 = "Select DateArrived, Tracking_Office_ID
                From Tracking 
                where StopNum = 1
                and Tracking.Package_ID IN (Select Tracking.Package_ID From Package, Tracking Where Package.Customer_ID = ? and Tracking.Package_ID = Package.Package_ID);";
            $stmt2 = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt2, $sql2)){
                header("location: ../pages/index-login.php?error=stmtfailed");
                exit();
            }
            mysqli_stmt_bind_param($stmt2, "i", $row['Customer_ID']);
            mysqli_stmt_execute($stmt2);

            $results2 = mysqli_stmt_get_result($stmt2);
            $rows2 = mysqli_num_rows($results2);
            $row2 = mysqli_fetch_assoc($results2);
            if($rows2 > 0 && $row2['DateArrived'] >= $before && $row2['DateArrived'] <= $after){
                $array[1][$length] = 1;
                $activeCustomers++;
                //echo $array[0][$length];
                //echo 'True';                
            } else {
                $array[1][$length] = 0;
                //echo $array[0][$length];
                //echo 'False';
            }
            $length++;
        }
    }

    //Get the average cost of a package
    $sql3 = "Select Priority, Package_Weight, Tracking_Office_ID From Package, Tracking Where Package.Package_ID = Tracking.Package_ID and StopNum = 1;";
    $stmt3 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt3, $sql3)){
        header("location: ../pages/index-login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt3);

    $results3 = mysqli_stmt_get_result($stmt3);
    $rows3 = mysqli_num_rows($results3);
    $total = 0;
    $rcount = 0;
    if($rows3 > 0){
        while($row3 = mysqli_fetch_assoc($results3)){
            if(!empty($pID) && $row3['Tracking_Office_ID'] == $pID){
                $total = $total + packageCost($row3['Priority'], $row3['Package_Weight']);
                $rcount++;
            } else if(empty($pID)){
                $total = $total + packageCost($row3['Priority'], $row3['Package_Weight']);
                $rcount++;
            } 
        }
        if($rcount > 0){
            $average = $total/$rcount++;
        } else{
            $average = 0;
        }
    }
    

    //Find the average spending per person
    $c = 0;
    $cc = 0;
    $ccc = 0;
    $temp = 0;
    $customers = 0;
    $averageTotal = 0;
    $totalTotal = 0;
    while($c<$length){
        if($array[1][$c] == 1){
            $sql4 = "Select Priority, Package_Weight, Tracking_Office_ID From Package, Tracking Where Customer_ID = ? and Package.Package_ID = Tracking.Package_ID and StopNum = 1 and Tracking.DateArrived >= ? and Tracking.DateArrived <= ?;";
            $stmt4 = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt4, $sql4)){
                header("location: ../pages/index-login.php?error=stmtfailed");
                exit();
            }
            mysqli_stmt_bind_param($stmt4, "iss", $array[0][$c], $before, $after);
            mysqli_stmt_execute($stmt4);

            $results4 = mysqli_stmt_get_result($stmt4);
            $rows4 = mysqli_num_rows($results4);
            $total1 = 0;
            if($rows4 > 0){
                $ccc = 0;
                while($row4 = mysqli_fetch_assoc($results4)){
                    if(!empty($pID) && $row4['Tracking_Office_ID'] == $pID){
                        $total1 = $total1 + packageCost($row4['Priority'], $row4['Package_Weight']);
                        $ccc++;
                        $cc++;
                    } else if(empty($pID)){
                        $total1 = $total1 + packageCost($row4['Priority'], $row4['Package_Weight']);
                        $ccc++;
                        $cc++;
                    } 
                }
                if($ccc > 0){
                    $average1 = $total1/$ccc++;
                    $averageTotal = $averageTotal + $average1;
                } else {
                    $average1 = 0;
                    $averageTotal = 0;
                }
            }
            //echo "Customer " . $array[0][$c] . "sent " . $cc . " packages <br>";
            //echo $rows4;
            //echo '<br>';
        }
        if($cc != $temp){
            $customers++;
        }
        $temp = $cc;
        $c++;
    }
    if($cc > 0){
        $avgT = $averageTotal/$cc;
    } else {
        $avgT = 0;
    }

    //total packages sent in this time frame
    $sql5 = "Select Tracking_Office_ID, Package.Package_ID From Package, Tracking Where Package.Package_ID = Tracking.Package_ID and StopNum = 1 and Tracking.DateArrived >= ? and Tracking.DateArrived <= ?;";
    $stmt5 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt5, $sql5)){
        header("location: ../pages/index-login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt5, "ss", $before, $after);
    mysqli_stmt_execute($stmt5);

    $results5 = mysqli_stmt_get_result($stmt5);
    $totalPackage = mysqli_num_rows($results5);

    //Total Number of Customers
    $sql6 = "Select * From Customer;";
    $stmt6 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt6, $sql6)){
        header("location: ../pages/index-login.php?error=stmtfailed");
        exit();
    };
    mysqli_stmt_execute($stmt6);

    $results6 = mysqli_stmt_get_result($stmt6);
    $totalCustom = mysqli_num_rows($results6);
    
    //active customers is the amount of customers that have sent their first package
    //echo $activeCustomers;
    //echo '<br>';
    //customers is the # of customers using this post office
    //echo $customers;
    //echo '<br>';
    //average is the average cost of a package at this location
    //echo number_format((float)$average, 2, '.', '');
    //echo '<br>';
    //Total spent at this location
    //echo number_format((float)$total, 2, '.', '');
    //echo '<br>';
    //CC is the total amount of packages sent through here
    //echo $cc;
    //echo '<br>';
    //avgT is the total average cost of spending per customer that uses this post office
    //echo number_format((float)$avgT, 2, '.', '');
    //echo '<br>';  
    //perPack is the percentage of packages that start in this post office in the time frame
    $perPack = ($cc*100)/$totalPackage;
    //echo number_format((float)$perPack, 2, '.', '');
    //echo '<br>'; 
    //perCustom is percentage of total users using this/these post offices
    $perCustom = ($customers*100)/$totalCustom;
    //echo number_format((float)$perCustom, 2, '.', '');
    //echo '<br>';
    ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administrator Services</title>
<link rel="stylesheet" href="../css/admin-services.css">
<!-- font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,600,700&display=swap" rel="stylesheet">
<!-- icons -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    

    <script src="../scripts/add-Perms.js"></script>

    <!-- Side Bar -->
    <section class="side-bar-container">
        <?php
            include_once '../a-sidebar.php';
        ?>

        <!-- content -->
        <div class="content", id="EmpInfo">

            <div class="form-col">
                <div>
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>
                    <h5>Purchases Report</h5>
                </span>
                </div>

                <table class="content-table">
                    <thead>
                        <tr>
                            <!--Package_ID, StopNum, DateArrived, DateSent, Tracking_Office_ID-->    
                            <th>New Customers</th>
                            <?php
                                if(empty($pID)){
                                    echo '<th>Active Customers</th>';
                                } else{
                                    echo '<th>Active Customers Here</th>';
                                }
                            ?>
                            <th>Avg Package Cost</th>
                            <th>Packages Sent</th>
                            <th>Total Earnings</th>
                            <th>Avg Customer Spending</th>
                            <th>% of Packages Sent by New Customers</th>
                            <th>% of Active Customers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                echo "<td>" . $activeCustomers . "</td>";
                                echo "<td>" . $customers . "</td>";
                                echo "<td> $" . number_format((float)$average, 2, '.', '') . "</td>";
                                echo "<td>" . $cc . "</td>";
                                echo "<td> $" . number_format((float)$total, 2, '.', '') . "</td>";
                                echo "<td> $" . number_format((float)$avgT, 2, '.', '') . "</td>";
                                echo "<td>" . number_format((float)$perPack, 2, '.', '') . "% </td>";
                                echo "<td>" . number_format((float)$perCustom, 2, '.', '') . "% </td>";
                            ?>
                        </tr>
                    </tbody>
                </table>

                <form method="post" action="../pages/admin-services-purchases2.php">
                <?php
                    $current = date("Y-m-d");
                    //echo $current;
                ?>
                <div>
                <span>
                    <h2>Starting Time</h2>
                </span>
                </div>
                <input type="date" id="start" name="start" value="2022-04-01" min="2022-04-01" max="<?php
                    echo $current;
                ?>">

                <div>
                <span>
                    <h2>Ending Time</h2>
                </span>
                </div>
                <input type="date" id="end" name="end" value="<?php
                    echo $current;
                ?>" min="2022-04-01" max="<?php
                    echo $current;
                ?>">
                <div>
                <span>
                    <h2>Exclude Customers from Before</h2>
                </span>
                </div>
                <input type="date" id="before" name="before" value="2022-04-01" min="2022-04-01" max="<?php
                    echo $current;
                ?>">
                <div>
                <span>
                    <h2>Exclude Customers from After</h2>
                </span>
                </div>
                <input type="date" id="after" name="after" value="<?php
                    echo $current;
                ?>" min="2022-04-01" max="<?php
                    echo $current;
                ?>">
                <div>
                <span>
                    <h2> Select Post Office </h2>
                </span>
                </div>
                <input type="text" name="pID" placeholder="Select Post Office" list="possible-ids">
                    <datalist id="possible-ids"> 
                        <?php
                            $sql = "SELECT * FROM Post_Office;";
                            $stmt = mysqli_stmt_init($conn);

                            if (!mysqli_stmt_prepare($stmt, $sql))
                            {
                                header("location: ../pages/index-login.php?error=stmtfailed");
                                exit();
                            }

                            mysqli_stmt_execute($stmt);
                            $results = mysqli_stmt_get_result($stmt);
                            $rows = mysqli_num_rows($results);

                            if($rows > 0){
                                while($row = mysqli_fetch_assoc($results)){
                                    echo "<option value=". $row['Office_ID'] .">". $row['Office_Name'] ."</option>";
                                }
                            }
                            else {
                                echo "<option> None </option>";
                            }
                        ?>
                    </datalist>               
                <input type="submit" name="choosePO" value="Retrieve the Data"/>
                </form>

                <!--Customer Table-->
                <span>
                    <h5 style="color:black">Customer Table</h5>
                </span>
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Customer Address Key</th>
                            <th>Customer Phone Number</th>
                            <th>Customer ID</th>
                            <th>Customer Email</th>
                        </tr>
                    </thead>
                    <?php
                        $sql = "SELECT * FROM Customer;";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                            header("location: ../pages/index-login.php?error=stmtfailed");
                            exit();
                        }

                        mysqli_stmt_execute($stmt);
                        $results = mysqli_stmt_get_result($stmt);
                        $rows = mysqli_num_rows($results);

                        if($rows > 0){
                            echo '<tbody>';
                            while($row = mysqli_fetch_assoc($results)){
                                echo '<tr>';
                                        echo "<td>" . $row['First_Name'] . "</td>";
                                        echo "<td>" . $row['Last_Name'] . "</td>";
                                        echo "<td>" . $row['Customer_Address_Key'] . "</td>";
                                        echo "<td>" . $row['Customer_Phone_Num'] . "</td>";
                                        echo "<td>" . $row['Customer_ID'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                    echo '</tr>';
                                
                            }
                            echo '</tbody>';
                        }   
                    ?>
                </table>
                <span>
                    <h5 style="color:black">Packages</h5>
                </span>
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>Package ID</th>
                            <th>Customer ID</th>
                            <th>Package Type</th>
                            <th>Package Weight</th>
                            <th>Package Volume</th>
                            <th>Return Address Key</th>
                            <th>Shipping Address Key</th>
                            <th>Recieved</th>
                            <th>Priority</th>
                        </tr>
                    </thead>
                    <?php
                        $sql = "SELECT * FROM Package;";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                            header("location: ../pages/index-login.php?error=stmtfailed");
                            exit();
                        }

                        mysqli_stmt_execute($stmt);
                        $results = mysqli_stmt_get_result($stmt);
                        $rows = mysqli_num_rows($results);

                        if($rows > 0){
                            echo '<tbody>';
                            while($row = mysqli_fetch_assoc($results)){
                                echo '<tr>';
                                        echo "<td>" . $row['Package_ID'] . "</td>";
                                        echo "<td>" . $row['Customer_ID'] . "</td>";
                                        echo "<td>" . $row['Package_Type'] . "</td>";
                                        echo "<td>" . $row['Package_Weight'] . "</td>";
                                        echo "<td>" . $row['Package_Volume'] . "</td>";
                                        echo "<td>" . $row['IC_Address_Key'] . "</td>";
                                        echo "<td>" . $row['OT_Address_Key'] . "</td>";
                                        echo "<td>" . $row['Recieved'] . "</td>";
                                        echo "<td>" . $row['Priority'] . "</td>";
                                    echo '</tr>';
                                
                            }
                            echo '</tbody>';
                        }   
                    ?>
                </table>
                
                <span>
                    <h5 style="color:black">Tracking Table</h5>
                </span>
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>Package_ID</th>
                            <th>StopNum</th>
                            <th>DateArrived</th>
                            <th>DateSent</th>
                            <th>Tracking_Office_ID</th>
                        </tr>
                    </thead>
                    <?php
                        $sql = "SELECT * FROM Tracking;";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                            header("location: ../pages/index-login.php?error=stmtfailed");
                            exit();
                        }

                        mysqli_stmt_execute($stmt);
                        $results = mysqli_stmt_get_result($stmt);
                        $rows = mysqli_num_rows($results);

                        if($rows > 0){
                            echo '<tbody>';
                            while($row = mysqli_fetch_assoc($results)){
                                echo '<tr>';
                                        echo "<td>" . $row['Package_ID'] . "</td>";
                                        echo "<td>" . $row['StopNum'] . "</td>";
                                        echo "<td>" . $row['DateArrived'] . "</td>";
                                        echo "<td>" . $row['DateSent'] . "</td>";
                                        echo "<td>" . $row['Tracking_Office_ID'] . "</td>";
                                    echo '</tr>';
                                
                            }
                            echo '</tbody>';
                        }   
                    ?>
                </table>
                <span>
                    <h5 style="color:black">Post Office Table</h5>
                </span>
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>Office ID</th>
                            <th>Office Name</th>
                            <th>Post Office Address Key</th>
                            <th>Post Office Phone Number</th>
                            <th>Supervisor ID</th>
                            <th>Number of Packages</th>
                        </tr>
                    </thead>
                    <?php
                        $sql = "SELECT * FROM Post_Office;";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                            header("location: ../pages/index-login.php?error=stmtfailed");
                            exit();
                        }

                        mysqli_stmt_execute($stmt);
                        $results = mysqli_stmt_get_result($stmt);
                        $rows = mysqli_num_rows($results);

                        if($rows > 0){
                            echo '<tbody>';
                            while($row = mysqli_fetch_assoc($results)){
                                echo '<tr>';
                                        echo "<td>" . $row['Office_ID'] . "</td>";
                                        echo "<td>" . $row['Office_Name'] . "</td>";
                                        echo "<td>" . $row['PO_Address_Key'] . "</td>";
                                        echo "<td>" . $row['PO_Phone_Num'] . "</td>";
                                        echo "<td>" . $row['Supervisor_ID'] . "</td>";
                                        echo "<td>" . $row['Num_of_Packages'] . "</td>";
                                    echo '</tr>';
                            }
                            echo '</tbody>';
                        }   
                    ?>
                </table>
                <span>
                    <h5 style="color:black">Notifications New Employees Table</h5>
                </span>
                <table class="content-table">
                    <thead>
                        <tr>
                            <th>Notification New Number</th>
                            <th>Employee ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Start Date</th>
                        </tr>
                    </thead>
                    <?php
                        $sql = "SELECT * FROM Notification_New_Employee;";
                        $stmt = mysqli_stmt_init($conn);

                        if (!mysqli_stmt_prepare($stmt, $sql))
                        {
                            header("location: ../pages/index-login.php?error=stmtfailed");
                            exit();
                        }

                        mysqli_stmt_execute($stmt);
                        $results = mysqli_stmt_get_result($stmt);
                        $rows = mysqli_num_rows($results);

                        if($rows > 0){
                            echo '<tbody>';
                            while($row = mysqli_fetch_assoc($results)){
                                echo '<tr>';
                                        echo "<td>" . $row['N_number'] . "</td>";
                                        echo "<td>" . $row['E_ID'] . "</td>";
                                        echo "<td>" . $row['First_Name'] . "</td>";
                                        echo "<td>" . $row['Last_Name'] . "</td>";
                                        echo "<td>" . $row['Start_Date'] . "</td>";
                                    echo '</tr>';
                            }
                            echo '</tbody>';
                        }   
                    ?>
                </table>

                <p class="heading"> HEADING </p>
                <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>

            </div>
            
        </div>

    </section>
    
</body>
</html>    