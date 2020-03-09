<?php
session_start();
require_once 'config.php';
require_once 'functions.inc.php';

?>

<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
    <ul>
        <li>
            <a href="home.php">Home</a>
        </li>
<?php
if (isset($_SESSION['user_id']) ) {
    echo "<li><a href='logoff.php'>Log Off</a></li>";

} else {

    echo "<li><a href='login.php'>Login</a></li><li><a href='register.php'>Register</a></li>";
}
?>
    </ul>