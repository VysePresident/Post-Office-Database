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
                    <h5>View Post Office Employees</h5>
                </span>
                </div>

                <form method="post" action="../pages/admin-services-ViewEmp2.php">
                <?php
                    if(Isset($_SESSION["role"]) && ($_SESSION["role"] == "hq manager")) {
                        echo '<div>
                        <span>
                            <h2> Select Post Office </h2>
                        </span>
                        </div>
                        <input type="text" name="pID" placeholder="Select Post Office" list="possible-ids" required>
                        <datalist id="possible-ids">';

                            $sql = "SELECT * FROM Post_Office;";
                            $stmt = mysqli_stmt_init($conn);

                            if (!mysqli_stmt_prepare($stmt, $sql))
                            {
                                header("location: ../pages/index-login.php?error=stmtfailed");
                                exit();
                            }

                            mysqli_stmt_execute($stmt);
                            $results = mysqli_stmt_get_result($stmt);
                            $rows = mysqli_num_rows($results);

                            if($rows > 0){
                                while($row = mysqli_fetch_assoc($results)){
                                    echo "<option value=". $row['Office_ID'] .">". $row['Office_Name'] ."</option>";
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
                    <h2>Optional: First Name</h2>
                </span>
                </div>
                <input type="text" name="fname" placeholder="John">
                <div>
                <span>
                    <h2>Optional: Last Name</h2>
                </span>
                </div>
                <input type="text" name="lname" placeholder="Doe">
                <input type="submit" name="choosePO" value="Select Office"/>
                </form>


                <p class="heading"> HEADING </p>
                <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>

            </div>
            
        </div>

    </section>
    
</body>
</html>    