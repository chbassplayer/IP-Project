<?php
    include_once('config.php');
    include_once('dbutils.php');
    $Newquantity=$_POST['Quantity'];
    session_start();
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    $item=$_GET['id'];
    $Newquantity=$_POST['Quantity'];
    $order=$_SESSION['startedOrder'];
    $isComplete = true;
    $errorMessage = "";
    
    $query="UPDATE itemsInOrder set quantityInOrder=$Newquantity where orderID=$order and itemID=$item;";
    $result=queryDB($query,$db);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
?>