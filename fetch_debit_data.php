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

$currentYear = $_GET['year'];
$currentMonth = $_GET['month'];
$sql_debit_total = "SELECT DATE(date) AS date, SUM(amount) AS total_debit FROM debit_transactions WHERE YEAR(date) = $currentYear AND MONTH(date) = $currentMonth GROUP BY DATE(date)";
$result_debit = $connection->query($sql_debit_total);

$debitData = array();

while ($row = $result_debit->fetch_assoc()) {
    $debitData[] = array(
        "x" => $row['date'],
        "y" => $row['total_debit']
    );
}

$connection->close();
header('Content-Type: application/json');
echo json_encode($debitData);
?>
