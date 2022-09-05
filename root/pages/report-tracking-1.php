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
                        <h5>Tracking and Delivery Report Filters:</h5>
                    </span>
                </div>

                <form method="post" action="report-tracking-2.php">

                    <div>
                        <span>
                            <h2>Min Month and Year</h2>
                        </span>
                    </div>
                    <input type="month" name="min_date" placeholder="Enter Starting Month and Year" required>

                    <div>
                        <span>
                            <h2>Max Month and Year</h2>
                        </span>
                    </div>
                  <input type="month" name="max_date" placeholder="Enter Max Month and Year" required>

                  <div>
                        <span>
                            <h2>Optional: Package Priority</h2>
                        </span>
                    </div>
                    <input type="text" name="prio-num" placeholder="1, 2, or 3">

                    <div>
                        <span>
                            <h2>Optional: Package Type</h2>
                        </span>
                    </div>
                    <input type="text" name="type" placeholder="Enter 'Standard' or 'Fragile' [Case sensitive]">

                <button type="submit" class="hero-btn red-btn" id="pkg-report-info">Generate Report</button>

                <!-- TODO: can't remove: will mess up side bar, so just hide by using color white in css -->
                <p class="heading"> HEADING </p>
                <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>
            </div> 
            
        </div>

    </section>
    
</body>
</html>    