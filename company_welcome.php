<?php
session_start(); // start the session
if(isset($_SESSION['recruiter_id'])) { // check if user is logged in
  $recruiter_id = $_SESSION['recruiter_id']; // get user's email from session
  // query the database to get user's information
  $conn = new mysqli('localhost', 'root', 'Devisyam@2003', 'dblab8');
  $sql = "SELECT * FROM Company WHERE recruiter_id='$recruiter_id'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $Company = $row['Company'];
	$recruiter_id = $row['recruiter_id'];
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
		.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width:100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
  color: #f1f1f1;
}

/* Main content */
.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

/* Add an active class to the active dropdown button */
.active {
  background-color: green;
  color: white;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: #262626;
  padding-left: 8px;
}

/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
}
	</style>
</head>
<body>
<div class="sidenav">
<a href="http://localhost/company_welcome.php">Home</a>
  <a href="http://localhost/company_requirements1.php">Add a role</a>
  <a href="http://localhost/companyview_student.php">Students</a>
  <a href="http://localhost/Applications.php">View Applications</a>
</div>


  <h1>Welcome to <?php echo $Company; ?></h1>
  <p>You can view your information <a href="http://localhost/details.php">here</a>.</p>
  <p>You can delete your account after confirmation<a href="http://localhost/logout.php">here</a>.</p>
  <form method="post" action="http://localhost/company_login.php">
    <input type="submit" name="logout" value="Logout">
  </form>
</body>
</html>

<?php
} else { // if user is not logged in, redirect to login page
  header("Location: company_login.php");
  exit();
}
?>