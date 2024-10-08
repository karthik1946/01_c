
<?php
session_start(); // Start the session

if(isset($_POST['submit'])) {
    // Get form data
    $rollno = $_POST['rollno'];
    $job_title = $_POST['job_title'];
    $name = $_POST['name'];
    $location = $_POST['location'];
    $ctc = $_POST['ctc'];
    $domain = $_POST['domain'];
    $begin_date = $_POST['begin_date'];
    $end_date = $_POST['end_date'];

    // Store form data in session variables
    $_SESSION['rollno'] = $rollno;
    $_SESSION['job_title'] = $job_title;
    $_SESSION['name'] = $name;
    $_SESSION['location'] = $location;
    $_SESSION['ctc'] = $ctc;
    $_SESSION['domain'] = $domain;
    $_SESSION['begin_date'] = $begin_date;
    $_SESSION['end_date'] = $end_date;

    // Connect to MySQL database
    $conn = mysqli_connect("localhost", "root", "Devisyam@2003", "dblab8");
    if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Insert data into alumni table
    $sql1 = "CREATE TABLE IF NOT EXISTS addinfo (
        rollno VARCHAR(100) PRIMARY KEY,
        job_title VARCHAR(100),
        name VARCHAR(100),
        location VARCHAR(100),
        ctc FLOAT(10,2),
        domain VARCHAR(255),
        begin_date DATE,
        end_date DATE
    )";
    mysqli_query($conn, $sql1);
    $sql = "INSERT INTO addinfo (rollno, job_title, name, location, ctc, domain, begin_date, end_date)
            VALUES ('$rollno', '$job_title', '$name', '$location', '$ctc', '$domain', '$begin_date', '$end_date')";
    if(mysqli_query($conn, $sql)) {
        echo "Data inserted successfully!";
        header("Location: a_login.php");
        
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
?>