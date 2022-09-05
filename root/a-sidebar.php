<div class="side-bar" id="sidebar" style="overflow:auto">
    <div class="list">
        <?php
        if(Isset($_SESSION["role"]) && (($_SESSION["role"] == "employee") || ($_SESSION["role"] == "manager") || ($_SESSION["role"] == "hq manager"))){
            echo '<a href="employee-services.php"><div class="icons"><i class="fa fa-user" aria-hidden="true"></i><p id="icon-txt">Employee Information</p></div></a>';
            echo '<a href="emp-create-pkg-1.php"><div class="icons"><i class="fa fa-dropbox" aria-hidden="true"></i><p id="icon-txt">Start Package</p></div></a>';
            echo '<a href="emp-recieved-pkg-1.php"><div class="icons"><i class="fa fa-check" aria-hidden="true"></i><p id="icon-txt">Mark Recieved</p></div></a>';
            echo '<a href="emp-send-out-1.php"><div class="icons"><i class="fa fa-truck" aria-hidden="true"></i><p id="icon-txt">Send Out</p></div></a>';
            echo '<a href="emp-report-lost-1.php"><div class="icons"><i class="fa fa-user-secret" aria-hidden="true"></i><p id="icon-txt">Report Lost</p></div></a>';
            echo '<a href="emp-update-inv-1.php"><div class="icons"><i class="fa fa-book" aria-hidden="true"></i><p id="icon-txt">Update Inventory</p></div></a>';
            echo '<a href="emp-pkg-report-1.php"><div class="icons"><i class="fa fa-database" aria-hidden="true"></i><p id="icon-txt">Package Report</p></div></a>';
            echo '<a href="emp-notifications-1.php"><div class="icons"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><p id="icon-txt">Notifications</p></div></a>';

            if(($_SESSION["role"] == "manager") || ($_SESSION["role"] == "hq manager")){
            echo '<a href="admin-services-ViewEmp.php"><div class="icons"><i class="fa fa-user" aria-hidden="true"></i><p id="icon-txt">View Employees</p></div></a>';
            echo '<a href="admin-services-newEmp.php"><div class="icons"><i class="fa fa-user" aria-hidden="true"></i><p id="icon-txt">Create New Employee</p></div></a>';
            echo '<a href="admin-services-remEmp.php"><div class="icons"><i class="fa fa-user" aria-hidden="true"></i><p id="icon-txt">Remove Employee</p></div></a>';
            echo '<a href="admin-services-offices.php"><div class="icons"><i class="fa fa-user" aria-hidden="true"></i><p id="icon-txt">View Office Reports</p></div></a>';
            echo '<a href="admin-services-purchases.php"><div class="icons"><i class="fa fa-user" aria-hidden="true"></i><p id="icon-txt">View Purchases Report</p></div></a>';
                if($_SESSION["role"] == "hq manager"){
                echo '<a href="admin-services-ViewPO.php"><div class="icons"><i class="fa fa-dropbox" aria-hidden="true"></i><p id="icon-txt">View Post Office</p></div></a>';
                echo '<a href="admin-services-newPO.php"><div class="icons"><i class="fa fa-dropbox" aria-hidden="true"></i><p id="icon-txt">Create Post Office</p></div></a>';
                echo '<a href="admin-services-ViewNotif2.php"><div class="icons"><i class="fa fa-user" aria-hidden="true"></i><p id="icon-txt">Notifications</p></div></a>';
                
                echo '<a href="report-tracking-1.php"><div class="icons"><i class="fa fa-user" aria-hidden="true"></i><p id="icon-txt">Tracking Report</p></div></a>';
                }

            }

        }

        ?>

    </div>
</div>