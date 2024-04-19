<?php
session_start();
require_once 'dbconfig/config.php';

function loginAdmin($db, $password) {
    $sql = "SELECT * FROM admin WHERE password = :password";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    return $stmt->rowCount() > 0;
}

if(isset($_POST['login'])) {
    $password = $_POST['password'];

    if(loginAdmin($db, $password)) {
        header('location: adminpage.php');
        exit();
    } else {
        echo '<script type="text/javascript"> alert("Invalid password") </script>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login as Admin</title>
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
        <div class="imgcontainer">
            <img src="image/admin.png" class="avatar"/>
        </div>
    </center>

    <form class="myform" action="adminlogin.php" method="post">
        <div class="inner_container">
            <label><b id="adminp">Password:</b></label><br>
            <input name="password" type="password" class="inputvalues" id="adminpass" placeholder="Type your password" required/><br>

            <input name="login" type="submit" id="admin_btn" value="LogIn"/><br>
            <a href="index.php"><input type="button" id="back_btn" value="Back"/></a>
        </div>
    </form>
</div>
</body>
</html>
