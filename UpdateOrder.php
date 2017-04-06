<?php
    include_once('config.php');
    include_once('dbutils.php');
    session_start();

    if($_SESSION['email']==null){
        header('Location: store-login.php');
    }
    $_SESSION['AccessOrders']=1;//this makes it so you can see orders the rest of the time :)

    
    
    
?>

<?php
/*
 *First I want to get all the information that will go into the forms
 
 *
 */
    
    $orderID=$_GET['id'];
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    $queryinfo="SELECT * from orders where id=$orderID;";
    $resultinfo=queryDB($queryinfo,$db);
    while($row = nextTuple($resultinfo)) {
        $customerID=$row['customerID'];
        $deliveryAddress=$row['deliveryAddress'];
        $preferredDate=$row['preferredDate'];
        $orderStatus=$row['orderStatus'];
        $preferredTime1=$row['preferredTime1'];
        $preferredTime2=$row['preferredTime2'];
        $orderStatus=$row['orderStatus'];
        $deliveryState=$row['deliveryState'];
        $deliveryZIP=$row['deliveryZIP'];
    }
    $queryName="SELECT fname,lname from customers where id=$customerID;";
    $resultname=queryDB($queryName,$db);
    while($row = nextTuple($resultname)) {
        $customerLname=$row['lname'];
        $customerFname=$row['fname'];
        
    }
    $queryStatus="SELECT description from orderStatus where id=$orderStatus;";
    $resultStatus=queryDB($queryStatus,$db);
    while($row = nextTuple($resultStatus)) {
        $StatusDes=$row['description'];
    }

    $queryTime1="SELECT clock from DeliveryTime where id=$preferredTime1;";
    $resultTime1=queryDB($queryTime1,$db);
    while($row = nextTuple($resultTime1)) {
        $Time1=$row['clock'];
    }
    $queryTime2="SELECT clock from DeliveryTime where id=$preferredTime2;";
    $resultTime2=queryDB($queryTime2,$db);
    while($row = nextTuple($resultTime2)) {
        $Time2=$row['clock'];
    }

    $queryState="SELECT stateName from states where id=$deliveryState;";
    $resultState=queryDB($queryState,$db);
    while($row = nextTuple($resultState)) {
        $State=$row['stateName'];
    }
    $queryTotal="SELECT sum(quantityInOrder*Price) as Total from itemsInOrder,items where items.id=itemsInOrder.itemID
    and OrderID=$orderID;";
    $resultTotal=queryDB($queryTotal,$db);
    while($row=nextTuple($resultTotal)){
        $Total=$row['Total'];
    }

    
?>

<html>
    <head>
<!-- Bootstrap links -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>        
        
        <title>Update Order #<?php echo $orderID; ?></title>
    </head>
    
    <body>
    <!-- Processing form input -->        
        <div class="row">
            <div class="col-xs-12">
<?php
//
// Code to handle input from form
//

if (isset($_POST['submit'])) {
    // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    // only run if the form was submitted
    
    // get data from form
    $orderID=$_GET['id'];
    $newAddress = $_POST['DeliveryAddress'];
    $newState=$_POST['states-id'];
    $newZIP=$_POST['zip'];
    $newTime1=$_POST['DeliveryTime-id'];
    $newTime2=$_POST['DeliveryTime2-id'];
    $newOrderStatus=$_POST['orderStatus-id'];
    echo "hello".$newTime2;
	
    
   // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);    
    
    // check for required fields
    $isComplete = true;
    $errorMessage = "";

    if(!$newAddress){
        $errorMessage .= " Must have an address. ";
        $isComplete = false;
    }

    if(!$newZIP){
        $errorMessage .= "Must have a ZIP code .  ";
        $isComplete= false;
    }
	    
    if ($isComplete) {
    
		// check if there's a user with the same email
		$query = "UPDATE orders set deliveryAddress='$newAddress', deliveryState=$newState,deliveryZIP=
        $newZIP,preferredTime1=$newTime1,preferredTime2=$newTime2, orderStatus=$newOrderStatus where id=$orderID;";
		$result = queryDB($query, $db);
        header("Location: ManageOrders.php");
        exit;
		
		}
	
}
?>
            </div>
        </div>
        
<!-- Visible title -->
<div class="row">
    <div class="col-xs-12">
        <h1>Update <?php echo $orderID; ?></h1>
    </div>
</div>

<!-- form to ask what should be changed about the order -->
<div class="row">
    <div class="col-xs-12">
<form action="<?php echo "UpdateOrder.php?id=".$orderID;?>" method="post">
<!--update status-->
    <div class="form-inline">
        <label for "Update Status">Order Status</label>
    <?php
    // connect to the database
    if (!isset($db)) {
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    }
    echo (generateDropdown2($db, "orderStatus", "description", "id", $orderStatus));        
    ?>
    </div>

<!--part to change Delivery Address-->

    <div class="form-group">
        <label for "DeliveryAddress">Delivery Address</label>
        <input type="text" class="form-control" name="DeliveryAddress" value="<?php echo $deliveryAddress;?>"/>
    </div>
<!--part to change delivery state-->
    <div class="form-group">
        <label for "DeliveryState">State</label>
    <?php
    // connect to the database
    if (!isset($db)) {
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    }
    echo (generateDropdown($db, "states", "stateName", "id", $deliveryState));        
    ?>
    </div>
<!--part to change ZipCode-->
    <div class="form-group">
        <label for "zip">Zip Code</label>
        <input type="number" class="form-control" name="zip" value="<?php echo $deliveryZIP; ?>"/>
    </div>
<!--Start of Available Delivery Times (from dropdown)-->
    <div class="form-inline">
    <p><b>Available Delivery Window</b><p> <label  for "Time1">Start</label>

    <?php
    // connect to the database
    if (!isset($db)) {
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    }
    echo (generateDropdown2($db, "DeliveryTime", "clock", "id", $preferredTime1));        
    ?>
    </div>
    
 <!--End of Available Delivery Times (from Dropdown)-->
    <div class="form-inline">
        <label for "Time2">End</label>
    <?php
    // connect to the database
    if (!isset($db)) {
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    }
    echo (generateDropdown2($db, "DeliveryTime2", "clock", "id", $preferredTime2));        
    ?>
    </div>

    
    
    <button type="submit" class="btn btn-default" name="submit">Submit</button>
</form>

    </div>
</div>
        
    </body>
</html>