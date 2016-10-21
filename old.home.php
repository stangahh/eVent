<?php
	//Author: Maxwell McLeod
	require_once 'classes/Membership.php';
	
	$membership = New Membership(); //simple new class call
	$membership->confirm_member(); //checks if a user is logged in, any user! (yes this is insecure but i made it simple =)
	$username = $membership->get_username(); //local variable of activer user username
	$organisation_id = $membership->get_org_id($username); //get organisation id for user
	$organisation_name = $membership->get_org_name($organisation_id); //get organisation name for user
	$events = $membership->get_event_list(0); //fetches an array of all events and stores as local variable
	$animals = array("11111cat", "22222dog", "33333mouse"); // array used for testing purposes
	
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		
		<title>eVent - Home</title>
		
		<meta name="description" content="IFB299 - Website" />
		<meta name="keywords" content="" />
		<meta name="author" content="McLeod" />
		
		<link rel="shortcut icon" href="media/favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		<link rel="stylesheet" type="text/css" href="css/placement1.css" />
		
		<!-- MODERNIZR -->
		<script type="text/javascript" src="javascripts/vendor/modernizr.custom.js"></script>	
		
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
				<h1>eVents<span>Search for events here</span></h1>	
			</header> 
			
		</div><!-- /container -->
		
		<!-- Page Content -->
		
		<div class="main-content">
			<body>
			
		<!-- JQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

		<!-- JS -->
		<script type="text/javascript" src="js/vendor/jquery.hideseek.min.js"></script>
		<script type="text/javascript" src="js/vendor/rainbow-custom.min.js"></script>
		<script type="text/javascript" src="js/vendor/jquery.anchor.js"></script>
		<script src="js/initializers.js"></script>
		<!-- JS ends -->	
			
		<div id="mains">
		
		<!-- Search -->
		
				<div class="row">
				<div class="six columns">
				</div>
				<div class="six columns">
					<article>
						<input id="search" name="search" placeholder="Search for Event name, Location, Detials..." type="text" data-list=".default_list" autocomplete="off">
						<ul class="vertical default_list">
						
						<?php 
						/* This is a bit complex, it steps through the array, trims the witespace, strips the first 5 characters which is always the event id and creates a list
						element that is populated with the array details and links to a dedicated url for each list element. A page for the event hasnt been made yet. The array
						is made through the medthod "$membership->get_org_name($id)". Look at it for details. It can be used in different ways depending on the input of the parameter.
						Dont worry about the concatenation i have worked it on the database side for ease of use =) */
							foreach( $events as &$p ):
							$p = trim($p);
							$id = substr($p, 0, 5);
							$p = substr($p, 5);
						?>
							<li><a href="event.php?eventid=<?php echo $id; ?>"><?php echo $p; ?></a></li>
						<?php endforeach; ?>
			
						</ul>
					</article>
				</div>
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