<?php

	require_once 'classes/Membership.php';

	$membership = New Membership(); //simple new class call
	$membership->confirm_member(); //checks if a user is logged in, any user! (yes this is insecure but i made it simple =)

	$membership->add_user_going($_POST['event_id'], $_POST['user_id'], $_POST['people_going']);
	
	header('Location: event.php?eventid=' . $_POST['event_id'] . '&going=1');

?>