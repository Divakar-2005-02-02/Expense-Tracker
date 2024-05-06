<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        label, input, select {
            display: block;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color:orangered;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .pie-chart-container {
    display: flex;
    justify-content: space-around;
    margin: 20px 0;
}

.chart-wrapper {
    text-align: center;
}

.chart-heading {
    margin-top: 10px;
}
    </style>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    

    <h1>Expense Tracking Report</h1>
    <form action="" method="POST">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>
        <br><br>
        
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>
        <br><br>
        
        <input type="submit" name="submit" value="Generate Report">
    </form>
    <div class="survey-report">
        <h1 class="survey-heading">Expense Tracking Survey Report</h1>

        <?php
        $host = 'localhost';
        $username = 'root'; 
        $password = ''; 
        $dbname = 'xpense'; 
        $connection = new mysqli($host, $username, $password, $dbname);
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        $labels = [];
        $data = [];
        if (isset($_POST['submit'])) {
            $start_date = $_POST['start_date'];
            $end_date = $_POST['end_date'];
            $sql_total_expenses = "SELECT category, SUM(amount) AS total_amount FROM debit_transactions WHERE date BETWEEN '$start_date' AND '$end_date' GROUP BY category ORDER BY total_amount DESC";

            $result_total_expenses = $connection->query($sql_total_expenses);

            if ($result_total_expenses === false) {
                die("Error executing the query: " . $connection->error);
            }

            while ($row = $result_total_expenses->fetch_assoc()) {
                $labels[] = $row['category'];
                $data[] = $row['total_amount'];
            }
        }
        ?>
        <canvas id="pieChart" width="200" height="200"></canvas>

        <?php
        if (isset($_POST['submit']) && count($labels) > 0) {
            echo '<div class="survey-results">';
            echo "<h2>Survey Results:</h2>";
            echo "<ul>";
            for ($i = 0; $i < count($labels); $i++) {
                echo "<li><span class='survey-category'>" . $labels[$i] . "</span>: <span class='survey-amount'>Rs." . number_format($data[$i], 2) . "</span></li>";
            }
            echo "</ul>";
            echo '</div>';
        } elseif (isset($_POST['submit']) && count($labels) === 0) {
            echo "<p>No expense data found for the selected date range.</p>";
        }
        ?>

    </div>

    <script>
  
        var ctx = document.getElementById('pieChart').getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12
                    }
                }
            }
        });
    </script>
  

<div class="survey-report">
    <?php

    $creditLabels = [];
    $creditData = [];

    if (isset($_POST['submit'])) {
        
        $sql_total_expenses_credit = "SELECT category, SUM(amount) AS total_amount FROM credit_transactions WHERE date BETWEEN '$start_date' AND '$end_date' GROUP BY category ORDER BY total_amount DESC";

        $result_total_expenses_credit = $connection->query($sql_total_expenses_credit);

        if ($result_total_expenses_credit === false) {
            die("Error executing the credit transactions query: " . $connection->error);
        }

        while ($row = $result_total_expenses_credit->fetch_assoc()) {
            $creditLabels[] = $row['category'];
            $creditData[] = $row['total_amount'];
        }
    }
    ?>

    <?php if (isset($_POST['submit']) && count($creditLabels) > 0): ?>
        <h1 class="survey-heading">Expense Tracking Survey Report - Credit Transactions</h1>
      
        <canvas id="creditPieChart" width="200" height="200"></canvas>
        <div class="survey-results">
           
            <h2>Survey Results - Credit Transactions:</h2>
            <ul>
            <?php for ($i = 0; $i < count($creditLabels); $i++): ?>
                <li>
                    <span class='survey-category'><?php echo $creditLabels[$i]; ?></span>: 
                    <span class='survey-amount'>Rs.<?php echo number_format($creditData[$i], 2); ?></span>
                </li>
            <?php endfor; ?>
            </ul>
        </div>
    <?php endif; ?>
</div>

<script>
 
    function createPieChart(canvasId, chartLabels, chartData) {
        var ctx = document.getElementById(canvasId).getContext('2d');
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: chartLabels,
                datasets: [{
                    data: chartData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)'
                       
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 12
                    }
                }
            }
        });
    }
    createPieChart('creditPieChart', <?php echo json_encode($creditLabels); ?>, <?php echo json_encode($creditData); ?>);

</script>

</body>
</html>
