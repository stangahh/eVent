<?php
	//Author: Maxwell McLeod
	// This Memebership class manages all user tracking and most actions
	// I have cut down everything to its simplest (insecure) form but if
	// you still dont understand something please ask =)
	
	require 'Mysql.php';
	require_once 'includes/constants.php';
	
	class Membership{
		
		//used in login page, forwards a user to home.php if they are a
		//valid user in the database
		function validate_user($un, $pwd){
			$mysql = New Mysql();
			$ensure_credentials = $mysql->verify_Username_and_Pass($un, MD5($pwd));
			
			if($ensure_credentials){
				$_SESSION['status'] = 'authorised_' . $un;
				header("location: home.php");
			}
		}
		
		//logs user out by destroying cookie
		function log_user_out(){
			if(isset($_SESSION['status'])){
				unset($_SESSION['status']);
				
			if(isset($_COOKIE[session_name()])) setcookie(session_name(), '', time() - 10000);
			session_destroy();
			}
		}
		
		
		//method to check if the current login is valid, i cant remember why it forwards
		//but its still handy to have
		function confirm_member(){
			session_start();
			
			$string_login = $_SESSION['status'];
			$search_for = 'authorised_';
			
			if(substr($string_login, 0, strlen($search_for)) != $search_for){
				header("location: login.php");
			}
		}
		
		//method to return user id from username
		function get_id($username){
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());;
			$query = "SELECT users_id FROM users WHERE users_username = '" . $username . "' LIMIT 1";
			$response = mysqli_query($connection, $query);
			
			if($response){
				while($row = mysqli_fetch_array($response)){
				$uname = $row['users_id'];
			};
			return $uname;
			}
		}
		
		//method to fetch userame
		function get_username(){
			
			$string_login = $_SESSION['status'];
			$search_for = 'authorised_'; 
			
			if(substr($string_login, 0, strlen($search_for)) == $search_for){
				return substr($_SESSION['status'], 11);
			}
			
		}
		
		//method to fetch organisation id using a username
		function get_org_id($username){
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());;
			$query = "SELECT users_org_id FROM users WHERE users_username = '" . $username . "' LIMIT 1";
			$response = mysqli_query($connection, $query);
			
			if($response){
				while($row = mysqli_fetch_array($response)){
				$id = $row['users_org_id'];
			};
			return $id;
			}
		}
		
		//method to fetch organisation name using an organisation id
		function get_org_name($org_id){
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT org_name FROM organisations WHERE org_id = '" . $org_id . "' LIMIT 1";
			$response = mysqli_query($connection, $query);
			
			if($response){
				while($row = mysqli_fetch_array($response)){
				$name = $row['org_name'];
			};
			return $name;
			}
		}
		
		//method to return array of all events, 
		//id = '0', returns all events
		//id = 'org_id' returns all associated with that organisation
		function get_event_list($id){
			$events = array();
			
			$modifier = "";
			
			if ($id != 0) {
				$modifier = "WHERE event_org_id = '". $id ."'";
			}
			
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT event_id, event_name, event_org_name, event_location FROM events " . $modifier . " ORDER BY event_name ASC";
			
			$response = mysqli_query($connection, $query);
			
			if($response){
				while($row = mysqli_fetch_array($response)){
					array_push($events, "
						" . $row['event_id'] . 
						"<strong>" . $row['event_name'] .",</strong> "
						. $row['event_org_name'] . ", "
						. $row['event_location'] . " 
					");	
				}
			} else {
				echo "FAILURE";
			}
			
			mysqli_close($connection);
			
			return $events;

		}
		
		//method used to update a users details
		function update_details($userid, $title, $fname, $mname, $lname, $hphone, $mphone, $address, $dob, $sex, $email, $occupation){
			
			//i created these to try and find the issue
			$userid = "67863";
			$title = "Mr";
			$fname = "Aden";
			$mname = "dffsd";
			$lname = "Max";
			$hphone = "7777777777";
			$mphone = "8888888888";
			$address = "27 Smith Lane, Greater Brisbane, 4311, Australia";
			$dob = "1994-09-07";
			$sex = "Male";
			$email = "adenjames@corpmail.com";
			$occupation = "Office Administrator";
						
			//I found the issue. SQL returns an error if you try to update a field with the exact same information. I will fix this later.				
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			
			$query = "UPDATE user_details
			SET ud_title = '" . $title . "', 
			ud_fname = '" . $fname . "', 
			ud_mname = '" . $mname . "', 
			ud_lname = '" . $lname . "', 
			ud_hphone = '" . $hphone . "', 
			ud_mphone = '" . $mphone . "', 
			ud_address = '" . $address . "', 
			ud_email = '" . $email . "', 
			ud_dob = '" . $dob . "', 
			ud_sex = '" . $sex . "', 
			ud_occupation = '" . $occupation . "' 
			WHERE ud_user_id = '" . $userid . "'";
			 
			$stmt = mysqli_prepare($connection,$query);
			
			mysqli_stmt_execute($stmt);

			$affected_rows = mysqli_stmt_affected_rows($stmt);
			
			if($affected_rows == 1){
				mysqli_stmt_close($stmt);
				mysqli_close($connection);
				return true;
				
			} else {
				echo mysqli_error($stmt);
				mysqli_stmt_close($stmt);
				mysqli_close($connection);
				return false;
			}
			
		}
		
	}
?>






















