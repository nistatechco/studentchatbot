<?php
session_start();
require_once 'dbconfig/config.php';

function loginUser($db, $username, $password) {
    $sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(loginUser($db, $username, $password)) {
        $_SESSION['username'] = $username;
        header('location: homepage.php');
        exit();
    } else {
        echo '<script type="text/javascript"> alert("Invalid credentials") </script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="css/stylex.css">
    <style>
        body {
            background-image: url('https://png.pngtree.com/thumb_back/fw800/background/20190223/ourmid/pngtree-smart-robot-arm-advertising-background-backgroundrobotblue-backgrounddark-backgroundlightlight-image_68405.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
    </style>
</head>
<body>
<div id="main-wrapper">
    <center>
        <h2><strong id="log">Login</strong></h2>
        <div class="imgcontainer">
            <img src="image/bot_avatar.png" class="avatar"/>
        </div>
    </center>
    <form class="myform" action="index.php" method="post">
        <div class="inner_container">
            <label><b id="un">Username:</b></label><br>
            <input name="username" id="us" type="text" class="inputvalues" placeholder="Enter Username here..." required/><br>
            <label><b id="pas">Password:</b></label><br>
            <input name="password" id="pass" type="password" class="inputvalues" placeholder="Your Password..." required/><br>

            <input name="login" type="submit" id="login_btn" value="Login"/><br>

            <a href="register.php"><input type="button" id="register_btn" value="Register"/></a> <br>

            <a href="admin.php"><input type="button" id="admin_btn" value="Login as Admin"/></a>
        </div>
    </form>
</div>
</body>
</html>
