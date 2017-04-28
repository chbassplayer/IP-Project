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
    //if its pushed we need to move it to the store and Thank Them
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    $query="UPDATE orders set orderStatus=0 where id=$order;";
    $result=queryDB($query,$db);
    header("Location:thankYou.php");
    exit;

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
        <li><a href="checkingOut4.php">Complete</a></li>
    </ol>
    
<?php
    include_once('config.php');
    include_once('dbutils.php');
    
?>


        <div class="row">
            <div class="col-xs-12">
                <h1>Are you sure you want to complete your order?</h1>
                
            </div>
        </div>
        

<!-- form for inputting data -->
        <div class="row">
            <div class="col-xs-8" style="padding-left:4%">
                
<form action="checkingOut4.php" method="post">


    <button type="submit" class="btn btn-default" name="submit">Yes</button>
</form>
<a class="btn btn-default" href="checkingOut0.php">No <b></b></a>
                
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
  