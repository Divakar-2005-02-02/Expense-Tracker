<?php
session_start();
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = $_SESSION['user'];

$connection = new mysqli($host, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$start_date = '';
$end_date = '';
$credit = 0;
$debit = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $sql_credit = "SELECT * FROM credit_transactions WHERE date BETWEEN '$start_date' AND '$end_date'";
    $result_credit = $connection->query($sql_credit);

    $sql_debit = "SELECT * FROM debit_transactions WHERE date BETWEEN '$start_date' AND '$end_date'";
    $result_debit = $connection->query($sql_debit);

    $csvContent = "Date,Description,Amount\n";

    if ($result_credit->num_rows > 0) {
        while ($row = $result_credit->fetch_assoc()) {
            $formattedDate = date('Y-m-d', strtotime($row['Date']));
            $csvContent .= $formattedDate . ',' . $row['Description'] . ',' . $row['Amount'] . "\n";
            $credit += $row['Amount'];
        }
    }

    if ($result_debit->num_rows > 0) {
        while ($row = $result_debit->fetch_assoc()) {
            $formattedDate = date('Y-m-d', strtotime($row['Date']));
            $csvContent .= $formattedDate . ',' . $row['Description'] . ',' . $row['Amount'] . "\n";
            $debit += $row['Amount'];
        }
    }

    $closing_bal = $credit - $debit;

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="expense_report.csv"');

    echo $csvContent;
    $connection->close();
    exit; }
?>
