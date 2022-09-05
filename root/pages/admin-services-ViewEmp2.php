<html>
<head>

<?php
    include("../includes/dbh.inc.php");
    $postOff = $_POST['pID'];
    if(Isset($_SESSION["role"]) && ($_SESSION["role"] == "manager")){
        $postOff = $_SESSION["officeID"];
    }
    $state = $_POST['state'];
    $city = $_POST['city'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
?>

<section class="sub-header">
    <?php
    include_once '../header.php';
    ?>
</section>
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
                    <h5>View Post Office Employees</h5>
                </span>
                </div>

                <div>
                <span>
                    <h2>Post Office Employees</h2>
                </span>
                </div>
                
                <table class="content-table">
                        <thead>
                            <tr>
                                <!--Package_ID, StopNum, DateArrived, DateSent, Tracking_Office_ID-->
                                
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>ID</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>State</th>
                                <th>Zipcode</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                //query Tracking row
                                $tracksql = "SELECT * FROM Employee WHERE Office_ID = ? AND Employee.isAdd = 1;";
                                $stmtTrack = mysqli_stmt_init($conn);
                             
                                if (!mysqli_stmt_prepare($stmtTrack, $tracksql)){
                                    header("location: ../pages/index-login.php?error=stmtfailed");
                                    exit();
                                    }
                                mysqli_stmt_bind_param($stmtTrack, "i", $postOff);
                                mysqli_stmt_execute($stmtTrack);
                                    
                                $trackStartRow = mysqli_stmt_get_result($stmtTrack);
                                $stmtTrack_check = mysqli_num_rows($trackStartRow);



                                //Check for results
                                if($stmtTrack_check > 0){
                                    while($check = mysqli_fetch_assoc($trackStartRow)){

                                        //get office name
                                        $officeSql = "SELECT * FROM Address WHERE Address_Key = ?;";
                                        $stmtOffice = mysqli_stmt_init($conn);
                                            
                                            if (!mysqli_stmt_prepare($stmtOffice, $officeSql))
                                            {
                                                header("location: ../pages/index-login.php?error=stmtfailed");
                                                exit();
                                            }
                                            mysqli_stmt_bind_param($stmtOffice, "i", $check['Employee_Address_Key']);
                                            mysqli_stmt_execute($stmtOffice);
                                            $a=0;
                                            $officeNameRow = mysqli_stmt_get_result($stmtOffice);
                                            $officeNameRow = mysqli_fetch_assoc($officeNameRow);
                                            if(!empty($fname)){
                                                if($check['First_Name'] != $fname){
                                                    $a=1;
                                                }
                                            }
                                            if(!empty($state)){
                                                if($officeNameRow['State'] != $state){
                                                    $a=1;
                                                }
                                            }
                                            if(!empty($city)){
                                                if($officeNameRow['City'] != $city){
                                                    $a=1;
                                                }
                                            }
                                            if(!empty($lname)){
                                                if($check['Last_Name'] != $lname){
                                                    $a=1;
                                                }
                                            }
                                        if($a==0){
                                        echo "<tr> 
                                        <td>" . $check['First_Name'] . "</td>
                                        <td>" . $check['Last_Name'] . "</td>
                                        <td>" . $check['Employee_ID'] . "</td>
                                        <td>" . $check['Employee_Phone_Num'] . "</td>
                                        <td>" . $check['email'] . "</td>
                                        <td>" . $officeNameRow['Building_Num'] . " " . $officeNameRow['Street_Name'] .", " . $officeNameRow['City'] . "</td>
                                        <td>" . $officeNameRow['State'] . "</td>
                                        <td>" . $officeNameRow['Zipcode'] . "</td>
                                    
                                        </tr>";
                                        }

                                    }
                                }
                            ?>
                            

                            
                        </tbody>
                    </table>
                    <?php
                    if(Isset($_SESSION["role"]) && (($_SESSION["role"] == "manager") || ($_SESSION["role"] == "hq manager"))) {
                    echo '<a href="admin-services-newEmp.php"><button class="hero-btn red-btn" id="emp-edit-info-btn">Add Employee</button></a>';
                    echo '<a href="admin-services-remEmp.php"><button class="hero-btn red-btn" id="emp-edit-info-btn">Remove Employee</button></a>';
                    if($_SESSION["role"] == "hq manager") {
                    echo '<a href="admin-services-newPerm.php"><button class="hero-btn red-btn" id="emp-edit-info-btn">Add Employee Permissions</button></a>';
                    echo '<a href="admin-services-remPerm.php"><button class="hero-btn red-btn" id="emp-edit-info-btn">Remove Employee Permissions</button></a>';
                    }
                    }
                    ?>
                <p class="heading"> HEADING </p>
                <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>

            </div>
            
        </div>

    </section>
    
</body>
</html>    