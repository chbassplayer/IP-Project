<html>
<head>
   <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="grocery.css">
<title>Manager Home</title>
</head>
<body>
    <?php
    include_once('config.php');
    include_once('dbutils.php');
    session_start();

    if($_SESSION['email']==null){
        header('Location: store-login.php');
    }
    ?>
    <?php 
    //get store Name
    $storeID=$_SESSION['storeID'];
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    $query="SELECT storeName from stores where id=$storeID;";
    $result = queryDB($query, $db);
    $row = nextTuple($result);
    $storeName=$row['storeName'];
    ?>
    
     <div class="heading">
		<h1 style="color:gray"><?php echo $storeName;?></h1>
        <a class="btn btn-default" href="store-logout.php" style="position:absolute; top:0; right:0;">Log Out <b></b></a>
	</div>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <ul class="nav navbar-nav">
			    <li class="active"><a href="Manager_Home.php">Home</a></li>
			    <li><a href="categories.php">Categories</a></li>
                <li><a href="items.php">Items</a></li>
			    <li><a href="ManageOrders.php">Orders</a></li>
                <li><a href="ManageStore.php">Store</a></li>
                <li><a href="ManageEmployees.php">Employees</a></li>
                <li><a href="ManageCustomers.php">Customers</a></li>
                <li><a href="CustomerView.php">Store Front</a></li>
		    </ul>
            </div>
        </div>
    </nav>
    <!--card button to get to the Order Managment-->
    <div class="row">
        <div class="col-xs-3">
        </div>
        <div class="col-xs-2"  style="padding-top: 7%">
            <a style="text-decoration:none; color:#6B6867" href="ManageOrders.php">
            <div class="card text-center" style="background-color:white">
            <div class="card-block">
                <blockquote class="card-blockquote">
                <h1>Orders</h1>
                </blockquote>
            </div>
            </div>
            </a>
        </div>
        <div class="col-xs-2">
        </div>
        <div class="col-xs-2"  style="padding-top: 7%">
            <a style="text-decoration:none; color:#6B6867;" href="items.php">
            <div class="card text-center" style="background-color:white">
            <div class="card-block">
                <blockquote class="card-blockquote">
                <h1>Items</h1>
                </blockquote>
            </div>
            </div>
            </a>
        </div>
    </div>
</body>
<footer>
    <b>Admin: </b>
    jessica-lu@uiowa.edu
</footer>
</html>