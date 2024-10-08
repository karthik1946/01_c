<!DOCTYPE html>
<html>
<head>
	<title>Alumni Authentication</title>
</head>
 <style>
  body {
  font-family: Arial, sans-serif;
  background-color: #f7f7f7;
}

.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

h1 {
  font-size: 36px;
  font-weight: bold;
  margin: 0 0 20px;
  text-align: center;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

table th,
table td {
  padding: 10px;
  border: 1px solid #ddd;
  text-align: left;
}

table th {
  background-color: #f5f5f5;
}

table td.actions {
  width: 120px;
  text-align: center;
}

table td.actions form {
  display: inline-block;
}

table td.actions button {
  padding: 10px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
}

table td.actions button.accept {
  background-color: #00c853;
  color: #fff;
}

table td.actions button.reject {
  background-color: #ff3d00;
  color: #fff;
}

table td.actions button:hover {
  transform: translateY(-3px);
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

.message {
  padding: 10px;
  border-radius: 5px;
  font-size: 16px;
  font-weight: bold;
  text-align: center;
}

.message.success {
  background-color: #00c853;
  color: #fff;
}

.message.error {
  background-color: #ff3d00;
  color: #fff;
}
</style>
<body>
	<h2>Alumni Authentication</h2>
	<table>
		<tr>
			<th>ID</th>
			<th>Roll No</th>
			<th>Name</th>
			<th>Email</th>
			<th>Placement Status</th>
			<th>Action</th>
		</tr>
		<?php
		// Establish a connection to the MySQL database
		$servername = "localhost";
		$username = "root";
		$password1 = "Devisyam@2003";
		$dbname = "dblab8";

		$conn = mysqli_connect($servername, $username, $password1, $dbname);

		// Check if the connection was successful
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		// Fetch all tuples with authenticated = FALSE
		$sql = "SELECT * FROM alumni WHERE authenticated = FALSE";
		$result = mysqli_query($conn, $sql);

		// Display each tuple with accept/reject buttons
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td>" . $row["id"] . "</td>";
				echo "<td>" . $row["rollNo"] . "</td>";
				echo "<td>" . $row["name"] . "</td>";
				echo "<td>" . $row["email"] . "</td>";
				echo "<td>" . $row["placement_status"] . "</td>";
				echo "<td>";
				echo "<form method='post' action=''>";
				echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
				echo "<input type='submit' name='accept' value='Accept'>";
				echo "<input type='submit' name='reject' value='Reject'>";
				echo "</form>";
				echo "</td>";
				echo "</tr>";
			}
		} else {
			echo "<tr><td colspan='6'>No alumni to authenticate</td></tr>";
		}

		// Process the form submission when accept/reject is clicked
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$id = $_POST["id"];
			if (isset($_POST["accept"])) {
				// Update authenticated column to TRUE
				$sql = "UPDATE alumni SET authenticated = TRUE WHERE id = '$id'";
				mysqli_query($conn, $sql);
				echo "Alumni with ID $id has been authenticated.";
			} elseif (isset($_POST["reject"])) {
				// Remove the tuple from the table
				$sql = "DELETE FROM alumni WHERE id = '$id'";
				mysqli_query($conn, $sql);
				echo "Alumni with ID $id has been rejected.";
			}
		}

		// Close the database connection
		mysqli_close($conn);
		?>
	</table>
</body>
</html>
