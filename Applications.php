<html>
    <head>
    <style>
    /* Apply border to the table */
    table {
        border: 1px solid #ddd;
        border-collapse: collapse;
        margin: 20px 0;
        width: 100%;
        margin: 0 auto;
    }
    
    /* Style the table header cells */
    th {
        background-color: #f2f2f2;
        border: 1px solid #ddd;
        font-weight: bold;
        padding: 8px;
        text-align: left;
    }
    
    /* Style the table data cells */
    td {
        border: 1px solid #ddd;
        padding: 8px;
    }
    
    /* Style the link within the table */
    a {
        color: #337ab7;
        text-decoration: none;
    }
    
    /* Style the link hover state within the table */
    a:hover {
        text-decoration: underline;
    }
</style>

</head>
<?php
session_start();

// Check if user is logged in and is a recruiter
if (!isset($_SESSION['recruiter_id'])) {
    // Redirect to login page or show error message
    header('Location: login.php');
    exit();
}

// Get the recruiter ID from the session
$recruiter_id = $_SESSION['recruiter_id'];

// Establish database connection
$conn = mysqli_connect('localhost', 'root', 'Devisyam@2003', 'dblab8');

// Retrieve job data from the database
$sql = "SELECT job_id, job_title FROM jobs WHERE recruiter_id = '$recruiter_id'";
$result = mysqli_query($conn, $sql);

// Display job data in a table
if (mysqli_num_rows($result) > 0) {
    echo '<table>';
    echo '<thead><tr><th>Job Title</th><th>View Applications</th></tr></thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['job_title'] . '</td>';
        echo '<td><a href="view_Applications.php?job_id=' . $row['job_id'] . '">View Applications</a></td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No jobs found';
}

mysqli_close($conn);
?>
</html>