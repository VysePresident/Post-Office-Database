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
                        <h5>New Employee Information</h5>
                    </span>
                    </div>

                    <form method="post" action="admin-services-newEmp2.php">
                    <div>
                        <span>
                            <h2>First Name</h2>
                        </span>
                    </div>
                    <input type="text" name="fname" placeholder="John" required>

                    <div>
                        <span>
                            <h2>Last Name</h2>
                        </span>
                    </div>
                    <input type="text" name="lname" placeholder="Doe" required>

                    <div>
                        <span>
                            <h2>Phone Number</h2>
                        </span>
                    </div>
                    <input type="text" name="phone-number" placeholder="**********" required>


                    <!-- This section should be automatic if they are a normal manager -->
                    <?php
                    if(isset($_SESSION["role"]) && ($_SESSION["role"] == "hq manager")) {
                        echo '<div>
                                <span>
                                    <h2> Select Post Office </h2>
                                </span>
                            </div>';
                        echo '<input type="text" name="location" placeholder="Select Post Office" list="possible-ids" required>';
                        echo '<datalist id="possible-ids">';
                            
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
                    echo '</datalist>';
                    }
                    ?>
                    <div>
                        <span>
                            <h2>Supervisor ID</h2>
                        </span>
                    </div>
                    <input type="text" name="supervisor" placeholder="****">

                    <div>
                        <span>
                            <h2>Email</h2>
                        </span>
                    </div>
                    <input type="text" name="email" placeholder="jDoe321@postOffice.com" required>

                    <div>
                        <span>
                            <h2>password</h2>
                        </span>
                    </div>
                    <input type="text" name="pwd" placeholder="*****" required>

                    <div>
                        <span>
                            <h2>Building Number</h2>
                        </span>
                    </div>
                    <input type="text" name="building-number" placeholder="****" required>
                    
                    <div>
                        <span>
                            <h2>City</h2>
                        </span>
                    </div>
                    <input type="text" name="city" placeholder="Houston" required>

                    <div>
                        <span>
                            <h2>Street Name</h2>
                        </span>
                    </div>
                    <input type="text" name="street-name" placeholder="2nd Street" required>
                    <div>
                        <span>
                            <h2>Zipcode</h2>
                        </span>
                    </div>
                    <input type="text" name="zipcode" placeholder="*****" required>
                    <div>
                        <span>
                            <h2>State</h2>
                        </span>
                    </div>
                    <input type="text" name="state" placeholder="TX" required>
                    <?php
                    if(Isset($_SESSION["role"]) && (($_SESSION["role"] == "hq manager") || ($_SESSION["role"] == "manager"))) {
                        echo '<button type="submit" class="hero-btn red-btn" id="emp-add-emp-btn">Add Employee</button>';
                    }
                    ?>

                    <p class="heading"> HEADING </p>
                    <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>

            </div> 
            
        </div>

    </section>
    
</body>
</html>    