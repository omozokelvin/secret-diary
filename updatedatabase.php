<?php

session_start();


if(!array_key_exists('id', $_SESSION) && !$_SESSION['id']){
	header('Location:index.php');
}

if(array_key_exists('content', $_POST)){
	
	include('dbconnection.php');
	
	$query = "UPDATE `users` SET `diary` = '".mysqli_real_escape_string($link, $_POST['content'])."' WHERE `id` = '".mysqli_real_escape_string($link, $_SESSION['id'])."' LIMIT 1";
	
	mysqli_query($link, $query);
}



?>