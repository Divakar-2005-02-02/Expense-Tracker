<?php
session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Open Sans Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
 <style>
  .quote-img img {
  width: 300px; 
  height: 100px; 
  margin-left: 70px;
  }
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin-left: 40px; 
            padding: 0; 
      }
  </STYLE>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>
  </head>
  <body>
    <div class="grid-container">
      <!-- Sidebar -->
      <?php include "HomePage.html"; ?>

      <!-- End Sidebar -->

      <!-- Main -->
      <main class="main-container">
        <div class="main-title">
          <h2>DASHBOARD</h2>
        </div>

        <div class="main-cards">

          <div class="card">
            <div class="card-inner">
              <h2>Total Income for current Month</h2>
              <span class="material-symbols-outlined">account_balance</span>
            </div>
            <?php
    // Database connection and other code above
    $host = 'localhost';
    $username = 'root'; 
    $password = ''; 
    $dbname = $_SESSION['user']; 

    // Create a database connection
    $connection = new mysqli($host, $username, $password, $dbname);

    // Check if the connection is successful
 if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    // Calculate total sum of expenses for the current month
    $currentMonth = date('m');
    $sql = "SELECT SUM(amount) AS total FROM credit_transactions WHERE MONTH(date) = $currentMonth";
    $result = $connection->query($sql);
    $totalExpense = 0;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalExpense = $row['total'];
    }
        echo '<h1> Rs.'.$totalExpense.'</h1>';
    ?>
          </div>

          <div class="card">
            <div class="card-inner">
              <h2>Total Expense for current Month</h2>
              <span class="material-symbols-outlined">
add_card
</span>
            </div>
            <?php

    // Calculate total sum of expenses for the current month
    $currentMonth = date('m');
    $sql = "SELECT SUM(amount) AS total FROM debit_transactions WHERE MONTH(date) = $currentMonth";
    $result = $connection->query($sql);
    $totalExpense = 0;

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalExpense = $row['total'];
    }
        echo '<h1> Rs.'.$totalExpense.'</h1>';
    ?>
          </div>

          <div class="card">
            <div class="card-inner">
              <h2>Todays Income</h2>
              <span class="material-symbols-outlined">currency_rupee</span>    
      </div>
            <?php
// Get the current date in the format YYYY-MM-DD
$currentDate = date('Y-m-d');

// Calculate total sum of credit transactions for the current day
$sql = "SELECT SUM(amount) AS total FROM credit_transactions WHERE DATE(date) = '$currentDate'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalCredit = $row['total'];
    echo '<h1> Rs.' . $totalCredit . '</h1>';
} else {
    echo '<h1> Rs. 0</h1>';
}
?>


          </div>

          <div class="card">
            <div class="card-inner">
              <h2>Todays Expense</h2>
              <span class="material-symbols-outlined">send_money</span>     
                </div>
            
            <?php
// Get the current date in the format YYYY-MM-DD
$currentDate = date('Y-m-d');

// Calculate total sum of credit transactions for the current day
$sql = "SELECT SUM(amount) AS total FROM debit_transactions WHERE DATE(date) = '$currentDate'";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalCredit = $row['total'];
    echo '<h1> Rs.' . $totalCredit . '</h1>';
} else {
    echo '<h1> Rs. 0</h1>';
}
?>

        </div>
        </div>

        <div class="products">

          <div class="product-card">
            <h2 class="product-description">Quote For You</h2><br>
            <p class="text-secondary">
           <?php $quotes = array(
    "Every expense tells a story of your journey. What will today's story be?",
    "Tracking today's expenses paves the way for tomorrow's financial freedom.",
    "A new day, a new chance to track your expenses and conquer your goals.",
    "Seize the day by tracking your expenses and embracing financial clarity.",
    "Today's expenses shape tomorrow's dreams. Stay mindful, stay ahead.",
    "As the sun rises, so do your financial goals. Track your expenses and shine.",
    "Your financial health matters every day. Track your expenses and prosper.",
    "Small expenses today, big dreams tomorrow. Keep track, stay inspired.",
    "Expense tracking: Where today's numbers meet tomorrow's ambitions.",
    "Each day is a fresh start. Track your expenses and paint a brighter financial future."
);
$randomQuote = $quotes[array_rand($quotes)];
echo $randomQuote;
?>
            </p><br>
            <div class ='quote-img'>
            
              <img src="expense.jpg" alt="Expense symbol">
            </div>
          </div>

          <div class="social-media">
          
<!--Current month graph -->
<canvas id="creditDebitChart" width="400" height="200"></canvas>
<script>
// Get the current year and month
var currentYear = moment().format('YYYY');
var currentMonth = moment().format('MM');
// Fetch credit data for the current month from the database
var xhr_credit = new XMLHttpRequest();
xhr_credit.open('GET', 'fetch_credit_data.php?year=' + currentYear + '&month=' + currentMonth, true);
xhr_credit.onreadystatechange = function () {
    if (xhr_credit.readyState === 4 && xhr_credit.status === 200) {
        var creditData = JSON.parse(xhr_credit.responseText);
        // Fetch expense data for the current month from the database
        var xhr_debit = new XMLHttpRequest();
        xhr_debit.open('GET', 'fetch_debit_data.php?year=' + currentYear + '&month=' + currentMonth, true);
        xhr_debit.onreadystatechange = function () {
            if (xhr_debit.readyState === 4 && xhr_debit.status === 200) {
                var debitData = JSON.parse(xhr_debit.responseText);
                
                // Get the canvas element
                var ctx = document.getElementById('creditDebitChart').getContext('2d');
                
                var creditDebitChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        datasets: [
                            {
                                label: 'Credit',
                                data: creditData,
                                borderColor: '#36a2eb',
                                borderWidth: 2,
                                pointRadius: 5,
                                pointBackgroundColor: '#36a2eb',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                fill: false
                            },
                            {
                                label: 'Expense',
                                data: debitData,
                                borderColor: '#ff6384',
                                borderWidth: 2,
                                pointRadius: 5,
                                pointBackgroundColor: '#ff6384',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                fill: false
                            }
                        ]
                    },
                    options: {
                        scales: {
                            x: {
                                type: 'time',
                                time: {
                                    unit: 'day',
                                    tooltipFormat: 'MMM DD',
                                    displayFormats: {
                                        day: 'MMM DD'
                                    }
                                }
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        };
        xhr_debit.send();
    }
};
xhr_credit.send();
</script>

        </div>
      </main>
<!-- GRAPH


      
GRAPH-->
<!-- ... Rest of your HTML body ... -->
<!-- ... Rest of your HTML head ... -->

<!-- ... Rest of your HTML head ... -->


      <!-- End Main -->

    </div>
  </body>
</html>