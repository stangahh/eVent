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
	$GLOBALS['title'] = "NULL";
	$GLOBALS['first_name'] = "NULL";
	$GLOBALS['middle_name'] = "NULL";
	$GLOBALS['last_name'] = "NULL";
	$GLOBALS['home_phone'] = "NULL";
	$GLOBALS['mobile_phone'] = "NULL";
	$GLOBALS['address'] = "NULL";
	$GLOBALS['DOB'] = "NULL";
	$GLOBALS['sex'] = "NULL";
	$GLOBALS['email'] = "NULL";
	$GLOBALS['occupation'] = "NULL";
	
	get_spec_info($userid);
	
	//fetches info from database and assigns it to the globals
	function get_spec_info($userid){
		
		$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
		$query = "SELECT ud_title, ud_fname, ud_lname, ud_mname, ud_hphone, ud_mphone, ud_address, ud_email, ud_dob, ud_sex, ud_occupation FROM user_details WHERE 
			ud_user_id = '". $userid . "' LIMIT 1";
			
		$response = mysqli_query($connection, $query);
			
		if($response){
			while($row = mysqli_fetch_array($response)){
					
					$GLOBALS['title'] = $row['ud_title'];
					$GLOBALS['first_name'] = $row['ud_fname'];
					$GLOBALS['middle_name'] = $row['ud_mname'];
					$GLOBALS['last_name'] = $row['ud_lname'];
					$GLOBALS['home_phone'] = $row['ud_hphone'];
					$GLOBALS['mobile_phone'] = $row['ud_mphone'];
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
		if(!$membership->update_details($userid, $_POST['title'], $_POST['fname'], $_POST['mname'], $_POST['lname'], $_POST['hphone'], $_POST['mphone'], 
				$_POST['address'], $_POST['dob'], $_POST['sex'], $_POST['email'], $_POST['occupation'])){
			echo "<SCRIPT>alert('Failed to Update Details');</SCRIPT>";
		} else{
			echo "<SCRIPT>alert('Details Updated');</SCRIPT>";
			header("location: accountsettings.php");
		}
	}
	
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		
		<title>eVent - Account Settings</title>
		
		<meta name="description" content="IFB299 - Website" />
		<meta name="keywords" content="" />
		<meta name="author" content="McLeod" />
		
		<link rel="shortcut icon" href="media/favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/placement2.css" />
		
		<script src="js/modernizr.custom.js"></script>
	</head>
	<body>
		<div class="container">
			<ul id="gn-menu" class="gn-menu-main">
				<li class="gn-trigger">
					<a class="gn-icon gn-icon-menu"><span>Menu</span></a>
					<nav class="gn-menu-wrapper">
						<div class="gn-scroller">
							<ul class="gn-menu">
								<li><a class="gn-icon gn-icon-earth" href="home.php">Home</a></li>
								<li><a class="gn-icon gn-icon-help" href="lsp.php">Location Services</a></li>
								<li><a class="gn-icon gn-icon-article" href="tos.php">Terms of Service</a></li>
								<li><a class="gn-icon gn-icon-cog" href="accountsettings.php">Settings</a></li>
								<li><a class="gn-icon gn-icon-earth" href="login.php?status=loggout">Logout</a></li>
							</ul>
						</div><!-- /gn-scroller -->
					</nav>
				</li>
				<!-- <li><a href="">Page Menu 1</a></li> -->
				<!-- <li><a href="">Page Menu 2</a></li> -->
				<!-- <li><a href="">Page Menu 3</a></li> -->
				<li><a href="accountsettings.php"><span><?php echo $organisation_name . " - " . $username ?></span></a></li>
				<li></li>
			</ul>
					
			<header>
				<h1><?php echo $username; ?><span>Edit and View your Information Here</span></h1>	
			</header>
			
		</div><!-- /container -->
		
		<!-- Page Content -->
		
		<div class="main-content">
			<body>
				
				<div id="ceditsettings">

			<div id="formbody">
				<form method="post" action="">
				<!-- Title -->
					<label for="title" id="flabel">Title</label>
					<select id="title" name="title">
						
						<?php foreach ($titlearray as $t): ?>
							<option value="<?php echo $t; ?>" <?php if($t == $GLOBALS['title']){echo 'selected="selected"';} ?>><?php echo $t; ?></option>
						<?php endforeach; ?>

					</select>
					
				<!-- First Name -->
					<label for="fname" id="flabel">First Name</label>
					<input type="text" id="fname" name="fname" value="<?php echo $GLOBALS['first_name']; ?>">
				<!-- Middle Name -->
					<label for="mname" id="flabel">Middle Name</label>
					<input type="text" id="mname" name="mname" value="<?php echo $GLOBALS['middle_name']; ?>">
				<!-- Last Name -->
					<label for="lname" id="flabel">Last Name</label>
					<input type="text" id="lname" name="lname" value="<?php echo $GLOBALS['last_name']; ?>">
				<!-- Home Phone -->
					<label for="hphone" id="flabel">Home Phone</label>
					<input type="text" id="hphone" name="hphone" value="<?php echo $GLOBALS['home_phone']; ?>">
				<!-- Mobile Phone -->
					<label for="mphone" id="flabel">Mobile Phone</label>
					<input type="text" id="mphone" name="mphone" value="<?php echo $GLOBALS['mobile_phone']; ?>">
				<!-- Address -->
					<label for="address" id="flabel">Address</label>
					<input type="text" id="address" name="address" value="<?php echo $GLOBALS['address']; ?>">
				<!-- DOB -->
					<label for="dob" id="flabel">Date of Birth (Year-Month-Day)</label>
					<input type="text" id="dob" name="dob" value="<?php echo $GLOBALS['DOB']; ?>">
				<!-- Gender -->
					<label for="sex" id="flabel">Gender</label>
					<select id="sex" name="sex">
					
						<?php foreach ($genderarray as $g): ?>
							<option value="<?php echo $g; ?>" <?php if($g == $GLOBALS['sex']){echo 'selected="selected"';} ?>><?php echo $g; ?></option>
						<?php endforeach; ?>
	
						
					</select>
				<!-- Email -->
					<label for="email" id="flabel">Email Address</label>
					<input type="text" id="email" name="email" value="<?php echo $GLOBALS['email']; ?>">
				<!--Occipation -->
					<label for="occupation" id="flabel">Occupation</label>
					<input type="text" id="occupation" name="occupation" value="<?php echo $GLOBALS['occupation']; ?>">

				<!-- Submit -->
					<input type="submit" value="Update Details">
				</form>
			</div>
				
	
				</div>
				
			</body>
		</div>
		
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>