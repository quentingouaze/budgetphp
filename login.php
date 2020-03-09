<?php

include 'header.php';
if (isset($_POST['login'])) {
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    $user = selectUser($username, $pdo);
    if ($user === false) {
        die('Incorrect username/password combination, user= false');
    } else {
        $validPassword = password_verify($passwordAttempt, $user['password']);
        if ($validPassword) {
            $_SESSION['user_id'] = $user['idUser'];
            $_SESSION['logged_in'] = time();
            if ($_SESSION['user_id']) {
                header('Location:home.php');
            }
            exit;
        } else {
            die('Incorrect username/password combination, wrong password');
        }
    }
} else if (!isset($_SESSION['user_id'])) {
    ?>
    <h1>Login</h1>
    <form action="login.php" method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password"><br>
        <input type="submit" name="login" value="Login">
    </form>
    <?php

} else {
    echo "User already logged in";
}
include_once 'footer.php';
?>