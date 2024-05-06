<!DOCTYPE html>
<html>
<head>
  <title>Sign Up Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .background-image {
      background-image: url("IMG-20230506-WA0011.jpg");
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
      height: 100vh;
    }

    .center {
      width: 30%;
      margin: auto;
      margin-top: 50px;
      padding: 35px;
      border: 3px solid silver;
      border-radius: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    form {
      text-align: left;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      color: #333;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    input[type="date"],
    input[type="number"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 25px;
      background: #f1f1f1;
      border: 1px solid #ccc;
    }

    input:focus {
      outline: none;
      box-shadow: 0 0 5px skyblue;
    }

    button[type="submit"] {
      width: 100%;
      padding: 15px;
      margin: 20px 0 10px;
      border-radius: 25px;
      border: none;
      background: orangered;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
    }

    button[type="submit"]:hover {
      background: #F09440;
    }

    .form-footer {
      text-align: center;
      font-size: 14px;
      color: #666;
    }

    .form-footer a {
      color: #36a1dd;
      text-decoration: none;
    }

    .welcome-sentence {
      font-size: 24px;
      font-weight: bold;
      text-align: center;
      margin: 20px 0;
      color: #333; 
    }
  </style>
</head>
<body>
  <div class="background-image">
    <section class="welcome-section">
      <p class="welcome-sentence">Start your financial journey with us by signing up today.</p>
    </section>
    <div class="center">
      <form name="fs" method="post" action="create.php">
        <label for="fname">Username:</label>
        <input type="text" name="fname" id="fname" required>

        <label for="lname">Full Name:</label>
        <input type="text" name="lname" id="lname" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password1">Password:</label>
        <input type="password" name="password1" id="password1" required>

        <label for="password2">Confirm Password:</label>
        <input type="password" name="password2" id="password2" required>

        <label for="mnum">Mobile Number:</label>
        <input type="number" name="mnum" id="mnum" required>
        <button type="submit">Register</button>
      </form>
    </div>
  </div>
</body>
</html>
