<?php
    //get categories for drop down and start a session with a stream_wrapper_restore
    // for every page for this store it will have a consistent Store ID 
    //for now we hard code
    include_once('config.php');
    include_once('dbutils.php');
    session_start();
    $Search=$_GET['search'];
    echo $_SESSION['startedOrder'];
    $_SESSION['StoreID']=1;
    $storeID=$_SESSION['StoreID'];
    //echo $_SESSION['startedOrder'];
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    //get Date
    $queryDate="SELECT CURDATE() as TD;";
    $result = queryDB($queryDate, $db);
    $row = nextTuple($result);
    $TodayDate=$row['TD'];
    $ProductID=$_GET['id'];

    // add things to the cart 
    if (isset($_POST['AddToCart'])) {
        $quantity=$_POST['Quantity'];
        $isComplete = true;
        $errorMessage = "";
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
        //this happens if the order has nothing in it.
        if ($_SESSION['startedOrder']==null){
            $queryStart="INSERT into orders (storeID,orderDate,orderStatus)Values(1,$TodayDate,6);";//starts an order
            $resultStart=queryDB($queryStart,$db);
            //for now get last order created:
            $queryGETid="SELECT max(id) as lastEntry from orders;";
            $resultGETid=queryDB($queryGETid,$db);
            $row = nextTuple($resultGETid);
            $lastOrder=$row['lastEntry'];
            $_SESSION['startedOrder']=$lastOrder;
            $queryDoOrder="INSERT into itemsInOrder (itemID,orderID,quantityInOrder)Values($ProductID,$lastOrder,$quantity);";
            $resultDoOrder=queryDB($queryDoOrder,$db);
        }
        else{
            $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
            //this is is the order has already been started
            echo "order started";
            
            //first we need to check if the items are unique
            $order=$_SESSION['startedOrder'];
            $queryCheck="SELECT * from itemsInOrder where orderID=$order and itemID=$ProductID;";
            $queryResult=queryDB($queryCheck,$db);
            if (nTuples($queryResult) == 0) {
                echo "no";
                echo "next";
                echo "ok";
                $queryA="INSERT into itemsInOrder (itemID,orderID,quantityInOrder)Values($ProductID,$order,$quantity);";
                $resultA=queryDB($queryA,$db);
            }
            
        while($row=nextTuple($queryResult)){
            echo "not empty";
            //echo mysql_error ([ resource $link_identifier = NULL ] );
            $checkQ=$row['quantityInOrder'];
            $intCheckQ=intval($checkQ);
            $intQuant=intval($quantity);
            echo $intCheckQ. " ". $intQuant;
                //echo "$checkQ";
            //echo "$intQuant";
            $newQuantity=($intCheckQ)+($quantity);
            echo $newQuantity. "wasit";
            $queryB="UPDATE itemsInOrder set quantityInOrder=$newQuantity where orderID=$order and itemID=$ProductID;";
            $resultB=queryDB($queryB,$db);
            
            echo "done";
        }

        }
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    
        
    }
    ?>
    