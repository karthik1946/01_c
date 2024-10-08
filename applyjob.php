<?php

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "Devisyam@2003";
$dbname = "dblab8";

$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Create the database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS dblab8";
if (mysqli_query($conn, $sql)) {
} else {
  echo "Error creating database: " . mysqli_error($conn) . "\n";
}

// Select the database
mysqli_select_db($conn, $dbname);

// Create the applications table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS applications (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  rollno VARCHAR(10) NOT NULL,
  company VARCHAR(50) NOT NULL,
  job_title VARCHAR(50) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
} else {
  echo "Error creating table: " . mysqli_error($conn) . "\n";
}

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['rollno'])) {
  header("Location: login.php");
  exit();
}

// Check if form has been submitted
if (isset($_POST['Apply'])) {
  // Get form data
  $rollno = $_SESSION['rollno'];
  $company = $_POST['company'];
  $job_title = $_POST['job_title'];

  // Insert data into applications table
  $sql = "INSERT INTO applications (rollno, company, job_title) VALUES ('$rollno', '$company', '$job_title')";

  if (mysqli_query($conn, $sql)) {
    echo "Application submitted successfully.";
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}

// Close database connection
mysqli_close($conn);

?>

<!doctype html>
<html>
<head>
  <title>Apply for a job</title>
<style>

form {
      padding: 20px;
      background-color: #f2f2f2;
      border-radius: 5px;
      box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
      width: 30%;
      margin: 0 auto;
    }
    label {
      display: block;
      margin-bottom: 10px;
    }
    input[type=text] {
      padding: 10px;
      border-radius: 5px;
      border: none;
      margin-bottom: 20px;
      width:100%;
    }
    input[type=submit] {
      padding: 10px;
      border-radius: 5px;
      border: none;
      background-color: #4CAF50;
      color: white;
      font-weight: bold;
      cursor: pointer;
    }

  </style>

  
    
</head>
<body>

  <h1>Enter Company details</h1>

  <form method="post" action="">
    <label for="company">Company Name:</label>
    <input type="text" id="company" name="company" required><br>

    <label for="job_title">Job Title:</label>
    <input type="text" id="job_title" name="job_title" required><br>

    <input type="submit" name="Apply" value="Apply">
  </form>

</body>
</html>
