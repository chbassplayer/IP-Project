<?php
    include_once('config.php');
    include_once('dbutils.php');
    session_start();
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    $storeID=1;
    $item=$_GET['id'];
    $order=$_SESSION['startedOrder'];
    $query="DELETE from itemsInOrder where itemID=$item and orderID=$order;";
    $result=queryDB($query,$db);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>