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
                    <i class="fa fa-book" aria-hidden="true"></i>
                        <span>
                            <h5>Update Inventory</h5>
                        </span>
                    </div>

                    <table class="content-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Inventory Count</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            include("../includes/dbh.inc.php");
                            ?>
                            <?php
                                //query Items row
                                $itemssql = "SELECT * FROM Items;";
                                $resultDataitem = mysqli_query($conn, $itemssql);
                                $resultDataitem_check = mysqli_num_rows($resultDataitem);

                                //Check for results
                                if($resultDataitem_check > 0){
                                    while($check = mysqli_fetch_assoc($resultDataitem)){ 
                                        //compare each row's PO ID to session id, return if match
                                        if($check["PO_ID"] == $_SESSION["officeID"])
                                        {
                                            echo "<tr> 
                                            <td>" . $check['Item_Name'] . "</td>
                                            <td>" . $check['Item_Cost'] . "</td>
                                            <td>" . $check['Item_Count'] . "</td>
                                            </tr>";
                                        }
                                        
                                        
                                        /**else if($check["PO_ID"] == "2")
                                        {
                                            echo "<tr> 
                                            <td>" . $check['Item_Name'] . "</td>
                                            <td>" . $check['Item_Cost'] . "</td>
                                            <td>" . $check['Item_Count'] . "</td>
                                            </tr>";
                                        }
                                        else if($check["PO_ID"] == "3")
                                        {
                                            echo "<tr> 
                                            <td>" . $check['Item_Name'] . "</td>
                                            <td>" . $check['Item_Cost'] . "</td>
                                            <td>" . $check['Item_Count'] . "</td>
                                            </tr>";
                                        }
                                        /**else{
                                            echo "bleh";
                                        }**/
                                    }
                                }

                            ?>
                            
                        
                        
                        
                            
                        
                        
                        
                        
                        
                        
                        
                            <!-- <tr>
                                <td>item </td>
                                <td>1.00</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>item 2</td>
                                <td>2.00</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>item 3</td>
                                <td>2.00</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>item 4</td>
                                <td>2.00</td>
                                <td>500</td>
                            </tr>
                            <tr>
                                <td>item 5</td>
                                <td>2.00</td>
                                <td>500</td>
                            </tr> -->
                        </tbody>
                    </table>

                    <!-- had to make btn a form so that I could use the action to call a php script to take us somewhere to update -->
                    <form action="emp-update-inv-2.php" method="get">
                        <!-- <input type="submit" class="hero-btn red-btn" id="update-inventory-btn"> --> 
                        <button type="submit" class="hero-btn red-btn" id="update-inventory-btn">Update</button>
                    </form>

                    <!-- <button type="button" class="hero-btn red-btn" id="update-inventory-btn">Update</button> -->

                    <!-- TODO: can't remove: will mess up side bar, so just hide by using color white in css -->
                    <p class="heading"> HEADING </p>
                    <p class="paragraph"> Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus blanditiis cumque voluptate laboriosam? Voluptate delectus saepe impedit, dolores aliquam in possimus corporis rerum a quam itaque dolor animi cupiditate expedita.</p>
            </div> 
            
        </div>

    </section>
    
</body>
</html>    