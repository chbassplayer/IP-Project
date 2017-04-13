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
    //get categories for drop down and start a session with a stream_wrapper_restore
    // for every page for this store it will have a consistent Store ID 
    //for now we hard code
    include_once('config.php');
    include_once('dbutils.php');
    session_start();
    //echo $_SESSION['startedOrder'];
    $_SESSION['StoreID']=1;
    $storeID=$_SESSION['StoreID'];
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    //get Date
    $queryDate="SELECT CURDATE() as TD;";
    $result = queryDB($queryDate, $db);
    $row = nextTuple($result);
    $TodayDate=$row['TD'];


    
    ?>

    <?php
     echo $_SESSION['startedOrder'];
    // add things to the cart 
    if (isset($_POST['AddToCart'])) {
        $quantity=$_POST['Quantity'];
        $isComplete = true;
        $errorMessage = "";
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
        
        if ($_SESSION['startedOrder']==null){
            $queryStart="INSERT into orders (storeID,orderDate)Values(1,$TodayDate);";//starts an order
            $resultStart=queryDB($queryStart,$db);
            //for now get last order created:
            $queryGETid="SELECT max(id) as lastEntry from orders;";
            $resultGETid=queryDB($queryGETid,$db);
            $row = nextTuple($resultGETid);
            $lastOrder=$row['lastEntry'];
            $_SESSION['startedOrder']=$lastOrder;
            $queryDoOrder="INSERT into itemsInOrder (itemID,orderID,quantityInOrder)Values(1,$lastOrder,$quantity);";
            $resultDoOrder=queryDB($queryDoOrder,$db);
        }
        else{
            $order=$_SESSION['startedOrder'];
            $query="INSERT into itemsInOrder (itemID,orderID,quantityInOrder)Values(3,$order,$quantity);";
            $result=queryDB($query,$db);
        }
    

    }
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
    include_once('config.php');
    include_once('dbutils.php');
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
                        <li><a href="customer-logout.php"><?php echo $_SESSION['email']; ?><span class="glyphicon glyphicon-user"></span></a></li>
						<li><a href="customerCart.php">Cart <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                        <li><a href="customerSettings.php">Settings <span class="glyphicon glyphicon-cog"></span></a></li>
                        <li><a href="customerHelp.php">Help <span class="glyphicon glyphicon-question-sign"></span></a></li>
                   </ul>
                   <a class="btn btn-default" href="draftCustomerLogout.php" style="position:absolute; top:0; right:0;">Log Out <b></b></a>

                 
                 
                </div>

                 
            </nav>
   

<div class="container">
  <h3>Buy This</h3>
  <p>Strawberry Yogurt
      <!-- form to enter new toppings -->
<div class="row">
    <div class="col-xs-12">
        
<form action="sidenav.php" method="post">

<!-- AgeCanBuy -->
<div class="form-inline">
    <label for="Quantity">Quantity:</label>
    <input type="number" class="form-control" name="Quantity" value="<?php if($quantity) { echo $quantity; } ?>"/>
</div>
<button type="submit" class="btn btn-default" name="AddToCart">Add To Cart</button>


</form>
  </p>
   
</div>



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
  