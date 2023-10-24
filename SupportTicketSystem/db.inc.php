<?php
$hostname = "localhost";
$username = "root";
$password = "";




$dbname = "supportticketsystem";


$con= mysqli_connect($hostname, $username, $password, $dbname);



if (!$con)
   {
    die ("Failed to connect MySQL: " . mysqli_connect_error());
	}

    ?>