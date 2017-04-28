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
    // only run if the form was submitted
    
    // get data from form
    $fName = $_POST['fName'];
    $lName= $_POST['lName'];
    $cardNum= $_POST['cardNum'];
    $exp=$_POST['Exp'];
    $CVV=$_POST['CVV'];
    
	
    
   // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);    
    
    // check for required fields
    $isComplete = true;
    $errorMessage = "";

    if(!$fName){
        $errorMessage .= " Enter your first name. ";
        $isComplete = false;
    }
    if(!$lName){
        $errorMessage .= " Enter your last name. ";
        $isComplete = false;
    }
    if(!$cardNum){
        $errorMessage .= " Please enter card number. ";
        $isComplete = false;
    }
    /*if(strlen($cardNum !=16)){
        $errorMessage .="Card number invalid.  ";
        $isComplete=false;
    }*/
    if(!$exp){
        $errorMessage .= " Please enter expiration date. ";
        $isComplete = false;
    }


    if ($isComplete) {
        header("Location:checkingOut4.php");
        exit;
    }
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

<?php
include_once('myNav.php');

?>
    <!--we have the Nav, now the cool stuff starts check out AS GUEST-->
    <!--bread crumb place-->
    <ol class="breadcrumb">
        <li>Check Out</li>
        <li><a href="checkingOut0.php">Review Order</a></li>
        <li><a href="checkingOut1.php">Delivery Information</a></li>
        <li><a href="checkingOut2.php">Preferences</a></li>
        <li><a href="checkingOut3.php">Payment</a></li>
    </ol>
    
<?php
    include_once('config.php');
    include_once('dbutils.php');
    
?>


        <div class="row">
            <div class="col-xs-12">
                <h1>Payment Information</h1>
                
            </div>
        </div>
        
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
        echo ("success in entering " ."$email");
        unset($fname, $lname, $address, $stateID, $zip, $email);
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
            <div class="col-xs-8" style="padding-left:4%">
                
<form action="checkingOut3.php" method="post">

<!--first Name on card-->
<label>Name on Card</label>
    <div class="form-group">
        <label for="fName">First</label>
        <input type="text" class="form-control" name="fName"/>
        <label for="lName">Last </label>
        <input type="text" class="form-control" name="lName"/>
    </div>

<!--cardType-->
    <div class="form-inline">
        <label for "CardType">Card Type</label>
    <?php
    // connect to the database
    if (!isset($db)) {
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    }
    echo (generateDropdown2($db, "cardType", "CardName", "id"));        
    ?>
    </div>


<!--CardNumber-->
    <div class="form-group">
        <label for="cardNum">Card Number </label>
        <input type="number" class="form-control" name="cardNum"/>
    </div>
<!--expiration-->
    <div class="form-group">
        <label for="Exp">Expiration (mm/yy)</label>
        <input type="text" class="form-control" name="Exp"/>
    </div>
<!--CVV-->
    <div class="form-group">
        <label for="CVV">CVV </label>
        <input type="number" class="form-control" name="CVV"/>
    </div>
    <button type="submit" class="btn btn-default" name="submit">Submit</button>
</form>
                
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
  