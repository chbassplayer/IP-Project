<html lang="en">
<head>
  <title>See Your Cart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
.dropdown-submenu {
    position: relative;
}

.dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
}
</style>
</head>
<body>
<div class="heading">
		<h1 style="color:gray">Store Name</h1>
</div>
    <?php
    include_once('config.php');
    include_once('dbutils.php');
    session_start();
    $storeID=$_SESSION['StoreID'];
    ?>
<?php
include_once('myNav.php');
?>    

<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>
<div class ="row">
    <div class="col-xs-12">
    <h1>Your Cart</h1>
    </div>
</div>
<div class="row">
    <div class="col" style ="padding:3%">
    <table class="table table-hover">
    <!-- headers for table -->
    <thead style ="padding:5%">
        <th>Name</th>
        <th>Brand</th>
        <th>Quantity</th>
        <th></th>
        <th></th>
        <th></th>
        <th>Price</th>
        
    </thead>
    <?php
    //get categories for drop down and start a session with a stream_wrapper_restore
    // for every page for this store it will have a consistent Store ID 
    //for now we hard code
    
    $storeID=$_SESSION['StoreID'];
    $order=$_SESSION['startedOrder'];
    if($order==""){
        echo "Currently No Items In Cart";
        exit;
    }
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    //get Date
    $query="SELECT Nam,Brand,quantityInOrder,Price,items.ID,image from itemsInOrder join items on itemsInOrder.itemID=items.ID where StoreID=$storeID
    and orderID=$order;";
    $result = queryDB($query, $db);
    while($row = nextTuple($result)) {
        $itemID=$row['ID'];
        $Name=$row['Nam'];
        $Brand=$row['Brand'];
        $quantity=$row['quantityInOrder'];
        echo "\n <tr>";
        echo "<td>" . $Name. "</td>";
        echo "<td>" . $Brand . "</td>";
        echo "<td><form action='UpdateCart.php?id=$itemID' method='post'>";
        echo "<div class='form-inline' style='width:25'>";
        //echo "<label for='Quantity'>Quantity:</label>";
        echo "<input type='number' class='form-control' name='Quantity' style= 'width:50' value='$quantity'/>";
        echo "</div>";
        echo "<td>";
         if ($_SESSION['startedOrder']){
            echo "<button type='submit' class='btn btn-default' name='UpdateCart$itemID'>Update My Cart</button>";
            echo "</td>";
        }
        echo "</form></td>";
        echo "<td><a href='removeFromCart.php?id=$itemID'>Remove</a></td>";
        echo "<td>";
        if($row['image']){
            $imageLocation=$row['image'];
            echo "<img src=$imageLocation width='70'>";
        }

        echo "</td>";
        echo "<td>" . $row['Price'] . "</td>";
        echo "\n <tr>";
    }
            
        
       
        
    ?>

    </table>
    <?php
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    $queryTotal="SELECT sum(quantityInOrder*Price) as Total from itemsInOrder,items where items.id=itemsInOrder.itemID
    and OrderID=$order and StoreID=$storeID;";
    $resultTotal=queryDB($queryTotal,$db);
    while($row=nextTuple($resultTotal)){
        $Total=$row['Total'];
    }
     
    ?>
        </div>
    </div>
    <div class="row">
        <div class= "col-xs-12" style="position:absolute; right:5%;">
        <p  style="position:absolute; right:0%;"><b>Total </b><?php echo $Total;?></p>
        </div>
    </div>
    <?php
    if($_SESSION['Cemail']==""){
        echo "<a  class='btn btn-default' href='checkingOut0.php' style='position:absolute; right:12%'>Check Out as Guest</a>";
        echo "<a  class ='btn btn-default'href='login-customer.php' style='position:absolute; right:25%'>Login</a>";
        }
    else{
        echo "<a  class='btn btn-default' href='checkingOut0.php' style='position:absolute; right:12%'>Check Out</a>";
    }

    ?>

</body>
</html>
