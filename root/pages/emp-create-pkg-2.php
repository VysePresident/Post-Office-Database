<html>
<head>

<?php 
    include("../includes/dbh.inc.php");
    $custemail= $_POST["email"];
    //$customID = $_POST["customer-id"];
    //$Rbuildingnum = $_POST['Rbuilding-num'];
    //$Rbnum_converted = (int) $Rbuildingnum;
    //$Rstreet = $_POST['Rstreet-name'];
    //$Rcity = $_POST['Rcity'];
    //$Rstate = $_POST['Rstate'];
    //$Rzipcode = $_POST['Rzip'];
    //$Rzipcode_coverted = (int) $Rzipcode;
                
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
?>

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

    <!-- Side Bar -->
    <section class="side-bar-container">
        <?php
            include_once '../a-sidebar.php';
        ?>

        <!-- content -->
        <div class="content">
            <?php
                
                //Check if email exists
                $email = "SELECT email FROM PostOffice.Customer
                            WHERE email = ?;";
                $stmtEmail = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmtEmail, $email)){
                    header("location: ../pages/index-login.php?error=stmtfailed");
                    exit();   
                }
                mysqli_stmt_bind_param($stmtEmail, "s", $custemail);
                mysqli_stmt_execute($stmtEmail);

                $resultEmail = mysqli_stmt_get_result($stmtEmail);
                $resultEmailCheck = mysqli_num_rows($resultEmail);

                //if email exists, then officially set the inputted customer email to its respective known email
                if($resultEmailCheck>0){
                    while($resultEmailCheck = mysqli_fetch_assoc($resultEmail)){
                        $custemail = $resultEmailCheck["email"];
                    }
                }
                else {
                    header("location: ../pages/emp-create-pkg-1.php?error=emailexist");
                    exit();
                }
                
                //Get address key through email
                $getAddrKey = "SELECT Customer_Address_Key From PostOffice.Customer
                                WHERE email = ?;";
                $stmtAddrKey = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmtAddrKey, $getAddrKey)){
                    header("location: ../pages/index-login.php?error=stmtfailed");
                    exit();   
                }
                mysqli_stmt_bind_param($stmtAddrKey,"s",$custemail);
                mysqli_stmt_execute($stmtAddrKey);

                $resultAddrKey = mysqli_stmt_get_result($stmtAddrKey);
                $resultAddrCheck = mysqli_num_rows($resultAddrKey);

                $holdAddrKey = -1;

                if($resultAddrCheck>0){
                    while($resultAddrCheck = mysqli_fetch_assoc($resultAddrKey)){
                        $holdAddrKey = $resultAddrCheck['Customer_Address_Key'];
                    }
                }
                $holdCustID = -1;
                

                //Get Customer ID through email because we still need the Customer's ID to make a package
                $getCustID = "SELECT Customer_ID FROM PostOffice.Customer
                                WHERE email = ?;";
                $stmtCustID =  mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmtCustID, $getCustID)){
                    header("location: ../pages/index-login.php?error=stmtfailed");
                    exit();   
                }
                mysqli_stmt_bind_param($stmtCustID,"s",$custemail);
                mysqli_stmt_execute($stmtCustID);

                $resultCustID =  mysqli_stmt_get_result($stmtCustID);
                $resultCustIDCheck = mysqli_num_rows($resultCustID);

                if($resultCustIDCheck>0){
                    while($resultCustIDCheck = mysqli_fetch_assoc($resultCustID)){
                        $holdCustID = $resultCustIDCheck['Customer_ID'];
                    }
                }
                            
                
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
                mysqli_stmt_bind_param($stmtPkg, "isddiiii", $holdCustID, $ptype, $weight, $vol_converted, $holdAddrKey, $holdDaddr, $notReceived, $priority);
                mysqli_stmt_execute($stmtPkg);

                // get package_id of package we just inserted
                $last_id = mysqli_insert_id($conn);

                //echo "Last inserted package ID: ";
                //echo $last_id;
                //echo $last_id;
                //echo $last_id;
                //echo $last_id;
                //echo $last_id;
                //echo $last_id;
                //echo $last_id;
                //echo $last_id;


                // update Tracking_Status table: set package_if of newly created package, set status to transit, destination office to selected by customer
                $sqlTrkStatus = "INSERT INTO Tracking_Status (Package_ID, Package_Status, Destination_Office) VALUES(?, ?, ?);";
                $stmtTrkStatus = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmtTrkStatus, $sqlTrkStatus))
                {
                    header("location: ../pages/index-login.php?error=stmtfailed");
                    exit();
                }
                $pkgStatus = "office";

                mysqli_stmt_bind_param($stmtTrkStatus, "isi", $last_id, $pkgStatus, $_SESSION["officeID"]);
                mysqli_stmt_execute($stmtTrkStatus);
            ?>
            <div class="form-col">
                <div>
                    <i class="fa fa-truck" aria-hidden="true"></i>
                    <span>
                        <h5> <h5>Thank You! Package has been created and added to the database. Please be sure to send it out to it's next location. The package ID associated with this package is: <?php echo $last_id ?>.</h5></h5>
                    </span>
                </div>

                
                <!-- TODO: can't remove: will mess up side bar, so just hide by using color white in css -->
                <p class="heading"> HEADING </p>
                <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>
            </div> 

        </div>

    </section>

</body>
</html>