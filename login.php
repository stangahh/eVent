<?php
	session_start();
	require_once 'classes/Membership.php';
	$membership = new Membership();
	
	//when status is pushed via 'loggout'
	if(isset($_GET['status']) && $_GET['status'] == 'loggout'){
		$membership->log_user_out();
	}
	
	//user enter password and username
	if($_POST && !empty($_POST['username']) && !empty($_POST['pwd'])){
		$catch = $membership->validate_user($_POST['username'], $_POST['pwd']);
	}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
	<title>eVent Login Page</title>
    <link rel="stylesheet" href="css/loginpagestyle.css">
	<link rel="shortcut icon" href="media/favicon.ico">
	<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  </head>

  <body>

    <div class="login-page">
	
	<div class="form">
	<img src="media/event_img.png" alt="eVent" align="center" style="width:250px;height:250px;padding-bottom:45px;">
  
    <form class="register-form">
      <input type="text" placeholder="name"/>
      <input type="password" placeholder="password"/>
      <input type="text" placeholder="email address"/>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
	
    <form class="login-form" method="post" action="">
      <input type="text" name="username" placeholder="username"/>
      <input type="password" name = "pwd" placeholder="password"/>
      <button type="submit" value="Login" name="Login">login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form

  </div>
  
</div>
		<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="js/index.js"></script>
    
  </body>
</html>
