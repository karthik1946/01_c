<!DOCTYPE html>
<html>
<head>
  <title>Insert Job Details</title>
  <style>
    form {
  border: 2px solid #ccc;
  padding: 10px;
  border-radius: 10px;
}

label {
  display: block;
  margin-bottom: 10px;
}

input[type="text"],
input[type="email"],
input[type="password"],
select,
textarea {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  width: 50%;
  box-sizing: border-box;
  margin-bottom: 10px;
}

input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type="submit"]:hover {
  background-color: #45a049;
}


    </style>
</head>
<body>
  <h1>Insert Job Details</h1>
  <!-- HTML form to collect job details -->
  <form method="post" action="">
    <label for="recruiter_id">Recruiter ID:</label>
    <input type="text" name="recruiter_id" id="recruiter_id" required>
    <br>
    <label for="job_title">Job Title:</label>
    <input type="text" name="job_title" id="job_title" required>
    <br>
    <label for="Company">Company:</label>
    <input type="text" name="Company" id="Company" required>
    <br>
    <label for="location">Location:</label>
    <input type="text" name="location" id="location" required>
    <br>
    <label for="ctc">CTC:</label>
    <input type="text" name="ctc" id="ctc" required>
    <br>
    <label for="interview_mode">Interview Mode:</label>
    <select id="interview_mode" name="interview_mode" required>
      <option value="online">Online</option>
      <option value="offline">Offline</option>
    </select><br>
    <label for="number_of_openings">Number of Openings:</label>
    <input type="number" name="number_of_openings" id="number_of_openings" required>
    <br>
    <label for="required_skills">Required Skills:</label>
    <textarea name="required_skills" id="required_skills" rows="4" cols="30" required></textarea>
    <br>
    <label for="domain">Domain:</label>
    <input type="text" name="domain" id="domain" required>
    <br>
    <label for="recruiting_from_year">Recruiting From Year:</label>
    <input type="number" name="recruiting_from_year" id="recruiting_from_year" required>
    <br>
    <label for="hr_contact">HR Contact:</label>
    <input type="text" name="hr_contact" id="hr_contact" required>
    <br>
    <label for="apply_link">Of campus apply link:</label>
    <input type="text" name="apply_link" id="apply_link" required>
    <br>
    <input type="submit" value="Submit">
  </form>
</body>
</html>
<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Collect form data
  $recruiter_id = $_POST["recruiter_id"];
  $job_title = $_POST["job_title"];
  $Company = $_POST["Company"];
  $location = $_POST["location"];
  $ctc = $_POST["ctc"];
  $interview_mode = $_POST["interview_mode"];
  $number_of_openings = $_POST["number_of_openings"];
  $required_skills = $_POST["required_skills"];
  $domain = $_POST["domain"];
  $recruiting_from_year = $_POST["recruiting_from_year"];
  $hr_contact = $_POST["hr_contact"];
  $apply_link = $_POST["apply_link"];
  // Connect to MySQL database
  $conn = mysqli_connect("localhost", "root", "Devisyam@2003", "dblab8"); // Replace with your database credentials

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  $sql_create_table = "CREATE TABLE IF NOT EXISTS jobs (
    job_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    recruiter_id VARCHAR(30) NOT NULL,
    job_title VARCHAR(255) NOT NULL,
    Company VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    ctc DECIMAL(10,2) NOT NULL,
    interview_mode VARCHAR(255) NOT NULL,
    number_of_openings INT NOT NULL,
    required_skills VARCHAR(255) NOT NULL,
    domain VARCHAR(255) NOT NULL,
    recruiting_from_year INT NOT NULL,
    hr_contact VARCHAR(30) NOT NULL,
    apply_link VARCHAR(255) NOT NULL,
    FOREIGN KEY (recruiter_id) REFERENCES Company(recruiter_id)
  );";
  if (mysqli_query($conn, $sql_create_table)) {
    echo "Table jobs created successfully.<br>";
  } else {
    echo "Error creating table: " . mysqli_error($conn) . "<br>";
  }
  
  // Insert data into jobs table
  $sql = "INSERT INTO jobs (recruiter_id, job_title, Company, location, ctc, interview_mode, number_of_openings, required_skills, domain, recruiting_from_year, hr_contact, apply_link)
          VALUES ('$recruiter_id', '$job_title', '$Company', '$location', $ctc, '$interview_mode', $number_of_openings, '$required_skills', '$domain', $recruiting_from_year, '$hr_contact', '$apply_link')";

  if (mysqli_query($conn, $sql)) {
    echo "New job details inserted successfully";
    header("Location: company_welcome.php");
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  // Close database connection
  mysqli_close($conn);
}
?>
