<html>
<head>

    <!-- WRITE PHP HERE TO COLLECT FORM INFORMATION FROM CUST-SND-PKG-1.PHP WHICH CALLED THIS FILE -->


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
    
    
    <!-- 
    <section class="sub-header">
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
                
                /**$Rbuildingnum = $_POST['Rbuilding-num'];
                $Rbnum_converted = (int) $Rbuildingnum;
                $Rstreet = $_POST['Rstreet-name'];
                $Rcity = $_POST['Rcity'];
                $Rstate = $_POST['Rstate'];
                $Rzipcode = $_POST['Rzip'];
                $Rzipcode_coverted = (int) $Rzipcode;**/
                
                $Dbuildingnum = $_POST['Dbuilding-num'];
                $Dbnum_converted = (int) $Dbuildingnum;
                $Dstreet = $_POST['Dstreet-name'];
                $Dcity = $_POST['Dcity'];
                $Dstate = $_POST['Dstate'];
                $Dzipcode = $_POST['Dzip'];
                $Dzipcode_coverted = (int) $Dzipcode;
                
                $ptype = $_POST['ptype'];
                $weight = $_POST['weight'];
                $vol = $_POST['vol'];
                $vol_converted = (int) $vol;

                $priority = (int) $_POST['priority'];

                $dropOffLocation = $_POST['pkg-drop-off-location'];
                
                
                /**$addrRKeys = "SELECT Address_Key FROM PostOffice.Address 
                                WHERE Building_Num = ? AND Street_Name = ? AND City = ? AND State = ? AND Zipcode = ?;";
                
                $stmtRKeys = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmtRKeys, $addrRKeys)){
                    header("location: ../pages/index-login.php?error=stmtfailed");
                    exit();   
                }
                mysqli_stmt_bind_param($stmtRKeys, "isssi", $Rbnum_converted, $Rstreet, $Rcity, $Rstate, $Rzipcode_coverted );
                mysqli_stmt_execute($stmtRKeys);

                $resultRKey = mysqli_stmt_get_result($stmtRKeys);
                $resultRKeyCheck = mysqli_num_rows($resultRKey);
                
                $holdRaddr = -1;
                
                if($resultRKeyCheck > 0) {
                    while($resultRKeyCheck = mysqli_fetch_assoc($resultRKey))
                    {
                        $holdRaddr = $resultRKeyCheck["Address_Key"];       
                    }
                } else {
                    $sqlRaddr = "INSERT INTO PostOffice.Address (Building_Num, Street_Name, City, State, Zipcode)
                    VALUES (?, ?, ?, ?, ?);";
                    $stmtRaddr = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtRaddr, $sqlRaddr)) {
                        header("location: ../pages/index-login.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmtRaddr, "isssi", $Rbnum_converted, $Rstreet, $Rcity, $Rstate, $Rzipcode_coverted );
                    mysqli_stmt_execute($stmtRaddr);
                
                    $addrRKeys = "SELECT Address_Key FROM PostOffice.Address 
                                WHERE Building_Num = ? AND Street_Name = ? AND City = ? AND State = ? AND Zipcode = ?;";
                
                    $stmtRKeys = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtRKeys, $addrRKeys)) {
                        header("location: ../pages/index-login.php?error=stmtfailed");
                        exit();   
                    }
                    mysqli_stmt_bind_param($stmtRKeys, "isssi", $Rbnum_converted, $Rstreet, $Rcity, $Rstate, $Rzipcode_coverted );
                    mysqli_stmt_execute($stmtRKeys);

                    $resultRKey = mysqli_stmt_get_result($stmtRKeys);
                    $resultRKeyCheck = mysqli_num_rows($resultRKey);
                
                    $holdRaddr = -1;
                
                    if($resultRKeyCheck > 0) {
                        while($resultRKeyCheck = mysqli_fetch_assoc($resultRKey)) {
                            $holdRaddr = $resultRKeyCheck["Address_Key"];       
                        }
                    }
                    else {
                    echo "error";
                    }
                } **/

                //Retrieve Destination Destination Address Keys
                $addrDKeys = "SELECT Address_Key FROM PostOffice.Address 
                                WHERE Building_Num = ? AND Street_Name = ? AND City = ? AND State = ? AND Zipcode = ?;";
                
                $stmtDKeys = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmtDKeys, $addrDKeys)) {
                    header("location: ../pages/index-login.php?error=stmtfailed");
                    exit();   
                }
                mysqli_stmt_bind_param($stmtDKeys, "isssi", $Dbnum_converted, $Dstreet, $Dcity, $Dstate, $Dzipcode_coverted );
                mysqli_stmt_execute($stmtDKeys);

                $resultDKey = mysqli_stmt_get_result($stmtDKeys);
                
                $resultDKeyCheck = mysqli_num_rows($resultDKey);
                
                $holdDaddr = -1;
                
                if($resultDKeyCheck > 0){
                    while($resultDKeyCheck = mysqli_fetch_assoc($resultDKey))
                    {
                        $holdDaddr = $resultDKeyCheck["Address_Key"];       
                    }
                } else {
                    //New (destination) Address tuple
                    $sqlDaddr = "INSERT INTO PostOffice.Address (Building_Num, Street_Name, City, State, Zipcode)
                    VALUES (?, ?, ?, ?, ?);";
                    $stmtDaddr = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtDaddr, $sqlDaddr)) {
                        header("location: ../pages/index-login.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_bind_param($stmtDaddr, "isssi", $Dbnum_converted, $Dstreet, $Dcity, $Dstate, $Dzipcode_coverted);
                    mysqli_stmt_execute($stmtDaddr);
                    //Retrieve Destination Destination Address Keys
                    $addrDKeys = "SELECT Address_Key FROM PostOffice.Address 
                                WHERE Building_Num = ? AND Street_Name = ? AND City = ? AND State = ? AND Zipcode = ?;";
                
                    $stmtDKeys = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtDKeys, $addrDKeys)) {
                        header("location: ../pages/index-login.php?error=stmtfailed");
                        exit();   
                    }
                    mysqli_stmt_bind_param($stmtDKeys, "isssi", $Dbnum_converted, $Dstreet, $Dcity, $Dstate, $Dzipcode_coverted );
                    mysqli_stmt_execute($stmtDKeys);

                    $resultDKey = mysqli_stmt_get_result($stmtDKeys);
                
                    $resultDKeyCheck = mysqli_num_rows($resultDKey);
                
                    $holdDaddr = -1;
                
                    if($resultDKeyCheck > 0) {
                        while($resultDKeyCheck = mysqli_fetch_assoc($resultDKey)) {
                            $holdDaddr = $resultDKeyCheck["Address_Key"];       
                        }
                    }
                    else {
                        echo "error";
                    }
                }

                //echo $holdRaddr;
                //echo $holdDaddr;

                
                $notReceived = 0;
                //Create Package
                $newPkg = "INSERT INTO PostOffice.Package (Customer_ID, Package_Type, Package_Weight, Package_Volume, IC_Address_Key, OT_Address_Key, Recieved, Priority)
                            VALUES(?,?,?,?,?,?,?,?);";
                $stmtPkg = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmtPkg, $newPkg))
                {
                    header("location: ../pages/index-login.php?error=stmtfailed");
                    exit();
                }
                mysqli_stmt_bind_param($stmtPkg, "isddiiii", $_SESSION["userid"], $ptype, $weight, $vol_converted, $_SESSION["custAddressKey"],$holdDaddr, $notReceived, $priority);
                mysqli_stmt_execute($stmtPkg);

                // get package_id of package we just inserted
                $last_id = mysqli_insert_id($conn);


                // update Tracking_Status table: set package_if of newly created package, set status to transit, destination office to selected by customer
                $sqlTrkStatus = "INSERT INTO Tracking_Status (Package_ID, Package_Status, Destination_Office) VALUES(?, ?, ?);";
                $stmtTrkStatus = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmtTrkStatus, $sqlTrkStatus))
                {
                    header("location: ../pages/index-login.php?error=stmtfailed");
                    exit();
                }
                $pkgStatus = "transit";
                $destinationOffice = -1;

                if ($dropOffLocation === "Houston Branch") {
                    $destinationOffice = 1;
                }
                elseif ($dropOffLocation === "Austin Branch") {
                    $destinationOffice = 2;
                } else {
                    $destinationOffice = 3;
                }

                mysqli_stmt_bind_param($stmtTrkStatus, "isi", $last_id, $pkgStatus, $destinationOffice);
                mysqli_stmt_execute($stmtTrkStatus);

            ?>
            
        
        
        
            
            
            <div class="form-col">
                <div>
                <i class="fa fa-truck" aria-hidden="true"></i>
                <span>
                    <h5>Thank You! Visit "Package Information" in your services page to follow your package after it's delivered to your selected post office. The package ID associated with this package is: <?php echo $last_id ?>.</h5>
                </span>
                </div>

                <p class="heading"> HEADING </p>
                <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>
            </div> 
            
        </div>

    </section>
    
</body>
</html>    