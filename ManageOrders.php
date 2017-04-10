<?php
    include_once('config.php');
    include_once('dbutils.php');
    session_start();

    if($_SESSION['email']==null){
        header('Location: store-login.php');
    }
    
    $storeID=$_SESSION['storeID'];    
?>
<html>
    <head>
<!-- Bootstrap links -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>        
<?php 
    include_once("config.php");
    include_once("dbutils.php");
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    $queryGTotal="SELECT sum(quantityInOrder*Price) as Total from itemsInOrder,items where items.id=itemsInOrder.itemID;";
    $resultGTotal=queryDB($queryGTotal,$db);
    while($row=nextTuple($resultGTotal)){
        $GTotal=$row['Total'];
        }
?>
        
        <title>Orders</title>
    </head>
    <body>
    <?php
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    $query="SELECT storeName from stores where id=$storeID;";
    $result = queryDB($query, $db);
    $row = nextTuple($result);
    $storeName=$row['storeName'];
    ?>
     <div class="heading">
		<h1 style="color:gray"><?php echo $storeName;?></h1>
        <a class="btn btn-default" href="store-logout.php" style="position:absolute; top:0; right:0;">Log Out <b></b></a>
	</div>
    
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <ul class="nav navbar-nav">
			    <li><a href="Manager_Home.php">Home</a></li>
			    <li><a href="categories.php">Categories</a></li>
                <li><a href="items.php">Items</a></li>
			    <li class = "active"><a href="ManageOrders.php">Orders</a></li>
                <li><a href="ManageStore.php">Store</a></li>
                <li><a href="ManageEmployees.php">Employees</a></li>
                <li><a href="ManageCustomers.php">Customers</a></li>
                <li><a href="CustomerView.php">Store Front</a></li>
                
		    </ul>
            </div>
        </div>
    </nav>
<!--show total money generated by online sales ever!!!!!-->
<div class="row">
    <div class="col-xs-12">
        <h4 style="position:absolute; top:0; right:2%;">Total Ever! : $<?php echo $GTotal;?></h4>

    </div>
</div>

<!-- show orders by requested date -->
<div class="row">
    <div class="col-xs-12">
        <h1>Manage Orders</h1>

    </div>
</div>

<table class="table table-hover">
    <!-- headers for table -->
    <thead>
        <th>Order ID</th>
        <th>Date Out</th>
        <th>Order Status</th>
        
        
    </thead>


       
<?php

$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
$query1 = "SELECT orders.id,description, preferredDate, orderStatus from   orders join orderStatus on 
orders.orderStatus=orderStatus.id where storeID=$storeID order by preferredDate;";
$result = queryDB($query1, $db);

    
    while($row = nextTuple($result)) {
        $orderID=$row['id'];
        echo "\n <tr>";
        echo "<td><a  href='exampleOrder.php?id=$orderID'>" . $orderID. "</a> </td>";
        echo "<td>" . $row['preferredDate'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td><a  href='canYouChangeOrders.php?id=$orderID'>" . "Update". "</a> </td>";
        echo "\n <tr>";
        

}
?>
        </table>
    <div>
</div>



    </body>
</html>