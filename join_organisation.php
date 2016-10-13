<?php 
  //Author: Maxwell McLeod 
  require_once 'classes/Membership.php'; 
  require_once 'includes/constants.php'; 
 
  $membership = New Membership(); //simple new class call 
  $membership->confirm_member(); //checks if a user is logged in, any user! (yes this is insecure but i made it simple =) 
  $username = $membership->get_username(); //local variable of activer user username 
  $organisation_id = $membership->get_org_id($username); //get organisation id for user 
  $organisation_name = $membership->get_org_name($organisation_id); //get organisation name for user 
  $userid = $membership->get_id($username); //local variable of activer user id 
?> 

<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
  <title>eVent - Account Settings</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>

  <?php include 'includes/navigation.php' ?>

<body>
  <!-- Page Content -->
  <div class="center">
    <h2>Join an Organisation</h2>
    <form>
      <select name="orgname">
        <option>Test 1</option>
        <option>Test 2</option>
        <option>Test 3</option>
      </select>
    </form>
  </div>
</body>

  <?php include 'includes/footer.php' ?>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

</html>