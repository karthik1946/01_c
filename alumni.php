<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		form {
			display: flex;
			flex-direction: column;
			align-items: center;
		}
		
		label {
			font-weight: bold;
			margin-bottom: 5px;
		}
		
		input[type="text"],
		input[type="password"] {
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-bottom: 10px;
			width: 300px;
			font-size: 16px;
		}
		
		input[type="submit"] {
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 16px;
			margin-top: 20px;
			margin-bottom: 10px;
			width: 200px;
			transition: all 0.2s ease-in-out;
		}
		
		input[type="submit"]:hover {
			background-color: #3e8e41;
			box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
		}
		
		a {
			text-decoration: none;
			font-size: 14px;
			color: #333;
		}
		
		a:hover {
			color: #4CAF50;
		}
		
		h2 {
			text-align: center;
			margin-top: 50px;
			margin-bottom: 30px;
		}
	</style>
</head>
<body>
	<h2>Alumni Registration Form</h2>
	<form method="post" action="">
		<label for="rollNo">Roll No:</label>
		<input type="text" id="rollNo" name="rollNo">
		
		<label for="name">Name:</label>
		<input type="text" id="name" name="name">
		
		<label for="email">Email:</label>
		<input type="text" id="email" name="email">
		
		<label for="password">Password:</label>
		<input type="password" id="password" name="password">
		
		<label for="confirm_password">Confirm Password:</label>
		<input type="password" id="confirm_password" name="confirm_password">
		
		<label for="placement_status">Placement Status:</label>
		<select id="placement_status" name="placement_status">
			<option value="Yes">Yes</option>
			<option value="No">No</option>
		</select>
		
		<input type="submit" value="Submit">
		<a href="http://localhost/a_login.php">Click here to login</a>

	</form>
</body>
</html>

<?php
// Establish a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password1 = "Devisyam@2003";
$dbname = "dblab8";

$conn = mysqli_connect($servername, $username, $password1, $dbname);

// Check if the connection was successful
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$sql_1 = "CREATE TABLE IF NOT EXISTS alumni (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rollNo VARCHAR(100),
    name VARCHAR(100),
    email VARCHAR(100),
    password VARCHAR(100),
    placement_status VARCHAR(100),
    authenticated BOOLEAN NOT NULL DEFAULT FALSE
)";
mysqli_query($conn, $sql_1);

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
	$rollNo = $_POST["rollNo"];
	$name = $_POST["name"];
	$email = $_POST["email"];
	$password = $_POST["password"];
	$confirm_password = $_POST["confirm_password"];
	$placement_status = $_POST["placement_status"];
	
	// Validate the form data
	if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($placement_status)) {
		echo "Please fill in all fields.";
	} elseif ($password != $confirm_password) {
		echo "Passwords do not match.";
	} elseif (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[a-zA-Z]+#", $password)) {
		echo "Password must be at least 8 characters long and contain at least a letter and a number";
	} else {
		// Hash the password for security
		$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
		// Insert the user data into the database

		if (empty($rollNo)) {
			$sql = "INSERT INTO alumni (name, email, password, placement_status, authenticated) VALUES ('$name', '$email', '$password', '$placement_status', FALSE)";
			mysqli_query($conn, $sql);
			$id = mysqli_insert_id($conn); // Retrieve the ID of the last inserted row
			$sql = "UPDATE alumni SET rollNo = '$id' WHERE id = '$id'";
			mysqli_query($conn, $sql);
			$rollNo = $id;
			echo "Your registration is complete. Your ID is $id. Please remember this ID for future reference.";
		} else {
			$sql = "INSERT INTO alumni (rollNo, name, email, password, placement_status, authenticated) VALUES ('$rollNo', '$name', '$email', '$password', '$placement_status', FALSE)";
			mysqli_query($conn, $sql);
			echo "Your registration is complete.";
		}
		
		
			if($placement_status == 'Yes'){
				header("Location: alumni1.php");
			}
			else{
				echo "You Have Registered Successfully! Click below link to login";
			}
		
	}
}
?>



