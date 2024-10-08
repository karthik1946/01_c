<?php
    require 'alumni2.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
        }

        form {
            width: 300px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50; /* Green */
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Alumni Job Details</h1>
    <form method="post" action="">
        <label for="rollno">Roll No:</label>
        <input type="text" id="rollno" name="rollno"><br>
        <label for="job_title">Job Title:</label>
        <input type="text" id="job_title" name="job_title"><br>
        <label for="name">Company Name:</label>
        <input type="text" id="name" name="name"><br>
        <label for="location">Location:</label>
        <input type="text" id="location" name="location"><br>
        <label for="ctc">CTC:</label>
        <input type="text" id="ctc" name="ctc"><br>
        <label for="domain">Domain:</label>
        <input type="text" id="domain" name="domain"><br>
        <label for="begin_date">Begin Date:</label>
        <input type="date" id="begin_date" name="begin_date"><br>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date"><br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
<?php

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
    $sql3 = "CREATE TABLE IF NOT EXISTS first_company (
        rollno VARCHAR(100) PRIMARY KEY,
        job_title VARCHAR(100),
        name VARCHAR(100),
        location VARCHAR(100),
        ctc FLOAT(10,2),
        domain VARCHAR(255),
        begin_date DATE,
        end_date DATE
    )";
    mysqli_query($conn, $sql3);

    $sql = "INSERT INTO first_company (rollno, job_title, name, location, ctc, domain, begin_date, end_date)
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