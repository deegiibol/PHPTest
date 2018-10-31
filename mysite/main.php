<?php

require_once('config.php');
require_once('functions.php');

$dbh = connectDb();
$posts = array();

$desc = "";

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $desc = trim($_GET['val']);
}else if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $inDate = $_POST['date'];
    $inTime = $_POST['time'];
    $inDesc = h($_POST['des']);

    $sql = "insert into posts (date, time, description) values (?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$inDate, $inTime, $inDesc]);
}

if($desc == "" || empty($desc)){
    $posts= getAll($dbh);
}else{
    $posts = getPostByDesc($dbh, $desc);
}

header('Content-type: application/json; charset=utf-8');
echo json_encode($posts);


