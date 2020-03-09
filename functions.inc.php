<?php

function showUserBudget($pdo)
{
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM entries WHERE entryUser=:userid";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':userid', $user_id);
    $stmt->execute();
    $entries = $stmt->fetch(PDO::FETCH_ASSOC);
    return $entries;
}
function addBudgetEntry($pdo){
$entryName=$_POST['entryName'];
$entryType=$_POST['entryType'];
$entryCategory=$_POST['entryCategory'];
$entryDetail=$_POST['entryDetail'];
$entryUser=$_SESSION['user_id'];
$date=date();
    $sql="INSERT INTO entries (entryName, entryType, entryDetail, entryCategory, entryUser, date) 
VALUES (?,?,?,?,?,?)";
    $stmt=$pdo->prepare($sql);
    $stmt->execute([$entryName, $entryType, $entryDetail, $entryCategory, $entryUser, $date]);
}


function selectUser($username, $pdo)
{
    $sql = "SELECT idUser, username, password FROM users where username=:username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    return $user;
}

function getCategoriesList($pdo)
{
    $sql="SELECT idCategory, categoryName  FROM categories ";
    $stmt=$pdo->prepare($sql);
    $stmt->execute();
    $categories=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $categories;
}