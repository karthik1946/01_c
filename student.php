<!DOCTYPE html>
<html>
<head>
	<title>User Registration Form</title>
	<style>
		body {
            background-image: url('https://kahedu.edu.in/n/wp-content/uploads/2021/11/7-suggestions-for-getting-a-good-job-during-campus-placements-990x500-1-990x500.jpg');
            background-repeat: no-repeat;
            background-size: cover;
		}
		form {
			max-width: 500px;
			margin-left: 900px;
			padding: 20px;
			background-color: #f2f2f2;
			border: 1px solid #ccc;
			border-radius: 5px;
		}
		h2 {
			margin-left: 800px;
			text-align: center;
			margin-top: 20px;
			margin-bottom: 20px;
		}
		label {
			display: block;
			margin-bottom: 10px;
		}
		input[type="text"], input[type="email"], input[type="password"] {
			display: block;
			width: 100%;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			margin-bottom: 20px;
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
		}
		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
		p {
			margin-left: 800px;
			margin-top: 20px;
			text-align: center;
		}
	</style>
</head>
<body>
	<h2>User Registration Form</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label for="rollno">Enter Your RollNo:</label>
		<input type="text" name="rollno" required>

		<label for="name">Enter Your Name:</label>
		<input type="text" name="name" required>

		<label for="email">Enter Your Email:</label>
		<input type="email" name="email" required>

		<label for="password">Create Password:</label>
		<input type="password" name="password" required>

		<label for="confirmpassword">Confirm Password:</label>
		<input type="password" name="confirmpassword" required>

		<input type="submit" value="Submit">
	</form>

	<?php
	// Set up MySQL database connection
	$servername = "localhost";
	$username = "root";
	$password = "Devisyam@2003";
	$dbname = "dblab8";

	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	// Create "users" table if it doesn't exist
	mysqli_select_db($conn, $dbname);
	$sql = "CREATE TABLE IF NOT EXISTS students (
		rollno  VARCHAR(8)  PRIMARY KEY,
		name VARCHAR(30) NOT NULL,
		email VARCHAR(50) NOT NULL,
		password VARCHAR(255) NOT NULL
	)";
	if (!mysqli_query($conn, $sql)) {
		echo "Error creating table: " . mysqli_error($conn) . "<br>";
	}
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$rollno = mysqli_real_escape_string($conn, $_POST['rollno']);
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		$confirmpassword = mysqli_real_escape_string($conn, $_POST['confirmpassword']);

		// Email validation
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "Invalid email format. Please enter a valid email address.<br>";
		}

		// Password validation
		if (strlen($password) < 8) {
			echo "Password must be at least 8 characters long.<br>";
		}
		if (!preg_match("#[0-9]+#", $password)) {
			echo "Password must include at least one number.<br>";
		}
		if (!preg_match("#[a-zA-Z]+#", $password)) {
			echo "Password must include at least one letter.<br>";
		}
		if ($password != $confirmpassword) {
			echo "Passwords do not match.<br>";
		}

		// Insert form data into MySQL database if validation passes
	if (filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($password) >= 8 && preg_match("#[0-9]+#", $password) && preg_match("#[a-zA-Z]+#", $password) && ($password == $confirmpassword)) {
		$sql = "INSERT INTO students (rollno, name, email, password) VALUES ('$rollno', '$name', '$email', '$password')";
		if (mysqli_query($conn, $sql)) {
			$id = mysqli_insert_id($conn);
			echo "<p style='font-size: 16px; font-weight: bold;'>User registration successful.</p>";

		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}

mysqli_close($conn);
?>
 <p>Already had an account? <a href="http://localhost/login.php">to login</a></p>
