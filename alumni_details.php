<html>
<?php
session_start(); // Start session

// Check if session variables are set
if(isset($_SESSION['rollNo']) && isset($_SESSION['job_title']) && isset($_SESSION['name']) && isset($_SESSION['location']) && isset($_SESSION['ctc']) && isset($_SESSION['domain']) && isset($_SESSION['begin_date']) && isset($_SESSION['end_date'])) {
    // Retrieve session data
    $rollno = $_SESSION['rollNo'];
    $job_title = $_SESSION['job_title'];
    $name = $_SESSION['name'];
    $location = $_SESSION['location'];
    $ctc = $_SESSION['ctc'];
    $domain = $_SESSION['domain'];
    $begin_date = $_SESSION['begin_date'];
    $end_date = $_SESSION['end_date'];
} else {
    echo "Session data not found!";
    header("Location: a_welcome.php"); // Redirect to form page
    exit();
}

// Connect to MySQL database
$conn = mysqli_connect("localhost", "root", "Devisyam@2003", "dblab8");
if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve data from alumni table
$sql = "SELECT * FROM addinfo WHERE rollno='$rollno'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
    // Output retrieved data
    echo "<table>";
	        // Fetch and display job details
	        while ($row = mysqli_fetch_assoc($result)) {
                
                echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>"; 
	            echo "<tr><td>Roll No:</td><td>" . $row['rollno'] . "</td></tr>";
	            echo "<tr><td>Job Title:</td><td>" . $row['job_title'] . "</td></tr>";
	            echo "<tr><td>Company Name:</td><td>" . $row['name'] . "</td></tr>";
	            echo "<tr><td>Location:</td><td>" . $row['location'] . "</td></tr>";
	            echo "<tr><td>CTC:</td><td>" . $row['ctc'] . "</td></tr>";
	            echo "<tr><td>Domain:</td><td>" . $row['domain'] . "</td></tr>";
	            echo "<tr><td>Begin Date:</td><td>" . $row['begin_date'] . "</td></tr>";
	            echo "<tr><td>End Date:</td><td>" . $row['end_date'] . "</td></tr>";
	            // Add a blank row between each job details
	        }
	        
            
    
} else {
    echo "No data found in database!";
}

// Close database connection
mysqli_close($conn);
?>
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
</html>