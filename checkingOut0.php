<!DOCTYPE html>
<html>
<head>
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
<?php
    include_once('config.php');
    include_once('dbutils.php');
    session_start();
    //echo $_SESSION['startedOrder'];
    $_SESSION['StoreID']=1;
    $storeID=$_SESSION['StoreID'];
    $order=$_SESSION['startedOrder'];

?>
<div class="heading">
		<h1 style="color:gray">Store Name</h1>
</div>
<?php
include_once('myNav.php');
?>

    <!--we have the Nav, now the cool stuff starts check out AS GUEST-->
    <!--bread crumb place-->
    <ol class="breadcrumb">
        <li>Check Out</li>
        <li><a href="checkingOut0.php">Review Order</a></li>
        
    </ol>


        <div class="row">
            <div class="col-xs-12">
                <h1>Review Order</h1>
                
            </div>
        </div>
        


<table class="table table-hover">
    <!-- headers for table -->
    <thead>
        <th>Name</th>
        <th>Brand</th>
        <th>Quantity</th>
        <th>Price</th>
        
    </thead>
    <?php
    //get categories for drop down and start a session with a stream_wrapper_restore
    // for every page for this store it will have a consistent Store ID 
    //for now we hard code
    
    $storeID=$_SESSION['StoreID'];
    $order=$_SESSION['startedOrder'];
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    //get Date
    $query="SELECT Nam,Brand,quantityInOrder,Price from itemsInOrder join items on itemsInOrder.itemID=items.ID where StoreID=$storeID
    and orderID=$order;";
    $result = queryDB($query, $db);
    while($row = nextTuple($result)) {
        $Name=$row['Nam'];
        $Brand=$row['Brand'];
        $quantity=$row['quantityInOrder'];
        echo "\n <tr>";
        echo "<td>" . $Name. "</td>";
        echo "<td>" . $Brand . "</td>";
        echo "<td>" . $quantity . "</td>";
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
    <div class="row">
        <div class= "col-xs-12" style=" right:15%;">
        <p  style="position:absolute; right:0%;"><b>Total </b><?php echo $Total;?></p>
        </div>
    </div>
    <div class="row">
        <div class= "col-xs-12" style="position:absolute; right:10%;">
        <?php
        if($_SESSION['Cemail']!=""){
            echo "<a class='btn btn-default' href='checkingOut1.php' style='position:absolute; top:0; right:15%'>Check Out<b></b></a>";
        }
        else {
            echo "<a class='btn btn-default' href='login-customer.php' style='position:absolute; top:0; right:10%'>Log In <b></b></a>";
            echo "<a class='btn btn-default' href='checkingOut1.php' style='position:absolute; top:0; right:15%;'>Check Out as guest <b></b></a>";
        
        }
        ?>
        </div>
    <div>


<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>

</body>
</html>
  