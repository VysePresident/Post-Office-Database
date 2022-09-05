<html>
<head>

<?php
    include("../includes/dbh.inc.php");
?>

<section class="sub-header">
    <?php
    include_once '../header.php';
    ?>
</section>

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
                    //Make sure input Package_ID is valid 
                    $pkgID = $_POST['package-id'];
                    $pkgIDConverted = (int) $pkgID;
                    
            
                    $pkgsql = "SELECT * FROM PostOffice.Package WHERE PACKAGE_ID = ?;";
                    $stmtpkg = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtpkg, $pkgsql))
                    {
                        header("location: ../pages/index-login.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmtpkg, "i", $pkgID);
                    mysqli_stmt_execute($stmtpkg);
            
                    $pkgStartRow = mysqli_stmt_get_result($stmtpkg);
                    $pkgStartRowCheck = mysqli_num_rows($pkgStartRow);
            
                    $holdPkgKey = -1;
                    $holdPkgWeight = -1;
                    $holdPkgVol = -1;
                    $holdPkgOTAddrKey = -1;
                    
            
                    if ($pkgStartRowCheck > 0)
                    { 

                        $_SESSION['packageIDglobal'] = $pkgIDConverted;
                        
                        while($pkgStartRowCheck = mysqli_fetch_assoc($pkgStartRow))
                        {
                            $holdPkgKey = $pkgStartRowCheck["Package_ID"];
                            $holdPkgWeight = $pkgStartRowCheck["Package_Weight"];     
                            $holdPkgVol = $pkgStartRowCheck["Package_Volume"];  
                            $holdPkgOTAddrKey = $pkgStartRowCheck["OT_Address_Key"]; 
                        }
            
                        
                    }
            
                    else {
                        header("location: ../pages/emp-create-pkg-1.php?error=packagedoesnotexist");
                        exit();
                    }

                    //Get Destination  Address
                    $addrSql2 = "SELECT Building_Num, Street_Name, City, State, Zipcode FROM PostOffice.Address, PostOffice.Package WHERE Address.Address_Key = ?;";
                    $stmtAddrSql2 = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtAddrSql2, $addrSql2))
                    {
                        header("location: ../pages/index-login.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmtAddrSql2, "i", $holdPkgOTAddrKey);
                    mysqli_stmt_execute($stmtAddrSql2);
                    
                    $resultAddrRow2 = mysqli_stmt_get_result($stmtAddrSql2);
                    $resultAddrRowCheck2 = mysqli_num_rows($resultAddrRow2);
                    
                    $holdDAddrBnum = -1;
                    $holdDStreet = "";
                    $holdDCity = "";
                    $holdDState = "";
                    $holdDZip = -1;
                    
                    
                    //Retired code, keep just in case something else messses up
                    /**$addrSql2 = "SELECT Building_Num, Street_Name, City, State, Zipcode FROM PostOffice.Address, PostOffice.Package WHERE Address.Address_Key = Package.OT_Address_Key;";
                    $resultAddrRow2 = mysqli_query($conn, $addrSql2);
                    $resultAddrRowCheck2 = mysqli_num_rows($resultAddrRow2);

                    $resultAddrRow2 = mysqli_query($conn, $addrSql2);
                    $resultAddrRowCheck2 = mysqli_num_rows($resultAddrRow2);
                    
                    $holdDAddrBnum = -1;
                    $holdDStreet = "";
                    $holdDCity = "";
                    $holdDState = "";
                    $holdDZip = -1;
                    **/
                    
                    if($resultAddrRowCheck2 > 0){
                        while($resultAddrRowCheck2 = mysqli_fetch_assoc($resultAddrRow2))
                        {
                            $holdDAddrBnum = $resultAddrRowCheck2['Building_Num'];
                            $holdDStreet = $resultAddrRowCheck2['Street_Name'];
                            $holdDCity = $resultAddrRowCheck2['City'];
                            $holdDState = $resultAddrRowCheck2['State'];
                            $holdDZip = $resultAddrRowCheck2['Zipcode'];
                        }

                    }
            ?>

            <div class="form-col">
            <div>
                        <i class="fa fa-truck" aria-hidden="true"></i>
                        <span>
                            <h5>Package Info For ID: <?php echo $_SESSION['packageIDglobal']?></h5>
                        </span>
                    </div>

                    <div>
                        <span>
                            <h2>Package HISTORY</h2>
                        </span>
                    </div>

                    
                    <table class="content-table">
                        <thead>
                            <tr>
                                <!--Package_ID, StopNum, DateArrived, DateSent, Tracking_Office_ID-->
                                
                                <th>Package ID</th>
                                <th>Stop Number</th>
                                <th>Date Arrived to this PO</th>
                                <th>Date Sent from Last PO</th>
                                <th>Office ID</th>
                                <th>Destination Address</th>
                                <th>State</th>
                                <th>Zipcode</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                //query Tracking row
                                $tracksql = "SELECT * FROM PostOffice.Tracking WHERE Package_ID = ?;";
                                $stmtTrack = mysqli_stmt_init($conn);
                             
                                    if (!mysqli_stmt_prepare($stmtTrack, $tracksql))
                                    {
                                        header("location: ../pages/index-login.php?error=stmtfailed");
                                        exit();
                                    }
                                    mysqli_stmt_bind_param($stmtTrack, "i", $_SESSION['packageIDglobal']);
                                    mysqli_stmt_execute($stmtTrack);
                                    
                                    $trackStartRow = mysqli_stmt_get_result($stmtTrack);
                                    $stmtTrack_check = mysqli_num_rows($trackStartRow);



                                //Check for results
                                if($stmtTrack_check > 0){
                                    while($check = mysqli_fetch_assoc($trackStartRow)){

                                        //get office name
                                        $officeSql = "SELECT Office_Name
                                        FROM Post_Office, Tracking
                                        WHERE Office_ID = ?;";
                                        $stmtOffice = mysqli_stmt_init($conn);
                                            
                                            if (!mysqli_stmt_prepare($stmtOffice, $officeSql))
                                            {
                                                header("location: ../pages/index-login.php?error=stmtfailed");
                                                exit();
                                            }
                                            mysqli_stmt_bind_param($stmtOffice, "i", $check['Tracking_Office_ID']);
                                            mysqli_stmt_execute($stmtOffice);

                                            $officeNameRow = mysqli_stmt_get_result($stmtOffice);
                                            $officeNameRowCheck = mysqli_num_rows($officeNameRow);

                                            $holdOfficeName = "";
                                            
                                            if($officeNameRowCheck > 0){
                                                while($trackingIDCheck = mysqli_fetch_assoc($officeNameRow))
                                                {
                                                    $holdOfficeName = $trackingIDCheck['Office_Name'];
                                                }
                                            }

                                        echo "<tr> 
                                        <td>" . $check['Package_ID'] . "</td>
                                        <td>" . $check['StopNum'] . "</td>
                                        <td>" . $check['DateArrived'] . "</td>
                                        <td>" . $check['DateSent'] . "</td>
                                        <td>" . $holdOfficeName . "</td>
                                        <td>" . $holdDAddrBnum . " " . $holdDStreet . ", " . $holdDCity . "</td>
                                        <td>" . $holdDState . "</td>
                                        <td>" . $holdDZip . "</td>
                                    
                                        </tr>";

                                    }
                                }
                            ?>
                            

                            
                        </tbody>
                    </table>


                    <form method="post" action="emp-update-trk-3.php">
                        <div>
                            <span>
                                <h2>Send to Next Post Office</h2>
                            </span>
                        </div>
                        <input type="text" name="nextPO" placeholder="Enter next post office to ship to">
                        <div>
                            <span>
                                <h2>Is this the Last Stop? Type 'Yes' or leave Blank if 'No'</h2>
                            </span>
                        </div>
                        <input type="text" name="deliver" placeholder="Yes">
 
                        <button type="submit" class="hero-btn red-btn" id="update-track-enter">Enter</button>

                    <!-- TODO: can't remove: will mess up side bar, so just hide by using color white in css -->
                    <p class="heading"> HEADING </p>
                    <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>
            </div> 
            
        </div>

    </section>
    
</body>
</html>    