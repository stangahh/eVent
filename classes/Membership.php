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
                    mysqli_stmt_close($response);
                    mysqli_close($connection);
					return $uname = $row['users_id'];
				};
				//return $uname;
                
			}
            
            mysqli_stmt_close($response);
            mysqli_close($connection);            
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
                    mysqli_stmt_close($response);
                    mysqli_close($connection);
					return $id = $row['users_org_id'];
				};
				//return $id;
			}
            
            mysqli_stmt_close($response);
            mysqli_close($connection);             
            
		}

		//method to fetch organisation name using an organisation id
		//@input org_id
		//@output org_name, @(true), @catch(mysqli_error);
		function get_org_name($org_id){
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT * FROM organisations WHERE org_id = '" . $org_id . "' LIMIT 1";
			$response = mysqli_query($connection, $query);

			if($response){
				while($row = mysqli_fetch_array($response)){
                    mysqli_stmt_close($response);
                    mysqli_close($connection);
					return $name = $row['org_name'];
				};
				//return $name;
			}
            
            mysqli_stmt_close($response);
            mysqli_close($connection); 
		}
		//method to fetch organisation name using an organisation id
		//@input org_id
		//@output org_name, @(true), @catch(mysqli_error);
		function get_org($org_id){
			$org_info = array();
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT * FROM organisations WHERE org_id = '" . $org_id . "' LIMIT 1";
			$response = mysqli_query($connection, $query);

			if($response){
				while($row = mysqli_fetch_array($response)){
					array_push($org_info, $row['org_name']);
					array_push($org_info, $row['org_details']);
					array_push($org_info, $row['org_logo']);
					array_push($org_info, $row['org_contact_person']);
					array_push($org_info, $row['org_password']);
				}
			} else {
				echo "FAILURE";
			}
            mysqli_stmt_close($response); 
			mysqli_close($connection);

			return $org_info;
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
				//$eventarray = get_event_information($id);
			}

			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT event_id, event_name, event_org_id, event_location FROM events " . $modifier . " ORDER BY event_name ASC";

			$response = mysqli_query($connection, $query);

			if($response){
				while($row = mysqli_fetch_array($response)){
					array_push($events, "
						" . $row['event_id'] .
						"<strong>" . $row['event_name'] ."</strong>, "
						. $row['event_location'] . "
					");
				}
			} else {
				echo "FAILURE";
			}

            mysqli_stmt_close($response);
            mysqli_close($connection); 

			return $events;

		}

		//method to return array of all events,
		//id = 'user_id' returns all events associated with that user
		//@input id
		//@output event_list, @(true), @catch(mysqli_error);
		function get_event_list_user_id($id){
			$events = array();

			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT event_id, event_name, event_org_id, event_location FROM events WHERE event_creator_user_id = '". $id ."' ORDER BY event_name ASC";

			$response = mysqli_query($connection, $query);

			if($response){
				while($row = mysqli_fetch_array($response)){
					array_push($events, "
						" . $row['event_id'] .
						"<strong>" . $row['event_name'] ."</strong>, "
						. $row['event_location'] . "
					");
				}
			} else {
				echo "FAILURE";
			}

			mysqli_stmt_close($response);
            mysqli_close($connection); 

			return $events;

		}

		//method to get event infomation from the event id
		//@input event_id
		//@output event_info, @(true), @catch(mysqli_error);
		function get_event_information($eventid) {
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

			mysqli_stmt_close($response);
            mysqli_close($connection); 

			return $event_info;
		}

		//method to get user info from the user id
		//@input userid
		//@output spec_info, @(true), @catch(mysqli_error);
		function get_spec_info($userid) {
			$spec_info = array();

			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT ud_title, ud_fname, ud_lname, ud_username, ud_phone, ud_address, ud_email, ud_dob, ud_sex, ud_occupation FROM user_details WHERE
					ud_user_id = '". $userid . "' LIMIT 1";

			$response = mysqli_query($connection, $query);

			if($response){
				while($row = mysqli_fetch_array($response)){
					array_push($spec_info, $row['ud_title']);
					array_push($spec_info, $row['ud_fname']);
					array_push($spec_info, $row['ud_username']);
					array_push($spec_info, $row['ud_lname']);
					array_push($spec_info, $row['ud_phone']);
					array_push($spec_info, $row['ud_address']);
					array_push($spec_info, $row['ud_dob']);
					array_push($spec_info, $row['ud_sex']);
					array_push($spec_info, $row['ud_email']);
					array_push($spec_info, $row['ud_occupation']);
				}
			} else {
				echo "FAILURE";
			}

			mysqli_stmt_close($response);
            mysqli_close($connection); 

			return $spec_info;
		}

		//returns event information as array
		//@input user_id
		//@output user's latest single uploaded event as array
		function get_latest_event_from_user($user_id) {
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());;

			$query = "SELECT event_id FROM events WHERE event_creator_user_id = '" . $user_id . "' ORDER BY event_id DESC LIMIT 1";

			$retrv = mysqli_query($connection, $query);

			if (!$retrv) {
				die('Could not get data: ' . mysql_error());
			}

			$row = mysqli_fetch_array($retrv, MYSQL_ASSOC);

			mysqli_stmt_close($response);
            mysqli_close($connection); 

			return $row['event_id'];
		}


		//method used to update a users details
		//@input $userid, $title, $fname, $username, $lname, $phone, $address, $dob, $sex, $email, $occupation
		//@output void 'true', @(mysqli_query), @(mysqli_error);
		function update_details($userid, $title, $fname, $username, $lname, $phone, $address, $dob, $sex, $email, $occupation){

			//i created these to try and find the issue
			// $userid = "67863";
			// $title = "Mr";
			// $fname = "Aden";
			// $username = "username";
			// $lname = "Max";
			// $phone = "0412345678";
			// $address = "27 Smith Lane, Greater Brisbane, 4311, Australia";
			// $dob = "1994-09-07";
			// $sex = "Male";
			// $email = "adenjames@corpmail.com";
			// $occupation = "Office Administrator";

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
            
            mysqli_stmt_close($stmt);
            mysqli_close($connection); 

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
            
            mysqli_stmt_close($stmt);
            mysqli_close($connection); 
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
            
            mysqli_stmt_close($stmt_ud);
            mysqli_close($connection); 
		}

				//create an event by inserting information into database, also uploads an image
				//@input $title, $fn, $ln, $un, $ph, $add, $email, $dob, $sex, $occ
				//@output void 'true', @(mysqli_query), @(mysqli_error);
		function create_event($event_name, $org_id, $event_loc, $event_lat, $event_lng, $event_postcode, $amount_required, $user_id, $desc, $date, $image){
			$starting_funds = '0';
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die ("Database Connection Error: " . mysqli_connect_error());

			$query = "INSERT INTO `events` (`event_name`, `event_org_id`, `event_location`, `event_latitude`, `event_longitude`, `event_postcode`, `event_amount_funded`, `event_amount_required`, `event_creator_user_id`, `event_desc`, `event_photo`, `event_date`) VALUES
			(
			'". $event_name ."',
			'". $org_id ."',
			'". $event_loc ."',
			'". $event_lat ."',
			'". $event_lng ."',
			'". $event_postcode ."',
			'". $starting_funds ."',
			'". $amount_required ."',
			'". $user_id ."',
			'". $desc ."',
			'". $image['name'] ."',
			'". $date ."'
			)";

			//upload image
	        move_uploaded_file($image['tmp_name'], "eventimg/" . basename($image['name']));

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

			mysqli_stmt_close($response);
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

			$delete_stmt = "SELECT event_photo FROM events WHERE event_id ='" . $event_id . "'";
			$image_to_delete = mysqli_query($connection, $delete_stmt);

			$img_path = "eventimg/" . $image_to_delete;

			if (file_exists($img_path)) {
			    unlink($img_path);
			}

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

		//method that inserts users going status into the database
		//@input $event_id, $user_id, $username
		//@output void 'true', @(mysqli_query), @(mysqli_error);
		function add_user_going($event_id, $user_id, $amount_going) {
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "INSERT INTO `going` (`going_event_id`, `going_user_id`, `going_user_amount`) VALUES ('" . $event_id . "', '" . $user_id . "', '" . $amount_going . "')";

			$stmt = mysqli_prepare($connection, $query);

			mysqli_stmt_execute($stmt);

			$affected_rows = mysqli_stmt_affected_rows($stmt);

			if ($affected_rows >= 1) {
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

		//inserts a donation amount into the database specifying the userid and their amount
		function add_donation($amt, $user, $id) {
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "INSERT INTO donations (don_id, don_user_id, don_amount_donated, don_event_id)
					VALUES ('0','" . $user ."','" . $amt . "','" . $id ."')";

			$stmt = mysqli_prepare($connection, $query);

			mysqli_stmt_execute($stmt);

			$affected_rows = mysqli_stmt_affected_rows($stmt);

			if ($affected_rows == 1) {
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

		//returns the total number of donations made to a specific event
		function sum_donation($id) {
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT SUM(don_amount_donated) FROM donations WHERE don_event_id = '". $id . "'";

			$response = mysqli_query($connection, $query);

			if($response){
				while($row = mysqli_fetch_array($response)){
					$sum = $row['SUM(don_amount_donated)'];

					if ($sum != NULL){
                        mysqli_stmt_close($response);
                        mysqli_close($connection);
						return $sum;
					} else {
                        mysqli_stmt_close($response);
                        mysqli_close($connection);
						return 0;
					}
				};
			} else 
                mysqli_stmt_close($response);
                mysqli_close($connection); 
				return 'ERROR';
			}

			mysqli_stmt_close($stmt);
			mysqli_close($connection);

		}

		//method to return array of all events a user has donated to, and amount donated
		//id = 'user_id'
		//@input id
		//@output event array
		function get_donated_events($id){
			$events = array();

			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT don_event_id,don_amount_donated FROM donations WHERE don_user_id = '" . $id . "'";

			$response = mysqli_query($connection, $query);

			if($response){
				while($row = mysqli_fetch_array($response)){
					array_push($events, $row['don_event_id'] . $row['don_amount_donated']);
				}
			} else {
				echo "Failed to retrieve donation information. Have you donated to any events? :)";
			}

			mysqli_stmt_close($response);
            mysqli_close($connection); 

			return $events;
		}

		// If the event is created by the current user, return true
		function get_created_event_user($eventid, $userid) {
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT * FROM events WHERE event_org_id = '" . $eventid . "' AND event_creator_user_id = '" . $userid . "'";

			$stmt = mysqli_prepare($connection, $query);
			mysqli_stmt_execute($stmt);
			$affected_rows = mysqli_num_rows($stmt);

			if ($affected_rows == 1) {
				mysqli_stmt_close($stmt);
				mysqli_close($connection);
				return true;

			} else {
				mysqli_stmt_close($stmt);
				mysqli_close($connection);
				return false;
			}

		}

		//Removes all the rows with the same event id (not checked, not added into the html stuff)
		function remove_going($event_id) {
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "DELETE FROM going WHERE going_event_id ='" . $event_id . "'";

			$stmt = mysqli_prepare($connection, $query);
			mysqli_stmt_execute($stmt);
			$affected_rows = mysqli_stmt_affected_rows($stmt);

			if($affected_rows >= 0){
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

		//Returns Number of People going to an event
		function find_going($eventid) {

			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT SUM(going_user_amount) FROM going WHERE going_event_id = '". $eventid . "' LIMIT 1";

			$response = mysqli_query($connection, $query);

			if($response){
				while($row = mysqli_fetch_array($response)){
					$going = $row['SUM(going_user_amount)'];

					if ($going != NULL)
                        mysqli_stmt_close($response);
                        mysqli_close($connection);
						return $going;
					} else {
                        mysqli_stmt_close($response);
                        mysqli_close($connection);
						return 0;
					}

				};
			} else {
                mysqli_stmt_close($response);
                mysqli_close($connection);
				return 'ERROR';
			}

			mysqli_stmt_close($response);
			mysqli_close($connection);
		}

		//returns true of user is going to event
		function is_user_going($user_id, $event_id){
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT COUNT(going_event_id) FROM going WHERE going_user_id = '" . $user_id . "' AND going_event_id = '" . $event_id . "' LIMIT 1";

			$response = mysqli_query($connection, $query);

			//wont return response if user isnt in table
			if($response){
				while($row = mysqli_fetch_array($response)){
					$count = $row['COUNT(going_event_id)'];

					if ($count == 0){
                        mysqli_stmt_close($response);
                        mysqli_close($connection); 
						return false;
					} else if ($count == NULL){
                        mysqli_stmt_close($response);
                        mysqli_close($connection);
						return false;
					} else {
                        mysqli_stmt_close($response);
                        mysqli_close($connection);
						return true;
					}
				};
			} else {
                mysqli_stmt_close($response);
                mysqli_close($connection);
				return false;
			}
		}

				//function to cancel a user going to an event
		function cancel_part($user_id){
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "DELETE FROM going WHERE going_user_id = '" . $user_id . "'";

			$stmt = mysqli_prepare($connection, $query);

			mysqli_stmt_execute($stmt);

			$affected_rows = mysqli_stmt_affected_rows($stmt);

			if($affected_rows >= 1){
				mysqli_stmt_close($stmt);
				mysqli_close($connection);
			} else {
				echo mysqli_error($stmt);
				mysqli_stmt_close($stmt);
				mysqli_close($connection);
			}
		}

		// Send the user a password reset e-mail and use it to reset their password
		function reset_password($email) {
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());

			// Check to see if the email actually exists
			$valid_email = "SELECT ud_email FROM user_deatils WHERE ud_email = '" . $email . "' LIMIT 1";

			// Get the ID associated with the given email address
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
			$body = nl2br("Hi ". $user_dp_name .", \n\nYou have requested a password reset. Please click the following link to set your new password: \n\nhttp://straya.tech/passreset.php?id=". $user_id ."&io7u=1  \n\nIf you did not request this reset, please ignore this email. \n\nRegards, \n\neVent Admin");
			$headers  = 'From: ifb299event@gmail.com' . "\r\n" .
                  'MIME-Version: 1.0' . "\r\n" .
                  'Content-type: text/html; charset=utf-8';
			mail($to, $subject, $body, $headers);
            
            mysqli_stmt_close($stmt);
			mysqli_close($r_user);
			mysqli_close($r_name);
			mysqli_close($r_email);
		}

		//change user password
	    function change_user_password($userid, $password){
            $connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "UPDATE users SET users_password = '". $password ."' WHERE users_id = '". $userid ."'";

			$stmt = mysqli_prepare($connection, $query);

			mysqli_stmt_execute($stmt);

			$affected_rows = mysqli_stmt_affected_rows($stmt);

			if($affected_rows >= 1){
				mysqli_stmt_close($stmt);
				mysqli_close($connection);

			} else {
				echo mysqli_error($stmt);
				mysqli_stmt_close($stmt);
				mysqli_close($connection);
			}
		}

		//returns true if email is valid
		function valid_email($email){
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT COUNT(ud_email) FROM user_details WHERE ud_email= '" . $email . "'";

			$response = mysqli_query($connection, $query);

			//wont return response if user isnt in table
			if($response){
				while($row = mysqli_fetch_array($response)){

					$count = $row['COUNT(ud_email)'];

					if ($count == 1){
                        mysqli_stmt_close($response);
                        mysqli_close($connection);
						return true;
					} else {
                        mysqli_stmt_close($response);
                        mysqli_close($connection);
						return false;
					}

				};
			} else {
                mysqli_stmt_close($response);
                mysqli_close($connection);
				return false;
			}

			mysqli_stmt_close($response);
			mysqli_close($connection);
		}

		function get_events_going_to($userid) {
			$events_going = array();

			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT going_event_id FROM going WHERE going_user_id = '" . $userid . "'";

			$response = mysqli_query($connection, $query);

			if($response){
				while($row = mysqli_fetch_array($response)){
					array_push($events_going, $row['going_event_id']);
				}
			} else {
				echo "Failed to retrieve events information. Are you attending any events? :)";
			}
            
            mysqli_stmt_close($response);
			mysqli_close($connection);

			return $events_going;
		}
    
		function get_org_array() {
			$orgs = array();

			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT org_name FROM organisations";

			$response = mysqli_query($connection, $query);

			if($response){
				while($row = mysqli_fetch_array($response)){
					array_push($orgs, $row['org_name']);
				}
			} else {
				echo "FAILURE";
			}

			mysqli_stmt_close($response);
			mysqli_close($connection);

			return $orgs;
		}
    
        //function join_organisation($org_id) {
        //  $connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
        //}

		function check_org_pass($org, $pw) {
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT COUNT(org_id) FROM organisations WHERE org_name = '" . $org . "' AND org_password = '" . $pw . "' LIMIT 1";

			$response = mysqli_query($connection, $query);

			if($response){
				while($row = mysqli_fetch_array($response)) {
					$count = $row['COUNT(org_id)'];

					if ($count == 0) {
                        mysqli_stmt_close($response);
                        mysqli_close($connection);
						return false;
					} else if ($count == NULL){
                        mysqli_stmt_close($response);
                        mysqli_close($connection);
						return false;
					} else {
                        mysqli_stmt_close($response);
                        mysqli_close($connection);
						return true;
					}
				}
			} else {
                mysqli_stmt_close($response);
                mysqli_close($connection);
				return false;
			}
		}

		function set_org($user, $org) {
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());

			$query = "UPDATE users
			SET users_org_id = '" . $org . "' WHERE users_id = '" . $user . "'";;

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

		function get_org_id_from_name($org_name){
			$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
			$query = "SELECT * FROM organisations WHERE org_name = '" . $org_name . "' LIMIT 1";
			$response = mysqli_query($connection, $query);

			if($response){
				while($row = mysqli_fetch_array($response)){
                    mysqli_stmt_close($response);
                    mysqli_close($connection);
					return $name = $row['org_id'];
				};
				//return $name;
			}
            
            mysqli_stmt_close($response);
            mysqli_close($connection);
		}

  }

?>