<?php

require_once('config.php');
require_once('functions.php');

$dbh = connectDb();
$posts = array();

$inDate = $_POST['date'];
$inTime = $_POST['time'];
$inDesc = $_POST['des'];

try{
    $sql = "insert into posts (date, time, description) values (?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$inDate, $inTime, $inDesc]);
}catch(Exception $e){
    echo $e->getMessage();
}

$posts = getAll($dbh);

header('Content-type: application/json; charset=utf-8');
echo json_encode($posts);
