<section class="header">           
    <?php
        include_once '../header.php';
    ?>
</section>

<?php
    include("../includes/dbh.inc.php");
?>
<?php

    $itemNameInput = $_POST['item-name'];
    //$priceInput = $_POST['price'];
    $countIncInput = $_POST['count-inc'];

    $converted = (int) $countIncInput;

    $sql = "UPDATE PostOffice.Items 
    SET Item_Count = Item_Count + ?
    WHERE PO_ID = ? AND Item_Name = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../pages/index-login.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iis", $converted, $_SESSION["officeID"], $itemNameInput);
    mysqli_stmt_execute($stmt);
    


    // after gathering form info from update inventory form (emp-update-inv-2.php), we'll go back to inv-1.php
    // so they can see the reflected changes
    echo "<script> location.href='emp-update-inv-1.php'; </script>";
    exit;
?>