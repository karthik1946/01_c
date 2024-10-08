<!DOCTYPE html>
<html>
<head>
    <title>Number of Placements per Year</title>
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
        $sql = "SELECT YEAR(begin_date) AS year, COUNT(*) AS count FROM first_company GROUP BY YEAR(begin_date) ORDER BY YEAR(begin_date)";
        $result = $conn->query($sql);

        // Fetch query results and store in arrays
        $years = array();
        $counts = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $years[] = $row["year"];
                $counts[] = $row["count"];
            }
        }

        // Close database connection
        $conn->close();
    ?>

    <script>
        // Retrieve PHP arrays in JavaScript
        var years = <?php echo json_encode($years); ?>;
        var counts = <?php echo json_encode($counts); ?>;

        // Create a bar chart using Chart.js
        var ctx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: years,
                datasets: [{
                    label: 'Number of Placements',
                    data: counts,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Customize bar color
                    borderColor: 'rgba(75, 192, 192, 1)', // Customize bar border color
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1 // Customize step size of y-axis
                    }
                }
            }
        });
    </script>
</body>
</html>
