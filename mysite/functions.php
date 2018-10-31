<?php

function connectDB(){
    try{
        return new PDO(DSN, DB_USER, DB_PASSWORD);
    }catch(PDOException $e){
        echo $e->getMessage();
        exit;
    }
}

function h($s){
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}


function getAll($dbh){
    $sql = "select * from posts";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getPostByDesc($dbh, $desc){
    $sql = "select * from posts" . " where description like '" . $desc . "%'";

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}