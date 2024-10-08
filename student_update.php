<!DOCTYPE html>
<html>
<?php
    // Set up MySQL database connection
    session_start(); // start the session
    $servername = "localhost";
    $username = "root";
    $password = "Devisyam@2003";
    $dbname = "dblab8";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Create the table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS student_data (
            Rollno VARCHAR(8) PRIMARY KEY,
            `10th_Standard` FLOAT NOT NULL,
            cpi FLOAT NOT NULL,
            Age INT NOT NULL,
            Specialization VARCHAR(50) NOT NULL,
            Area_of_interest VARCHAR(50) NOT NULL,
            Year_of_passing INT NOT NULL,
            Placement_Status VARCHAR(10),
            CTC FLOAT
          )";
    if (!mysqli_query($conn, $sql)) {
        echo "Error creating table: " . mysqli_error($conn) . "<br>";
    }

    // Insert the form data into the table when the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $rollno = $_SESSION['rollno'];
      $standard_10 = isset($_POST['10th_standard_percentage']) ? $_POST['10th_standard_percentage'] : null;
      $cpi = isset($_POST['cpi']) ? $_POST['cpi'] : null;
      $age = isset($_POST['age']) ? $_POST['age'] : null;
      $spl = isset($_POST['spl']) ? $_POST['spl'] : null;
      $aoi = isset($_POST['Aoi']) ? $_POST['Aoi'] : null;
      $Year = isset($_POST['Year']) ? $_POST['Year'] : null;
      $Placement = isset($_POST['Placement']) ? $_POST['Placement'] : null;
      $ctc = isset($_POST['ctc']) ? $_POST['ctc'] : null;
      if ($Placement == 'No') {
        $ctc = 0;
    }
      // Check if the rollno already exists in the database
      $sql = "SELECT * FROM student_data WHERE Rollno = '$rollno'";
      $result = mysqli_query($conn, $sql);
      
      if (mysqli_num_rows($result) > 0) {
          // If the rollno exists, update the values
          $sql = "UPDATE student_data SET `10th_Standard` = '$standard_10', cpi = '$cpi', Age = '$age', 
                  Specialization = '$spl', Area_of_interest = '$aoi', Year_of_passing = '$Year', Placement_Status = '$Placement', CTC = '$ctc' 
                  WHERE Rollno = '$rollno'";
          if (mysqli_query($conn, $sql)) {
              echo "Data updated successfully";
          } else {
              echo "Error updating data: " . mysqli_error($conn);
          }
      } else {
          // If the rollno doesn't exist, insert the tuple
          $sql = "INSERT INTO student_data (Rollno, `10th_Standard`, cpi, Age, Specialization, Area_of_interest, Year_of_passing, Placement_Status, CTC) 
                  VALUES ('$rollno', '$standard_10', '$cpi', '$age', '$spl', '$aoi', '$Year', '$Placement', '$ctc')";
      
          if (mysqli_query($conn, $sql)) {
              echo "Data inserted successfully";
          } else {
              echo "Error inserting data: " . mysqli_error($conn);
          }
      }
      
    }
?>
<head>
    <title>Registration Form</title>
    <style>
/* Sidenav */
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

/* General styling */
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, sans-serif;
  font-size: 16px;
  line-height: 1.5;
}

/* Form container */
.container {
  background-color: #f7f7f7;
  border-radius: 10px;
  box-shadow: 0px 0px 10px 1px rgba(0, 0, 0, 0.2);
  margin: 50px auto;
  max-width: 500px;
  padding: 30px;
}

/* Headings */
h1 {
  color: #333;
  font-size: 32px;
  font-weight: 600;
  margin-bottom: 20px;
  text-align: center;
}

p {
  color: #777;
  font-size: 18px;
  font-weight: 400;
  margin-bottom: 30px;
  text-align: center;
}

/* Form inputs */
label {
  color: #333;
  display: block;
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 10px;
}

input[type=number], input[type=text], select {
  background-color: #fff;
  border: none;
  border-radius: 5px;
  box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.1);
  font-size: 16px;
  margin-bottom: 20px;
  padding: 10px;
  width: 100%;
}

input[type=number]:focus, input[type=text]:focus, select:focus {
  box-shadow: 0px 0px 5px 1px rgba(0, 0, 0, 0.2);
  outline: none;
}

button[type=submit] {
  background-color: #4CAF50;
  border: none;
  border-radius: 5px;
  color: #fff;
  cursor: pointer;
  font-size: 18px;
  font-weight: 500;
  margin-top: 20px;
  padding: 15px 20px;
  transition: all 0.3s ease;
  width: 100%;
}

button[type=submit]:hover {
  background-color: #3e8e41;
}

/* Form validation error messages */
.error {
  color: red;
  font-size: 14px;
  font-weight: 400;
  margin-top: 5px;
}

/* Responsive design */
@media screen and (min-width: 768px) {
  /* Form container */
  .container {
    max-width: 700px;
  }
  
  /* Form inputs */
  input[type=number], input[type=text], select {
    width: 50%;
  }
  
  /* Labels */
  label {
    display: inline-block;
    margin-right: 10px;
    width: 50%;
  }
}

</style>

</head>
<body>
  
<div class="sidenav">
<a href="http://localhost/welcome.php">Home</a>
  <a href="http://localhost/student_update.php">Update_Profile</a>
  
  
  <div class="dropdown-container">
    <a href="#">Link 1</a>
    <a href="#">Link 2</a>
    <a href="#">Link 3</a>
  </div>
  
</div>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="container">
            <h1></h1>
            <p>Enter your details</p>
            <hr>

            <label for="10th_standard_percentage"><b>10th Standard Percentage</b></label>
            <input type="number" step="0.01" max="100" placeholder="Enter percentage" name="10th_standard_percentage" id="10th_standard_percentage" required><br>

            <label for="cpi"><b>CPI</b></label>
        <input type="number" step="0.01" max="10" placeholder="Enter CPI" name="cpi" id="cpi" required><br>

        <label for="age"><b>AGE</b></label>
        <input type="number" max="25" placeholder="Enter age" name="age" id="age" required><br>

        <label for="spl"><b>Enter Specialization</b></label>
        <input type="text" placeholder="Enter Specialization" name="spl" id="spl" required><br>


        <label for="Aoi"><b>Area of interest</b></label>
        <input type="text" placeholder="area of interest" name="Aoi" id="Aoi" required><br>

        <label for="Year"><b>Enter Year</b></label>
        <input type="number" max="2026" min="2021" placeholder="Enter Year" name="Year" id="Year" required><br>

        <label for="Placement"><b>Placement</b></label>
    <select name="Placement" id="Placement" onchange="showCTC(this.value)" required>
      <option value="">Select one</option>
      <option value="Yes">Yes</option>
      <option value="No">No</option>
    </select><br>

    <div id="ctc-div" style="display:none;">
      <label for="ctc"><b>CTC</b></label>
      <input type="number" placeholder="Enter CTC" name="ctc" id="ctc"><br>
</div>
<script>
function showCTC(value) {
  var ctcDiv = document.getElementById("ctc-div");
  if (value == "Yes") {
    ctcDiv.style.display = "block";
  } else {
    ctcDiv.style.display = "none";
  }
}
</script>
        <hr>

        <button type="submit" class="registerbtn">Submit</button>
    </div>
</form>
