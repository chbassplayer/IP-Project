<html>
    <head>

<title>A Category</title>

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
<div class="heading">
		<h1 style="color:gray">Store Name</h1>
</div>
<?php
include_once('myNav.php');
?>

<div class = "row">
    <div class="col-xs-12" style="background-color:white">
    <!--Set up table-->
	
	  
      
    </div>


<?php
    include_once('config.php');
    include_once('dbutils.php');
    //$subCategory=7;
	$Category=$_GET['id'];
	$storeID=1;
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    //here I want to get the main category even though in items we only store the subcategory
    $query="SELECT * FROM items join SubCats on items.Categor=SubCats.id WHERE MainCatID=$Category AND items.storeID=$storeID=1;";
	//$query="SELECT * from items where StoreID=$storeID order by Nam;";
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
        echo "<form action='addToCart.php?id=$productID' method='post'>";
        echo "<div class='form-inline'>";
        echo "<label for='Quantity'>Quantity:</label>";
        echo "<input type='number' class='form-control' name='Quantity' style= 'width:25%' value='1'/>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-default' name='AddToCart'>Add To Cart</button>";
        echo "</form>";

        echo "</div> \n ";
    }

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