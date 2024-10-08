<!DOCTYPE html>
<html>
<head>
	<title>Job Details</title>
	<style>
		main {
  margin-left: 200px; /* Adjust the margin as needed */
  padding: 20px;
  display: block;
  width: 100%;
}
table {
  border-collapse: collapse;
  width: 100%;
}
th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}
th {
  background-color: #111;
  color: white;
}
table {
  border-collapse: collapse;
  width: 40%;
  margin-left: 20%;
  margin-right: 80%;
  padding-right: 50px;
}

th, td {
  text-align: left;
  padding: 8px;
}

th {
  background-color: #3399ff;
  color: white;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
	</style>
</head>
<body>
	<?php
	session_start(); // Start session

	// Check if recruiter_id is stored in session
	if (isset($_SESSION['recruiter_id'])) {
	    // Retrieve recruiter_id from session
	    $recruiter_id = $_SESSION['recruiter_id'];

	    // Connect to MySQL database using mysqli
	    $servername = "localhost";
	    $username = "root";
	    $password = "Devisyam@2003";
	    $dbname = "dblab8"; // Replace with your database name

	    $conn = mysqli_connect($servername, $username, $password, $dbname);

	    // Check connection
	    if (!$conn) {
	        die("Connection failed: " . mysqli_connect_error());
	    }

	    // Prepare and execute query to select job details based on recruiter_id
	    $sql = "SELECT * FROM jobs WHERE recruiter_id = ?;";
	    $stmt = mysqli_prepare($conn, $sql);
	    mysqli_stmt_bind_param($stmt, "s", $_SESSION['recruiter_id']);
	    mysqli_stmt_execute($stmt);
	    $result = mysqli_stmt_get_result($stmt);

	    // Check if query was successful
	    if (mysqli_num_rows($result) > 0) {
	        echo "<table>";
	        // Fetch and display job details
	        while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>"; 
                echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>"; 
	            echo "<tr><td>Recruiter ID:</td><td>" . $row['recruiter_id'] . "</td></tr>";
	            echo "<tr><td>Job Title:</td><td>" . $row['job_title'] . "</td></tr>";
	            echo "<tr><td>Company:</td><td>" . $row['Company'] . "</td></tr>";
	            echo "<tr><td>Location:</td><td>" . $row['location'] . "</td></tr>";
	            echo "<tr><td>CTC:</td><td>" . $row['ctc'] . "</td></tr>";
	            echo "<tr><td>Interview Mode:</td><td>" . $row['interview_mode'] . "</td></tr>";
	            echo "<tr><td>Number of Openings:</td><td>" . $row['number_of_openings'] . "</td></tr>";
	            echo "<tr><td>Required Skills:</td><td>" . $row['required_skills'] . "</td></tr>";
	            echo "<tr><td>Domain:</td><td>" . $row['domain'] . "</td></tr>";
	            echo "<tr><td>Recruiting From Year:</td><td>" . $row['recruiting_from_year'] . "</td></tr>";
	            echo "<tr><td>HR Contact:</td><td>" . $row['hr_contact'] . "</td></tr>";
	            // Add a blank row between each job details
	        }
	        echo "</table>";
	    } else {
	        echo "<p>No job details found for the given recruiter ID</p>";
	    }

	    // Close connection
	    mysqli_close($conn);
	} else {
		echo "<p>Please log in to view job details</p>";
	}
	?>
</body>
</html>
