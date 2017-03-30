<html>
    <head>
<!-- Bootstrap links -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>        

        
        <title>Orders</title>
    </head>
    <body>
     <div class="heading">
		<h1 style="color:gray">Store Name</h1>
        <a class="btn btn-default" href="store-logout.php" style="position:absolute; top:0; right:0;">Log Out <b></b></a>
	</div>
    
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <ul class="nav navbar-nav">
			    <li><a href="Manager_Home.html">Home</a></li>
			    <li><a href="categories.php">Categories</a></li>
                <li class="active"><a href="items.php">Items</a></li>
			    <li><a href="ManageOrders.php">Orders</a></li>
                <li><a href="ManageStore.php">Store</a></li>
                <li><a href="ManageEmployees.php">Employees</a></li>
                <li><a href="ManageCustomers.php">Customers</a></li>
                <li><a href="CustomerView.php">Store Front</a></li>
                
		    </ul>
            </div>
        </div>
    </nav>

<!-- show orders by requested date -->
<div class="row">
    <div class="col-xs-12">
        <h1>Manage Orders</h1>

    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <a href="exampleOrder.php">
<?php

include_once('config.php');
include_once('dbutils.php');
$db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
$query1 = 'SELECT id from orders order by PreferredDate;';
    
$result = queryDB($query1, $db);
while($row = nextTuple($result)) {
    $OrderID= $row['id'];
}
echo($OrderID);
?>
        </a>
    <div>
</div>
<div class="row">
    <div class="col-xs-12">
    
        
<!-- set up html table to show contents -->
<table class="table table-hover">
    <!-- headers for table -->
    <thead>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        
    </thead>
<?php
    
    /*
     * List all the items in the database
     *
     */
    
    // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    // set up a query to get information on the toppings from the database
    $query = 'SELECT Nam,Price,quantityInOrder from itemsInOrder,items where items.ID=itemsInOrder.itemID;';
    
    // run the query
    $result = queryDB($query, $db);
    
    while($row = nextTuple($result)) {
        echo "\n <tr>";
        echo "<td>" . $row['Nam'] . "</td>";
        echo "<td>" . $row['Price'] . "</td>";
        echo "<td>" . $row['quantityInOrder'] . "</td>";
       
    }
?>   



    
</table>
        
    </div>
</div>



    </body>
</html>