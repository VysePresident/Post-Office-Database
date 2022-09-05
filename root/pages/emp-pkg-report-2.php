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
            $weight = $_POST['weight'];
            $volume = $_POST['volume'];
            $type = $_POST['type'];
            $due = $_POST['due'];
            $cost = $_POST['cost'];
            $pID = $_POST['pID'];
            if(empty($pID)){
                $pID =  $_SESSION["officeID"];
            }

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

            <div class="form-col">
            <div>
            <i class="fa fa-database" aria-hidden="true"></i>
                    <span>
                        <h5>Package Report</h5>
                    </span>
                </div>
             <table class="content-table">
                <thead>
                    <tr>
                        <!--Package_ID, StopNum, DateArrived, DateSent, Tracking_Office_ID-->
                        
                        <th>Package ID</th>
                        <th>Stop Number</th>
                        <th>Package Type</th>
                        <th>Package Weight</th>
                        <th>Package Volume</th>
                        <th>Priority Level</th>
                        <th>Price</th> <!--Price = Priority * 5.00-->
                        <th>Days Before Due</th>
                        <!--Due by date = (priority * 7) - (current date - sent date);-->
                    </tr>
                </thead>
                <tbody>
                <!--My query-->
                <?php
                    //Get Tracking information related to your office
                    $sql1 = "SELECT * FROM Tracking WHERE Tracking_Office_ID = ?;";
                    $stmt1 = mysqli_stmt_init($conn);                        
                    if (!mysqli_stmt_prepare($stmt1, $sql1))
                    {
                        header("location: ../pages/index.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmt1, "i", $pID);
                    mysqli_stmt_execute($stmt1);

                    $result1 = mysqli_stmt_get_result($stmt1);
                    $result1Check = mysqli_num_rows($result1);

                    if($result1Check > 0)
                    {
                        while($row1 = mysqli_fetch_assoc($result1))
                        {
                            //Use Tracking information to get the ID of packages at latest location at your office. 
                            $sql2 = "SELECT COUNT(*) as total FROM Tracking WHERE Package_ID = ?;";
                            $stmt2 = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt2, $sql2))
                            {
                                header("location: ../pages/index.php?error=stmtfailed");
                                exit();
                            }
                            mysqli_stmt_bind_param($stmt2, 'i', $row1["Package_ID"]);
                            mysqli_stmt_execute($stmt2);

                            $result2 = mysqli_stmt_get_result($stmt2);
                            $result2Check = mysqli_num_rows($result2);

                            if($result2Check > 0)
                            {
                                while($row2 = mysqli_fetch_assoc($result2))
                                {
                                    //Check if count = stop num in first row.  That means package is at your office.
                                    if ($row2["total"] == $row1["StopNum"])
                                    {
                                        //If we get the total, now we want to print the package in 
                                        $sql3 = "SELECT * FROM Package WHERE Package_ID = ?;";
                                        $stmt3 = mysqli_stmt_init($conn);
                                        if (!mysqli_stmt_prepare($stmt3, $sql3))
                                        {
                                            header("location: ../pages/index.php?error=stmtfailed");
                                            exit();
                                        }
                                        mysqli_stmt_bind_param($stmt3, 'i', $row1["Package_ID"]);
                                        mysqli_stmt_execute($stmt3);

                                        $result3 = mysqli_stmt_get_result($stmt3);
                                        $result3Check = mysqli_num_rows($result3);

                                        if($result3Check > 0)
                                        {
                                            while($row3 = mysqli_fetch_assoc($result3))
                                            {
                                                $a = 0;
                                                $value = $row3["Priority"] * 3.00 + 0.5 * $row3["Package_Weight"];
                                                $price = "$" . strval($value);
                                                
                                                date_default_timezone_set("America/Los_Angeles");

                                                $origin = new DateTime($row1["DateSent"]);
                                                $current = new DateTime(date("Y-m-d H:i:s"));
                                                $interval = date_diff($origin, $current);
                                                $daysPassed = intval($interval->format("%d"));
                                                $dueDate = (7 * $row3["Priority"]) - ($daysPassed);
                                                
                                                if(!empty($prio))
                                                {
                                                    if($row3["Priority"] != $prio)
                                                    {
                                                        $a = 1;
                                                    }
                                                }
                                                if(!empty($weight))
                                                {
                                                    if($row3["Package_Weight"] > $weight)
                                                    {
                                                        $a = 1;
                                                    }
                                                }
                                                if(!empty($volume))
                                                {
                                                    if($row3["Package_Volume"] > $volume)
                                                    {
                                                        $a = 1;
                                                    }
                                                }
                                                if(!empty($type))
                                                {
                                                    if($row3["Package_Type"] != $type)
                                                    {
                                                        $a = 1;
                                                    }
                                                }
                                                if(!empty($due))
                                                {
                                                    if($dueDate > $due)
                                                    {
                                                        $a = 1;
                                                    }
                                                }
                                                if(!empty($cost))
                                                {
                                                    if(floatval($cost) < $value)
                                                    {
                                                        $a = 1;
                                                    }
                                                }


                                                if ($a == 0)
                                                {
                                                //Package_ID, Stop, Type, Weight, Volume, Priority, Price, (Add due-by if you can and hate yourself)
                                                echo "<tr> 
                                                            <td>" . $row3['Package_ID'] . "</td>
                                                            <td>" . $row1['StopNum'] . "</td>
                                                            <td>" . $row3['Package_Type'] . "</td>
                                                            <td>" . $row3['Package_Weight'] . "</td>
                                                            <td>" . $row3['Package_Volume'] . "</td>
                                                            <td>" . $row3['Priority'] . "</td>
                                                            <td>" . $price . "</td>
                                                            <td>" . $dueDate . "</td>
                                                        
                                                            </tr>";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
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