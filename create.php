<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dname = $_POST['fname'];
    $name = $_POST['lname'];
    $dbname = strtolower($dname);
    $dname = strtolower($name);
    $mail = $_POST['email'];
    $pass1 = $_POST['password1'];
    $pass2 = $_POST['password2'];
    $num = $_POST['mnum'];
    $tbname = "usertable";
    $_SESSION['user'] = $dname;
    echo "<body bgcolor=#f2f2f2></body>";

    if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo "<div style='text-align:center; background-color: #f1f1f1; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 20px; border: 2px solid #ccc; box-shadow: 5px 5px 10px #888; font-family: Arial, sans-serif; font-size: 26px;'><b>Invalid email address</b></div>";
        exit;
    }

    if ($pass1 !== $pass2 || strlen($pass1) < 8) {
        echo "<div style='text-align:center; background-color: #f1f1f1; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 20px; border: 2px solid #ccc; box-shadow: 5px 5px 10px #888; font-family: Arial, sans-serif; font-size: 26px;'><b>Passwords must match and have a minimum length of 8 characters</b></div>";
        exit;
    }

    $conn = mysqli_connect($servername, $username, $password);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query1 = "CREATE DATABASE $dbname";

    try {
        if (!mysqli_query($conn, $query1)) {
            throw new Exception("Error creating database: " . mysqli_error($conn));
        }
    } catch (Exception $e) {
        echo "<div style='text-align:center; background-color: #f1f1f1; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 20px; border: 2px solid #ccc; box-shadow: 5px 5px 10px #888; font-family: Arial, sans-serif; font-size: 26px;'><b>" . $e->getMessage() . "</b></div>";
        mysqli_close($conn);
        exit;
    }

    $conn2 = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn2) {
        $sql = "CREATE TABLE $tbname (
            Username VARCHAR(30) UNIQUE,
            Fullname VARCHAR(50) UNIQUE,
            Email VARCHAR(50) UNIQUE,
            Password1 VARCHAR(50),
            Password2 VARCHAR(50),
            MobileNumber VARCHAR(10)
        )";

        try {
            if (!mysqli_query($conn2, $sql)) {
                throw new Exception("Error creating table: " . mysqli_error($conn2));
            }
            
            $sql1 = "INSERT INTO $tbname (Username, Fullname, Email, Password1, Password2, MobileNumber)
                VALUES ('$name', '$dbname', '$mail', '$pass1', '$pass2', $num)";

            if (mysqli_query($conn2, $sql1)) {
                echo '<script>window.location.href = "login.php";</script>';
                exit;
            } else {
                $prin = "<div style='text-align:center; background-color: #f1f1f1; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 20px; border: 2px solid #ccc; box-shadow: 5px 5px 10px #888; font-family: Arial, sans-serif; font-size: 26px;'><b>Unable to create the Profile</b></div>";
                echo $prin;
            }
        } catch (Exception $e) {
            echo "<script>window.alert('Duplicate Entry')</script>";
            echo '<script>window.location.href = "login.php";</script>';
            exit;
        }
        mysqli_close($conn2);
    } else {
        echo "<div style='text-align:center; background-color: #f1f1f1; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); padding: 20px; border: 2px solid #ccc; box-shadow: 5px 5px 10px #888; font-family: Arial, sans-serif; font-size: 26px;'><b>Connection to the database failed: </b>" . mysqli_connect_error() . "</div>";
    }
}
?>
