<html>
<head>
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
                        <h5>Setup a New Post Office</h5>
                    </span>
                    </div>

                    <form method="post" action="admin-services-newPO2.php">
                    <div>
                        <span>
                            <h2>Office Name</h2>
                        </span>
                    </div>
                    <input type="text" name="fname" placeholder="____ Branch" required>

                    <div>
                        <span>
                            <h2>Supervisor ID</h2>
                        </span>
                    </div>
                    <input type="text" name="lname" placeholder="***">

                    <div>
                        <span>
                            <h2>Phone Number</h2>
                        </span>
                    </div>
                    <input type="text" name="phone-number" placeholder="**********" required>
                    
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
                        if(Isset($_SESSION["role"]) && ($_SESSION["role"] == "hq manager")) {
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