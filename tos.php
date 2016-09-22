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
  <h1 class="center">Terms of Service</h1>
  <p class ="tos">Bacon ipsum dolor amet deserunt nostrud magna, cow beef incididunt consectetur swine salami anim veniam shank dolore. Leberkas doner ut strip steak sed brisket, andouille corned beef ut eu. Sirloin ribeye spare ribs veniam turkey fugiat. Consectetur fugiat chuck sunt, filet mignon dolor pork adipisicing. Officia voluptate doner ut aliquip est laborum. Velit est ea picanha, ham sirloin consectetur. Meatball ipsum reprehenderit swine excepteur, in meatloaf bresaola ad short ribs tempor. Cupidatat do meatball alcatra jerky frankfurter ham andouille pork belly elit spare ribs nostrud aute. Occaecat ut eu magna beef ribs tri-tip laboris turducken frankfurter non shoulder. Rump andouille jerky, ball tip frankfurter id chuck. Mollit shank hamburger incididunt elit. Frankfurter tongue pig capicola minim in pork loin pastrami id. Shoulder nulla beef consequat prosciutto ham hock.
  <br><br> 
  Reprehenderit cupim sunt jowl, pastrami pig ground round ipsum proident aliquip pork chop cow id. Kielbasa culpa andouille id, occaecat leberkas labore sint biltong deserunt. Dolore pork loin ground round, adipisicing lorem aute voluptate enim turducken esse boudin drumstick meatloaf do. Adipisicing laborum voluptate cow. Velit pork chop reprehenderit dolore turducken, ut corned beef chuck duis ribeye in. Bresaola prosciutto meatball laboris. Dolore shank aute enim salami sirloin drumstick porchetta frankfurter. Commodo ham hock pastrami, rump excepteur sint beef ribs et biltong pig cow. Consequat do aute dolore, landjaeger excepteur anim doner officia. Leberkas sirloin exercitation, minim bresaola laboris turducken esse dolore. Dolor corned beef strip steak jerky nulla. Corned beef doner rump, nulla shoulder qui strip steak officia shankle dolore velit. Short ribs elit tempor sint kevin. Tempor nisi boudin veniam. Tri-tip culpa elit ut voluptate, pig cupidatat laborum turkey beef ribs esse cupim. Shank meatloaf cupim, ribeye adipisicing turkey leberkas velit jowl dolor irure sunt alcatra pork loin chicken.
  <br><br>
  Cillum doner ex leberkas tempor non. Ut voluptate pancetta pork chop, pork beef ribs short loin turkey pariatur proident. Shoulder anim landjaeger capicola, tongue ham hock porchetta brisket ribeye irure et id short loin. Cow corned beef swine elit doner tenderloin. Flank eiusmod sirloin rump. Sed cillum chicken tenderloin alcatra. Landjaeger turducken leberkas id sunt, sirloin deserunt pork chop tempor chicken swine. Anim ad turducken porchetta, cillum ribeye consectetur in ut biltong non. Bresaola in boudin pig pork loin proident. Occaecat meatloaf tail, swine meatball ex sunt cupidatat consequat exercitation in do filet mignon ham hock. Cupim voluptate pork t-bone, boudin excepteur veniam ball tip esse dolore laborum.
  <br><br>
  Beef ribs id lorem, andouille picanha velit reprehenderit ex. In pork loin spare ribs, bresaola chicken quis incididunt tenderloin. Pastrami jerky nisi veniam do, tri-tip quis boudin officia. Veniam cupim short ribs pork chop frankfurter. Meatball proident velit salami, ut qui incididunt sunt adipisicing tail eu ut in in officia. Capicola shank laborum aliqua incididunt short loin aliquip cillum reprehenderit. Meatball enim occaecat tri-tip eu, kevin est velit laborum porchetta cow nostrud. Ut nisi in magna jerky pork dolore adipisicing elit ipsum esse. Non aliqua nisi pariatur.
  <br><br>
  Sint cupim ground round exercitation. Laborum deserunt venison consequat ea, t-bone qui et meatloaf. Leberkas flank anim pork loin picanha nostrud salami laboris meatloaf turkey. Pastrami kevin doner deserunt leberkas tail qui corned beef in eiusmod duis drumstick ham. Aliquip deserunt ut porchetta meatball eu corned beef cillum kevin pork loin pastrami short ribs. Veniam t-bone shoulder, aliqua cupidatat hamburger nulla ea alcatra. Andouille ut alcatra nisi shoulder rump velit ullamco sirloin landjaeger incididunt ad. Kielbasa pariatur in leberkas cupim ribeye. Frankfurter pancetta corned beef chicken labore andouille ham hock. T-bone mollit tenderloin, nostrud tri-tip bresaola dolore flank laboris id duis. Cupidatat laboris pork eu, consequat sint ea reprehenderit sed commodo. Nostrud laboris pig meatball hamburger excepteur ut turducken labore ham hock filet mignon exercitation shoulder cow ex.
  <br><br>
  Strip steak in ham hock ullamco veniam. Do venison magna, filet mignon elit cupim sunt meatball. Consectetur biltong hamburger incididunt pork. Porchetta ad alcatra ipsum ball tip quis laborum dolor ribeye. Commodo consectetur aute tri-tip nulla esse meatball ex, qui bacon adipisicing sausage biltong. Pork chicken meatloaf, t-bone consequat chuck elit laborum biltong voluptate pig dolor. Dolor alcatra aliqua bacon boudin jowl et enim doner fatback. Biltong swine shank tail sirloin fugiat, consequat officia brisket nisi beef ribs. Pariatur ut cow alcatra quis.
  <br><br>
  Fugiat spare ribs qui boudin. Flank occaecat chicken, excepteur strip steak nulla meatball andouille drumstick velit elit exercitation culpa alcatra magna. Minim dolore in pork belly. Enim meatball prosciutto jowl pig aliqua. Doner meatloaf dolore tenderloin, landjaeger short ribs t-bone magna laboris occaecat brisket reprehenderit. Short ribs ad incididunt ullamco sed sausage filet mignon. Quis rump laboris, labore ullamco anim sunt nostrud ribeye short ribs. Ut beef ribs aliqua flank leberkas est. Biltong brisket duis in, magna officia dolore.</p>
  
  <?php include 'includes/footer.php' ?>  
</body>

<?php include 'includes/footer.php' ?>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>

</html>
