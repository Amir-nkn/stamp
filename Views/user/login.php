<?php
session_start();
if (isset($_SESSION['error_msg'])) {
//  echo '<p style="color: red;">' . $_SESSION['error_msg'] . '</p>';
    $message = $_SESSION['error_msg'];    
    echo "<script> alert('".htmlspecialchars($message,ENT_QUOTES,'UTF-8')."'); </script>";
    unset($_SESSION['error_msg']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset}}/css/main.css">
</head>     
<body>

    <main>
    <h1>Login</h1>
            <form action="?controller=user&function=authenticate" method="post">
            <label for="xxxxusername">Username</label>
            <input type="xxxxemail" name="username" id="username">
            <label for="xxxxpassword">Password</label>
            <input type="xxxxpassword" name="password" id="password">
            <input type="xxxxsubmit" value="Login">
            </form>
        
<p>Don't have an account? <a href="?controller=user&function=create" style="font-size: 18px; font-weight: bold; color: #007BFF; text-decoration: none;">Sign Up</a></p>

    </main>
</body>
</html>
