<?php
	//Author: Maxwell McLeod
	// This Memebership class manages all user tracking and most actions
	// I have cut down everything to its simplest (insecure) form but if
	// you still dont understand something please ask =)

	//@inputs and @outputs are used for unit testing

	require 'Mysql.php';
	require_once 'includes/constants.php';

	class Membership{
		//function for debuging to javascript console
		function debug_to_console( $data ) {
    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
		}
		//used in login page, forwards a user to home.php if they are a
		//valid user in the database
		//@input username, passsword
		//@output void 'true'
		function validate_user($un, $pwd){
			$mysql = New Mysql();
			$ensure_credentials = $mysql->verify_Username_and_Pass($un, MD5($pwd));

			if($ensure_credentials){
				$_SESSION['status'] = 'authorised_' . $un;
				header("location: home.php");
			}
		}

		//logs user out by destroying cookie
		//@input NULL
		//@output void 'true', destroy(@cookie);
		function log_user_out(){
			if(isset($_SESSION['status'])){
				unset($_SESSION['status']);

			if(isset($_COOKIE[session_name()])) setcookie(session_name(), '', time() - 10000);
				session_destroy();
			}
		}


		//method to check if the current login is valid, i cant remember why it forwards
		//but its still handy to have
		//@input NULL
		//@output void 'true|false'
		function confirm_member(){
			session_start();

			$string_login = $_SESSION['status'];
			$search_for = 'authorised_';

			if(substr($string_login, 0, strlen($search_for)) != $search_for){
				header("location: login.php");
			}
		}

		//method to return user id from username
		//@input username
		//@output id, @(true), @catch(mysqli_error);
		function get_id($username){
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());;
			$query = "SELECT users_id FROM users WHERE users_username = '" . $username . "' LIMIT 1";
			$response = mysqli_query($connection, $query);

			if($response){
				while($row = mysqli_fetch_array($response)){
					return $uname = $row['users_id'];
				};
				//return $uname;
			}
		}

		//method to fetch userame
		//@input NULL
		//@output username, @(true), @catch(mysqli_error);
		function get_username(){

			$string_login = $_SESSION['status'];
			$search_for = 'authorised_';

			if(substr($string_login, 0, strlen($search_for)) == $search_for){
				return substr($_SESSION['status'], 11);
			}

		}

		//method to fetch organisation id using a username
		//@input username
		//@output id, @(true), @catch(mysqli_error);
		function get_org_id($username){
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());;
			$query = "SELECT users_org_id FROM users WHERE users_username = '" . $username . "' LIMIT 1";
			$response = mysqli_query($connection, $query);

			if($response){
				while($row = mysqli_fetch_array($response)){
					return $id = $row['users_org_id'];
				};
				//return $id;
			}
		}

		//method to fetch organisation name using an organisation id
		//@input org_id
		//@output org_name, @(true), @catch(mysqli_error);
		function get_org_name($org_id){
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT org_name FROM organisations WHERE org_id = '" . $org_id . "' LIMIT 1";
			$response = mysqli_query($connection, $query);

			if($response){
				while($row = mysqli_fetch_array($response)){
					return $name = $row['org_name'];
				};
				//return $name;
			}
		}

		//method to return array of all events,
		//id = '0', returns all events
		//id = 'org_id' returns all associated with that organisation
		//@input id
		//@output event_list, @(true), @catch(mysqli_error);
		function get_event_list($id){
			$events = array();

			$modifier = "";

			if ($id != 0) {
				$modifier = "WHERE event_org_id = '". $id ."'";
				$eventarray = get_event_information($id);
			}

			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT event_id, event_name, event_org_id, event_location FROM events " . $modifier . " ORDER BY event_name ASC";

			$response = mysqli_query($connection, $query);

			if($response){
				while($row = mysqli_fetch_array($response)){
					array_push($events, "
						" . $row['event_id'] .
						"<strong>" . $row['event_name'] .",</strong>, "
						. $row['event_location'] . "
					");
				}
			} else {
				echo "FAILURE";
			}

			mysqli_close($connection);

			return $events;

		}
		//method to get event infomation from the event id
		//@input event_id
		//@output event_info, @(true), @catch(mysqli_error);
		function get_event_information($eventid){
			$event_info = array();

			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT event_name, event_org_id, event_location, event_latitude, event_longitude, event_postcode,
			event_amount_funded, event_amount_required, event_creator_user_id, event_date, event_desc, event_photo FROM events WHERE event_id = '" . $eventid . "' LIMIT 1";

			$response = mysqli_query($connection, $query);

			if($response){
					while($row = mysqli_fetch_array($response)){

						//this should be done easier with a loop and switch
						//it is like this for simplicity
						array_push($event_info, $row['event_name']);
						array_push($event_info, $row['event_org_id']);
						array_push($event_info, $row['event_location']);
						array_push($event_info, $row['event_latitude']);
						array_push($event_info, $row['event_longitude']);
						array_push($event_info, $row['event_postcode']);
						array_push($event_info, $row['event_amount_funded']);
						array_push($event_info, $row['event_amount_required']);
						array_push($event_info, $row['event_creator_user_id']);
						array_push($event_info, $row['event_date']);
						array_push($event_info, $row['event_desc']);
						array_push($event_info, $row['event_photo']);

					}
				} else {
					echo "FAILURE: Unable to pull event information";
				}

			mysqli_close($connection);

			return $event_info;
		}


		//method used to update a users details
		//@input $userid, $title, $fname, $username, $lname, $phone, $address, $dob, $sex, $email, $occupation
		//@output void 'true', @(mysqli_query), @(mysqli_error);
		function update_details($userid, $title, $fname, $username, $lname, $phone, $address, $dob, $sex, $email, $occupation){

			//i created these to try and find the issue
			$userid = "67863";
			$title = "Mr";
			$fname = "Aden";
			$username = "username";
			$lname = "Max";
			$phone = "0412345678";
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
			ud_username = '" . $username . "',
			ud_lname = '" . $lname . "',
			ud_phone = '" . $phone . "',
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

		//method used to create an account
		//@input $un, $pw, $org_id
		//@output void 'true', @(mysqli_query), @(mysqli_error);
		function register_user($un, $pw, $org_id) {
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());

			$query_users = "INSERT INTO users (users_username, users_password, users_org_id)
							VALUES ('" . $un . "','" . MD5($pw) . "','" . $org_id . "')";

			$stmt_users = mysqli_prepare($connection, $query_users);

			mysqli_stmt_execute($stmt_users);

			$affected_rows = mysqli_stmt_affected_rows($stmt_users);

			if($affected_rows == 1){
				mysqli_stmt_close($stmt_users);
				mysqli_close($connection);
				$_SESSION['status'] = 'authorised_' . $un;
					header("location: home.php");
				return true;

			} else {
				echo mysqli_error($stmt_users);
				mysqli_stmt_close($stmt_users);
				mysqli_close($connection);
				return false;
			}
		}
		//method used to create an account detials for user
		//@input $title, $fn, $ln, $un, $ph, $add, $email, $dob, $sex, $occ
		//@output void 'true', @(mysqli_query), @(mysqli_error);
		function register_user_details($title, $fn, $ln, $un, $ph, $add, $email, $dob, $sex, $occ) {
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());

			$query_ud = "INSERT INTO user_details (ud_title, ud_user_id, ud_fname, ud_lname, ud_username, ud_phone, ud_address, ud_email, ud_dob, ud_sex, ud_occupation)
							VALUES ('" . $title . "', (SELECT users.users_id FROM users WHERE users_username = '" . $un . "'),'" . $fn . "','" . $ln . "','" . $un . "','" . $ph . "','" . $add . "','" . $email . "','" . $dob . "','" . $sex . "','" . $occ . "')";

			$stmt_ud = mysqli_prepare($connection, $query_ud);

			mysqli_stmt_execute($stmt_ud);

			$affected_rows = mysqli_stmt_affected_rows($stmt_ud);

			if($affected_rows == 1){
				mysqli_stmt_close($stmt_ud);
				mysqli_close($connection);
				$_SESSION['status'] = 'authorised_' . $un;
					header("location: home.php");
				return true;

			} else {
				echo mysqli_error($stmt_ud);
				mysqli_stmt_close($stmt_ud);
				mysqli_close($connection);
				return false;
			}
		}

				//create an event by inserting information into database, also uploads an image
				//@input $title, $fn, $ln, $un, $ph, $add, $email, $dob, $sex, $occ
				//@output void 'true', @(mysqli_query), @(mysqli_error);
		function create_event($event_name, $org_id, $event_loc, $event_lat, $event_lng, $event_postcode, $amount_required, $user_id, $desc, $date){
			debug_to_console( "error1" );
			$latest_img_num = $this ->lastestimgnumber();
			$starting_funds = '0';
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die ("Database Connection Error: " . mysqli_connect_error());
			$query = "INSERT INTO `events` (`event_id`, `event_name`, `event_org_id`, `event_location`, `event_latitude`, `event_longitude`, `event_postcode`, `event_amount_funded`, `event_amount_required`, `event_creator_user_id`, `event_desc`, `event_date`) VALUES
			(NULL,
			'". $event_name ."',
			'". $org_id ."',
			'". $event_loc ."',
			'". $event_lat ."',
			'". $event_lng ."',
			'". $starting_funds ."',
			'". $amount_required ."',
			'". $user_id ."',
			'". $desc ."',
			'". $latest_img_num ."',
			'". $date ."')";
			debug_to_console( "error4" );
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

			mysqli_close($connection);

			//upload image
			$target = "eventimg/". $latest_img_num .".jpg";
			move_uploaded_file($image, $target);

			// $uploaddir = 'eventimg/'. $latest_img_num .'.jpg';
			// move_uploaded_file($image, $target);
		}

		//returns next image number or default image
		//@input null;
		//@output image.jpg, @(mysqli_query), @(mysqli_error);
		function lastestimgnumber(){
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die ("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT event_photo FROM events ORDER BY event_photo DESC LIMIT 1";

			$img = 0;

			$response = mysqli_query($connection, $query);

			if($response){

				while($row = mysqli_fetch_array($response)){

					$img = $row['event_photo'];

				}

			} else {

				echo "FAILURE: Unable to fetch image information";

			}

			mysqli_close($connection);

			if($img != 0){
				$img++;
			}
			return $img;
		}
		//method that deletes and event using it's ID
		//@input $event_id;
		//@output void 'true', @(mysqli_query), @(mysqli_error);
		function delete_event($event_id) {
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "DELETE FROM events WHERE event_id ='" . $event_id . "'";

			$stmt = mysqli_prepare($connection, $query);

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
