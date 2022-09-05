<html>
<head>
<?php
    include("../includes/dbh.inc.php");
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
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <span>
                        <h5>Update Inventory</h5>
                    </span>
                    </div>

                    <form method="POST" action="emp-update-inv-3.php">
                    <div>
                        <span>
                            <h2>Item Name</h2>
                        </span>
                    </div>
                    <input type="text" name="item-name" placeholder="Enter item's name" list="possible-items" required>
                        <datalist id="possible-items"> 
                            <?php
                                //query Items row
                                $itemssql = "SELECT * FROM Items;";
                                $resultDataitem = mysqli_query($conn, $itemssql);
                                $resultDataitem_check = mysqli_num_rows($resultDataitem);
                                if($resultDataitem_check > 0){
                                    while($check = mysqli_fetch_assoc($resultDataitem)){ 
                                        //compare each row's PO ID to session id, return if match
                                        if($check["PO_ID"] == $_SESSION["officeID"])
                                        {
                                            echo "<option>". $check['Item_Name'] ."</option>";
                                        }
                                    }
                                }
                            ?>
                        </datalist>

                    <div>
                        <span>
                            <h2>Price</h2>
                        </span>
                    </div>

                    <div>
                        <span>
                            <h2>Count Increase</h2>
                        </span>
                    </div>
                    <input type="number" name="count-inc" placeholder="Enter item's increase" required>

                    <button type="submit" class="hero-btn red-btn" id="update-inventory-confirm">Confirm</button>

                    <p class="heading"> HEADING </p>
                    <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>

                    </form>
            </div> 
            
        </div>

    </section>
    
</body>
</html>    