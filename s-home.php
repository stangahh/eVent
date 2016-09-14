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
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>oZbot</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
  <!--Top nav bar -->
  <nav class="orange darken-2 lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#home.php" class="brand-logo">oZbot</a>
      <ul class="right hide-on-med-and-down">
        <!-- Items on the top nav bar in desktop mode -->
        <li><a href="home.php" class="active tooltipped" data-position="bottom" data-tooltip="What's trending">Home</a></li>
        <li><a href="lsp.php" class="tooltipped" data-position="bottom" data-tooltip="Lots of stuff is on">Find events</a></li>
        <li><a href="login.php?status=loggout" class="tooltipped" data-position="bottom" data-tooltip="Cya later">Logout</a></li>
      </ul>
      <!-- Code for the sidenav -->
        <ul id="nav-mobile" class="side-nav">
        <li>
           <img class="background" src="media/event_img.png">
           <a href="#!name"><span class="name">John Doe</span></a>
       </li>
        <li><a href="home.php"><i class="material-icons">home</i>Home</a></li>
        <li><a href="lsp.php">Find things nearby</a></li>
        <li><div class="divider"></div></li>
        <li><i class="material-icons">lock_open</i><a href="login.php?status=loggout">Logout</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <!-- first image -->
  <div class="parallax-container z-depth-2">
  <div class="parallax"><img alt="image" src="http://technext.github.io/Evento/images/demo/bg-slide-01.jpg"></div>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <!-- title on image -->
      <h1 class="header center orange-text">oZbot</h1>
      <div class="row center">
        <h5 class="header col s12 light">A modern responsive event organiser</h5>
      </div>
      <!-- sign up button -->
      <div class="row center">
        <a data-target="modal1" class="btn-large modal-trigger waves-effect waves-red light-blue darken-4 tooltipped" data-position="bottom" data-delay="50" data-tooltip="Do it">Sign up <i class="material-icons right">perm_identity</i></a>
      </div>
    </div>
  </div>
</div>
<br>
<!-- Sign in form -->
<div class="row">
<form class="col s12 m8 l6 offset-l3 offset-m2 offset-s0" method="post" action="">
<div class="row">
    <div class="input-field col s12">
      <input id="first_name" type="text" name="username" class="validate">
      <label for="first_name">Username</label>
    </div>
  </div>
  <div class="row">
    <div class="input-field col s12">
      <input id="password" name="pwd" type="password" class="validate">
      <label for="password">Password</label>
    </div>
  </div>
  <p class="col s6">Don't have an account? <a class="modal-trigger" data-target="modal1">Sign up</a></p>
  <button name="Login" type="submit" value="Login" class="btn-large waves-effect waves-light waves-red light-blue darken-4 right tooltipped" data-position="left" data-delay="50" data-tooltip="Thanks" type="submit" name="action">Submit
    <i class="material-icons right">send</i>
  </button>
</form>
</div>


<!-- Sign up form -->
<div id="modal1" class="modal bottom-sheet">
  <div class="row modal-content">
    <form class="col s12 m8 l6 offset-l3 offset-m2 offset-s0" method="post" action="">
    <div class="row">
        <div class="input-field col s12">
          <input id="first_name" name="username"type="text" class="validate">
          <label for="first_name">Username</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" name="pwd" type="password" length="18" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" class="validate">
          <label for="email" data-error="wrong" data-success="right">Email</label>
        </div>
      </div>
      <p class="col s6">Already registered? <a href="#">Sign In</a></p>
      <button class="btn-large waves-effect waves-light right tooltipped" data-position="left" data-delay="50" data-tooltip="Thanks" type="submit" name="action">Submit
        <i class="material-icons right">send</i>
      </button>
    </form>
    <br>
  </div>
  </div>
  
  
<!-- second image -->
<div class="parallax-container z-depth-2">
<div class="parallax"><img alt="image" src="http://www.americanspiritcentre.com/wp-content/uploads/2015/06/concert.jpeg"></div>
</div>
<div class="row">
 <p class="flow-text center col s12 m6 offset-s0 offset-m3">Bacon ipsum dolor amet andouille cupim ground round voluptate bresaola consequat. Labore shankle chicken fatback pork ea ham hock id est short ribs short loin jerky veniam. Boudin velit sunt quis tongue tri-tip mollit picanha beef frankfurter prosciutto pork chop. Beef ribs eu pancetta spare ribs. Ham hock cow pariatur ribeye beef ribs jerky pig pork loin ham meatball kielbasa eu t-bone esse.</p>
</div>
<!-- footer with team name -->
  <footer class="page-footer orange">
    <div class="footer-copyright">
      <div class="container" href="tos.php">
      Made by <a class="orange-text text-lighten-3" href="tos.php">NoneOfTheAbove</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
