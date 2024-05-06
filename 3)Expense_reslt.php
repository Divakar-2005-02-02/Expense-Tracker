<?php
session_start();
include 'HomePage.html'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracking</title>
    <style>
        
        body {
            background-color: #f2f2f2;
      font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            color: #333;
        }
        
        h2 {
            color: #333;
            margin-top: 30px;
            text-align: center;
        }

        h3 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .balance {
            text-align: center;
            margin-top: 30px;
            font-size: 20px;
        }

        .income {
            color: #4CAF50        
        }

        .debit {
            color: #f44336;
        }

        .closing_bal {
            color: darkblue;
        }
    </style>
</head>
<body>
<?php
  
    $host = 'localhost';
    $username = 'root'; 
    $password = ''; 
    $dbname = $_SESSION['user']; 


    $connection = new mysqli($host, $username, $password, $dbname);
 if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $credit=0;
        $debit=0;
        $sql_credit = "SELECT * FROM credit_transactions WHERE date BETWEEN '$start_date' AND '$end_date'";
        $result_credit = $connection->query($sql_credit);

        $sql_debit = "SELECT * FROM debit_transactions WHERE date BETWEEN '$start_date' AND '$end_date'";
        $result_debit = $connection->query($sql_debit);
        
        echo "<h2>Expenses from $start_date to $end_date:</h2>";

        echo "<h3>Credit Transactions:</h3>";
        if ($result_credit->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Date</th><th>Description</th><th>Amount</th></tr>";
            while ($row = $result_credit->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['amount'] . "</td>";
                echo "</tr>";
                $credit=$credit+$row['amount'];
            }
            echo "</table>";
        } else {
            echo "<p>No credit transactions found</p>";
        }

        echo "<h3>Debit Transactions:</h3>";
        if ($result_debit->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Date</th><th>Description</th><th>Amount</th></tr>";
            while ($row = $result_debit->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['description'] . "</td>";
                echo "<td>" . $row['amount'] . "</td>";
                echo "</tr>";
                $debit=$debit+$row['amount'];
            }
            echo "</table>";
        } else {
            echo "<p>No debit transactions found.</p>";
        }
        $closing_bal=$credit-$debit;    
        echo "<div class='balance'>";
        echo "<h2>Summary:</h2>";
        echo '<p class="income">Income: Rs.' . number_format($credit, 2) . '</p>';
        echo '<p class="debit">Debit: Rs.' . number_format($debit, 2) . '</p>';
        echo '<p class ="closing_bal">Closing balance: Rs.' . number_format($closing_bal, 2) . '</p>';
        echo'</div>';
    }
    $connection->close();
?>
</body>
</html>
