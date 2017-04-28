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
    $Time1 = $_POST['DeliveryTime-id'];
    $Time2= $_POST['DeliveryTime2-id'];
    $DDate= $_POST['dDate'];
    
	
    
   // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);    
    
    // check for required fields
    $isComplete = true;
    $errorMessage = "";

    if(!$DDate){
        $errorMessage .= " Select your preferred delivery date please.";
        $isComplete = false;
    }


    if ($isComplete) {
        $queryDate="SELECT CURDATE() as TD;";
        $result = queryDB($queryDate, $db);
        $row = nextTuple($result);
        $TodayDate=$row['TD'];
        $query="UPDATE orders set preferredTime1=$Time1, preferredTime2=$Time2, preferredDate='$DDate'
        where id=$order;";
        $result2=queryDB($query,$db);
        header("Location:checkingOut3.php");
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
    </ol>
    
<?php
    include_once('config.php');
    include_once('dbutils.php');
    
?>


        <div class="row">
            <div class="col-xs-12">
                <h1>Preferences</h1>
                
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
                
<form action="checkingOut2.php" method="post">

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

<!-- Date -->
    <div class="form-group">
        <label for="dDate">Date to be Delivered</label>
        <input type="date" class="form-control" name="dDate"/>
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
  