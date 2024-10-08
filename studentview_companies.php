<!DOCTYPE html>
<html>
<head>
	<title>Recruiting Companies</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="sidenav">
<a href="http://localhost/welcome.php">Home</a>
</div>
<style>
      .container {
	margin: 0 auto;
	padding: 20px;
	max-width: 600px;
}
table {
	border-collapse: collapse;
	width: 100%;
}
th, td {
	text-align: left;
	padding: 8px;
	border: 1px solid #ddd;
}
th {
	background-color: #f2f2f2;
}
tr:nth-child(even) {
	background-color: #f2f2f2;
}
tr:hover {
	background-color: #ddd;
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

ul {
	list-style-type: none;
	padding: 0;
	margin: 0;
}

li {
	margin-bottom: 10px;
	padding: 10px;
	background-color: #f1f1f1;
	border-radius: 5px;
	box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
}
</style>
	<div class="container">
		<h1>Recruiting Companies</h1>
		<?php
session_start();
// Connect to the database
$conn = mysqli_connect("localhost", "root", "Devisyam@2003", "dblab8");

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all unique company names from the jobs table
$sql = "SELECT DISTINCT company FROM jobs";
$result = mysqli_query($conn, $sql);

// Display the company names in a list
if (mysqli_num_rows($result) > 0) {
			// Output data of each row as a table row
			echo "<table>";
			echo "<thead><tr><th>Company</th><th>View Open Positions</th></tr></thead>";
			echo "<tbody>";

			while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["company"] . "</td>";
        echo "<td><a href='studentview_companiesroles.php?company_name=" . urlencode($row["company"]) . "'>View Open Positions</a></td>";
        echo "</tr>";
    }


			echo "</tbody>";
			echo "</table>";
		} else {
			echo "No companies found.";
		}

		// Close the database connection
		mysqli_close($conn);
	?>
	</div>
</body>
</html>




