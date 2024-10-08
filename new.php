<?php
// establish database connection
$conn = mysqli_connect('localhost', 'root', 'Devisyam@2003', 'dblab8');

$result = mysqli_query($conn, "SELECT YEAR(recyear) AS year, COUNT(*) AS count FROM details WHERE placed='Yes' GROUP BY year ORDER BY year DESC");



// create associative array from data
$data = array();
$max_value = 1;
while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['year']] = $row['count'];
    if ($row['count'] > $max_value) {
        $max_value = $row['count'];
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bar Graph Example</title>
</head>
<style>
        .chart {
            display: flex;
            flex-direction: row;
            justify-content: flex-start;
            align-items: flex-end;
            height: 400px;
            width: 600px;
            margin: 0 auto;
        }

        .axis-x {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-end;
            height: 30px;
            width: 100%;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .axis-x-line {
            width: 100%;
            height: 1px;
            background-color: #ccc;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .axis-x-label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .axis-y {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            height: 300px;
            width: 30px;
            margin-left: 10px;
            margin-right: 10px;
        }

        .axis-y-line {
            height: 100%;
            width: 1px;
            background-color: #ccc;
            position: absolute;
            top: 0;
            right: 0;
        }

        .axis-y-tick {
            height: 1px;
            width: 10px;
            background-color: #ccc;
            position: absolute;
            top: 0;
            left: 0;
        }

        .axis-y-label {
            font-size: 12px;
            font-weight: bold;
            margin-left: 20px;
            position: absolute;
            top: 0;
            left: 0;
        }

        .bar-container {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-end;
            height: 300px;
            width: calc(100% - 50px);
            margin-right: 10px;
        }

        .bar {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
            width: 50px;
            margin-left: 10px;
            position: relative;
        }

        .bar-value {
            font-size: 12px;
            font-weight: bold;
            position: absolute;
            top: -20px;
            left: 0;
        }

        .bar-fill {
            width: 100%;
            background-color: #337ab7;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .bar-label {
            font-size: 12px;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
<body>

<div class="chart">
    <div class="axis-x">
        <div class="axis-y-line"></div>
        <div class="axis-x-line"></div>
        <div class="axis-x-label">Year</div>
    </div>
    <div class="axis-y">
        <?php
        // loop through the values on the Y axis and display the ticks
        for ($i = $max_value; $i >= 0; $i -= 10) {
            $height = $i / $max_value * 300;
            echo '<div class="axis-y-tick" style="height:'.$height.'px;"></div>';
            echo '<div class="axis-y-label">'.$i.'</div>';
        }
        ?>
    </div>
    <div class="bar-container">
        <?php
        // loop through the data and display the bars
        foreach ($data as $year => $count) {
            $height = $count / $max_value * 300;
            echo '<div class="bar">';
            echo '<div class="bar-value">'.$count.'</div>';
            echo '<div class="bar-fill" style="height:'.$height.'px;"></div>';
            echo '<div class="bar-label">'.$year.'</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>

</body>

</html>