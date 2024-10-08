<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = 'Devisyam@2003';
$db_name = 'dblab8';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_id = $_POST['job_id'];
    $sql = "SELECT * FROM jobs WHERE job_id = $job_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    $sql = "INSERT INTO rollno_saved_jobs (job_title, company, location, ctc, interview_mode, number_of_openings, required_skills, domain, recruiting_from_year, hr_contact, apply_link, save_link) VALUES ('" . $row['job_title'] . "', '" . $row['company'] . "', '" . $row['location'] . "', '" . $row['ctc'] . "', '" . $row['interview_mode'] . "', '" . $row['number_of_openings'] . "', '" . $row['required_skills'] . "', '" . $row['domain'] . "', '" . $row['recruiting_from_year'] . "', '" . $row['hr_contact'] . "', '" . $row['apply_link'] . "', '" . $row['save_link'] . "')";

    if (mysqli_query($conn, $sql)) {
        echo "Job saved successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
