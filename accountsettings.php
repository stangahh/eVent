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

	//yes this is porly written but fuck it right
	//also the php on this page should be moved to its own class so please do that i cbf
	// $GLOBALS['title'] = "NULL";
	// $GLOBALS['first_name'] = "NULL";
	// $GLOBALS['username'] = "NULL";
	// $GLOBALS['last_name'] = "NULL";
	// $GLOBALS['phone'] = "NULL";
	// $GLOBALS['address'] = "NULL";
	// $GLOBALS['DOB'] = "NULL";
	// $GLOBALS['sex'] = "NULL";
	// $GLOBALS['email'] = "NULL";
	// $GLOBALS['occupation'] = "NULL";

	get_spec_info($userid);

	//fetches info from database and assigns it to the globals
	function get_spec_info($userid){

		$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
		$query = "SELECT ud_title, ud_fname, ud_lname, ud_username, ud_phone, ud_address, ud_email, ud_dob, ud_sex, ud_occupation FROM user_details WHERE
			ud_user_id = 67863 LIMIT 1";

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
			echo "<SCRIPT>Materialize.toast('Failed to Update Details', 4000);</SCRIPT>";
		} else{
			echo "<SCRIPT>Materialize.toast('Details Updated', 4000);</SCRIPT>";
			header("location: accountsettings.php");
		}
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>eVent - Home</title>

  <!-- CSS  -->
  <link rel="shortcut icon" href="media/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
  <?php include 'includes/navigation.php' ?>
  
			<header class="center">
				<h1><?php echo $membership->get_username(); ?><span> - Edit and View your Information Here</span></h1>
			</header>

		<!-- Page Content -->
		<container>
		<div class="row">
				<form class="center col l12" method="post" action="">
				<!-- Title -->
				 <div class="row">
				 <div class="input-field col s6">
					<select class="browser-default" id="title" name="title">
						<?php foreach ($titlearray as $t): ?>
							<option value="<?php echo $t; ?>" <?php if($t == $GLOBALS['title']){echo 'selected="selected"';} ?>><?php echo $t; ?></option>
						<?php endforeach; ?>
					</select>
					</div>
				</div>
				<!-- First Name -->
				<div class="row">
				 <div class="input-field col s6">
					<label for="fname" id="flabel">First Name</label>
					<input type="text" id="fname" name="fname" value="<?php echo $GLOBALS['first_name']; ?>">
				</div>
				</div>
				<!-- Username Name -->
				<div class="row">
				 <div class="input-field col s6">
					<label for="username" id="flabel">Username Name</label>
					<input type="text" id="username" name="username" value="<?php echo $GLOBALS['username']; ?>">
				</div>
				</div>
				<!-- Last Name -->
				<div class="row">
				 <div class="input-field col s6">
					<label for="lname" id="flabel">Last Name</label>
					<input type="text" id="lname" name="lname" value="<?php echo $GLOBALS['last_name']; ?>">
				</div>
				</div>
				<!-- Phone -->
				<div class="row">
				 <div class="input-field col s6">
					<label for="phone" id="flabel">Phone</label>
					<input type="text" id="phone" name="phone" value="<?php echo $GLOBALS['phone']; ?>">
				</div>
				</div>
				<!-- Address -->
				<div class="row">
				 <div class="input-field col s6">
					<label for="address" id="flabel">Address</label>
					<input type="text" id="address" name="address" value="<?php echo $GLOBALS['address']; ?>">
				</div>
				</div>
				<!-- DOB -->
				<div class="row">
				 <div class="input-field col s6">
					<label for="dob" id="flabel">Date of Birth (Year-Month-Day)</label>
					<input type="text" id="dob" name="dob" value="<?php echo $GLOBALS['DOB']; ?>">
				</div>
				</div>
				<!-- Gender -->
				<div class="row">
				 <div class="input-field col s6">
					<select class="browser-default" id="sex" name="sex">
						<?php foreach ($genderarray as $g): ?>
							<option value="<?php echo $g; ?>" <?php if($g == $GLOBALS['sex']){echo 'selected="selected"';} ?>><?php echo $g; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				</div>
				<!-- Email -->
				<div class="row">
				 <div class="input-field col s6">
					<label for="email" id="flabel">Email Address</label>
					<input type="text" id="email" name="email" value="<?php echo $GLOBALS['email']; ?>">
				</div>
				</div>
				<!--Occipation -->
				<div class="row">
				 <div class="input-field col s6">
					<label for="occupation" id="flabel">Occupation</label>
					<input type="text" id="occupation" name="occupation" value="<?php echo $GLOBALS['occupation']; ?>">
					</div>
					</div>
				<!-- Submit -->
					<button type="submit" value="Update Details">
				</form>
			</div>

	</container>

  		</body>
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



				</html>
