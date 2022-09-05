<?php
//Handles Employee Registration

if (isset($_POST["submit"]))
{
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $address = 1; //FIX HARD-CODED ADDRESS KEY
    $phone = 1234567891; //FIX HARD-CODED ADDRESS KEY
    $office_id = 1; //FIX HARD-CODED OFFICE KEY
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($fname, $lname, $email, $pwd, $pwdrepeat) !== false)
    {
        header("location: ../pages/index-employee-signup.php?error=emptyinput");
        exit();
    }
    if(invalidEmail($email) !== false)
    {
        header("location: ../pages/index-employee-signup.php?error=invalidemail");
        exit();
    }
    if(pwdMatch($pwd, $pwdrepeat) !== false)
    {
        header("location: ../pages/index-employee-signup.php?error=passwordsdontmatch");
        exit();
    }
    if(uidExists($conn, $email) !== false)
    {
        header("location: ../pages/index-employee-signup.php?error=usernametaken");
        exit();
    }

    //Replace with createEmployee function
    createEmployee($conn, $fname, $lname, $address, $phone, $office_id, $email, $pwd);

}
else
{
    header("location: ../pages/index-employee-signup.php");
    exit();
}