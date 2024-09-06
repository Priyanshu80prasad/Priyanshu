<?php
session_start();
require 'includes/dbh.inc.php'; // Database connection

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to check for admin credentials
    $sql = "SELECT * FROM admins WHERE username=? AND password=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "SQL error";
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Debugging output
        if (mysqli_num_rows($result) > 0) {
            echo "Found user in database!";
            $row = mysqli_fetch_assoc($result);
            $_SESSION['adminId'] = $row['id'];
            header("Location: admin_dashboard.php");
        } else {
            echo "Invalid credentials! Debugging info: Username - $username, Password - $password";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
          
             background-image: url("img/1.jpg"), url("paper.gif"); 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 10;
        }

     

        form {
            background: red;
            padding: 60px;
            border-radius: 58px;
            box-shadow: 10 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            max-width: 100%;
            background-color: black;

            /* background-image: url("img/6.jpeg"); */
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid blue;
            border-radius: 24px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: green;
            border: none;
            border-radius: 14px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: red;
        }

        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
        p{
            font-size:30px;
            color:yellow;
            text-align:center;
        }
    </style>
</head>
<body>
   
    <form method="post" action="admin_login.php">
        <p>Admin Login</p>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>
