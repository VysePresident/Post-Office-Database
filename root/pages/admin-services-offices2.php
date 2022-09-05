<html>
<head>
<section class="sub-header">
    <?php
    include_once '../header.php';
    include_once '../includes/dbh.inc.php';
    include_once '../includes/functions.inc.php';
    $start = $_POST['start'];
    $end = $_POST['end'];
    if(Isset($_SESSION["role"]) && ($_SESSION["role"] == "hq manager")) {
        $pID = $_POST['pID'];
    } else {$pID = $_SESSION['officeID'];}

    //Select the amount of packages in this place 
    $sql = "Select * From Post_Office Where Office_ID = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../pages/index-login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $pID);
    mysqli_stmt_execute($stmt);

    $results = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($results);
    $currPack = $row['Num_of_Packages'];

    //Total Packages Processed Here
    $sql1 = "Select count(*) From Tracking Where Tracking_Office_ID = ? and DateArrived >=? and DateArrived <= ?;";
    $stmt1 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt1, $sql1)){
        header("location: ../pages/index-login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt1, "iss", $pID, $start, $end);
    mysqli_stmt_execute($stmt1);

    $results1 = mysqli_stmt_get_result($stmt1);
    $row1 = mysqli_fetch_assoc($results1);
    $procPack = $row1['count(*)'];
    
    //Total Packages All
    $sql2 = "Select count(*) From Tracking Where DateArrived >=? and DateArrived <= ?;";
    $stmt2 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt2, $sql2)){
        header("location: ../pages/index-login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt2, "ss", $start, $end);
    mysqli_stmt_execute($stmt2);

    $results2 = mysqli_stmt_get_result($stmt2);
    $row2 = mysqli_fetch_assoc($results2);
    $totPack = $row2['count(*)'];
    
    //Calculate the Percentage of processed packages
    $totPercent = ($procPack*100)/$totPack;

    //Calculate the indivudual revenue from each package and add them up
    $sql3 = "Select Priority, Package_Weight From Package, Tracking Where Package.Package_ID = Tracking.Package_ID and Tracking.StopNum = 1 and Tracking.Tracking_Office_ID = ? and DateArrived >=? and DateArrived <= ?;";
    $stmt3 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt3, $sql3)){
        header("location: ../pages/index-login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt3, "iss", $pID, $start, $end);
    mysqli_stmt_execute($stmt3);

    $results3 = mysqli_stmt_get_result($stmt3);
    $rows3 = mysqli_num_rows($results3);
    $profit = 0;
    if($rows3 > 0){
        while($row3 = mysqli_fetch_assoc($results3)){
            $profit = $profit + packageCost($row3['Priority'], $row3['Package_Weight']);
        }
    }
    
    


    //Select all customers that have sent packages
    $sql4 = "Select Distinct Customer.Customer_ID From Customer, Package Where Customer.Customer_ID = Package.Customer_ID;";
    $stmt4 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt4, $sql4)){
        header("location: ../pages/index-login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt4);

    $results4 = mysqli_stmt_get_result($stmt4);
    $rows4 = mysqli_num_rows($results4);

    //As long ast there is one row run this for each row
    $activeCustomers = 0;
    if($rows4 > 0){
        while($row4 = mysqli_fetch_assoc($results4)){
            $sql5 = "Select DateArrived, Tracking_Office_ID
                From Tracking 
                where StopNum = 1
                and Tracking.Package_ID IN (Select Tracking.Package_ID From Package, Tracking Where Package.Customer_ID = ? and Tracking.Package_ID = Package.Package_ID);";
            $stmt5 = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt5, $sql5)){
                header("location: ../pages/index-login.php?error=stmtfailed");
                exit();
            }
            mysqli_stmt_bind_param($stmt5, "i", $row['Customer_ID']);
            mysqli_stmt_execute($stmt5);

            $results5 = mysqli_stmt_get_result($stmt5);
            $rows5 = mysqli_num_rows($results5);
            $row5 = mysqli_fetch_assoc($results5);
            if($rows5 > 0 && $row5['DateArrived'] >= $before && $row5['DateArrived'] <= $after && $row5['Tracking_Office_ID'] == $pID){
                $activeCustomers++;                
            }
        }
    }

    //Find how many new employees are in this office
    $sql6 = "Select count(*) From Employee, Notification_New_Employee Where Office_ID = ? and Start_Date >=? and Start_Date <= ? and E_ID = Employee_ID and Employee.isAdd = 1;";
    $stmt6 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt6, $sql6)){
        header("location: ../pages/index-login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt6, "iss", $pID, $start, $end);
    mysqli_stmt_execute($stmt6);

    $results6 = mysqli_stmt_get_result($stmt6);
    $row6 = mysqli_fetch_assoc($results6);
    $newEmp = $row6['count(*)'];
    //Get the number of employees here
    $sql7 = "Select count(*) From Employee Where Office_ID = ? and Employee.isAdd = 1;";
    $stmt7 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt7, $sql7)){
        header("location: ../pages/index-login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt7, "i", $pID);
    mysqli_stmt_execute($stmt7);

    $results7 = mysqli_stmt_get_result($stmt7);
    $row7 = mysqli_fetch_assoc($results7);
    $allEmp = $row7['count(*)'];

    //Get total employees still active
    $sql8 = "Select count(*) From Employee Where Employee.isAdd = 1;";
    $stmt8 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt8, $sql8)){
        header("location: ../pages/index-login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_execute($stmt8);

    $results8 = mysqli_stmt_get_result($stmt8);
    $row8 = mysqli_fetch_assoc($results8);
    $totEmp = $row8['count(*)'];
    //num/Total
    if($allEmp == 0){
        $perNew = 0;
    } else{
        $perNew = ($newEmp*100)/$allEmp;
    }
    $perTot = ($allEmp*100)/$totEmp;

    //Number of Packages in the post office
    $sql9 = "Select Num_of_Packages From Post_Office Where Office_ID = ?;";
    $stmt9 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt9, $sql9)){
        header("location: ../pages/index-login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt9, "i", $pID);
    mysqli_stmt_execute($stmt9);

    $results9 = mysqli_stmt_get_result($stmt9);
    $row9 = mysqli_fetch_assoc($results9);
    $packNum = $row9['Num_of_Packages'];

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
                    <h5>Post Office Report</h5>
                </span>
                </div>

                <table class="content-table">
                    <thead>
                        <tr>
                            <!--Package_ID, StopNum, DateArrived, DateSent, Tracking_Office_ID-->    
                            <th>Number of Packages in Post Office</th>
                            <th>Packages Processed</th>
                            <th>Percentage Passthrough</th>
                            <th>Total Earnings</th>
                            <th>New Customers</th>
                            <th>New Employees</th>
                            <th>Number of Employees</th>
                            <th>Percentage of New Employees</th>
                            <th>Percentage of Employees Employed at this Post Office</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                                echo "<td>" . $currPack . "</td>";
                                echo "<td>" . $procPack . "</td>";
                                echo "<td>" . number_format((float)$totPercent, 2, '.', '') . "% </td>";
                                echo "<td> $" . number_format((float)$profit, 2, '.', '') . "</td>";
                                echo "<td>" . $activeCustomers . "</td>";
                                echo "<td>" . $newEmp . "</td>";
                                echo "<td>" . $allEmp . "</td>";
                                echo "<td>" . number_format((float)$perNew, 2, '.', '') . "% </td>";
                                echo "<td>" . number_format((float)$perTot, 2, '.', '') . "% </td>";
                            ?>
                        </tr>
                    </tbody>
                </table>

                <form method="post" action="../pages/admin-services-offices2.php">
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
                <?php
                if(Isset($_SESSION["role"]) && ($_SESSION["role"] == "hq manager"))
                    {echo '<div>
                <span>
                    <h2> Select Post Office </h2>
                </span>
                </div>
                <input type="text" name="pID" placeholder="Select Post Office" list="possible-ids" required>
                    <datalist id="possible-ids">';

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

                    echo'</datalist>';}
               ?>
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