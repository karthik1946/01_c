<?php
session_start();

// Retrieve the student roll number from the session
$rollno = $_SESSION['rollno'];

// Connect to the database
$conn = mysqli_connect("localhost", "root", "Devisyam@2003", "dblab8");

// Retrieve the image path from the database based on the roll number
$sql = "SELECT image_path FROM student_imgdata WHERE name = '$rollno'";
$result = mysqli_query($conn, $sql);

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

// Close the database connection
mysqli_close($conn);
?>
