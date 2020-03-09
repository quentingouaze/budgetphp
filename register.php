<?php
include 'header.php';
if (isset($_POST['register'])) {
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $sql = "SELECT COUNT(username) AS num FROM users WHERE username= :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row['num'] > 0) {
        die("Username already exists");
    }
    $passwordHash = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password) VALUES (:username,:password)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', $passwordHash);
    $result = $stmt->execute();
    $user = selectUser($username, $pdo);
    if ($result) {
        $_SESSION['user_id'] = $user['idUser'];
        $_SESSION['logged_in'] = time();
        header('Location:home.php');
        exit;
    }
} else {
    echo "
    <html>
<head>
    <meta charset=\"UTF-8\">
    <title> Register </title>
</head>
<body>
<h1>Register</h1>
<form action=\"register.php\" method=\"post\">
    <label for=\"username\">Username</label>
    <input type=\"text\" id=\"username\" name=\"username\"><br>
    <label for=\"password\">Password</label>
    <input type=\"text\" id=\"password\" name=\"password\"><br>
    <input type=\"submit\" name=\"register\" value=\"Register\">
</form>

";
}

include_once 'footer.php';


