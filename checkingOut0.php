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

     <nav class="navbar navbar-inverse">
                 <div class="container-fluid">
                   <div class="navbar-header">
                     <a class="navbar-brand" href="customerHome.php">Store Name</a>
                   </div>
				   
				<ul class="nav navbar-nav">
                                                            
  <div class="dropdown" style="padding-top:8%">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Categories
    <span class="caret"></span></button>
    <ul class='dropdown-menu'>;
       <?php    
    $storeID=1;
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    $query="SELECT * from categories where StoreID=$storeID;";
    $result = queryDB($query, $db);
    while($row = nextTuple($result)) {
        $categoryID=$row['id'];
        $catName=$row['catName'];
            echo "<li class='dropdown-submenu'>";
                echo "<a class='test' tabindex='-1' href='#'>$catName<span class='caret'></span></a>";
                echo "<ul class ='dropdown-menu'>";
                $query1="SELECT subName from SubCats where StoreID=$storeID and MainCatID=$categoryID;";
                $result1 = queryDB($query1, $db);
                while($row1 = nextTuple($result1)) {
                $subName=$row1['subName'];
                
                    echo"<li><a tabindex='-1' href='#'>$subName</a></li>";
                }
                echo"</ul>";
                echo "</li>";
    }
        ?>
    
    </ul>
   
  </div>
      

        </ul>
        
            <ul class="nav navbar-nav navbar-right">
                <li style ="padding-top:2%; padding-bottom:1%"><input type="text" name="search" placeholder="Search.." style="border-radius:5px;"></li> 
                <li><a href="customer-logout.php"><?php echo $_SESSION['email']; ?><span class="glyphicon glyphicon-user"></span></a></li>
                <li><a href="customerCart.php">Cart <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                <li><a href="customerSettings.php">Settings <span class="glyphicon glyphicon-cog"></span></a></li>
                <li><a href="customerHelp.php">Help <span class="glyphicon glyphicon-question-sign"></span></a></li>
            </ul>
            <a class="btn btn-default" href="draftCustomerLogout.php" style="position:absolute; top:0; right:0;">Log Out <b></b></a>

            
            
        </div>

            
    </nav>
    <!--we have the Nav, now the cool stuff starts check out AS GUEST-->
    <!--bread crumb place-->
    <ol class="breadcrumb">
        <li>Check Out</li>
        <li><a href="checkingOut1.php">Review Order</a></li>
        
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
        <div class= "col-xs-12" style="position:absolute; right:12%;">
        <p  style="position:absolute; right:0%;"><b>Total </b><?php echo $Total;?></p>

        </div>
    <div>
    <div class="row">
        <div class= "col-xs-12" style="position:absolute; right:10%;">
        <a class="btn btn-default" href="login-customer.php" style="position:absolute; top:0; right:12%;">Log In <b></b></a>
        <a class="btn btn-default" href="checkingOut1.php" style="position:absolute; top:0; right:0;">Check Out as guest <b></b></a>
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
  