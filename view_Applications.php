<html>
    <head>
        <style>

.container {
  margin: 0 auto;
  width: 80%;
  padding: 20px;
}

.table {
  width: 100%;
  border-collapse: collapse;
}

.table thead th {
  font-weight: bold;
  background-color: #f5f5f5;
  border-bottom: 1px solid #ddd;
  text-align: left;
  padding: 10px;
}

.table tbody td {
  border-bottom: 1px solid #ddd;
  text-align: left;
  padding: 10px;
}



            </style>
</head>
<?php
// Establish database connection
$conn = mysqli_connect("localhost", "root", "Devisyam@2003", "dblab8");

// Check if job_id is set in URL parameters
if (isset($_GET['job_id'])) {
    $job_id = $_GET['job_id'];

    // Get job title from the jobs table using job_id
    $sql_job = "SELECT job_title FROM jobs WHERE job_id='$job_id'";
    $result_job = mysqli_query($conn, $sql_job);
    $row_job = mysqli_fetch_assoc($result_job);
    $job_name = $row_job['job_title'];


    

    // Get Rollno of students who applied for the job from the applications table
    $sql_app = "SELECT DISTINCT Rollno FROM applications WHERE job_title='$job_name'";
    $result_app = mysqli_query($conn, $sql_app);

    // Create a table to display job applications
    echo '<div class="container">';
    echo '<h1> '. $job_name . '</h1>';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Roll No.</th>';
    echo '<th>Name</th>';
    echo '<th>Email</th>';
    echo '<th>CPI</th>';
    echo '<th>Age</th>';
    echo '<th>Specialization</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    // Loop through each application and display student details
    while ($row_app = mysqli_fetch_assoc($result_app)) {
        $rollno = $row_app['Rollno'];

        // Get details of student from the students and student_data table using Rollno
        $sql_stud = "SELECT students.rollno, students.name, students.email, student_data.cpi, student_data.Age, student_data.Specialization
        FROM students JOIN student_data ON students.Rollno=student_data.Rollno WHERE students.Rollno='$rollno'
        ORDER BY student_data.cpi DESC";
        $result_stud = mysqli_query($conn, $sql_stud);
        $row_stud = mysqli_fetch_assoc($result_stud);

        // Display student details in a table row
        echo '<tr>';
        echo '<td>' . $row_stud['rollno'] . '</td>';
        echo '<td>' . $row_stud['name'] . '</td>';
        echo '<td>' . $row_stud['email'] . '</td>';
        echo '<td>' . $row_stud['cpi'] . '</td>';
        echo '<td>' . $row_stud['Age'] . '</td>';
        echo '<td>' . $row_stud['Specialization'] . '</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
}
?>

</html>