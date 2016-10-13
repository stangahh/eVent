<?php
  session_start();
  require_once 'classes/Membership.php';
  $membership = new Membership();
  
  if($_POST && !empty($_POST['userid']) && !empty($_POST['pass1']) && !empty($_POST['pass2']) && $_POST['pass1'] == $_POST['pass2']){
    $membership->change_user_password($_POST['userid'], md5($_POST['pass1']));
	header('Location: login.php?pw_change=0');
  } else {
	  
	if(!isset($_GET['io7u'])){
		echo "<script>alert('The Passwords Did not Match! Try Again.');</script>";
	} 
  }
  
  $uid='00000';
  
  if(isset($_GET['id'])){
	  $uid = $_GET['id'];
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>eVent</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
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
      <br>
      <br>
      <!-- title on image -->
	  <div class="row center">
      <h1 class="header center orange-text">eVent</h1>
	  </div>
    </div>
  </div>
  </div>
  <br>
  <!-- Sign in form -->
  <div class="row">
    <form class="col s12 m8 l6 offset-l3 offset-m2 offset-s0" method="post" action="passreset.php?id=<?php echo $_GET['id'] ?>">
      <div class="row">
        <div class="input-field col s12">
          <input id="pass1" type="password" name="pass1" class="validate" required>
          <label for="first_name">Enter New Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="pass2" name="pass2" type="password" class="validate" required>
          <label for="password">Enter New Password Again</label>
        </div>
      </div>
	  <div class="input-field col s12">
          <input id="userid" type="text" name="userid" style="display :none" value="<?php echo $uid ?>" class="validate" required>
          <label for="first_name"></label>
       </div>
      <button name="Login" type="submit" value="Login" class="btn-large waves-effect waves-light waves-red light-blue darken-4 right tooltipped" data-position="left" data-delay="50" data-tooltip="Thanks" type="submit" name="action">Submit
        <i class="material-icons right">send</i>
      </button>
    </form>
  </div>


  

  <!-- Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>
</body>

<?php include 'includes/footer.php' ?>

</html>
