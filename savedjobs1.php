<!DOCTYPE html>
<html>
<head>
	<title>Saved Jobs</title>
	<link rel="stylesheet" href="styles.css">
	<style>
      table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #f5f5f5;
}
table {
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

th {
  background-color: #f2f2f2;
}

tr:hover {
  background-color: #f5f5f5;
}

.view-details-link {
  color: blue;
  text-decoration: underline;
  cursor: pointer;
}

/* Modal dialog box styles */
#job-details-modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto
}
.sidenav {
  height: 7vh;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color:darkBlue; /* change background color to skyblue */
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a, .dropdown-btn {
  margin-bottom: 15px;
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #f2f2f2;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
  transition: 0.3s;
}

.sidenav a:hover, .dropdown-btn:hover {
  color: #fff;
  background-color: #555;
}

.dropdown-btn {
  position: relative;
}
h1 {
  text-align: center;
}

.dropdown-btn:after {
  content: '\25BC';
  font-size: 10px;
  color: #f2f2f2;
  position: absolute;
  right: 8px;
  top: 50%;
  transform: translateY(-50%);
}

.dropdown-container {
  display: none;
  background-color: #262626;
  padding-left: 8px;
}

.dropdown-container a {
  color: #f2f2f2;
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  display: block;
  transition: 0.3s;
}

.dropdown-container a:hover {
  background-color: #555;
}
</style>
</head>
<body>
<div class="sidenav">
<a href="http://localhost/welcome.php">Home</a>
</div>
	<h1>Saved Jobs</h1>

	<?php
		// Start the session
		session_start();

		// Check if the user is logged in
		if (!isset($_SESSION["rollno"])) {
			header("Location: login.php");
			exit;
		}

		// Get the rollno from the session
		$rollno = $_SESSION["rollno"];

		// Connect to the database
		$db_host = 'localhost';
		$db_user = 'root';
		$db_pass = 'Devisyam@2003';
		$db_name = 'dblab8';

		$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		
		$sql = "SELECT * FROM saved_jobs where rollno = '$rollno'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			// Output data of each row as a table row
			echo "<table>";
			echo "<thead><tr><th>Job Title</th><th>Company</th><th>Location</th><th>CTC</th><th>Action</th></tr></thead>";
			echo "<tbody>";

			while ($row = mysqli_fetch_assoc($result)) {
				// Fetch the job details for each saved job
				$job_id = $row["job_id"];
				$sql2 = "SELECT * FROM jobs WHERE job_id = $job_id";
				$result2 = mysqli_query($conn, $sql2);

				if (mysqli_num_rows($result2) > 0) {
					$job_row = mysqli_fetch_assoc($result2);

					// Output the job details as a table row
					echo "<tr>";
					echo "<td>" . $job_row["job_title"] . "</td>";
					echo "<td>" . $job_row["Company"] . "</td>";
					echo "<td>" . $job_row["location"] . "</td>";
					echo "<td>" . $job_row["ctc"] . "</td>";
          echo "<td><a href='studentview_job.php?job_id=" . $job_row["job_id"] . "'>View Details</a></td>";
					echo "</tr>";
				}
			}

			echo "</tbody>";
			echo "</table>";
		} else {
			echo "No saved jobs found.";
		}

		// Close the database connection
		mysqli_close($conn);
	?>

</body>
</html>
