<?php
session_start(); // start the session
if(isset($_SESSION['rollno'])) { // check if user is logged in
  $rollno = $_SESSION['rollno']; // get user's email from session
  // query the database to get user's information
  $conn = new mysqli('localhost', 'root', 'Devisyam@2003', 'dblab8');
  $sql = "SELECT * FROM students WHERE Rollno='$rollno'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
	$email = $row['email'];
  }
  $sql1 = "SELECT * FROM student_data WHERE Rollno='$rollno'";
  $result = $conn->query($sql1);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $tenth = $row['10th_Standard'];
	  $cpi = $row['cpi'];
    $Age = $row['Age'];
    $Specialization = $row['Specialization'];
    $Area_of_interest = $row['Area_of_interest'];
    $Year_of_passing = $row['Year_of_passing'];
    $Placement_Status = $row['Placement_Status'];
    $CTC = $row['CTC'];
    
  }
  // Retrieve the image path from the database based on the roll number
$sql4 = "SELECT image_path FROM student_imgdata WHERE name = '$rollno'";
$result = mysqli_query($conn, $sql4);

if (mysqli_num_rows($result) > 0) {
    // Image path was found in the database
    $row = mysqli_fetch_assoc($result);
    $image_path = $row['image_path'];

    // Display the image on the webpage
    echo "<img src='$image_path' width='300' height='300'>";

} else {
    // Image path was not found in the database
    echo "No image found for the student roll number: $rollno";
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
  <style>
		/* Set the style for the side navigation */
    img {
    display: block;
    margin: auto;
    margin-top: 50px;
  }
    .sidenav {
  height: 100%;
  width: 200px; /* Adjust the width as needed */
  position: fixed;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

/* Style the links inside the navigation bar */
.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
}

/* Change the color of links on hover */
.sidenav a:hover {
  color: #f1f1f1;
}

/* Add a black background color to the dropdown button */
.dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #f1f1f1;
  display: block;
  background-color: #111;
  border: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

/* Add a red background color to dropdown button on hover */
.dropdown-btn:hover {
  background-color: #f1f1f1;
  color: #111;
}

/* Style the dropdown container */
.dropdown-container {
  display: none;
  background-color: #262626;
  padding-left: 8px;
}

/* Style links inside the dropdown */
.dropdown-container a {
  color: #f1f1f1;
  padding: 8px 8px 8px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-container a:hover {
  background-color: #f1f1f1;
  color: #111;
}

/* Show the dropdown menu on hover */
.dropdown-btn:hover .dropdown-container {
  display: block;
}

/* Style the main content */
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
<div class="sidenav">
<a href="http://localhost/welcome.php">Home</a>
  <a href="http://localhost/student_update.php">Update_Profile</a>
  <a href="http://localhost/login.php">logout</a>
  <a href="http://localhost/delete.php">Delete your account</a>
</div>


<table>
    <tr>
      <th>Field</th>
      <th>Value</th>
    </tr>
    <tr>
      <td>Name</td>
      <td><?php echo $name; ?></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><?php echo $email; ?></td>
    </tr>
    <tr>
      <td>RollNo</td>
      <td><?php echo $rollno; ?></td>
    </tr>
    <tr>
      <td>10th_Standard</td>
      <td><?php echo $tenth; ?></td>
    </tr>
    <tr>
      <td>CPI</td>
      <td><?php echo $cpi; ?></td>
    </tr>
    <tr>
      <td>Age</td>
      <td><?php echo $Age; ?></td>
    </tr>
    <tr>
      <td>Specialization</td>
      <td><?php echo $Specialization; ?></td>
    </tr>
    <tr>
      <td>Area_of_interest</td>
      <td><?php echo $Area_of_interest; ?></td>
    </tr>
    <tr>
      <td>Year_of_passing</td>
      <td><?php echo $Year_of_passing; ?></td>
    </tr>
    <tr>
      <td>Placement_Status</td>
      <td><?php echo $Placement_Status; ?></td>
    </tr>
    <tr>
      <td>CTC</td>
      <td><?php echo $CTC; ?></td>
    </tr>
  </table>
</body>
</html>

<?php
} else { // if user is not logged in, redirect to login page
  header("Location: login.php");
  exit();
}
?>
