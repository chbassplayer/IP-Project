<html lang="en">
<head>
  <title>Bootstrap Case</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
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


		<nav class="navbar navbar-default">
				<div class="container-fluid">
				  <!-- Brand and toggle get grouped for better mobile display -->
				  <div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					  <span class="sr-only">Toggle navigation</span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					  <span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="draftHomeCustomer.php">Home</a>
                    <a class="btn btn-default" href="draftCustomerLogout.php" style="position:absolute; top:0; right:0;">Log Out <b></b></a>
				  </div>
			  
				  <!-- Collect the nav links, forms, and other content for toggling -->
				  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">

					  <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories <span class="caret"></span></a>
						<ul class="dropdown-menu">
                            <?php    
                        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
                        $query="SELECT * from categories where StoreID=$storeID;";
                        $result = queryDB($query, $db);
                        while($row = nextTuple($result)) {
                            $categoryID=$row['id'];
                            $catName=$row['catName'];
                            echo "<li><a href='ShowCustomerCategory.php?id=$categoryID'>". $row['catName'] . "</a></td>";
                            

        
                        }
                        ?>
					  
						  
						</ul>
					  </li>
					</ul>
					<form class="navbar-form navbar-left">
					  <div class="form-group">
						<input type="text" class="form-control" placeholder="Search Products">
					  </div>
					  <button type="submit" class="btn btn-default">Search</button>
					</form>
					<ul class="nav navbar-nav navbar-right">
					  <li><a href="login-customer.php">Login <span class="glyphicon glyphicon-user"></span></a></li>
					  <li><a href="customerCart.php">Cart <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
					  <li><a href="#">Settings <span class="glyphicon glyphicon-cog"></span></a></li>
					  <li><a href="#">Help <span class="glyphicon glyphicon-question-sign"></span></a></li>
					</ul>
				  </div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
		</nav>
  
<div class="container">
  <h3>Buy This</h3>
  <p>Strawberry Yogurt
      <!-- form to enter new toppings -->
<div class="row">
    <div class="col-xs-12">
        
<form action="draftHomeCustomer.php" method="post">

<!-- AgeCanBuy -->
<div class="form-inline">
    <label for="Quantity">Quantity:</label>
    <input type="number" class="form-control" name="Quantity" value="<?php if($quantity) { echo $quantity; } ?>"/>
</div>
<button type="submit" class="btn btn-default" name="AddToCart">Add To Cart</button>


</form>
  </p>
   
</div>

</body>
</html>
