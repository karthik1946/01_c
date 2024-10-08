<?php
// Establish database connection
$conn = mysqli_connect('localhost', 'root', 'Devisyam@2003', 'dblab8');

// Retrieve data from database
$result = mysqli_query($conn, 'SELECT name, AVG(ctc) AS avg_ctc FROM first_company GROUP BY name ORDER BY avg_ctc DESC');

// Create associative array from data
$data = array();
$max_value = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['name']] = $row['avg_ctc'];
    if ($row['avg_ctc'] > $max_value) {
        $max_value = $row['avg_ctc'];
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bar Graph Example</title>
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
            text-align: center;
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

        /* Style for name links */
        .bar-label a {
            text-decoration: none;
            color: #007bff;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="chart">
    <div class="axis-x">
        <div class="axis-y-line"></div>
        <div class="axis-x
        -label">Average CTC</div>
</div>
<div class="bar-container">
<?php foreach ($data as $name => $avg_ctc): ?>
<div class="bar">
<div class="bar-value"><?php echo $avg_ctc; ?></div>
<div class="bar-fill" style="height: <?php echo ($avg_ctc / $max_value) * 100; ?>%;"></div>
<div class="bar-label"><a href="#"><?php echo $name; ?></a></div>
</div>
<?php endforeach; ?>
</div>
<div class="axis-y">
<div class="axis-y-label"><?php echo $max_value; ?></div>
<div class="axis-y-tick"></div>
<div class="axis-y-label"><?php echo round($max_value / 2, 2); ?></div>
<div class="axis-y-tick"></div>
<div class="axis-y-label">0</div>
</div>

</div>
</body>
</html>