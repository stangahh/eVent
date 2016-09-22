<?php
  //Author: Maxwell McLeod
  require_once 'classes/Membership.php';

  $membership = New Membership(); //simple new class call
  $membership->confirm_member(); //checks if a user is logged in, any user! (yes this is insecure but i made it simple =)
  $username = $membership->get_username(); //local variable of activer user username
  $organisation_id = $membership->get_org_id($username); //get organisation id for user
  $organisation_name = $membership->get_org_name($organisation_id); //get organisation name for user
  $events = $membership->get_event_list(0); //fetches an array of all events and stores as local variable

  if (isset($_POST['submit'])) {
    $_SESSION['event_name'] = $_POST['event_name'];
    $_SESSION['event_desc'] = $_POST['event_desc'];
  }
?>
  
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>eVent - Event Preview</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>

  <?php include 'includes/navigation.php' ?>

  <!-- New page content  -->
  <div class="row">
    <h1 class="heading center">Event Preview</h1>
    <p><?php echo $_POST['event_name'] ?></p>
    <p><?php echo $_POST['event_desc'] ?></p>
  </div>

  <!-- Here put Submit button that actually goes to database-->

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>


</body>

<?php include 'includes/footer.php' ?>

</html>
