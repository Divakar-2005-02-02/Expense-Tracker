<?php include 'HomePage.html'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Expense Tracker Logout</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            margin-left: 100px;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .center {
            border-radius: 15px;
            width: 30%;
            border: 1px solid #ccc;
            padding: 35px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1, p {
            text-align: center;
            color: #333;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        input[type="submit"] {
            background-color: #FF5733;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #FF4500;
        }

        /* Loader styles */
        .loader-container {
            display: none;
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
    <div class='center'>
        <h1>Expense Tracker Logout</h1>
        <p>Are you sure you want to log out?</p>
    
        <form>
            <input type="submit" value="Log Out" onclick="showLoader(); redirectToLoginPage(); return false;">
        </form>
    </div>

    <div class="loader-container" id="loader">
        <div class="loader"></div>
    </div>

    <script>
        function showLoader() {
            document.getElementById("loader").style.display = "flex";
        }

        function redirectToLoginPage() {
            
            setTimeout(function() {
                window.location.href = "index (1).html";
            }, 2000);
        }
    </script>
</body>
</html>
