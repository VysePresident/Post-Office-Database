<?php
    include("../includes/dbh.inc.php");
?>

<?php 

    $cartItems = json_decode($_POST['cartItems']);

    foreach ($cartItems as $cartItem) {
        $itemName = $cartItem->title;
        $quantityDec = $cartItem->quantity;
        print_r($quantityDec);
        print_r($$itemName);

        $tracksql = "UPDATE Items SET Items.Item_Count = Items.Item_Count - ? WHERE Items.Item_Name = ? LIMIT 1;";
        $stmtTrack = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmtTrack, $tracksql))
        {
            header("location: ../pages/index-login.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmtTrack, "is", $quantityDec, $itemName);
        mysqli_stmt_execute($stmtTrack);
    }
?>