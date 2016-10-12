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


	$titlearray = array("Mr", "Mrs", "Ms", "Miss", "Mx", "Master", "Maid" ,"Madam", "Other");
	$genderarray = array("Male", "Female", "Other", "Not Applicable");

	get_spec_info($userid);

	//fetches info from database and assigns it to the globals
	function get_spec_info($userid){

		$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
		$query = "SELECT ud_title, ud_fname, ud_lname, ud_username, ud_phone, ud_address, ud_email, ud_dob, ud_sex, ud_occupation FROM user_details WHERE
			ud_user_id = '". $userid . "' LIMIT 1";

		$response = mysqli_query($connection, $query);

		if($response){
			while($row = mysqli_fetch_array($response)){

					$GLOBALS['title'] = $row['ud_title'];
					$GLOBALS['first_name'] = $row['ud_fname'];
					$GLOBALS['username'] = $row['ud_username'];
					$GLOBALS['last_name'] = $row['ud_lname'];
					$GLOBALS['phone'] = $row['ud_phone'];
					$GLOBALS['address'] = $row['ud_address'];
					$GLOBALS['DOB'] = $row['ud_dob'];
					$GLOBALS['sex'] = $row['ud_sex'];
					$GLOBALS['email'] = $row['ud_email'];
					$GLOBALS['occupation'] = $row['ud_occupation'];
			}
		} else {
			echo "FAILURE";
		}

		mysqli_close($connection);
	}

	//yes this is super lazy and terrible code, please fix
	if($_POST){
		if(!$membership->update_details($userid, $_POST['title'], $_POST['fname'], $_POST['username'], $_POST['lname'], $_POST['phone'],
				$_POST['address'], $_POST['dob'], $_POST['sex'], $_POST['email'], $_POST['occupation'])){
			echo "<script>Materialize.toast('Failed to Update Details', 4000);</script>";
		} else{
			echo "<script>Materialize.toast('Details Updated', 4000);</script>";
		}
	}

?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>eVent - Account Settings</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<?php include 'includes/navigation.php' ?>
<body>

	<!-- Page Content -->
	<container>
		<header class="center">
			<h1><?php echo $membership->get_username(); ?></h1>
			<h3>Edit and View your Information Here</h3>
			<h3>User ID: <?php echo $userid; ?></h3>
		</header>

		<div class="row">
			<?php include 'includes/edit_user_details_form.php' ?>
		</div>
		<div class="row">
			<?php include 'includes/edit_user_events.php' ?>
		</div>
	</container>

</body>

<?php include 'includes/footer.php' ?>


<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>



</html>
