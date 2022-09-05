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

        <?php 
            $pkgID = (int) $_POST["package-id"];
            $destinationOffice = $_POST["next-location"];

            // set package status to delivered
            if ($destinationOffice === -1) {
                $sql = "UPDATE Tracking_Status SET Package_Status = 'delivered' WHERE Package_ID = ?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: ../pages/index-login.php?error=stmtfailed");
                    exit();   
                }
                mysqli_stmt_bind_param($stmt,"i", $pkgID);
                mysqli_stmt_execute($stmt);
            } 
            else {
                // find which office they meant to send to, mark as transit and update destination office

                $sql = "UPDATE Tracking_Status SET Package_Status = 'transit', Destination_Office = ? WHERE Package_ID = ?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: ../pages/index-login.php?error=stmtfailed");
                    exit();   
                }
                mysqli_stmt_bind_param($stmt,"ii", $destinationOffice, $pkgID);
                mysqli_stmt_execute($stmt);
            }
        ?>
        
        <!-- content -->
        <div class="content">

            <div class="form-col">
                    <div>
                        <i class="fa fa-truck" aria-hidden="true"></i>
                        <span>
                            <h5>Package <?php echo $pkgID; ?> Marked For Send Out</h5>
                        </span>
                    </div>

                    <p>The package has been marked for send out: <?php echo $nextDest; ?> </p>

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