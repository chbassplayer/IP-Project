<?php
    include_once('config.php');
    include_once('dbutils.php')
?>

<?php
// this kicks users out if they are not logged in
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: login-customer.php');
        exit;
    }

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
    include_once('config.php');
    include_once('dbutils.php')
?>


<?php
		//testing code
		
    //get categories for drop down and start a session with a stream_wrapper_restore
    // for every page for this store it will have a consistent Store ID 
    //for now we hard code
    include_once('config.php');
    include_once('dbutils.php');
    session_start();
    echo $_SESSION['startedOrder'];
    $_SESSION['StoreID']=1;
    $storeID=$_SESSION['StoreID'];
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    //get Date
    $queryDate="SELECT CURDATE() as TD;";
    $result = queryDB($queryDate, $db);
    $row = nextTuple($result);
    $TodayDate=$row['TD'];


		//end of test
    ?>






<div class="heading">
		<h1 style="color:gray">Store Name</h1>
	</div>
	
    
            <nav class="navbar navbar-inverse">
                 <div class="container-fluid">
                   <div class="navbar-header">
                     <a class="navbar-brand" href="customerHome.php">Store Name</a>
                   </div>
				   
				   <ul class="nav navbar-nav navbar-right">
						<li><a href="customerCart.php">Cart <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                        <li><a href="customerSettings.php">Settings <span class="glyphicon glyphicon-cog"></span></a></li>
                        <li><a href="customerHelp.php">Help <span class="glyphicon glyphicon-question-sign"></span></a></li>
						<li><a href="customer-logout.php">Logout: <?php echo $_SESSION['email']; ?><span class="glyphicon glyphicon-user"></span></a></li>
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
					$query1="SELECT subName from SubCats where StoreID=$storeID and MainCatID=$categoryID;";
					$result1 = queryDB($query1, $db);
                    echo  "<li><a tabindex='-1' href='customerShowBigCategory.php?id=$categoryID'>All $catName</a></li>";
					while($row1 = nextTuple($result1)) {
					$subName=$row1['subName'];
								
						echo"<li><a tabindex='-1' href='customerItemsView.php?id=$subName'>$subName</a></li>";
					
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
	
	  
      
    </div>


<?php
    include_once('config.php');
    include_once('dbutils.php');
    //$subCategory=7;
	$subCategory=$_GET['id'];
	$storeID=1;
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    //here I want to get the main category even though in items we only store the subcategory
    $query="SELECT * FROM items join SubCats on items.Categor=SubCats.id WHERE Categor=$subCategory AND items.storeID=$storeID;";
	//$query="SELECT * from items where StoreID=$storeID order by Nam;";
    $result=queryDB($query,$db);
    while($row = nextTuple($result)) {
        $subName=$row['id'];
        
		echo "\n <div class='col-md-3 column productbox'>";
		echo "<img src='http://placehold.it/460x250/e67e22/ffffff&text=ITEMS TEST' class='img-responsive'>";
        echo "<div class='producttitle'>" . "<center>" . $row['Brand'] . " " . $row['Nam'] . "</center>" . "</div>";
		echo "<div class='productprice'><div class='pull-right'><a href='#' class='btn btn-success btn-sm' role='button'>Add to cart</a></div><div class='pricetext'>" . "$" . "<strong>" . $row['Price'] . "</strong>" . "</div></div>";
		
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