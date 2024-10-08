<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

th {
  background-color: #4CAF50;
  color: white;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

a {
  color: #4CAF50;
  text-decoration: none;
}
</style>
<?php
session_start();

// Check if the company_name variable is set
if (isset($_GET['company_name'])) {
    // Store the company_name value in the session
    $_SESSION['company_name'] = $_GET['company_name'];
} else {
    // Redirect to the companies page if the company_name variable is not set
    header("Location: companies.php");
    exit();
}


// Connect to database
$conn = mysqli_connect("localhost", "root", "Devisyam@2003", "dblab8");

// Fetch all jobs offered by the company
$company_name = $_SESSION['company_name'];
$sql = "SELECT * FROM jobs WHERE company = '$company_name'";
$result = mysqli_query($conn, $sql);

// Display the jobs in a table
if (mysqli_num_rows($result) > 0) {
    echo "<h2>Jobs offered by $company_name:</h2>";
    echo "<table>";
    echo "<thead><tr><th>Job Title</th><th>Location</th><th>CTC</th><th>Eligibility</th><th></th></tr></thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["job_title"] . "</td>";
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
        echo "<td><a href='studentview_job.php?job_id=" . $row["job_id"] . "'>View Details</a></td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "No jobs found for $company_name.";
}

// Close the database connection
mysqli_close($conn);
?>

</body>
</html>
