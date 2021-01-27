<?php

$serverName = "localhost";
$dbUser = "root";
$dbPass = "root";
$dName = "secret_diary";

$link = mysqli_connect($serverName, $dbUser, $dbPass, $dName);
		
		if(mysqli_connect_error($link)){
			
			die("Database connection error");
		
		}

?>