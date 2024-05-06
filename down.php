<?php
session_start();
include "HomePage.html";
?>
<head><style>
         body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin-left: 300px;
            margin-top:100px;
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
            border-radius: 25px;
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            outline: none;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background: #F09440;
        }

        h1 {
            text-align: center;
            color: #333;
        }
    </style>
    </head>
<h1>Download Your report here..!</h1>

<div class="center">
    <form method="POST" action="download.php"> 
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" value="<?php echo $start_date; ?>" required>

        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" value="<?php echo $end_date; ?>" required>

        <input type="submit" value="Download">
    </form>
</div>
