<?php
session_start();
include 'HomePage.html'
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = $_SESSION['user'];
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user'];
    $sql = "SELECT * FROM usertable WHERE Fullname = '$dbname'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $profile = mysqli_fetch_assoc($result);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin-left: 300px; 
            padding: 0; 
      }

        .profile-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .profile-container h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 0 auto 20px;
        }

        .profile-details {
            margin-bottom: 20px;
            text-align: center;
        }

        .profile-details p {
            margin: 5px 0;
        }

        .profile-details strong {
            font-weight: bold;
            color: #008000;
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
    <?php if (isset($profile)) : ?>
        <div class="profile-container">
            <h2>User Profile</h2>
            <img class="profile-picture" src="profile.jpeg" alt="Profile Picture">
            <div class="profile-details">
                <p><strong>Username:</strong> <?php echo $profile['Username']; ?></p>
                <p><strong>Full Name:</strong> <?php echo $profile['Fullname']; ?></p>
                <p><strong>Email:</strong> <?php echo $profile['Email']; ?></p>
            </div>
        </div>
    <?php else : ?>
        <p class="error-message">User profile not found.</p>
    <?php endif; ?>
</body>
</html>
