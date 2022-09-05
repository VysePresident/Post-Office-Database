<html>
<head>
<section class="sub-header">
    <?php
    include_once '../header.php';
    include("../includes/dbh.inc.php");
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
                <?php
                    if(Isset($_SESSION["role"]) && ($_SESSION["role"] == "hq manager")){
                    $officesql = "UPDATE Notification_New_Employee SET isAdd = 0 where N_number > 0;";
                    $stmtOffice = mysqli_stmt_init($conn);
                             
                    if (!mysqli_stmt_prepare($stmtOffice, $officesql)){
                        header("location: ../pages/index-login.php?error=stmtfailed");
                        exit();
                    }
                    mysqli_stmt_execute($stmtOffice);
                    echo "<script> location.href='admin-services-ViewNotif2.php'; </script>";
                }
                ?>
                <p class="heading"> HEADING </p>
                <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>

            </div>
            
        </div>

    </section>
    
</body>
</html>    