<html>
<head>
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
                    <h5>Add Permissions to Employee</h5>
                </span>
                </div>

                <form method="post" action="../pages/admin-services-addPerm2.php">
                <div>
                <span>
                    <h2>Employee ID</h2>
                </span>
                </div>
                <input type="text" name="eID" placeholder="*******" required>

                <div>
                <span>
                    <h2>Post Office ID</h2>
                </span>
                </div>
                <input type="text" name="pID" placeholder="*******" required>
                <?php
                    if(Isset($_SESSION["role"]) && ($_SESSION["role"] == "hq manager")) {
                        echo '<input type="submit" name="choosePO" value="Make/Move Manager"/>';
                    }
                ?>
                </form>


                <p class="heading"> HEADING </p>
                <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>

            </div>
            
        </div>

    </section>
    
</body>
</html>    