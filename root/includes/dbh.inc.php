<?php

//Database Handler File

$serverName = "uhpost.xyz";
$dBUsername = "alex";
$dBPassword = "Team10server";
$dBName = "PostOffice";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}
