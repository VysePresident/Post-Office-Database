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


    <!-- <section class="sub-header">
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
        <!-- content -->
        <div class="content">
            <div class="form-col">
                <div>
                    <i class="fa fa-dropbox" aria-hidden="true"></i>
                    <span>
                        <h5>Create Package</h5>
                    </span>
                </div>
                
                <form method="post" action="emp-create-pkg-2.php">
                    <div>
                        <span>
                            <h2>Customer Email</h2>
                        </span>
                    </div>
                    <input type="text" name="email" placeholder="Enter customer's email">
                    <div>
                    <span>
                   <!--     <h2 style="color:gray;">Return Address</h2>
                    </span>
                </div> 
                <div>
                    <span>
                        <h2>Building #</h2>
                    </span>
                </div>
                <input type="text" name="Rbuilding-num" placeholder="Enter building number">

                <div>
                    <span>
                        <h2>Post Office</h2>
                    </span>
                </div>
                <input type="text" name="fname" placeholder="Enter your desired post office"> -->


                

                <!--OUTGOING INFO BELOW-->
                <div>
                        <span>
                            <h2>Building #</h2>
                        </span>
                    </div>
                    <input type="number" name="Dbuilding-num" placeholder="Enter building number" min="1">

                    <div>
                        <span>
                            <h2>Street Name</h2>
                        </span>
                    </div>
                    <input type="text" name="Dstreet-name" placeholder="Enter street name" pattern="[a-zA-Z]+" title="Only characters allowed" maxlength="25" required>

                    <div>
                        <span>
                            <h2>City</h2>
                        </span>
                    </div>
                    <input type="text" name="Dcity" placeholder="Enter city" pattern="[a-zA-Z]+" title="Only characters allowed" maxlength="20" required>
                    
                    <div>
                        <span>
                            <h2>State</h2>
                        </span>
                    </div>
                    <input type="text" name="Dstate" placeholder="Enter state" pattern="[a-zA-Z]+" title="Only characters allowed" maxlength="12" required>

                    <div>
                        <span>
                            <h2>Zipcode</h2>
                        </span>
                    </div>
                    <input type="text" name="Dzip" placeholder="Enter zipcode" pattern="[0-9]{5}" title=" 5 digit zipcode" minlength="5" maxlength="5" required>

                    <div>
                        <span>
                            <h2>Package Type</h2>
                        </span>
                    </div>
                    <input type="text" name="ptype" placeholder="Select package type" list="possible-pkg-typs" required>
                    <datalist id="possible-pkg-typs"> 
                        <option> Standard </option>
                        <option> Fragile </option>
                    </datalist>


                    <div>
                        <span>
                            <h2>Package Weight (lbs)</h2>
                        </span>
                    </div>
                    <input type="number" name="weight" placeholder="Enter package weight" min="1" required>

                    <div>
                        <span>
                            <h2>Package Volume (lbs^3)</h2>
                        </span>
                    </div>
                    <input type="number" name="vol" placeholder="Enter package volume" min="1" required>

                    <div>
                        <span>
                            <h2>Priority</h2>
                        </span>
                    </div>
                    <!-- <input type="text" name="prio" placeholder="Enter priority: 1 2 3"> --> 
                    <input type="text" name="priority" placeholder="Select a priority: 1 fastest" list="possible-prios" required>
                    <datalist id="possible-prios"> 
                        <option> 1 </option>
                        <option> 2 </option>
                        <option> 3 </option>
                    </datalist>
                    
                    <button type="submit" class="hero-btn red-btn" id="emp-conf-ship-btn">Create</button>

                    <p class="heading"> HEADING </p>
                    <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>


                    </div> 
            
        </div>
    </section>
    
</body>
</html>