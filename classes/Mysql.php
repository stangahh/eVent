<?php

//Author: Maxwell McLeod
// This is used as a generalised statement to connect to a database
// For Security reasons this should be used for all database queries
// As you can see this hasnt been the case #lazyfuck

require_once 'includes/constants.php';

 class Mysql{
	 
	 private $conn;
	 
	 function __construct(){
		 $this->conn = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die ('Problem Connecting to the Database');
	 }
	 
	 function verify_Username_and_Pass($un, $pwd) {
		 
		 $query = "SELECT * FROM users WHERE users_username = ? AND users_password = ? LIMIT 1";
		 
		 if($stmt = $this->conn->prepare($query)){
			 $stmt->bind_param('ss', $un, $pwd);
			 $stmt->execute();
			 
			 if($stmt->fetch()){
				 $stmt->close();
				 return true;
			 }
		 }
	 }
 }
?>