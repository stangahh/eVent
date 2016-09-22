<?php
	//Author: Maxwell McLeod
	//This page is good as a blank page template
	require_once 'classes/Membership.php';
	
	$membership = New Membership(); //simple new class call
	$membership->confirm_member(); //checks if a user is logged in, any user! (yes this is insecure but i made it simple =)
	$username = $membership->get_username(); //local variable of activer user username
	$organisation_id = $membership->get_org_id($username); //get organisation id for user
	$organisation_name = $membership->get_org_name($organisation_id); //get organisation name for user
?>

<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		
		<title>eVent - TOS</title>
		
		<meta name="description" content="IFB299 - Website" />
		<meta name="keywords" content="" />
		<meta name="author" content="McLeod"/>
		
		<link rel="shortcut icon" href="media/favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		
		
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
								<!-- <li class="gn-search-item">
									<input placeholder="Search" type="search" class="gn-search">
									<a class="gn-icon gn-icon-search"><span>Search</span></a>
								</li> -->
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
				<h1>Terms of Service<span>Agreement for the use of this website</span></h1>	
			</header> 
			
		</div><!-- /container -->
		
		<!-- Page Content -->
		
		<div class="main-content" style=" padding-right: 300px; color: white; font-family: 'Lato', Arial, sans-serif; ">
			<body>
				<p>Bacon ipsum dolor amet meatloaf pastrami turkey tri-tip. Porchetta picanha t-bone, jowl beef hamburger tenderloin ribeye andouille filet mignon strip steak beef ribs kielbasa cupim. Ground round turducken chicken kevin kielbasa corned beef drumstick tenderloin pastrami chuck doner porchetta spare ribs beef ribs flank. Beef ribeye t-bone chuck turkey. Ribeye turducken t-bone, alcatra bacon drumstick spare ribs beef ribs short loin landjaeger.</p>
				<p>Shoulder ribeye shankle, ham salami venison tenderloin meatball leberkas fatback pork belly shank landjaeger ground round. Sausage rump kielbasa drumstick corned beef tongue bacon boudin spare ribs prosciutto strip steak ground round meatball biltong jerky. Swine prosciutto shank pancetta short ribs flank leberkas tail tri-tip corned beef salami beef ribs tongue pastrami sausage. Porchetta beef frankfurter, venison corned beef capicola pork loin rump pancetta. Flank pork belly meatball short ribs, ham hock jerky andouille cupim doner swine biltong boudin. Ground round ribeye jowl salami pork, capicola ball tip.</p>
				<p>Andouille salami capicola cow leberkas ham ham hock pork belly. Pastrami ribeye leberkas kevin tail pig cupim short ribs spare ribs filet mignon chicken picanha beef ribs. Sausage corned beef prosciutto pig jowl, tongue short ribs. Frankfurter drumstick beef ribs hamburger, turkey short ribs pancetta shank chicken corned beef brisket shankle. Beef ribs ham pork pork loin pastrami kevin capicola tongue pork belly spare ribs ground round shank rump alcatra.</p>
				<p>Pork chop alcatra turkey chuck bacon prosciutto leberkas ground round salami beef porchetta. Capicola sirloin tongue biltong leberkas salami turducken cupim strip steak. Tail shoulder filet mignon alcatra. Cupim filet mignon alcatra, beef jerky tri-tip spare ribs capicola turducken andouille sirloin drumstick rump pig strip steak.</p>
				<p>Andouille doner shank ham hock. Ball tip filet mignon capicola turkey bacon boudin. Swine fatback t-bone pastrami meatloaf. Tri-tip pig andouille shank boudin pork loin, sirloin biltong filet mignon bacon. Swine capicola andouille ground round pork chop tail kevin t-bone frankfurter drumstick bresaola pastrami strip steak cupim. Chicken kevin tail, short ribs turkey tri-tip pork chop sirloin jerky. Jerky picanha jowl, sausage meatloaf capicola swine drumstick cow andouille shankle tri-tip cupim sirloin pork loin.</p>			
			</body>
		</div>
		
		<script src="js/classie.js"></script>
		<script src="js/gnmenu.js"></script>
		<script>
			new gnMenu( document.getElementById( 'gn-menu' ) );
		</script>
	</body>
</html>