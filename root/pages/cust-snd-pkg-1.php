<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Self Services</title>
<link rel="stylesheet" href="../css/customer-services.css">
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
                    <li><a href="customer-services.php">CUSTOMER SELF SERVICES</a></li>
                    <li><a href="">LOGOUT</a></li>
                </ul>
            </div>
        </nav>
            <h1></h1>
    </section> -->

    <!-- Side Bar -->
    <section class="side-bar-container">
        <div class="side-bar" id="sidebar">
            <div class="list">
                <a href="customer-services.php"><div class="icons"><i class="fa fa-user" aria-hidden="true"></i><p id="icon-txt">Customer Information</p></div></a>
                <a href="cust-pkg-info-1.php"><div class="icons"><i class="fa fa-dropbox" aria-hidden="true"></i><p id="icon-txt">Package Information</p></div></a>
                <a href="cust-snd-pkg-1.php"><div class="icons"><i class="fa fa-truck" aria-hidden="true"></i><p id="icon-txt">Create a Package</p></div></a>
                <a href="cust-report-lost-1.php"><div class="icons"><i class="fa fa-user-secret" aria-hidden="true"></i><p id="icon-txt">Report Lost</p></div></a>
                <!-- <a href="cust-shop.php"><div class="icons"><i class="fa fa-book" aria-hidden="true"></i><p id="icon-txt">Shop</p></div></a> -->
            </div>
        </div>

        <!-- content -->
        <div class="content">

            <div class="form-col">
                <div>
                <i class="fa fa-truck" aria-hidden="true"></i>
                <span>
                    <h5>Send Package to:</h5>
                </span>
                </div>

                <form method="post" action="cust-snd-pkg-2.php" autocomplete="off">
                <!-- Decision moved to Employee
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
                    <!-- <input type="text" name="ptype" placeholder="Enter Package Type (Standard/Fragile)" required> --> 
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


                    <div>
                    <i class="fa fa-truck" aria-hidden="true"></i>
                    <span>
                        <h5>Drop Off Location:</h5>
                    </span>
                    </div>

                    <input type="text" name="pkg-drop-off-location" placeholder="Select a post office to drop off at" list="possible-locations" required>
                    <datalist id="possible-locations"> 
                        <option>Houston Branch</option>
                        <option>Austin Branch</option>
                        <option>Dallas Branch</option>
                    </datalist>

                    
                    <button type="submit" class="hero-btn red-btn" id="cust-conf-ship-btn">Create</button>

                    <p class="heading"> HEADING </p>
                    <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>

                    </form>
            </div> 
            
        </div>

    </section>
    
</body>
</html>    