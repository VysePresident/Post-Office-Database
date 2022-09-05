<?php

//Login for everyone - customers, employees, and managers.

if(isset($_POST["submit"]))
{
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputLogin($username, $pwd) !== false)
    {
        header("location: ../pages/index-login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $pwd);
}

else
{
    header("location: ../pages/index-login.php");
        exit();
}