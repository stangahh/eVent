<?php

	require 'classes/Mysql.php';
	require_once 'includes/constants.php';
	
	$email = 'mcleodmax@hotmail.com';

// Connect to the database
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());

			// Check to see if the email actually exists
			$valid_email = "SELECT ud_email FROM user_deatils WHERE ud_email = '" . $email . "' LIMIT 1";

			// Get the username associated with the given email address
			$get_id = "SELECT ud_user_id FROM user_details WHERE ud_email = '" . $email . "' LIMIT 1";
			
			// Get the username associated with the given email address
			$get_name = "SELECT ud_fname FROM user_details WHERE ud_email = '" . $email . "' LIMIT 1";
			
			$r_user = mysqli_query($connection, $get_id);
			$r_name = mysqli_query($connection, $get_name);
			$r_email = mysqli_query($connection, $valid_email);
			
			$user_id;
			$user_dp_name;
			$user_email;
			
			if($r_user){
				while($row = mysqli_fetch_array($r_user)){
					$user_id = $row['ud_user_id'];
				}
			}
			
			if($r_name){
				while($row = mysqli_fetch_array($r_name)){
					$user_dp_name = $row['ud_fname'];
				}
			}
			
			if($r_email){
				while($row = mysqli_fetch_array($r_email)){
					$user_email = $row['ud_email'];
				}
			}

			// Send e-mail to the user
			$to = $email;
			$subject = "eVent Account Recovery";
			$body = nl2br("Hi ". $user_dp_name .", \n\nYou have requested a password reset. Please click the following link to set your new password: \n\nhttp://straya.tech/passreset.php?id=". $user_id ."  \n\nIf you did not request this reset, please ignore this email. \n\nRegards, \n\neVent Admin");
			$headers  = 'From: ifb299event@gmail.com' . "\r\n" .
                  'MIME-Version: 1.0' . "\r\n" .
                  'Content-type: text/html; charset=utf-8';
			mail($to, $subject, $body, $headers);
			
?>
