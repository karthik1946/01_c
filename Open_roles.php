
<!DOCTYPE html>
<html>
<head>
	<title>Jobs Listing</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="savedjobs.css">
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
h1 {
  text-align: center;
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
	<h1>Jobs Listing</h1>

	<?php
   session_start(); // start the session
   if(isset($_SESSION['rollno'])) { // check if user is logged in
     $rollno = $_SESSION['rollno'];
   }
		// Connect to the database
		$db_host = 'localhost';
		$db_user = 'root';
		$db_pass = 'Devisyam@2003';
		$db_name = 'dblab8';

		$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		// Create table for each student with saved jobs
		$sql = "CREATE TABLE IF NOT EXISTS savedjobs (
			student_rollno VARCHAR(10) NOT NULL,
			job_id INT(11) NOT NULL,
			PRIMARY KEY (student_rollno, job_id)
		)";

		if (!mysqli_query($conn, $sql)) {
			die("Error creating table: " . mysqli_error($conn));
		}
    // Check if a job has been saved for the current student
$rollno = $_SESSION['rollno'];
$sql = "SELECT job_id FROM savedjobs WHERE student_rollno = '$rollno'";
$result = mysqli_query($conn, $sql);
$saved_jobs = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $saved_jobs[] = $row['job_id'];
    }
}

		// Fetch all jobs from the database
		$sql = "SELECT * FROM jobs";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			// Output data of each row as a table row
			echo "<table>";
			echo "<thead><tr><th>Job Title</th><th>Company</th><th>Location</th><th>CTC</th><th>Eligibility</th><th>View Details|Save Job</th><th>Apply through TPC</th></tr></thead>";
			echo "<tbody>";

			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr data-interview-mode='" . $row["interview_mode"] . "' data-number-of-openings='" . $row["number_of_openings"] . "' data-required-skills='" . $row["required_skills"] . "' data-domain='" . $row["domain"] . "' data-recruiting-from-year='" . $row["recruiting_from_year"] . "' data-hr-contact='" . $row["hr_contact"] . "' data-apply-link='" . $row["apply_link"] . "' data-job-id='" . $row["job_id"] . "'>";
				echo "<td>" . $row["job_title"] . "</td>";
				echo "<td>" . $row["Company"] . "</td>";
				echo "<td>" . $row["location"] . "</td>";
				echo "<td>" . $row["ctc"] . "</td>";
        $student_rollno = $_SESSION['rollno'];
        $student_ctc_sql = "SELECT ctc FROM student_data WHERE rollno = '$student_rollno'";
        $student_ctc_result = mysqli_query($conn, $student_ctc_sql);
        $student_ctc_row = mysqli_fetch_assoc($student_ctc_result);
        $student_ctc = $student_ctc_row['ctc'];
        if ($student_ctc <= $row["ctc"]) {
            echo "<td>Eligible</td>";
        } else {
            echo "<td>Not Eligible</td>";
        }
				if (in_array($row["job_id"], $saved_jobs)) {
          echo "<td><a href='#' class='view-details-link'>View Details</a> | <span class='job-saved'>Saved</span></td>";
      } else {
          echo "<td><a href='#' class='view-details-link'>View Details</a> | <a href='savedjobs.php?job_id=" . $row["job_id"] . "' class='save-job-link'>Save Job</a></td>";
      }   
				
        if ($student_ctc <= $row["ctc"]) {
          echo "<td><a href='applyjob.php?job_id=" . $row["job_id"] . "&job_title=" . $row["job_title"] . "&Company=" . $row["Company"] . "' class='apply-link'>Apply</a></td>";
      }
      echo "</tr>";
			}

			echo "</tbody>";
			echo "</table>";
		} else {
			echo "No jobs found.";
		}

		// Close the database connection
		mysqli_close($conn);
	?>

	<!-- Modal dialog box for job details -->
<!-- Modal dialog box for job details -->
<div id="job-details-modal">
	<div id="job-details-content"></div>
	<div id="job-details-buttons">
		<a href="#" id="apply-link" target="_blank">Apply</a>
    <script>
// Add this JavaScript code to handle the click event of the "view details" link
const viewDetailsLinks = document.querySelectorAll('.view-details-link');

viewDetailsLinks.forEach(link => {
  link.addEventListener('click', (event) => {
    event.preventDefault();
    const jobRow = link.closest('tr');
    const jobDetailsRow = document.createElement('tr');
    jobDetailsRow.innerHTML = `
      <td colspan="7">
        <ul>
      <h2>Dont worry even if you are not eligible you can apply for this position off-campus here:</h2>
          <li>Interview Mode: ${jobRow.dataset.interviewMode}</li>
          <li>Number of Openings: ${jobRow.dataset.numberOfOpenings}</li>
          <li>Required Skills: ${jobRow.dataset.requiredSkills}</li>
          <li>Domain: ${jobRow.dataset.domain}</li>
          <li>Recruiting From Year: ${jobRow.dataset.recruitingFromYear}</li>
          <li>HR Contact: ${jobRow.dataset.hrContact}</li>
          <li><a href="${jobRow.dataset.applyLink}">Apply Now</a></li>
        </ul>
      </td>
    `;
    jobRow.insertAdjacentElement('afterend', jobDetailsRow);
  });
});

  </script>
	
  </body>
</html>