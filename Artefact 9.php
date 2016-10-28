//from membership.php
    //create an event by inserting information into database, also uploads an image
    //@input $title, $fn, $ln, $un, $ph, $add, $email, $dob, $sex, $occ
    //@output void 'true', @(mysqli_query), @(mysqli_error);
    function create_event($event_name, $org_id, $event_loc, $event_lat, $event_lng, $event_postcode, $amount_required, $user_id, $desc, $date, $image) {
        $starting_funds = '0';
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
        
        $query = "INSERT INTO `events` (`event_name`, `event_org_id`, `event_location`, `event_latitude`, `event_longitude`, `event_postcode`, `event_amount_funded`, `event_amount_required`, `event_creator_user_id`, `event_desc`, `event_photo`, `event_date`) VALUES
			(
			'" . mysqli_real_escape_string($connection, $event_name) . "',
			'" . $org_id . "',
			'" . $event_loc . "',
			'" . $event_lat . "',
			'" . $event_lng . "',
			'" . $event_postcode . "',
			'" . $starting_funds . "',
			'" . $amount_required . "',
			'" . $user_id . "',
			'" . mysqli_real_escape_string($connection, $desc) . "',
			'" . $image['name'] . "',
			'" . $date . "'
			)";
        
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
        
        mysqli_close($connection);
    }