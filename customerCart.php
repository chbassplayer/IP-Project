<html lang="en">
<head>
  <title>See Your Cart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
    include_once('config.php');
    include_once('dbutils.php');
    session_start();
    $storeID=$_SESSION['StoreID'];
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


</body>
</html>
