 <!DOCTYPE html>
<html>
<head>
    <title>Student Data</title>
    <style>
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #dddddd;
        }
        .student-data {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        .student-data div {
            flex-basis: 23%;
        }
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            margin: 0;
        }
        form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            background-color: #f2f2f2;
            padding: 20px;
        }
        form label {
            margin-right: 10px;
        }
        form input[type="text"], form input[type="submit"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }
        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form input[type="submit"]:hover {
            background-color: #3e8e41;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .input-form {
            margin-bottom: 20px;
        }
        .input-form label, input[type="submit"] {
            display: block;
            margin-bottom: 10px;
        }
        .input-form input[type="text"] {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .input-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .input-form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>

    
</head>


<body>


    <form method="post" action="">
        <label for="rollno">Roll No:</label>
        <input type="text" id="rollno" name="rollno"><br><br>
        <label for="cpi">CPI:</label>
        <input type="text" id="cpi" name="cpi"><br><br>
        <label for="ctc">CTC:</label>
        <input type="text" id="ctc" name="ctc"><br><br>
        <input type="submit" value="Search">
    </form>

    <?php
// Check if any input is provided
    
// Create a database connection
$servername = "localhost";
$username = "root";
$password = "Devisyam@2003";
$dbname = "dblab8";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to retrieve data based on input
$sql = "SELECT * FROM student_data";

// Check if rollno input is provided
if (isset($_POST['rollno']) && $_POST['rollno'] != "") {
    // Get input rollno from HTML form
    $input_rollno = $_POST['rollno'];
    // Add condition to SQL query
    $sql .= " WHERE Rollno='$input_rollno'";
}

// Check if cpi input is provided
if (isset($_POST['cpi']) && $_POST['cpi'] != "") {
    // Get input cpi from HTML form
    $input_cpi = $_POST['cpi'];
    // Check if there is already a WHERE clause in the SQL query
    if (strpos($sql, 'WHERE') !== false) {
        // Add condition to existing SQL query
        $sql .= " AND cpi>='$input_cpi'";
    } else {
        // Add condition to SQL query
        $sql .= " WHERE cpi>='$input_cpi'";
    }
}

// Check if ctc input is provided
if (isset($_POST['ctc']) && $_POST['ctc'] != "") {
    // Get input ctc from HTML form
    $input_ctc = $_POST['ctc'];
    // Check if there is already a WHERE clause in the SQL query
    if (strpos($sql, 'WHERE') !== false) {
        // Add condition to existing SQL query
        $sql .= " AND ctc>='$input_ctc'";
    } else {
        // Add condition to SQL query
        $sql .= " WHERE ctc>='$input_ctc'";
    }
}

// Execute the SQL query
$result = $conn->query($sql);

// Check if any data was found
if ($result->num_rows > 0) {
    // Output the data as an HTML table
    echo "<table>
            <tr>
                <th>Roll No</th>
                <th>10th Standard</th>
                <th>Specialization</th>
                <th>CPI</th>
                <th>placement status</th>
                <th>CTC</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["Rollno"] . "</td>
                <td>" . $row["10th_Standard"] . "</td>
                <td>" . $row["Specialization"] . "</td>
                <td>" . $row["cpi"] . "</td>
                <td>" . $row["Placement_Status"] . "</td>

                <td>" . $row["CTC"] . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    // Output a message if no data was found
    echo "No data found.";
}

// Close the database connection
$conn->close();
?>

    </body>
    </html>