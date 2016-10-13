
			$headers  = 'From: ifb299event@gmail.com' . "\r\n" .
                  'MIME-Version: 1.0' . "\r\n" .
                  'Content-type: text/html; charset=utf-8';
			mail($to, $subject, $body, $headers);
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
						return true;
					} else {
						return false;
					}

				};
			} else {
				return false;
			}

			mysqli_stmt_close($stmt);
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

			mysqli_close($connection);

			return $events_going;
		}
		
	}

?>
