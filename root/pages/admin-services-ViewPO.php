<html>
<head>
<section class="sub-header">
    <?php
    include_once '../header.php';
    include_once '../includes/dbh.inc.php';
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
                        <h5>Post Offices Report</h5>
                    </span>
                </div>

                <form method="post" action="../pages/admin-services-ViewPO2.php">
                    <div>
                        <span>
                            <h2>Optional: Post Office Name</h2>
                        </span>
                    </div>
                    <input type="text" name="pName" placeholder="*******">
                    
                    <?php
                    if(Isset($_SESSION["role"]) && ($_SESSION["role"] == "hq manager")) {
                        echo '<div>
                        <span>
                            <h2> Optional: Select a Manager </h2>
                        </span>
                        </div>
                        <input type="text" name="mID" placeholder="Select a Manager" list="possible-ids">
                        <datalist id="possible-ids">';

                            $sql = "SELECT Last_Name, Supervisor_ID FROM Post_Office, Employee Where Supervisor_ID = Employee_ID;";
                            $stmt = mysqli_stmt_init($conn);

                            if (!mysqli_stmt_prepare($stmt, $sql))
                            {
                                header("location: ../pages/index-login.php?error=stmtfailed");
                                exit();
                            }

                            mysqli_stmt_execute($stmt);
                            $results = mysqli_stmt_get_result($stmt);
                            $rows = mysqli_num_rows($results);

                            $sql1 = "SELECT * FROM Post_Office, Employee Where Supervisor_ID = Employee_ID and Employee.isAdd=1;";
                            $stmt1 = mysqli_stmt_init($conn);
                            
                            if (!mysqli_stmt_prepare($stmt1, $sql1))
                            {
                                header("location: ../pages/index-login.php?error=stmtfailed");
                                exit();
                            }

                            mysqli_stmt_execute($stmt1);
                            $results1 = mysqli_stmt_get_result($stmt1);
                            $rows1 = mysqli_num_rows($results1);

                            if($rows1 > 0){
                                while($row1 = mysqli_fetch_assoc($results1)){
                                    if($row1['Supervisor_ID'] == -1){
                                        echo "<option value=". $row1['Supervisor_ID'] ."> Unmanaged </option>";
                                    } else{
                                        $row = mysqli_fetch_assoc($results);
                                        echo "<option value=". $row['Supervisor_ID'] . ">". $row['Last_Name'] . "</option>";
                                    }
                                    
                                }
                            }
                            else {
                                echo "<option> None </option>";
                            }

                    echo'</datalist>';
                    }
                    ?>
                    <?php
                    if(Isset($_SESSION["role"]) && ($_SESSION["role"] == "hq manager")) {
                        echo '<div>
                        <span>
                            <h2> Optional: Select Post Office </h2>
                        </span>
                        </div>
                        <input type="text" name="pID" placeholder="Select a Post Office" list="possible-ids1">
                        <datalist id="possible-ids1">';

                            $sql2 = "SELECT * FROM Post_Office;";
                            $stmt2 = mysqli_stmt_init($conn);

                            if (!mysqli_stmt_prepare($stmt2, $sql2))
                            {
                                header("location: ../pages/index-login.php?error=stmtfailed");
                                exit();
                            }

                            mysqli_stmt_execute($stmt2);
                            $results2 = mysqli_stmt_get_result($stmt2);
                            $rows2 = mysqli_num_rows($results2);

                            if($rows2 > 0){
                                while($row2 = mysqli_fetch_assoc($results2)){
                                    echo "<option value=". $row2['Office_ID'] .">". $row2['Office_Name'] ."</option>";
                                }
                            }
                            else {
                                echo "<option> None </option>";
                            }

                    echo'</datalist>';
                    }
                    ?>
                    
                    <div>
                        <span>
                            <h2>Optional: State</h2>
                        </span>
                    </div>
                    <input type="text" name="state" placeholder="TX">
                    
                    <div>
                        <span>
                            <h2>Optional: City</h2>
                        </span>
                    </div>
                    <input type="text" name="city" placeholder="Houston">
                
                    <div>
                        <span>
                            <h2>Optional: Phone Number</h2>
                        </span>
                    </div>
                    
                    <input type="text" name="pNum" placeholder="**********">
                    <div>
                        <span>
                            <h2>Optional: Less than X Employees</h2>
                        </span>
                    </div>
                    <input type="text" name="xPloy" placeholder="Not Currently Implemented">
                    
                    <div>
                        <span>
                            <h2>Optional: Greater than X Packages</h2>
                        </span>
                    </div>
                    <input type="text" name="xPloy" placeholder="Not Currently Implemented">
                    <input type="submit" name="viewPO" value="Search for Post Offices"/>
                    
                </form>


                <p class="heading"> HEADING </p>
                <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>

            </div>
            
        </div>

    </section>
    
</body>
</html>