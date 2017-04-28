<?php
    include_once('config.php');
    include_once('dbutils.php');
    session_start();
    $storeID=1;

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


        <div class="row">
            <div class="col-xs-12">
                <h1>Thank You</h1>
                <h3>Confirmation Number <?php echo $_SESSION['startedOrder'];?></h3>
                <h4>Save this number to check the status of your order.</h4>
            </div>
        </div>  
<?php
unset ($_SESSION['startedOrder']);
unset ($_SESSION['customerID']);
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
  