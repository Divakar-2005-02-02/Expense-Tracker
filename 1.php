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
            margin-left: 280px; 
            padding: 0;
        }
        .center {
      margin: auto;
      width: 35%;
      margin-top: 40px;
      border: 3px solid silver;
      padding: 35px;
      border-radius: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
        h1 {
            text-align: center;
            color: #333;
        }
        select,
        input[type="date"],
        input[type="text"],
        input[type="number"] {
            border-radius: 25px;
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      display: inline-block;
      border: none;
      background: #f1f1f1;
      outline: none;
      font-size: 16px;
        }

        input[type="submit"] {
      cursor: pointer;
      background: orangered;
      color: #fff;
      font-weight: bold;
      transition: background 0.3s ease;
    }

    input[type="submit"]:hover {
      background:#F09440;
    }
    input[type="submit"] {
      border-radius: 25px;
      width: 100%;
      padding: 15px;
      margin: 5px 0 22px 0;
      display: inline-block;
      border: none;
      outline: none;
      font-size: 16px;
    }

        a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            color: orangered;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class='center'>
    <h1>Expense Tracking Form</h1>
    <form action=" " method="POST">
        <label for="expense_date">Date:</label>
        <input type="date" id="expense_date" name="expense_date" required>
        <br><br>
        
        <label for="expense_description">Expense Description:</label>
        <input type="text" id="expense_description" name="expense_description" required>
        <br><br>
        
        <label for="expense_amount">Amount:</label>
        <input type="number" step="0.01" id="expense_amount" name="expense_amount" required>
        <br><br>
        
        <label for="expense_category">Expense Category:</label>
        <select id="expense_category" name="expense_category" required>
            <option value="">Select Category</option>
            <option value="food">Food</option>
            <option value="transportation">Transportation</option>
            <option value="utilities">Utilities</option>
            <option value="entertainment">Entertainment</option>
            <option value="others">Others</option>
        </select>
        <br><br>
        <label for="expense_balance">Credit/Debit:</label>
        <select id="expense_balance" name="expense_balance" required>
            <option value="">Select Category</option>
            <option value="credit">Credit</option>
            <option value="debit">Debit</option>
        </select><br><br>
        
        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" required>
            <option value="">Select Payment Method</option>
            <option value="cash">Cash</option>
            <option value="credit_card">Credit Card</option>
            <option value="debit_card">Debit Card</option>
            <option value="online">Online Payment</option>
            <option value="others">Others</option>
        </select>
        <br><br>
 <input type="submit" value='SUBMIT'>
    </form></div>
    <?php
$host = 'localhost';
$username = 'root';
$password = ''; 

$connection = new mysqli($host, $username, $password);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$database_name = $_SESSION['user']; 
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $database_name";
if ($connection->query($sql_create_db) !== TRUE) {
    die("Error creating database: " . $connection->error);
}

$connection->close();
$connection = new mysqli($host, $username, $password, $database_name);

if ($connection->connect_error) {
    die("Connection to the database failed: " . $connection->connect_error);
}

$sql_create_credit_table = "CREATE TABLE IF NOT EXISTS Credit_transactions (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE NOT NULL,
    Description VARCHAR(255) NOT NULL,
    Amount DECIMAL(10, 2) NOT NULL,
    Category VARCHAR(50) NOT NULL,
    Payment_method VARCHAR(50) NOT NULL
)";
if ($connection->query($sql_create_credit_table) !== TRUE) {
    die("Error creating credit_transactions table: " . $connection->error);
}

$sql_create_debit_table = "CREATE TABLE IF NOT EXISTS Debit_transactions (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Date DATE NOT NULL,
    Description VARCHAR(255) NOT NULL,
    Amount DECIMAL(10, 2) NOT NULL,
    Category VARCHAR(50) NOT NULL,
    Payment_method VARCHAR(50) NOT NULL
)";
if ($connection->query($sql_create_debit_table) !== TRUE) {
    die("Error creating debit_transactions table: " . $connection->error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['expense_date'];
    $description = $_POST['expense_description'];
    $amount = $_POST['expense_amount'];
    $category = $_POST['expense_category'];
    $expense_balance = $_POST['expense_balance'];
    $payment_method = $_POST['payment_method'];

       $sql = "";

       if ($expense_balance === 'credit') {
           $sql = "INSERT INTO Credit_transactions (Date, Description, Amount, Category, Payment_method) VALUES ('$date', '$description', '$amount', '$category', '$payment_method')";
       } elseif ($expense_balance === 'debit') {
           $sql = "INSERT INTO Debit_transactions (Date, Description, Amount, Category, Payment_method) VALUES ('$date', '$description', '$amount', '$category', '$payment_method')";
       } else {
         
       }

    
       if (!empty($sql)) {
           if ($connection->query($sql) === TRUE) {
               echo "<div style='text-align:center; font-family: Arial, sans-serif; font-size: 26px;'><b>Expense Added Successfully</b></div>";
           } else {
               echo "Error: " . $sql . "<br>" . $connection->error;
           }
       }
   }

$connection->close();
?>
</body>
</html>
