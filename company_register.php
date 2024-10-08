<!DOCTYPE html>
<html>
<head>
	<title>Company Registration Form</title>
	<style>
		body{
			background-image: url('https://parsadi.com/wp-content/uploads/2022/05/Company.jpg');
            background-repeat: no-repeat;
            background-size: cover;
		}
		form {
  display: flex;
  flex-direction: column;
  margin-left: 1100px;
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
			margin-left: 1000px;
		}
	</style>
</head>
<body>
	<h2>Company Registration Form</h2>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label for="recruiter_id">Recruiter Id:</label>
		<input type="text" id="recruiter_id" name="recruiter_id">
		
		<label for="Company">Company Name:</label>
		<input type="text" id="Company" name="Company">
		
		
		<label for="password">Password:</label>
		<input type="password" id="password" name="password">
		
		<label for="confirm_password">Confirm Password:</label>
		<input type="password" id="confirm_password" name="confirm_password">
		
		<input type="submit" value="Submit">
		<a href="http://localhost/company_login.php">Click here to login</a>

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

// Create the Company table if it doesn't already exist
$sql_create_table = "CREATE TABLE IF NOT EXISTS Company (
	recruiter_id VARCHAR(30) NOT NULL,
	Company VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	PRIMARY KEY (recruiter_id, Company)
  );
  ";

if (mysqli_query($conn, $sql_create_table)) {
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
	$recruiter_id = $_POST["recruiter_id"];
	$Company = $_POST["Company"];
	$password = $_POST["password"];
	$confirm_password = $_POST["confirm_password"];
	
	// Validate the form data
	if (empty($recruiter_id) || empty($Company)  || empty($password) || empty($confirm_password)) {
		echo "Please fill in all fields.";
	} elseif ($password != $confirm_password) {
		echo "Passwords do not match.";
	} 
	elseif (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[a-zA-Z]+#", $password)) {
		echo "Password must be at least 8 characters long and contain at least a letter and a number";
	} 
	 else {
		// Hash the password for security
		$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
		
		// Insert the user data into the database
		$sql = "INSERT INTO Company (recruiter_id, Company, password) VALUES ('$recruiter_id', '$Company', '$password')";
		
		if (mysqli_query($conn, $sql)) {
			echo "<strong>Registration for Company successful!!</strong>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
}

mysqli_close($conn);
?>
