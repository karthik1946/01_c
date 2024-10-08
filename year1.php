<!DOCTYPE html>
<html>
<head>
    <title>Top 3 Highest Average CTC per Name</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="barChart"></canvas>
    <?php
        // Replace with your database connection details
        $servername = "localhost";
        $username = "root";
        $password = "Devisyam@2003";
        $dbname = "dblab8";

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to retrieve data from the database
        $sql = "SELECT name, AVG(ctc) AS avg_ctc FROM first_company GROUP BY name ORDER BY avg_ctc DESC LIMIT 3";
        $result = $conn->query($sql);

        // Fetch query results and store in arrays
        $names = array();
        $avg_ctcs = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $names[] = $row["name"];
                $avg_ctcs[] = $row["avg_ctc"];
            }
        }

        // Close database connection
        $conn->close();
    ?>

    <script>
        // Retrieve PHP arrays in JavaScript
        var names = <?php echo json_encode($names); ?>;
        var avg_ctcs = <?php echo json_encode($avg_ctcs); ?>;

        // Create a bar chart using Chart.js
        var ctx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: names,
                datasets: [{
                    label: 'Average CTC',
                    data: avg_ctcs,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Customize bar color
                    borderColor: 'rgba(75, 192, 192, 1)', // Customize bar border color
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 100000 // Customize step size of y-axis
                    }
                }
            }
        });
    </script>
</body>
</html>
