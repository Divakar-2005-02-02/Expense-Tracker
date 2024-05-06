
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

    </style>
</head>
<body>
    <h1>Expense Tracking Report</h1>
    <form action="3)Expense_reslt.php" method="POST">
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>
        <br><br>
        
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>
        <br><br>
     
        <input type="submit" value="Generate Report">
    </form>
</body>
</html>
