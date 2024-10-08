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
?>

<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
  <style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}

		h1 {
			text-align: center;
			margin-top: 50px;
		}

		p {
			text-align: center;
			margin-top: 20px;
		}

		a {
			color: blue;
		}

		form {
			display: flex;
			justify-content: center;
			margin-top: 20px;
		}

		input[type="submit"] {
			background-color: #4CAF50;
			border: none;
			color: white;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
			border-radius: 5px;
		}

		input[type="submit"]:hover {
			background-color: #3e8e41;
		}
/* Sidebar */
.sidenav {
  height: 100%;
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

.dropdown-container a:hover {
  background-color: #555;
}

.active {
  background-color: green;
  color: white;
}

/* Main content */
.main {
  margin-left: 200px;
  padding: 0px 10px;
}

/* Add an upload image button */
.upload-btn {
  padding: 6px 8px;
  text-decoration: none;
  font-size: 18px;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  margin-bottom: 16px;
  display: inline-block;
  transition: 0.3s;
}

.upload-btn:hover {
  background-color: #3e8e41;
}

/* Display uploaded image */
.uploaded-image {
  display: block;
  margin-top: 16px;
  max-width: 100%;
}

	</style>
</head>
<body>
<div class="sidenav">
<a href="http://localhost/welcome.php">Home</a>
  <a href="http://localhost/student_update.php">Update_Profile</a>
  <a href="http://localhost/Open_roles.php">Open Roles</a>
  <a href="http://localhost/studentview_companies.php">Companies</a>
  <a href="http://localhost/savedjobs1.php">Saved Jobs</a>
  <a href="http://localhost/student_alumni.php">Alumni</a>
  <a href="http://localhost/contact.php">Contact Us</a>
  <a href="http://localhost/login.php">logout</a>
  <a href="http://localhost/delete.php">Delete your account</a>
</div>


  <h1>Welcome, <?php echo $name; ?></h1>
  <p>You can view your information <a href="http://localhost/student_info.php">here</a></p>
  <p>Please add your image <a href="http://localhost/sahi.php">here</a></p>
  <p>please update your profile</p>
</body>
</html>

<?php
} else { // if user is not logged in, redirect to login page
  header("Location: login.php");
  exit();
}
?>
