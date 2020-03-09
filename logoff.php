<?php

session_start();

unset($_SESSION['user_id']);
session_destroy();
session_unset();


if (!isset($_SESSION['user_id'])){
    header( 'Location:login.php');
}