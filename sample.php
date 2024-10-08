<?php
// establish database connection
$conn = mysqli_connect('localhost', 'root', 'Devisyam@2003', 'dblab8');

// retrieve data from database
$result = mysqli_query($conn, 'SELECT YEAR(begin_date) AS year, COUNT(*) AS count FROM first_company GROUP BY year ORDER BY year DESC');

// create associative array from data
$data = array();
$max_value = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['year']] = $row['count'];
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
</head>
<body>

<div class="chart">
    <div class="axis-x">
        <div class="axis-y-line"></div>
        <div class="axis-x-line"></div>
        <div class="axis-x-label
        ">Number of students placed</div>
        <div class="axis-y-label
        ">Years</div>
</div>
<div class="bar-container">
<?php foreach ($data as $year => $count) { ?>
<div class="bar">
<div class="bar-value"><?php echo $count; ?></div>
<div class="bar-fill" style="height: <?php echo ($count / $max_value) * 100; ?>%;"></div>
<div class="bar-label"><a href="year.php?year=<?php echo $year; ?>"><?php echo $year; ?></a></div>
</div>
<?php } ?>
</div>

</div>



</body>
</html>