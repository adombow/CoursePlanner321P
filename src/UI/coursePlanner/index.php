<!doctype html>

/*
<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully<br>";

	

	// sql to create table
	$sql = "CREATE TABLE MyGuests (
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
		firstname VARCHAR(30) NOT NULL,
		lastname VARCHAR(30) NOT NULL,
		email VARCHAR(50),
		reg_date TIMESTAMP
	)";

	if ($conn->query($sql) === TRUE) {
	    echo "Table MyGuests created successfully";
	} else {
	    echo "Error creating table: " . $conn->error;
	}

	mysqli_close($conn);
?>
*/

<html>
<head>
<meta charset="utf-8">

	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	
  
</head>

<body>
	<button type="button" id="loginButton">Login with Facebook Account</button>
	<script src="js/login.js"></script>
</body>
</html>
