<!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Expense Tracker</title>
      <link rel="stylesheet" href="style.css">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
      <style>
         /* Add custom styles for the fixed sidebar */
         .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            width: 250px; /* Adjust the width as needed */
            background-color: #333;
            overflow-y: auto;
         }
         .content {
            margin-left: 250px; /* Match the width of the sidebar */
            padding: 20px; /* Add some padding to the content area */
         }
         body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('home.png') no-repeat center center fixed;
            background-size: cover;
            position: absolute;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 50px;
            display: flex;
            align-items: flex-start;
        }

        img.logo {
            width: 125px;
            height: 125px;
            position: absolute;
            top: 30px;
            left: 40px;
        }

        .app-title {
            font-family: 'Times New Roman', Times, serif;
            font-size: 60px;
            font-weight: bold;
            color: #211b1b;
            position: absolute;
            top: 5px;
            left: 180px;
        }

        .app-description {
            background-color: rgba(252, 247, 249, 0.9);
            border-radius: 15px;
            font-size: 19px;
            color: #583838;
            display: inline-block;
            height: 200px;
            width: 500px;
            margin-top: 150px;
            padding: 25px;
            position: relative;
            left: 20px;
        }

        .end {
            font-size: 30px;
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode';
            text-align: center;
            margin-top: 20px;
        }

        .top-buttons {
            position:fixed;
            top: 30px;
            right:60px;
           
        }

        button{
            padding:15px;
            border-radius:10px;
            color:rosybrown;
        }

        .top-buttons a {
            font-size: 50px;
            color: #8d7285;
            text-decoration: none;
            margin: 0 10px;
        }

        h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 28px;
            color: #333;
        }

        p {
            font-size: 16px;
            color: #666;
            line-height: 1.6;
        }

        ul {
            list-style-type: disc;
            margin-left: 20px;
            color: #666;
        }

        li {
            margin-bottom: 5px;
        }
      </style>
   </head>
   <body>
      <div class="btn">
         <span class="fas fa-bars"></span>
      </div>
      <nav class="sidebar">
         <div class="text">
            Side Menu
         </div>
         <ul>
            <li class="active"><a href="home.php">HomePage</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li>
               <a href="HomePage1.html" class="feat-btn">Expense
               <span class="fas fa-caret-down first"></span>
               </a>
               <ul class="feat-show">
                  <li><a href="1.php">Add Expense</a></li>
               </ul>
            </li>
            <li>
               <a href="#" class="serv-btn">Expense Report
               <span class="fas fa-caret-down second"></span>
               </a>
               <ul class="serv-show">
                  <li><a href="view.php">Track Expense</a></li>
                  <li><a href="survey.php">Expense Chart</a></li>
               </ul>
            </li>
            <li><a href='download.php'>Download Report</a></li>
            <li><a href="changepass.php">Change Password</a></li>
            <li><a href="login.php">Logout</a></li>
         </ul>
      </nav>
        <div class="container">
            <img src="https://cdn.pixabay.com/photo/2013/07/12/15/21/pie-chart-149727_1280.png" alt="pie" class="logo">
            <p class="app-title">EXPENSO</p>
            <p class="app-description">"Master Your Money: Empower Your Financial Journey 
                with Expensio – Your Personal Expense Tracker! Effortlessly monitor 
                your income and expenses, streamline budgeting, and achieve financial 
                success.Sign up today and embark on a transformative financial adventure!"</p>
        </div>
        <center>
            <p class="end">Get started today and take control of your finances!</p>
        </center>
      </div>
      <script> 
         $('.btn').click(function(){
           $(this).toggleClass("click");
           $('.sidebar').toggleClass("show");
         });
           $('.feat-btn').click(function(){
             $('nav ul .feat-show').toggleClass("show");
             $('nav ul .first').toggleClass("rotate");
           });
           $('.serv-btn').click(function(){
             $('nav ul .serv-show').toggleClass("show1");
             $('nav ul .second').toggleClass("rotate");
           });
           $('nav ul li').click(function(){
             $(this).addClass("active").siblings().removeClass("active");
           });
      </script>
   </body>
</html>
