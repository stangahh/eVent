<?php
	require 'classes/Mysql.php';
	require_once 'includes/constants.php';

  $connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_NAME) OR die("Database Connection Error: " . mysqli_connect_error());
  $result = $connection->query("SELECT org_name FROM organisations");

  echo "<html>";
  echo "<body>";
  echo "<select name='orgname'>";
  
  while ($row = $result->fetch_assoc()) {
    unset($name);
    $name = $row['org_name']; 
    echo '<option value="'.$id.'">'.$name.'</option>';
  };

  echo "</select>"; 
  echo "</body>";
  echo "</html>";
?>