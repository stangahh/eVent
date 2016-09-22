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
	$GLOBALS['title'] = "";
	$GLOBALS['first_name'] = "";
	$GLOBALS['last_name'] = "";
	$GLOBALS['phone'] = "";
	$GLOBALS['address'] = "";
	$GLOBALS['DOB'] = "";
	$GLOBALS['sex'] = "";
	$GLOBALS['email'] = "";
	$GLOBALS['occupation'] = "";

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
			echo "<SCRIPT>Materialize.toast('Failed to Update Details', 4000);</SCRIPT>";
		} else{
			echo "<SCRIPT>Materialize.toast('Details Updated', 4000);</SCRIPT>";
			header("location: accountsettings.php");
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
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
	<?php include 'includes/navigation.php' ?>
	
	<!-- Page Content -->
	<container>
		<header class="center">
			<h1><?php echo $membership->get_username(); ?></h1>
			<h3>Edit and View your Information Here</h3>
		</header>
		
		<div class="row">
			<form class="col s12 m8 l6 offset-l3 offset-m2 offset-s0" method="post" action="">
			<!-- Title -->
			 <div class="row">
			 <div class="input-field col s12">
				<select class="browser-default" id="title" name="title">
					<?php foreach ($titlearray as $t): ?>
						<option value="<?php echo $t; ?>" <?php if($t == $GLOBALS['title']){echo 'selected="selected"';} ?>><?php echo $t; ?></option>
					<?php endforeach; ?>
				</select>
				</div>
			</div>
			<!-- First Name -->
			<div class="row">
			 <div class="input-field col s12">
				<label for="fname" id="flabel">First Name</label>
				<input type="text" id="fname" name="fname" value="<?php echo $GLOBALS['first_name']; ?>">
			</div>
			</div>
			<!-- Username Name -->
			<div class="row">
			 <div class="input-field col s12">
				<label for="username" id="flabel">Username Name</label>
				<input type="text" id="username" name="username" value="<?php echo $GLOBALS['username']; ?>">
			</div>
			</div>
			<!-- Last Name -->
			<div class="row">
			 <div class="input-field col s12">
				<label for="lname" id="flabel">Last Name</label>
				<input type="text" id="lname" name="lname" value="<?php echo $GLOBALS['last_name']; ?>">
			</div>
			</div>
			<!-- Phone -->
			<div class="row">
			 <div class="input-field col s12">
				<label for="phone" id="flabel">Phone</label>
				<input type="text" id="phone" name="phone" value="<?php echo $GLOBALS['phone']; ?>">
			</div>
			</div>
			<!-- Address -->
			<div class="row">
			 <div class="input-field col s12">
				<label for="address" id="flabel">Address</label>
				<input type="text" id="address" name="address" value="<?php echo $GLOBALS['address']; ?>">
			</div>
			</div>
			<!-- DOB -->
			<div class="row">
			 <div class="input-field col s12">
				<label for="dob" id="flabel" class="datepicker">Date of Birth</label>
				<input type="text" id="dob" name="dob" value="<?php echo $GLOBALS['DOB']; ?>">
			</div>
			</div>
			<!-- Gender -->
			<div class="row">
			 <div class="input-field col s12">
				<select class="browser-default" id="sex" name="sex">
					<?php foreach ($genderarray as $g): ?>
						<option value="<?php echo $g; ?>" <?php if($g == $GLOBALS['sex']){echo 'selected="selected"';} ?>><?php echo $g; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			</div>
			<!-- Email -->
			<div class="row">
			 <div class="input-field col s12">
				<label for="email" id="flabel">Email Address</label>
				<input type="text" id="email" name="email" value="<?php echo $GLOBALS['email']; ?>">
			</div>
			</div>
			<!--Occipation -->
			<div class="row">
				<div class="input-field col s12">
					<label for="occupation" id="flabel">Occupation</label>
					<input type="text" id="occupation" name="occupation" value="<?php echo $GLOBALS['occupation']; ?>">
				</div>
			</div>
			
			<!-- Submit -->
			<button class="btn-large waves-effect waves-light right tooltipped" type="submit" data-position="left" data-delay="50" data-tooltip="Cool beans" type="submit" name="action">Submit<i class="material-icons right">send</i>
    		</button>

			</form>
		</div>
	</container>

</body>

<?php include 'includes/footer.php' ?>


<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>



</html>
