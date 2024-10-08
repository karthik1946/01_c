<!DOCTYPE html>
<html>
<head>
	<title>Job Details</title>
  <style>
		table {
			margin: 0 auto;
			border-collapse: collapse;
			width: 80%;
			border: 2px solid lightgray;
			background-color: #f9f9f9;
		}
		th, td {
			padding: 10px;
			text-align: center;
			border: 1px solid lightgray;
		}
		th {
			background-color: #ccc;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
	</style>
</head>
<body>

	<?php
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

	    // Retrieve job_id from URL
	    $job_id = $_GET['job_id'];

	    // Prepare and execute query to select job details based on job_id
	    $sql = "SELECT * FROM jobs WHERE job_id = ?";
	    $stmt = mysqli_prepare($conn, $sql);
	    mysqli_stmt_bind_param($stmt, "i", $job_id);
	    mysqli_stmt_execute($stmt);
	    $result = mysqli_stmt_get_result($stmt);

	    // Check if query was successful
	    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
	        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td><strong>job_title</strong></td><td>" . $row['job_title'] . "</th></tr>";
            echo "<tr><td><strong>Company</strong></td><td>" . $row['Company'] . "</td></tr>";
            echo "<tr><td><strong>Location</strong></td><td>" . $row['location'] . "</td></tr>";
            echo "<tr><td><strong>CTC</strong></td><td>" . $row['ctc'] . "</td></tr>";
            echo "<tr><td><strong>Interview Mode</strong></td><td>" . $row['interview_mode'] . "</td></tr>";
            echo "<tr><td><strong>Number of Openings</strong></td><td>" . $row['number_of_openings'] . "</td></tr>";
            echo "<tr><td><strong>Required Skills</strong></td><td>" . $row['required_skills'] . "</td></tr>";
            echo "<tr><td><strong>Domain</strong></td><td>" . $row['domain'] . "</td></tr>";
            echo "<tr><td><strong>Recruiting From Year</strong></td><td>" . $row['recruiting_from_year'] . "</td></tr>";
            echo "<tr><td><strong>HR Contact</strong></td><td>" . $row['hr_contact'] . "</td></tr>";
            echo "<tr><td><strong>Apply Link</strong></td><td><a href='applyjob.php'" . $row['apply_link'] . "'>" . $row['apply_link'] . "</a></td></tr>";
	        }
	    } else {
	        echo "No job details found for the given job ID";
	    }

	    // Close connection
	    mysqli_close($conn);
	?>

</body>
</html>
