<?php
	session_start();
	require_once 'classes/Membership.php';
	$membership = new Membership();

	//when status is pushed via 'loggout'
	if(isset($_GET['status']) && $_GET['status'] == 'logout'){
		$membership->log_user_out();
	}

	//user enter password and username
	if($_POST && !empty($_POST['username']) && !empty($_POST['pwd'])){
		$catch = $membership->validate_user($_POST['username'], $_POST['pwd']);
	}

 //user signed up 
  if($_POST && !empty($_POST['su_username']) && !empty($_POST['su_pwd']) && !empty($_POST['su_email']) && !empty($_POST['su_org_id'])){ 
    $membership->register_user($_POST['su_username'], $_POST['su_pwd'], $_POST['su_org_id']); 
    $membership->register_user_details($_POST['su_title'], $_POST['su_firstname'], $_POST['su_surname'], $_POST['su_username'], $_POST['su_phone'], $_POST['su_address'], $_POST['su_email'], $_POST['su_dob'], $_POST['su_sex'], $_POST['su_occupation']); 
  } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>eVent</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>

  <!--Login unique top nav -->
  <nav class="orange darken-2 lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#home.php" class="brand-logo">eVent</a>
      <ul class="right hide-on-med-and-down">
        <!-- login page dosn't have links to site content -->
  </nav>

  <div class="parallax-container z-depth-2">
  <div class="parallax"><img alt="image" src="http://technext.github.io/Evento/images/demo/bg-slide-01.jpg"></div>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <!-- title on image -->
      <h1 class="header center orange-text">eVent</h1>
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
<div id="modal1" class="modal">
  <div class="row modal-content">
    <form class="col s12 m8 l6 offset-l3 offset-m2 offset-s0" method="post" action="">
    <div class="row">
        <div class="input-field col s12">
          <input id="su_username" name="su_username" type="text" class="validate">
          <label for="su_username">Username</label>
        </div>
      </div>
      <div class="input-field col s12">
        <select class="browser-default" id="su_title" name="su_title">
          <option value="" enabled selected>Title</option>
          <option value="Mr">Mr</option>
          <option value="Miss">Miss</option>
          <option value="Mrs">Mrs</option>
        </select>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="su_firstname" name="su_firstname" type="text" class="validate">
          <label for="su_firstname" data-error="wrong" data-success="right">First Name</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="su_surname" name="su_surname" type="text" class="validate">
          <label for="su_surname" data-error="wrong" data-success="right">Surname</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="su_dob" name="su_dob" type="text">
          <label for="su_dob" data-error="wrong" data-success="right">Date of Birth</label>
        </div>
      </div>
      <div class="input-field col s12">
        <select class="browser-default" id="su_sex" name="su_sex">
          <option value="" enabled selected>Sex</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="su_pwd" name="su_pwd" type="password" length="18" class="validate">
          <label for="su_pwd">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="su_email" name="su_email" type="email" class="validate">
          <label for="su_email" data-error="wrong" data-success="right">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="su_phone" name="su_phone" type="text" class="validate">
          <label for="su_phone" data-error="wrong" data-success="right">Phone</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="su_address" name="su_address" type="text" class="validate">
          <label for="su_address" data-error="wrong" data-success="right">Address</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="su_occupation" name="su_occupation" type="text" class="validate">
          <label for="su_occupation" data-error="wrong" data-success="right">Occupation</label>
        </div>
      </div>
      <div class="input-field col s12">
          <input id="su_org_id" name="su_org_id"type="text" class="validate">
          <label for="su_org_id">Organisation ID</label>
        </div>
      <p class="col s6">Already registered? <a href="#">Sign In</a></p>
      <button class="btn-large waves-effect waves-light right tooltipped" type="submit" data-position="left" data-delay="50" data-tooltip="Thanks" type="submit" name="signup">Submit
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

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>

  <?php include 'includes/footer.php' ?>
  
</html>
