<?php
    include_once('config.php');
    include_once('dbutils.php')
?>

<?php

    session_start();

?>

<html>
    <head>

<title>Items</title>

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
		//testing code
		
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
    
    ?>

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
	
<div class = "row">
    <div class="col-xs-12" style="background-color:white">
    <!--Set up table-->
<?php
        if(isset($_POST['completedsearch']))
            {
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
                        echo "<form action='addToCart.php?id=$productID' method='post'>";
                        echo "<div class='form-inline'>";
                        echo "<label for='Quantity'>Quantity:</label>";
                        echo "<input type='number' class='form-control' name='Quantity' style= width:25% value='<?php if($quantity) { echo $quantity; } ?>'/>";
                        echo "</div>";
                        echo "<button type='submit' class='btn btn-default' name='AddToCart'>Add To Cart</button>";
                        echo "</form>";

                        echo "</div> \n ";
                    }
                    exit;
            }
    ?>
</div>
<?php
//is there a previous query... yes
if($_SESSION['query']!=""){
    //echo "there is something from before";
    $query=$_SESSION['query'];
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
        echo "<form action='addToCart.php?id=$productID' method='post'>";
        echo "<div class='form-inline'>";
        echo "<label for='Quantity'>Quantity:</label>";
        echo "<input type='number' class='form-control' name='Quantity' style= width:25% value='<?php if($quantity) { echo $quantity; } ?>'/>";
        echo "</div>";
        echo "<button type='submit' class='btn btn-default' name='AddToCart'>Add To Cart</button>";
        echo "</form>";

        echo "</div> \n ";
        }
}
unset($_SESSION['query']);
?>

<?php
    include_once('config.php');
    include_once('dbutils.php');
    //$subCategory=7;
	$subCategory=$_GET['id'];
    if(!$subCategory){
        exit;
    }
	$storeID=1;
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    $query="SELECT * FROM items WHERE storeID=$storeID AND Categor=$subCategory;";
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
        echo "<input type='number' class='form-control' name='Quantity' style= width:25% value='<?php if($quantity) { echo $quantity; } ?>'/>";
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