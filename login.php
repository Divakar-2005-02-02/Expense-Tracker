Copy code
<?php
session_start();
$var = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $uname = $_POST['username'];
    $username = strtolower($uname);
    $password = $_POST['pass'];
    $servername = "localhost";
    $username1 = "root";
    $dbpassword = "";
    $dbname = "your_database_name"; // Replace with your actual database name
    $tbname = "usertable";
    $_SESSION['user'] = $username;

    try {
        $conn = new mysqli($servername, $username1, $dbpassword, $dbname);
        // Check connection
        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }
    } catch (Exception $ex) {
        $var = "Invalid Username";
        $conn = null;
    }

    if ($conn) {
        $sql = "SELECT Password1,Fullname FROM $tbname WHERE Fullname = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $pass = $row['Password1'];
            $user = $row["Fullname"];

            if (($password != $pass) or ($username != $user)) {
                $var = "Invalid Username or Password";
            } else {
                header("Location: dash.php");
                exit;
            }
        } else {
            $var = "Username Not Found";
        }

        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Tracker</title>

    <link rel="stylesheet" href="style.css">
    <style>
        .quote {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            font-size: 25px;
        }

        .quote a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        .quote a:hover {
            text-decoration: underline;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li:last-child {
            margin-right: 0;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .about-expense-tracker {
            text-align: center;
            padding: 20px;
        }

        .about-expense-tracker h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #333;
        }

        .about-expense-tracker p {
            font-size: 16px;
            line-height: 1.5;
            color: #555;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        .center {
            border-radius: 15px;
            margin: auto;
            width: 30%;
            margin-top: 35px;
            border: 1px solid #ccc;
            padding: 35px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
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
            background: #F09440;
        }

        .error-msg {
            color: red;
            text-align: center;
        }

        .signup-link {
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        .signup-link a {
            color: #4CAF50;
            text-decoration: none;
        }

        .loader-container {
            display: flex;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loader {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
<header>
        <div class="quote">
            <p>Start managing your expenses with ease. Log in to Expense Tracker now.</p>
        </div>
        <div class="center">
            <h1>LOGIN</h1>
            <form name="fs1" method="post" action="">
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="password" name="pass" placeholder="Password" required><br>
                
                <input type="submit" value="Sign In" id="signin-btn"><br>
            </form>
            <p class="error-msg" id="error-msg">
                <?php
                if (!empty($var)) {
                    echo $var;
                }
                ?>
            </p>
            <p class="signup-link">Don't have an account? <a href="signup.html">Sign Up!</a></p>
        </div>

        <div class="loader-container" id="loader-container" style="display: none;">
            <div class="loader"></div>
        </div>

        <script>
            document.getElementById("signin-btn").addEventListener("click", function () {
                document.getElementById("loader-container").style.display = "flex";
            });
        </script>
    </header>
    <main>
        <section class="about-expense-tracker">
            <h1>About Expense Tracker</h1>
            <p>Welcome to Expense Tracker, your personal finance management tool. We're here to help you take control of your finances and make informed financial decisions.</p>
            <p>With Expense Tracker, you can track your expenses, set budgets, and gain valuable insights into your spending habits. Our user-friendly interface makes it easy for anyone to manage their money effectively.</p>
            <p>Join us on your journey to financial success!</p>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Expense Tracker</p>
    </footer>
</body>
</html>
