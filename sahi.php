<?php
session_start();

// Create a connection to the database
$conn = mysqli_connect("localhost", "root", "Devisyam@2003", "dblab8");

// Create the table if it doesn't already exist
$sql = "CREATE TABLE IF NOT EXISTS student_imgdata (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        image_name VARCHAR(100) NOT NULL,
        image_path VARCHAR(100) NOT NULL
    )";
mysqli_query($conn, $sql);

if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $target_dir = "uploads/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;

    // Move the file to the target directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // File was moved successfully
        echo "The file ". $image_name . " has been uploaded.";

        // Store the image path and student name in the database
        $rollno = $_SESSION['rollno'];
        $sql_select = "SELECT * FROM student_imgdata WHERE name = '$rollno'";
$result_select = mysqli_query($conn, $sql_select);

if (mysqli_num_rows($result_select) > 0) {
    // Tuple already exists, update the image_name and image_path columns
    $sql_update = "UPDATE student_imgdata SET image_name = '$image_name', image_path = '$target_file' WHERE name = '$rollno'";
    if (mysqli_query($conn, $sql_update)) {
        echo "Record updated successfully.";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
} else {
    // Tuple does not exist, insert a new one
    $sql_insert = "INSERT INTO student_imgdata (name, image_name, image_path) VALUES ('$rollno', '$image_name', '$target_file')";
    if (mysqli_query($conn, $sql_insert)) {
        echo "Record inserted successfully.";
    } else {
        echo "Error inserting record: " . mysqli_error($conn);
    }
}
    } else {
       
    }
} else {
    
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
  <title>File Upload Form</title>
  <link rel="stylesheet" type="text/css" href="style.css">
<style>
input[type=file] {
  padding: 10px;
  background-color: #fff;
  color: #000;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
}

/* Style the submit button */
input[type=submit] {
  background-color: #4CAF50;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* Add some spacing between the form and the message */
form {
  margin-top: 20px;
}

.message {
  margin-top: 20px;
}
</style>
</head>
<body>
<form action="sahi.php" method="post" enctype="multipart/form-data">
  <input type="file" name="image">
  <input type="submit" value="Upload">
</form>

</body>
</html>
