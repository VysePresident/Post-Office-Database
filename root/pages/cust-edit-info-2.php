<html>
<head>
<!-- edit the user's info, then display their information again, which should reflect changes -->
<?php
    include("../includes/dbh.inc.php");
?>
<section class="header">
    <?php
        include_once '../header.php';
    ?>
</section>
<?php
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $buildingnum = $_POST['building-num'];
    $bnum_converted = (int) $buildingnum;
    $street = $_POST['street-name'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zipcode = $_POST['zip'];
    $pnumber = $_POST['phone-number'];

    // if they entered a first name to be edited
    if (isset($fname) && $fname !==""){
        $sql1 = "UPDATE PostOffice.Customer
        SET First_Name = ?
        WHERE email = ?;"; 
        $stmt1 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt1,$sql1)){
            header("location: ../pages/index-login.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt1, "ss", $fname, $_SESSION["useruid"]);
        mysqli_stmt_execute($stmt1);

        $_SESSION["firstName"] = $fname;
    }

    // if they entered last name to be edited
    if (isset($lname) && $lname !==""){
        $sql2 = "UPDATE PostOffice.Customer
        SET Last_Name = ?
        WHERE email = ?;"; 
        $stmt2 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt2,$sql2)){
            header("location: ../pages/index-login.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt2, "ss", $lname, $_SESSION["useruid"]);
        mysqli_stmt_execute($stmt2);

        $_SESSION["lastName"] = $lname;
    }

    // if they enter email to be edited
    if (isset($email) && $ $email !==""){
        $sql2 = "UPDATE PostOffice.Customer
        SET email = ?
        WHERE Customer_ID = ?;"; 
        $stmt2 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt2,$sql2)){
            header("location: ../pages/index-login.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt2, "ss", $email, $_SESSION["userid"]);
        mysqli_stmt_execute($stmt2);

        $_SESSION["useruid"] = $email;
    }

    // if they enter Building#
    if (isset($buildingnum) && $buildingnum !==""){
        $sql3 = "UPDATE PostOffice.Address
        SET Building_Num = ?
        WHERE Address_Key = ?;"; 
        $stmt3 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt3,$sql3)){
            header("location: ../pages/index-login.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt3, "ii", $bnum_converted, $_SESSION["custAddressKey"]);
        mysqli_stmt_execute($stmt3);
    }

    //if street name
    if (isset($street) && $street !==""){
        $sql4 = "UPDATE PostOffice.Address
        SET Street_Name = ?
        WHERE Address_Key = ?;"; 
        $stmt4 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt4,$sql4)){
            header("location: ../pages/index-login.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt4, "si", $street, $_SESSION["custAddressKey"]);
        mysqli_stmt_execute($stmt4);
    }

    //if city
    if (isset($city) && $city !==""){
        $sql5 = "UPDATE PostOffice.Address
        SET City = ?
        WHERE Address_Key = ?;"; 
        $stmt5 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt5,$sql5)){
            header("location: ../pages/index-login.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt5, "si", $city, $_SESSION["custAddressKey"]);
        mysqli_stmt_execute($stmt5);
        }

    //if state,
    if (isset($state) && $state !==""){
        $sql6 = "UPDATE PostOffice.Address
        SET State = ? 
        WHERE Address_Key = ?;"; 
        $stmt6 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt6,$sql6)){
            header("location: ../pages/index-login.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt6, "si", $state, $_SESSION["custAddressKey"]);
        mysqli_stmt_execute($stmt6);
        }

    //if zip, 
    if (isset($zipcode) && $zipcode !==""){
        $sql7 = "UPDATE PostOffice.Address
        SET Zipcode = ? 
        WHERE Address_Key = ?;"; 
        $stmt7 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt7,$sql7)){
            header("location: ../pages/index-login.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt7, "ii", $zipcode, $_SESSION["custAddressKey"]);
        mysqli_stmt_execute($stmt7);
        }

    // if they entered phone number to be edited
    if (isset($pnumber) && $pnumber !==""){
        $sql8 = "UPDATE PostOffice.Customer
        SET Customer_Phone_Num = ?
        WHERE email = ?;"; 
        $stmt8 = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt8,$sql8)){
            header("location: ../pages/index-login.php?error=stmtfailed");
            exit();
        }
        mysqli_stmt_bind_param($stmt8, "is", $pnumber, $_SESSION["useruid"]);
        mysqli_stmt_execute($stmt8);

        $_SESSION["custpnum"] = $pnumber;
    }

    else {
        echo "Error!";
    }


    // uncomment this to allow you to pull the info from the form and update name based on sessionName person
    /*
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $pnumber = $_POST['phone-number'];

    // TODO: change this. i'm assuming Cornifer is logged in and wants to edit their information.
    $sessionName = "Corniferrr";
    
    $mysqli = new mysqli($host, $username, $password, $database);
    if ($mysqli->connect_error) {
        die("failed to connect: ".$mysqli->connect_error);
    }

    // if they entered a name to be edited
    if (isset($fname)) {
        if (!$mysqli->query("UPDATE Employee SET First_Name = '$fname' WHERE First_Name = '$sessionName';")) {
            echo "QUERY FAILED";
        }
    }

    $mysqli->close();
    */

    // after gathering form info we'll go back to main page where you can see your profile to see the results.
    echo "<script> location.href='customer-services.php'; </script>";
    exit;
?>