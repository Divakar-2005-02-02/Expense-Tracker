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

$sql_credit_total = "SELECT DATE(date) AS date, SUM(amount) AS total_credit FROM credit_transactions WHERE YEAR(date) = $currentYear AND MONTH(date) = $currentMonth GROUP BY DATE(date)";
$result_credit = $connection->query($sql_credit_total);

$creditData = array();
while ($row = $result_credit->fetch_assoc()) {
    $creditData[] = array(
        "x" => $row['date'],
        "y" => $row['total_credit']
    );
}

$connection->close();
header('Content-Type: application/json');
echo json_encode($creditData);

?>
