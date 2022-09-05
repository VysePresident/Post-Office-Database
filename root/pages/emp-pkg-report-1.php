<html>
<head>
<?php
    include_once '../includes/dbh.inc.php';
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
    <section class="sub-header">
        <?php
            include_once '../header.php';
        ?>
    </section>

    <!-- This section replaced with universal header above
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
    </section> 
    -->
    
    <!-- Side Bar -->
    <section class="side-bar-container">
        <?php
            include_once '../a-sidebar.php';
        ?>

        <!-- content -->
        <div class="content">

            <div class="form-col">
            <div>
            <i class="fa fa-database" aria-hidden="true"></i>
                    <span>
                        <h5>Package Report</h5>
                    </span>
                </div>

                <p>Enter fields for which you'd like to filter package reports by. Leave all others blank.</p>
                <br>

                <form method="post" action="emp-pkg-report-2.php" autocomplete="off">
                    <div>
                        <span>
                            <h2>Priority Number</h2>
                        </span>
                    </div>
                    <input type="text" name="prio-num" placeholder="Select a priority filter" list="possible-prios">
                        <datalist id="possible-prios"> 
                            <option> 1 </option>
                            <option> 2 </option>
                            <option> 3 </option>
                        </datalist>

                    <div>
                        <span>
                            <h2>Weight</h2>
                        </span>
                    </div>
                    <input type="number" name="weight" placeholder="Enter max weight in pounds..." min="1">

                    <div>
                        <span>
                            <h2>Volume</h2>
                        </span>
                    </div>
                    <input type="number" name="volume" placeholder="insert max package volume in inches..." min="1">

                    <div>
                        <span>
                            <h2>Package Type</h2>
                        </span>
                    </div>
                    <input type="text" name="type" placeholder="Select a package type..." list="possible-pkg-typs">
                    <datalist id="possible-pkg-typs"> 
                        <option> Standard </option>
                        <option> Fragile </option>
                    </datalist>

                    <div>
                        <span>
                            <h2>Due Within</h2>
                        </span>
                    </div>
                  <input type="number" name="due" placeholder="Enter max days until due..." min="1">

                    <div>
                        <span>
                            <h2>Max Price</h2>
                        </span>
                    </div>
                    <input type="text" name="cost" placeholder="Enter max price in dollars...">

                    
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

                <button type="submit" class="hero-btn red-btn" id="pkg-report-info">Generate Report</button>

                <!-- TODO: can't remove: will mess up side bar, so just hide by using color white in css -->
                <p class="heading"> HEADING </p>
                <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>
            </div> 
            
        </div>

    </section>
    
</body>
</html>    