<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

session_start();

$diaryContent ='';


if(array_key_exists('id', $_COOKIE) && $_COOKIE['id']){
	$_SESSION['id'] = $_COOKIE['id'];
}

if(array_key_exists('id', $_SESSION) && $_SESSION['id']){
	
	
	include('dbconnection.php');
	
	$query = "SELECT `diary` from `users` WHERE `id` = '".mysqli_real_escape_string($link, $_SESSION['id'])."' LIMIT 1";
	
	$row = mysqli_fetch_array(mysqli_query($link, $query));
	
	$diaryContent = $row['diary'];
	
} else{
	
	header("Location: index.php");
}

?>

<?php include('header.php'); ?>


	<nav class="navbar navbar-dark navbar-fixed-top bg-dark">
	  <a class="navbar-brand" href="index.php">Secret Diary</a>

		<div class="pull-xs-right">
			<a href='index.php?logout=1'><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button></a>
		</div>
	
	</nav>
	
	<div class="container-fluid">
		<textarea id="diary" class="form-control"><?php echo($diaryContent); ?></textarea>
	</div>

<?php include('footer.php'); ?>