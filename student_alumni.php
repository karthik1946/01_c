<!DOCTYPE html>
<html>
<head>
	<title>Alumni List</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}
		th, td {
			text-align: left;
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}
		th {
			background-color: #4CAF50;
			color: white;
		}
		tr:hover {
			background-color: #f5f5f5;
		}
         
	</style>
</head>
<body>
	<h1>Alumni List</h1>
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Roll No</th>
				<th>Email</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
$conn = mysqli_connect("localhost", "root", "Devisyam@2003", "dblab8");

// Retrieve alumni data from the database
$sql = "SELECT name, rollno, email FROM alumni";
$result = mysqli_query($conn, $sql);

// Display alumni data in the table
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<tr>";
		echo "<td>" . $row['name'] . "</td>";
		echo "<td>" . $row['rollno'] . "</td>";
		echo "<td>" . $row['email'] . "</td>";
		echo "<td><a href='view_alumni.php?rollno=" . $row['rollno'] . "'>View More</a></td>";
		echo "</tr>";
	}
} else {
	echo "<tr><td colspan='4'>No alumni found</td></tr>";
}

mysqli_close($conn);


			?>
		</tbody>
	</table>
</body>
</html>

