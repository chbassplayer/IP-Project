<?php
    include_once('config.php');
    include_once('dbutils.php');
    session_start();
    //echo $_SESSION['startedOrder'];
    $_SESSION['StoreID']=1;
    $storeID=$_SESSION['StoreID'];
    $order=$_SESSION['startedOrder'];

?>
<?php
//
// Code to handle input from form
//

if (isset($_POST['submit'])) {
    //if its pushed we need to move it to the store and Thank Them
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    $query="UPDATE orders set orderStatus=0 where id=$order;";
    $result=queryDB($query,$db);
    header("Location:thankYou.php");
    exit;

}
?>

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
<div class="heading">
		<h1 style="color:gray">Store Name</h1>
</div>

     <nav class="navbar navbar-inverse">
        <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="customerHomeForEdits.php">Store Name</a>
        </div>
        
        <ul class="nav navbar-nav navbar-right">
        
            <li style ="padding-top:2%; padding-bottom:1%">
            <form method="post" action="customerItemsViewForEdits.php">
                <input type="text" value="Search..." name="query" />
                <input type="submit" value="Find" name="completedsearch" />
            </form>
            </li>

            <li><a href="customerCart.php">Cart <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
            <li><a href="customerSettings.php">Settings <span class="glyphicon glyphicon-cog"></span></a></li>
            <li><a href="customerHelp.php">Help <span class="glyphicon glyphicon-question-sign"></span></a></li>
            <?php
            if($_SESSION['Cemail']==""){
                echo "<li><a href='login-customer.php'>Login<span class='glyphicon glyphicon-user'></span></a></li>";
            }
            else{
                echo "<li><a href='customer-logout.php'>Logout:". $_SESSION['Cemail']."<span class='glyphicon glyphicon-user'></span></a></li>";
            }
            ?>
            
        </ul>
        
        
        
        
        
        
        
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">

        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories <span class="caret"></span></a>
        <ul class="dropdown-menu">
                <?php    
            $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
            $query="SELECT * from categories where StoreID=$storeID order by catName;";
            $result = queryDB($query, $db);
            while($row = nextTuple($result)) {
                $categoryID=$row['id'];
                $catName=$row['catName'];
    echo "<li class='dropdown-submenu'>";
        echo "<a class='test' tabindex='-1' href='customerShowBigCategory.php?id=$categoryID'>$catName<span class='caret'></span></a>";
        echo "<ul class ='dropdown-menu'>";
        $query1="SELECT id,subName from SubCats where StoreID=$storeID and MainCatID=$categoryID;";
        $result1 = queryDB($query1, $db);
        echo  "<li><a tabindex='-1' href='customerShowBigCategory.php?id=$categoryID'>All $catName</a></li>";
        while($row1 = nextTuple($result1)) {
        $subName=$row1['subName'];
        $subID=$row1['id'];
                    
            echo"<li><a tabindex='-1' href='customerItemsViewForEdits.php?id=$subID'>$subName</a></li>";
        
        }
        echo"</ul>";
        echo "</li>";
        }
            ?>
        </div>
        
    </div>

        
</nav>
    <!--we have the Nav, now the cool stuff starts check out AS GUEST-->
    <!--bread crumb place-->
    <ol class="breadcrumb">
        <li>Check Out</li>
        <li><a href="checkingOut0.php">Review Order</a></li>
        <li><a href="checkingOut1.php">Delivery Information</a></li>
        <li><a href="checkingOut2.php">Preferences</a></li>
        <li><a href="checkingOut3.php">Payment</a></li>
        <li><a href="checkingOut4.php">Complete</a></li>
    </ol>
    
<?php
    include_once('config.php');
    include_once('dbutils.php');
    
?>


        <div class="row">
            <div class="col-xs-12">
                <h1>Are you sure you want to complete your order?</h1>
                
            </div>
        </div>
        

<!-- form for inputting data -->
        <div class="row">
            <div class="col-xs-8" style="padding-left:4%">
                
<form action="checkingOut4.php" method="post">


    <button type="submit" class="btn btn-default" name="submit">Yes</button>
</form>
<a class="btn btn-default" href="checkingOut0.php">No <b></b></a>
                
            </div>
        </div>
            
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
  