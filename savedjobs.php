<!DOCTYPE html>
<html>
<head>
	<title>Saved Jobs</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Saved Jobs</h1>

	<?php
	session_start();

	if(isset($_SESSION['rollno'])) {
	  // Access the rollno value here
	  $rollno = $_SESSION['rollno'];
	  
		// Connect to the database
		$db_host = 'localhost';
		$db_user = 'root';
		$db_pass = 'Devisyam@2003';
		$db_name = 'dblab8';

		$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$sql = "CREATE TABLE IF NOT EXISTS saved_jobs (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			job_id INT(6) NOT NULL,
			rollno VARCHAR(20) NOT NULL
		)";
		
		if (mysqli_query($conn, $sql)) {
			echo "Table saved_jobs created successfully";
		} else {
			echo "Error creating table: " . mysqli_error($conn);
		}
		
        if (isset($_GET['job_id'])) {
			$jobId = $_GET['job_id'];
		  
			// Save the job for the specified roll no
			$sql = "INSERT INTO saved_jobs (job_id, rollno) VALUES ('$jobId', '$rollno')";
			
			if (mysqli_query($conn, $sql)) {
				echo "Job saved successfully";
			} else {
				echo "Error saving job: " . mysqli_error($conn);
			}
		}
        header('Location: http://localhost/Open_roles.php');

		// Close the database connection
		mysqli_close($conn);
	} else {
		echo "Please login to view saved jobs.";
	}
	?>

</body>
</html>
