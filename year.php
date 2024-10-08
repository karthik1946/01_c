<?php
// retrieve year parameter from URL
if (isset($_GET['year'])) {
    $selected_year = $_GET['year'];
} else {
    // default year if not provided in URL
    $selected_year = date('Y');
}

// establish database connection
$conn = mysqli_connect('localhost', 'root', 'Devisyam@2003', 'dblab8');

// retrieve data from database for selected year
$result = mysqli_query($conn, "SELECT name, COUNT(*) AS count FROM first_company WHERE YEAR(begin_date) = $selected_year GROUP BY name");

// create associative array from data
$data = array();
$max_value = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['name']] = $row['count'];
    if ($row['count'] > $max_value) {
        $max_value = $row['count'];
    }
}

// close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
<style>
        .chart {
            display: flex;
            align-items: flex-end;
            height: 300px;
            margin: 50px;
        }

        .bar-container {
            display: flex;
            justify-content: space-around;
            width: 100%;
        }

        .bar {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            width: 50px;
            margin: 0 10px;
            height: 300px;
            position: relative;
        }

        .bar-value {
            position: absolute;
            top: -25px;
            font-size: 14px;
        }

        .bar-label {
            margin-top: 10px;
            font-size: 14px;
        }

        .bar-fill {
            background-color: #007bff;
            width: 40px;
        }

        .axis-y {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            margin-right: 10px;
        }

        .axis-y-tick {
            width: 10px;
            background-color: #ccc;
        }

        .axis-y-label {
            margin-top: -5px;
            margin-right: 5px;
            text-align: right;
            font-size: 12px;
        }

        .axis-x-label {
            font-size: 14px;
        }

        .axis-x {
            display: flex;
            align-items: center;
            margin-left: 70px;
            margin-top: 10px;
        }

        .axis-x-line {
            height: 2px;
            width: 100%;
            background-color: #ccc;
        }

        .axis-x-label {
            margin-left: 10px;
            font-size: 16px;
        }

        .axis-y-line {
            width: 2px;
            height: 300px;
            background-color: #ccc;
            margin-right: 10px;
        }

        .axis-y-label:first-child {
            margin-top: 15px;
        }

        .axis-y-label:last-child {
            margin-bottom: 10px;
        }

        /* Style for year links */
        .bar-label a {
            text-decoration: none;
            color: #007bff;
            cursor: pointer;
        }
    </style>
    <title>Bar Graph Example</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="chart">
    <!-- Display the selected year in the chart title -->
    <h1>Count vs Name for Year <?php echo $selected_year; ?></h1>
    <div class="axis-x">
        <!-- Display the axis labels and lines -->
    </div>
    <div class="bar-container">
        <?php foreach ($data as $name => $count) { ?>
            <div class="bar">
                <div class="bar-value"><?php echo $count; ?></div>
                <div class="bar-fill" style="height: <?php echo ($count / $max_value) * 100; ?>%;"></div>
                <div class="bar-label"><?php echo $name; ?></div>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
