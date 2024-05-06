<?php
session_start();
include "HomePage.html";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <style>
        body {
            background-color: #f2f2f2;
      font-family: Arial, sans-serif;
      margin-left: 300px; 
    }
        .center {
      margin: auto;
      width: 40%;
      margin-top: 100px;
      border: 3px solid silver;
      padding: 35px;
      border-radius: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

        h2 {
            text-align: center;
            margin-top: 50px;
            color: #333;
        }
      input[type="password"] {
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

        .error-message {
            color: #ff0000;
            margin-bottom: 10px;
            text-align: center;
        }

        .success-message {
            color: #008000;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class='center'>
        <form id='fs1' method="post" action=''>
            Enter Current Password:<br>
            <input type='password' name='cp'><br>
            Enter New Password:<br>
            <input type='password' name='np1'><br>
            Confirm New Password:<br>
            <input type='password' name='np2'><br>
            <input type='submit' value='Change Password'>
        </form>
    </div>
</body>
</html>

<div id="timer" style="text-align: center;"></div>
<?php 
function isStrongPassword($password) {
    
    if (strlen($password) < 8) {
        return false;
    }
    if (!preg_match("/[a-zA-Z]/", $password) || !preg_match("/[0-9]/", $password) || !preg_match("/[^a-zA-Z0-9]/", $password)) {
        return false;
    }

    return true;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $uname = $_SESSION['user'];
    $nn = strtolower($uname);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $cp1 = $_POST['cp'];
    $np1 = $_POST['np1'];
    $np2 = $_POST['np2'];
    $tbname = 'usertable';
    $conn = mysqli_connect($servername, $username, $password, $nn);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        $sql1 = "SELECT Password1 FROM $tbname WHERE Fullname='$nn'";
        $result = mysqli_query($conn, $sql1);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $currentPassword = $row['Password1'];
            $errorDisplayed = false;
                if ($currentPassword == $cp1) {
                    if ($np1 == $np2) {
                        if (isStrongPassword($np1)) {
                            $sql2 = "UPDATE $tbname SET Password1='$np1' WHERE Fullname='$nn'";
                            $sql3 = "UPDATE $tbname SET Password2='$np2' WHERE Fullname='$nn'";
                            if ((mysqli_query($conn, $sql2))&&(mysqli_query($conn, $sql3))) {
                                echo "<div class='success-message'>Password Updated Successfully</div>";
                            } else {
                                echo "<div class='error-message'>Failed to update password: " . mysqli_error($conn) . "</div>";
                                $errorDisplayed = true;
                            }
                        } else {
                            echo "<div class='error-message'>Weak password! Password must be at least 8 characters long and contain a mix of letters, numbers, and special characters.</div>";
                            $errorDisplayed = true;
                        }
                    } else {
                        echo "<div class='error-message'>Password and Confirm Password do not match</div>";
                        $errorDisplayed = true;
                    }
                } else {
                    echo "<div class='error-message'>Invalid Current Password</div>";
                    $errorDisplayed = true;
                }
                if (!$errorDisplayed) {
                    mysqli_close($conn);
                }
            } else {
                echo "<div class='error-message'>Error Occurred</div>";
            }
        }
    }
?>

<script>
   
    var countdownTime = 120; 

    function updateTimer() {
        var minutes = Math.floor(countdownTime / 60);
        var seconds = countdownTime % 60;

        document.getElementById("timer").innerHTML = "Time Left " + minutes + "m " + seconds + "s";

        if (countdownTime > 0) {
            countdownTime--;
            setTimeout(updateTimer, 1000); 
        } else {
            document.getElementById("timer").innerHTML = "Time's up!";
           
            window.location.href = "login.php";
        }
    }
    updateTimer();
</script>
