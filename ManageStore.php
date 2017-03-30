<!-- updates information into the system-->
<!-- It also lists the contents of the table -->
<!-- It uses bootstrap for formatting -->
<!-- from usernames they are recognized as store or customer eventually.....-->


<?php
    include_once('config.php');
    include_once('dbutils.php');
    session_start();

    if($_SESSION['email']==null){
        header('Location: store-login.php');
    }
    
    
?>

<html>
    <head>

<title>Manage Store <?php echo $_SESSION['email'];?></title>

<!-- This is the code from bootstrap -->        
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
    </head>
    
     <body>

<body>
     <div class="heading">
		<h1 style="color:gray">Store Name</h1>
        <a class="btn btn-default" href="store-logout.php" style="position:absolute; top:0; right:0;">Log Out <b></b></a>
	</div>
    
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <ul class="nav navbar-nav">
			    <li><a href="Manager_Home.html">Home</a></li>
			    <li><a href="categories.php">Categories</a></li>
                <li><a href="items.php">Items</a></li>
			    <li><a href="ManageOrders.php">Orders</a></li>
                <li class="active"><a href="ManageStore.php">Store</a></li>
                <li><a href="ManageEmployees.php">Employees</a></li>
                <li><a href="ManageCustomers.php">Customers</a></li>
                <li><a href="CustomerView.php">Store Front</a></li>
                
		    </ul>
            </div>
        </div>
    </nav>
    
    
        
<!-- Processing form input -->        
        <div class="row">
            <div class="col-xs-12">

            </div>
        </div>
<!-- Showing successfully entering pizza, if that actually happened -->
<div class="row">
    <div class="col-xs-12">
<?php
    if (isset($isComplete) && $isComplete) {
        echo '<div class="alert alert-success" role="alert">';
        echo ("success in entering " ."$storeName");
        unset($storeName, $address, $stateID, $zip,$MaxDelDis,$MaxDaysInAdvance,$TimeRestrict1,$TimeRestrict2, $email);
        echo '</div>';
    }
?>            	
		
<!-- Showing errors, if any -->
<div class="row">
    <div class="col-xs-12">
<?php
    if (isset($isComplete) && !$isComplete) {
        echo '<div class="alert alert-danger" role="alert">';
        echo ($errorMessage);
        echo '</div>';
    }
?>            
    </div>
</div>

<!-- form for inputting data -->
        <div class="row">
            <div class="col-xs-12">
                
<form action="store-signup.php" method="post">

<!--StoreName-->
    <div class="form-group">
        <label for "storeName">Store Name</label>
        <input type="text" class="form-control" name="storeName" value="<?php if($storeName) { echo $storeName; } ?>"/>
    </div>

<!--Street Address-->
    <div class="form-group">
        <label for "address">Street Address</label>
        <input type="text" class="form-control" name="address" value="<?php if($address) { echo $address; } ?>"/>
    </div>

<!--State this should be from dropown-->
    <div class="form-group">
        <label for "stateID">State</label>
    <?php
    // connect to the database
    if (!isset($db)) {
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    }
    echo (generateDropdown($db, "states", "stateName", "id", $stateID));        
    ?>
    </div>

<!--ZipCode-->
    <div class="form-group">
        <label for "zip">Zip Code</label>
        <input type="number" class="form-control" name="zip" value="<?php if($zip) { echo $zip; } ?>"/>
    </div>
<!--Delivery Radius-->
    <div class="form-group">
        <label for "MaxDelDis">Deleivery Radius (Miles)</label>
        <input type="number" class="form-control" name="MaxDelDis" value="<?php if($MaxDelDis) { echo $MaxDelDis; } ?>"/>
    </div>
<!--Max Days in Advance-->
    <div class="form-group">
        <label for "MaxDaysInAdvance">Maximum Days in Advance an Order Can be Taken</label>
        <input type="number" class="form-control" name="MaxDaysInAdvance" value="<?php if($MaxDaysInAdvance) { echo $MaxDaysInAdvance; } ?>"/>
    </div>
<!--Start of Available Delivery Times (from dropdown)-->
    <div class="form-inline">
    <p><b>Available Delivery Window</b><p> <label  for "TimeRestrict1">Start</label>

    <?php
    // connect to the database
    if (!isset($db)) {
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    }
    echo (generateDropdown2($db, "times", "clock", "id", "$TimeRestrict1"));        
    ?>
    </div>
    
 <!--End of Available Delivery Times (from Dropdown)-->
    <div class="form-inline">
        <label for "TimeRestrict2">End</label>
    <?php
    // connect to the database
    if (!isset($db)) {
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    }
    echo (generateDropdown2($db, "times", "clock", "id", "$TimeRestrict2"));        
    ?>
    </div>




<!-- email -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" value="<?php echo $_SESSION['email'];?>"/>
    </div>


    <button type="submit" class="btn btn-default" name="submit">Update!</button>
</form>
                
            </div>
        </div>
            
</div>        

        
    </body>
    
</html>