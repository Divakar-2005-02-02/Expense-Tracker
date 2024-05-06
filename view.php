<?php include 'HomePage.html' ?>
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
      margin-left: 300px; 

        }
        .center {
      margin: auto;
      width: 40%;
      margin-top: 40px;
      border: 3px solid silver;
      padding: 35px;
      border-radius: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    input[type="date"] {
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
        h1 {
            text-align: center;
            color: #333;
        }

    </style>
</head>
<body>
    <div class='center'>
    <h1>Expense Tracking Report</h1>
    <form action="Expense_reslt.php" method="POST">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>
        <br><br>
        
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>
        <br><br>
     <input type="submit" value="Generate Report">
    </form></div>
</body>
</html>
