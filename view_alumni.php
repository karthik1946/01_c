<html>
    <head>
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
<?php
session_start();


// Create a database connection
$connection = mysqli_connect('localhost', 'root', 'Devisyam@2003', 'dblab8');

$roll_no = $_GET['rollno'];
// Retrieve the rows from the add_info table where the roll number matches
$query = "SELECT * FROM addinfo WHERE rollno = '$roll_no'";
$result = mysqli_query($connection, $query);

// Display the results in a table format
echo '<table>';
echo '<tr><th>Roll No</th><th>Job Title</th><th>Name</th><th>Location</th><th>CTC</th><th>Domain</th><th>Begin Date</th><th>End Date</th></tr>';
while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['rollno'] . '</td>';
    echo '<td>' . $row['job_title'] . '</td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['location'] . '</td>';
    echo '<td>' . $row['ctc'] . '</td>';
    echo '<td>' . $row['domain'] . '</td>';
    echo '<td>' . $row['begin_date'] . '</td>';
    echo '<td>' . $row['end_date'] . '</td>';
    echo '</tr>';
}
echo '</table>';

// Close the database connection
mysqli_close($connection);
?>

</html>

