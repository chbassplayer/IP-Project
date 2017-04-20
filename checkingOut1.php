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
<?php
    include_once('config.php');
    include_once('dbutils.php');
    session_start();
    //echo $_SESSION['startedOrder'];
    $_SESSION['StoreID']=1;
    $storeID=$_SESSION['StoreID'];
    $order=$_SESSION['startedOrder'];

?>

     <nav class="navbar navbar-inverse">
                 <div class="container-fluid">
                   <div class="navbar-header">
                     <a class="navbar-brand" href="customerHome.php">Store Name</a>
                   </div>
				   
				<ul class="nav navbar-nav">
                                                            
  <div class="dropdown" style="padding-top:8%">
    <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Categories
    <span class="caret"></span></button>
    <ul class='dropdown-menu'>;
       <?php    
    include_once('config.php');
    include_once('dbutils.php');
    $storeID=1;
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    $query="SELECT * from categories where StoreID=$storeID;";
    $result = queryDB($query, $db);
    while($row = nextTuple($result)) {
        $categoryID=$row['id'];
        $catName=$row['catName'];
            echo "<li class='dropdown-submenu'>";
                echo "<a class='test' tabindex='-1' href='#'>$catName<span class='caret'></span></a>";
                echo "<ul class ='dropdown-menu'>";
                $query1="SELECT subName from SubCats where StoreID=$storeID and MainCatID=$categoryID;";
                $result1 = queryDB($query1, $db);
                while($row1 = nextTuple($result1)) {
                $subName=$row1['subName'];
                
                    echo"<li><a tabindex='-1' href='#'>$subName</a></li>";
                }
                echo"</ul>";
                echo "</li>";
    }
        ?>
    
    </ul>
   
  </div>
      

        </ul>
        
            <ul class="nav navbar-nav navbar-right">
                <li style ="padding-top:2%; padding-bottom:1%"><input type="text" name="search" placeholder="Search.." style="border-radius:5px;"></li> 
                <li><a href="customer-logout.php"><?php echo $_SESSION['email']; ?><span class="glyphicon glyphicon-user"></span></a></li>
                <li><a href="customerCart.php">Cart <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                <li><a href="customerSettings.php">Settings <span class="glyphicon glyphicon-cog"></span></a></li>
                <li><a href="customerHelp.php">Help <span class="glyphicon glyphicon-question-sign"></span></a></li>
            </ul>
            <a class="btn btn-default" href="draftCustomerLogout.php" style="position:absolute; top:0; right:0;">Log Out <b></b></a>

            
            
        </div>

            
    </nav>
    <!--we have the Nav, now the cool stuff starts check out AS GUEST-->
    <!--bread crumb place-->
    <ol class="breadcrumb">
        <li>Check Out</li>
        <li><a href="checkingOut0.php">Review Order</a></li>
        <li><a href="checkingOut1.php">Delivery Information</a></li>
    </ol>
    
<?php
    include_once('config.php');
    include_once('dbutils.php');
    
?>


        <div class="row">
            <div class="col-xs-12">
                <h1>Delivery Information</h1>
                
            </div>
        </div>
        
<!-- Processing form input -->        
        <div class="row">
            <div class="col-xs-12">
<?php
//
// Code to handle input from form
//

if (isset($_POST['submit'])) {
    // only run if the form was submitted
    
    // get data from form
    $email = $_POST['email'];
    $fname= $_POST['fname'];
    $lname= $_POST['lname'];
    $address=$_POST['address'];
    $stateID=$_POST['states-id'];
    $zip=$_POST['zip'];
	
    
   // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);    
    
    // check for required fields
    $isComplete = true;
    $errorMessage = "";

    if(!$fname){
        $errorMessage .= " Please enter your first name.";
        $isComplete = false;
    }

    if(!$lname){
        $errorMessage .= " Please enter your last name.";
        $isComplete = false;
    }
    
    if (!$email) {
        $errorMessage .= " Please enter an email.";
        $isComplete = false;
    } else {
        $email = makeStringSafe($db, $email);
    }

    if ($isComplete) {
        $query="INSERT into customers (fname,lname,address,stateID,zip,email)VALUES('$fname','$lname','$address',$stateID,$zip,'$email');";
        $result=queryDB($query,$db);
        $customerID=mysqli_insert_id($db);
        $queryDate="SELECT CURDATE() as TD;";
        $result = queryDB($queryDate, $db);
        $row = nextTuple($result);
        $TodayDate=$row['TD'];
        $query2="UPDATE orders set customerID=$customerID,
        deliveryAddress='$address' ,deliveryState= $stateID,deliveryZIP=$zip,storeID=$storeID,orderDate='$TodayDate'
        where id=$order;";
        $result2=queryDB($query2,$db);
        $_SESSION['customerID']=$customerID;//will be used for next page

        header("Location: checkingOut2.php");
        exit;
        
        
        
    
    }
}
?>
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
            <div class="col-xs-12" style="padding-left:4%">
                
<form action="checkingOut1.php" method="post">

<!--First Name-->
    <div class="form-group">
        <label for "fname">First Name</label>
        <input type="text" class="form-control" name="fname" value="<?php if($fname) { echo $fname; } ?>"/>
    </div>

<!--Last Name-->
    <div class="form-group">
        <label for "lname">Last Name</label>
        <input type="text" class="form-control" name="lname" value="<?php if($lname) { echo $lname; } ?>"/>
    </div>

<!--Street Address-->
    <div class="form-group">
        <label for "address">Delivery Street Address</label>
        <input type="text" class="form-control" name="address" value="<?php if($address) { echo $address; } ?>"/>
    </div>

<!--State this should be from dropown-->
    <div class="form-group">
        <label for "stateID">Delivery State</label>
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
        <label for "zip">Delivery Zip Code</label>
        <input type="number" class="form-control" name="zip" value="<?php if($zip) { echo $zip; } ?>"/>
    </div>

<!-- email -->
    <div class="form-group">
        <label for="email">Email (for confirmation email)</label>
        <input type="email" class="form-control" name="email" value="<?php if($email) { echo $email; } ?>"/>
    </div>

    <button type="submit" class="btn btn-default" name="submit" style="position:absolute; right:10%">Submit</button>
</form>
<div class="row">
    <div class= "col-xs-12" style="position:absolute; right:10%;">
    <a class="btn btn-default" href="login-customer.php" style="position:absolute; top:0; right:12%;">Log In <b></b></a>
    </div>
<div>
                
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
  