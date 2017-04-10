<html>
       <head>
<!-- Bootstrap links -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>        
<body>
    <div class="row" style="padding:1%;">
        <div class="col-xs-12">
        <a class="btn btn-default" href="ManageOrders.php" style="position:absolute; top:5%;left:2%;">Back To Orders <b></b></a>
        </div>
	</div>

    <!--lets make a box  to put the order info in-->
    <!--and get all the information for the order page-->
    <div class=row>
        <div class=col-xs-12>
        <?php
        include_once('config.php');
        include_once('dbutils.php');
        $orderID=$_GET['id'];
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
        $queryinfo="SELECT * from orders where id=$orderID;";
        $resultinfo=queryDB($queryinfo,$db);
        while($row = nextTuple($resultinfo)) {
            $customerID=$row['customerID'];
            $deliveryAddress=$row['deliveryAddress'];
            $preferredDate=$row['preferredDate'];
            $orderStatus=$row['orderStatus'];
            $preferredTime1=$row['preferredTime1'];
            $preferredTime2=$row['preferredTime2'];
            $orderStatus=$row['orderStatus'];
            $deliveryState=$row['deliveryState'];
            $deliveryZIP=$row['deliveryZIP'];
        }
        $queryName="SELECT fname,lname from customers where id=$customerID;";
        $resultname=queryDB($queryName,$db);
        while($row = nextTuple($resultname)) {
            $customerLname=$row['lname'];
            $customerFname=$row['fname'];
            
        }
        $queryStatus="SELECT description from orderStatus where id=$orderStatus;";
        $resultStatus=queryDB($queryStatus,$db);
        while($row = nextTuple($resultStatus)) {
            $StatusDes=$row['description'];
        }

        $queryTime1="SELECT clock from DeliveryTime where id=$preferredTime1;";
        $resultTime1=queryDB($queryTime1,$db);
        while($row = nextTuple($resultTime1)) {
            $Time1=$row['clock'];
        }
        $queryTime2="SELECT clock from DeliveryTime where id=$preferredTime2;";
        $resultTime2=queryDB($queryTime2,$db);
        while($row = nextTuple($resultTime2)) {
            $Time2=$row['clock'];
        }

        $queryState="SELECT stateName from states where id=$deliveryState;";
        $resultState=queryDB($queryState,$db);
        while($row = nextTuple($resultState)) {
            $State=$row['stateName'];
        }
        $queryTotal="SELECT sum(quantityInOrder*Price) as Total from itemsInOrder,items where items.id=itemsInOrder.itemID
        and OrderID=$orderID;";
        $resultTotal=queryDB($queryTotal,$db);
        while($row=nextTuple($resultTotal)){
            $Total=$row['Total'];
        }
        

        ?>

       

        <p><h1>#Order ID <?php echo $_GET['id'];?></h1></p>
        <p><b>Customer:</b> <?php echo $customerFname ." ". $customerLname;?>
        &nbsp <b>Delivery Address: </b> <?php echo $deliveryAddress . " , ". $State . " ," . $deliveryZIP;?>
        &nbsp <b>Delivery Date: </b><?php echo $preferredDate;?>
        &nbsp <b>Delivery Window:</b><?php echo $Time1 ."-".$Time2;?>
        &nbsp <b>Order Status:</b><?php echo $StatusDes;?></p>

        
        <!--get all the information for the order page-->


        </div>
    </div>
    <!-- set up html table to show contents -->
<table class="table table-hover">
    <!-- headers for table -->
    <thead>
        <th>Department</th>
        <th>Brand</th>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        
    </thead>

<?php
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    $orderID=$_GET['id'];
    
    
    // set up a query to get information on the toppings from the database
    $query = "SELECT catName,Nam,Brand,Price,quantityInOrder from itemsInOrder join items on itemsInOrder.itemID=items.ID 
    join categories on categories.id=items.Categor
    where orderID=$orderID";

    
    // run the query
    $result = queryDB($query, $db);
    
    
    while($row = nextTuple($result)) {
        echo "\n <tr>";
        echo "<td>" . $row['catName'];
        echo "<td>" . $row['Brand'];
        echo "<td>" . $row['Nam'] . "</td>";
        echo "<td>" . $row['quantityInOrder'] . "</td>";
        echo "<td>" . $row['Price'] . "</td>";
        echo "\n <tr>";
       
    }
?>   



    
</table>
<p>Total: <?php echo $Total;?></p>
        
    </div>
</div>



    </body>
</html>