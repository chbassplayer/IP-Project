<?php
    session_start();
    $Search=$_GET['search'];

?>
<?php
include_once('config.php');
include_once('dbutils.php');
$_SESSION['StoreID']=1;
$storeID=$_SESSION['StoreID'];

//does the query when searched
if(isset($_POST['completedsearch'])){
    $search = $_POST['query'];
    $_SESSION['query']=$search;
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    $query = "SELECT * FROM items WHERE (StoreID=$storeID) and (Nam LIKE '%$search%' OR Brand LIKE '%$search%');"; 
    $result=queryDB($query,$db);
        while($row = nextTuple($result)) {
        $productID=$row['ID'];
        echo "\n <div class='col-md-3 column productbox'>";
        if($row['image']){
            $imageLocation=$row['image'];
            echo "<img src=$imageLocation class='img-responsive' width='150' height='150'>";
        }
        else{
        echo "<img src='http://placehold.it/460x250/e67e22/ffffff&text=ITEMS TEST' class='img-responsive' width='150' height='150'>";
            }
        echo "<div class='producttitle'><a href='showItems.php?id=$subName'>" . "<left>" . $row['Brand'] . " " . $row['Nam']  . "</a></div>";
        echo "<div class='productprice'><div class='pricetext'>" . "$" . "<strong>" . $row['Price'] . "</strong>" . "</div></div>";
        echo "<form action='addToCart.php?id=$productID&search=$Search' method='post'>";
        echo "<div class='form-inline'>";
        echo "<label for='Quantity'>Quantity:</label>";
        echo "<input type='number' class='form-control' name='Quantity' style= 'width:25%' value='1'/>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-default' name='AddToCart'>Add To Cart</button>";
        echo "</form>";

        echo "</div> \n ";
    }
    header("Location: customerHomeForEdits.php?search=$search");
    exit;
}
?>


<html lang="en">
<head>
    
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
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
    
    <title>Customer Home</title>
    
</head>
<body>
	<div class="heading">
		<h1 style="color:gray">Store Name</h1>
	</div>
	
<?php
//include Nav Bar
include_once('myNav.php');
?>
</div>
<?php
if(isset($_SESSION['Cemail'])){
    $email=$_SESSION['Cemail'];
    echo "<h1>Welcome, $email</h1>";
}
?>

    <?php 
//lets make a homepage query with most popular items in stock
//here there is not a previous query
if($_GET['search']==""){
    echo "<div class='row' style='margin:auto; width:60%; padding-top: 3%;'>";
        echo "<div class='col-xs-12'>";
            echo "<h1>Try Some of Our most Popular Items</h1>";
        echo "</div>";
    echo "</div>";
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
                    
    $query = "SELECT * from items where StoreID=$storeID order by stock desc limit 3;"; 
    $result=queryDB($query,$db);
        while($row = nextTuple($result)) {
        $productID=$row['ID'];

        echo "\n <div class='col-md-3 column productbox' style='padding-left:10%;'>";
        if($row['image']){
            $imageLocation=$row['image'];
            echo "<img src=$imageLocation class='img-responsive' width='150' height='150'>";
        }
        else{
        echo "<img src='http://placehold.it/460x250/e67e22/ffffff&text=ITEMS TEST' class='img-responsive' width='150' height='150'>";
            }
        echo "<div class='producttitle'><a href='showItems.php?id=$subName'>" . "<left>" . $row['Brand'] . " " . $row['Nam']  . "</a></div>";
        echo "<div class='productprice'><div class='pricetext'>" . "$" . "<strong>" . $row['Price'] . "</strong>" . "</div></div>";
        echo "<form action='addToCart.php?id=$productID&search=$Search' method='post'>";
        echo "<div class='form-inline'>";
        echo "<label for='Quantity'>Quantity:</label>";
        echo "<input type='number' class='form-control' name='Quantity' style= 'width:35%' value='1'/>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-default' name='AddToCart'>Add To Cart</button>";
        echo "</form>";
        echo "</div> \n ";
        
        }
}

  
?>

<?php
//is there a previous query... yes
if($_GET['search']!=""){
    $query=$_GET['search'];
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    
    $query = "SELECT * FROM items WHERE (StoreID=$storeID) and (Nam LIKE '%$query%' OR Brand LIKE '%$query%');"; 
    $result=queryDB($query,$db);
        while($row = nextTuple($result)) {
        $productID=$row['ID'];
        echo "\n <div class='col-md-3 column productbox'>";
        if($row['image']){
            $imageLocation=$row['image'];
            echo "<img src=$imageLocation class='img-responsive' width='150' height='150'>";
        }
        else{
        echo "<img src='http://placehold.it/460x250/e67e22/ffffff&text=ITEMS TEST' class='img-responsive' width='150' height='150'>";
            }
        echo "<div class='producttitle'><a href='showItems.php?id=$subName'>" . "<left>" . $row['Brand'] . " " . $row['Nam']  . "</a></div>";
        echo "<div class='productprice'><div class='pricetext'>" . "$" . "<strong>" . $row['Price'] . "</strong>" . "</div></div>";
        echo "<form action='addToCart.php?id=$productID&search=$Search' method='post'>";
        echo "<div class='form-inline'>";
        echo "<label for='Quantity'>Quantity:</label>";
        echo "<input type='number' class='form-control' name='Quantity' style= width:25% value='1'/>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-default' name='AddToCart'>Add To Cart</button>";
        echo "</form>";

        echo "</div> \n ";
        }
}
 unset($_SESSION['query']);
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

</body>
</html>

