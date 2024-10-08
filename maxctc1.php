<!DOCTYPE html>
<html>
<head>
    <title>Highest CTC per Year</title>
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
        $sql = "SELECT YEAR(begin_date) AS year, MAX(ctc) AS max_ctc FROM first_company GROUP BY YEAR(begin_date) ORDER BY YEAR(begin_date)";
        $result = $conn->query($sql);

        // Fetch query results and store in arrays
        $years = array();
        $maxCtc = array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $years[] = $row["year"];
                $maxCtc[] = $row["max_ctc"];
            }
        }

        // Close database connection
        $conn->close();
    ?>

    <script>
        // Retrieve PHP arrays in JavaScript
        var years = <?php echo json_encode($years); ?>;
        var maxCtc = <?php echo json_encode($maxCtc); ?>;

        // Create a bar chart using Chart.js
        var ctx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: years,
                datasets: [{
                    label: 'Highest CTC',
                    data: maxCtc,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Customize bar color
                    borderColor: 'rgba(75, 192, 192, 1)', // Customize bar border color
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        // Customize step size and label callback of y-axis
                        ticks: {
                            stepSize: 10000,
                            callback: function(value, index, values) {
                                return '₹' + value.toLocaleString(); // Add currency symbol and format number
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                // Add currency symbol and format number in tooltip
                                return '₹' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
