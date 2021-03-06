<?php 
  //Author: Maxwell McLeod 
  require_once 'classes/Membership.php'; 
  require_once 'includes/constants.php'; 
 
  $membership = New Membership(); //simple new class call 
  $membership->confirm_member(); //checks if a user is logged in, any user! (yes this is insecure but i made it simple =) 
  $username = $membership->get_username(); //local variable of activer user username 
  $userid = $membership->get_id($username); //local variable of activer user id 

  if ($_POST && $_POST['pword'] && $_POST['orgname']) {
    if ($membership->check_org_pass($_POST['orgname'], $_POST['pword'])) {
      $membership->set_org($userid, $membership->get_org_id_from_name($_POST['orgname']));
      echo "<script>alert('You have successfully joined the organisation');</script>";
    } else {
      echo "<script>alert('Password incorrect');</script>";
    }
  }

  $organisation_id = $membership->get_org_id($username); //get organisation id for user 
  $organisation_name = $membership->get_org_name($organisation_id); //get organisation name for user 
  $orgarray = $membership->get_org_array();

  
?> 

<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>eVent - Join Organisation</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>

  <?php include 'includes/navigation.php' ?>

<main>
  <!-- Page Content -->
  <div class="center">
    <h2>Join Organisation</h2>
    <form class="container" method="post" action="">
      <p>Organisation Name</p>
      <select class="browser-default" name="orgname">
        <?php foreach ($orgarray as $org): ?>
          <option value="<?php echo $org; ?>"><?php echo $org; ?></option>
        <?php endforeach; ?>
      </select>
      <br>
      <div class="input-field col m6 s12">
        <label for="pword" class="active">Organisation Password</label>
        <input type="password" id="pword" name="pword" value="">
      </div>
      <div class="row">
        <button class="btn-large waves-effect waves-light right tooltipped" type="submit" data-position="left" data-delay="50" type="submit" name="action">Submit<i class="material-icons right">send</i></button>
      </div>
    </form>
  </div>
</main>

  <?php include 'includes/footer.php' ?>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

</html>