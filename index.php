 <?php

session_start();

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);




	if(array_key_exists('logout', $_GET)){
		unset($_SESSION['id']); 
		setcookie('id', '', time() - 60 * 60);
		$_COOKIE['id'] = '';
		
	} else if((array_key_exists('id', $_SESSION) AND $_SESSION['id'])  OR (array_key_exists('id', $_COOKIE) AND $_COOKIE['id'])){
		
		header('Location: loggedinpage.php');
	
	}
	$error = "";
	
	if(array_key_exists("submit", $_POST)){
		
		include('dbconnection.php');
		
		
		if(!$_POST['email']){
			
			$error .= "An email address is required<br>";
		}
		
		if ($_POST["email"] != "" && !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
  
			$error .= "Invalid email<br>";
		
		}
		
		if(!$_POST['password']){
			
			$error .= "A password is required<br>";
		} 
		
		if($error != ""){
			
			$error = "<p>There were error(s) in your form</p>".$error;
		
		} else{
			
			if($_POST['signup'] == "1"){
				
			
				$query = "SELECT id from `users` WHERE `email` = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

				$result = mysqli_query($link, $query);

				if(mysqli_num_rows($result) > 0){

					$error = "That email already exists";
				} else{

					$query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";


					if(!mysqli_query($link, $query)){
						$error = "<p>Could not sign you up... please try again later";
					}else{
						
						$query = "SELECT `id` FROM `users` WHERE `email` = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
						
						$row = mysqli_fetch_array(mysqli_query($link, $query));

						$query = "UPDATE `users` SET `password`='".md5(md5($row['id']).$_POST['password'])."' WHERE `id` = '".$row['id']."' LIMIT 1";

						mysqli_query($link, $query);

						$_SESSION["id"] =$row['id'];
						

						if(array_key_exists('stayLoggedIn', $_POST) AND ($_POST['stayLoggedIn'] == '1')){

							setcookie('id', $row['id'], time() + 60*60*24*365);
						}
						
						header("Location: loggedinpage.php");
					}
				}

			} else{
			
				$query = "SELECT * FROM `users` WHERE `email`='".mysqli_real_escape_string($link, $_POST['email'])."'";
				
				$result = mysqli_query($link, $query);
				
				$row = mysqli_fetch_array($result);
				
				if(isset($row)){
					
					$hashedPassword = md5(md5($row['id']).$_POST['password']);
					
					if($hashedPassword == $row['password']){
						
						$_SESSION['id'] = $row['id'];
						
						if($_POST['stayLoggedIn'] == '1'){

							setcookie('id', $row['id'], time() + 60*60*24*365);
						}

						header("Location: loggedinpage.php");
						
					} else{
					
					$error = "The username/password is incorrect!";
				}
					
				} else{
					
					$error = "The username/password is incorrect!";
				}
			
			}
		}
	}

?>






<?php include('header.php'); ?>
	  
	  <div class="container">
    
		  <h1>Secret Diary</h1>
		  
		  <p><strong>Store your deepest thoughts permanently!</strong></p>
		  
		  <div id="error"><?php 
			  if($error != ""){
				  echo '<div class="alert alert-danger" role="alert">'.$error.'
				  </div>';
			  }
			  
			  ?>
		  </div>

		  
		  <form method="post" id="signupForm">
			  
			  <p>Interested? sign up now!</p>
			  
			  <fieldset class="form-group">
				  <input class="form-control" type="text" name="email" placeholder="Enter Email" required autocomplete="off">
			  </fieldset>
			  
			  <fieldset class="form-group">
				  <input class="form-control" type="password" name="password" placeholder="Enter Password" autocomplete="off" required minlength="6">
			  </fieldset>
			  
			  <fieldset class="form-group form-check">
				  <input class="form-check-input" type="checkbox" name="stayLoggedIn" value="1"> Stay logged In
			  </fieldset>
			  
			  <fieldset class="form-group">
				<input type="hidden" name="signup" value="1">
				<input class="btn btn-success" type="submit" name="submit" value="Sign Up!">  
			  </fieldset>
			  
			  <p>Already have an account? <a class="toggleForms">Log In</a></p>
			  
		  </form>
		  

		  <form method="post" id="loginForm">

			   <p>Login using your email and password</p>
			  
			  <fieldset class="form-group">
				  <input class="form-control" type="text" name="email" placeholder="Enter Email" required autocomplete="on"> 
			  </fieldset>
			  
			  <fieldset class="form-group">
				  <input class="form-control" type="password" name="password" placeholder="Enter Password" required autocomplete="off">	  
			  </fieldset>
			  
			  <fieldset class="form-group form-check">
				  <input class="form-check-input" type="checkbox" name="stayLoggedIn" value="1"> Stayed Logged In
			  </fieldset>
			  
			  <fieldset class="form-group">
				  <input type="hidden" name="signup" value="0">
				  <input class="btn btn-success" type="submit" name="submit" value="Log In">		   
			  </fieldset>
			  
			  <p>Don't have an account? <a class="toggleForms">Sign Up</a></p>

		  </form>

	  </div>
	  
	<?php include('footer.php'); ?>