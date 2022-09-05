<html>
<head>
    <?php
        include("../includes/dbh.inc.php");
        $employeeID = $_POST["eID"];
        //Select the Office_ID of the supervisors original office
        $sql1 = "SELECT Office_ID FROM Post_Office WHERE Supervisor_ID = ?;";
        $stmt1 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt1, $sql1))
        {
            header("location: ../pages/admin-services-addPerm2.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt1, "i", $employeeID);
        mysqli_stmt_execute($stmt1);

        $mngRow  = mysqli_stmt_get_result($stmt1);
        $isMNG = mysqli_num_rows($mngRow);
        $mngOut1 = mysqli_fetch_all($mngRow);

        if($isMNG != 0){
            $sql2 = "UPDATE Post_Office SET Supervisor_ID = -1 WHERE Office_ID = ?;";
            $stmt2 = mysqli_stmt_init($conn);
        
        
            if (!mysqli_stmt_prepare($stmt2, $sql2))
            {
                header("location: ../pages/admin-services-addPerm2.php?error=stmtfailed");
                exit();
            }
            mysqli_stmt_bind_param($stmt2, "i", $mngOut1[0][0]);
            mysqli_stmt_execute($stmt2);
        }
        echo "<script> location.href='admin-services-remPerm.php'; </script>";
    ?>

    <section class="sub-header">
    <?php
    include_once '../header.php';
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
                    <h5>Permissions Removed</h5>
                    <h5>Again? </h5>
                </span>
                </div>

                <form method="post" action="../pages/admin-services-remPerm2.php">
                <div>
                <span>
                    <h2>Employee ID</h2>
                </span>
                </div>
                <input type="text" name="eID" placeholder="*******" required>

                <input type="submit" name="choosePO" value="Remove Manager"/>
                </form>


                <p class="heading"> HEADING </p>
                <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>

            </div>
            
        </div>
            
        </div>

    </section>
    
</body>
</html>    