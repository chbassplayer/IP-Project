<?php
// this kicks users out if they are not logged in
    session_start();
    if (!isset($_SESSION['Cemail'])) {
        header('Location: login-customer.php');
        exit;
    }


?>




<html lang="en">
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

    
    <title>Customer Home</title>
    
</head>
<body>
	
	<?php
    include_once('config.php');
    include_once('dbutils.php');
    //session_start();
		
	?>
    
    <?php
		//testing code
		
    //get categories for drop down and start a session with a stream_wrapper_restore
    // for every page for this store it will have a consistent Store ID 
    //for now we hard code
    include_once('config.php');
    include_once('dbutils.php');
    session_start();
    //echo $_SESSION['startedOrder'];
    $_SESSION['StoreID']=1;
    $storeID=$_SESSION['StoreID'];
    $email=$_SESSION['Cemail'];
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);    
    $queryO="SELECT * from customers where email='$email';";
    $resultO = queryDB($queryO, $db);
    while($rowO = nextTuple($resultO)) {
        $custid=$rowO['id'];
        //echo "<p>Hello $custid</p>";
        $fnameO=$rowO['fname'];
        $lnameO=$rowO['lname'];
        $addressO=$rowO['address'];
        $stateIDO=$rowO['stateID'];
        $zipO=$rowO['zip'];
        $emailO=$rowO['email'];
    }
?>
	
	<div class="heading">
		<h1 style="color:gray">Store Name</h1>
	</div>
	

	
    
            <nav class="navbar navbar-inverse">
                 <div class="container-fluid">
                   <div class="navbar-header">
                     <a class="navbar-brand" href="customerHomeForEdits.php">Store Name</a>
                   </div>
				   
				   <ul class="nav navbar-nav navbar-right">
                   
                        <li style ="padding-top:2%; padding-bottom:1%">
                        <form method="post" action="customerItemsViewForEdits.php">
                            <input type="text" value="Search..." name="query" />
                            <input type="submit" value="Find" name="completedsearch" />
                        </form>
                        </li>

						<li><a href="customerCart.php">Cart <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                        <li><a href="customerSettings.php">Settings <span class="glyphicon glyphicon-cog"></span></a></li>
                        <li><a href="customerHelp.php">Help <span class="glyphicon glyphicon-question-sign"></span></a></li>
                        <?php
                        if($_SESSION['Cemail']==""){
                            echo "<li><a href='login-customer.php'>Login<span class='glyphicon glyphicon-user'></span></a></li>";
                        }
                        else{
                            echo "<li><a href='customer-logout.php'>Logout:". $_SESSION['Cemail']."<span class='glyphicon glyphicon-user'></span></a></li>";
                        }
                        ?>
						
                   </ul>
				   
				   
				   
				   
				   
				   
				   
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">

					<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories <span class="caret"></span></a>
					<ul class="dropdown-menu">
                            <?php    
                        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
                        $query="SELECT * from categories where StoreID=$storeID order by catName;";
                        $result = queryDB($query, $db);
                        while($row = nextTuple($result)) {
                            $categoryID=$row['id'];
                            $catName=$row['catName'];
				echo "<li class='dropdown-submenu'>";
					echo "<a class='test' tabindex='-1' href='customerShowBigCategory.php?id=$categoryID'>$catName<span class='caret'></span></a>";
					echo "<ul class ='dropdown-menu'>";
					$query1="SELECT id,subName from SubCats where StoreID=$storeID and MainCatID=$categoryID;";
					$result1 = queryDB($query1, $db);
                    echo  "<li><a tabindex='-1' href='customerShowBigCategory.php?id=$categoryID'>All $catName</a></li>";
					while($row1 = nextTuple($result1)) {
					$subName=$row1['subName'];
                    $subID=$row1['id'];
								
						echo"<li><a tabindex='-1' href='customerItemsViewForEdits.php?id=$subID'>$subName</a></li>";
					
					}
					echo"</ul>";
					echo "</li>";
					}
                        ?>
				   </div>
				   
				   
				   
				   
				   
				</div>

                 
            </nav>
			
			
			
			
			
			
			




<div class="row">
            <div class="col-xs-12">
                <h1>Update your information</h1>
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
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$custAddress = $_POST['custAddress'];
	$stateID = $_POST['states-id'];
	$custZip = $_POST['custZip'];
	
    
   // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);    
    
    // check for required fields
    $isComplete = true;
    $errorMessage = "";
    
    

    if (!$password) {
        $errorMessage .= " Please enter a password.";
        $isComplete = false;
    }
	
	if (!$password2) {
        $errorMessage .= " Please enter a password again.";
        $isComplete = false;
    }
	
	if ($password != $password2) {
		$errorMessage .= " Your two passwords are not the same.";
		$isComplete = false;
	}
	
	
	
	if (!$firstName) {
        $errorMessage .= " Please enter a first name.";
        $isComplete = false;
    }
	
	if (!$lastName) {
        $errorMessage .= " Please enter a last name.";
        $isComplete = false;
    }
	
	if (!$custAddress) {
        $errorMessage .= " Please enter an address.";
        $isComplete = false;
    }
	
	if (!$custZip) {
        $errorMessage .= " Please enter a zip code.";
        $isComplete = false;
    }
	

	
	
	    
	
    if ($isComplete) {
    
		// check if there's a user with the same email
		$query = "SELECT * FROM customers WHERE email='" . $email . "';";
		$result = queryDB($query, $db);
		if (nTuples($result) == 1) {
			// if we're here it means there's already a user with the same email
			
			$currentUser = $_SESSION['email'];
			
			// generate the hashed version of the password
			$hashedpass = crypt($password, getSalt());
			
			// put together sql code to insert tuple or record
			$insert= "UPDATE customers SET hashedpass = '$hashedpass', fname = '$fname', lname = '$lastName', address = '$custAddress', stateID = '$stateID', zip = '$custZip' WHERE email='$currentUser';";
			
		
			// run the insert statement
			$result = queryDB($insert, $db);
			
			// we have successfully inserted the record
			//echo ("Congratulations, " . $firstName . " you now have an account!");
		} //else {
			//$isComplete = false;
			//$errorMessage = "Sorry. We already have a user account under email " . $email;
		//}
	}
}
?>
            </div>
        </div>
		
<div class="row">
    <div class="col-xs-12">
<?php
    if (isset($isComplete) && $isComplete) {
        echo '<div class="alert alert-success" role="alert">';
        echo ("Congratulations, " . $firstName . " you have updated your account!");
        unset($firstName, $lastName, $custAddress, $stateID, $custZip, $email);
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
                
<form action="customerSettings.php" method="post">
	<?php $currentUser = $_SESSION['email'];?>
	<h1><strong><?php echo $currentUser;?></strong></h1>
<!-- email -->
    <!--<div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email"/>
    </div>-->

<!-- password1 -->
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password"/>
    </div>

<!-- password2 -->
    <div class="form-group">
        <label for="password2">Enter password again</label>
        <input type="password" class="form-control" name="password2"/>
    </div>

<!-- First Name -->
	<div class="form-group">
		<label for="firstName">First Name</label>
		<input type="text" class="form-control" name="firstName" value="<?php if($fnameO) { echo $fnameO; } ?>"/>
	</div>
	
<!-- Last Name -->
	<div class="form-group">
		<label for="lastName">Last Name</label>
		<input type="text" class="form-control" name="lastName" value="<?php if($lnameO) { echo $lnameO; } ?>"/>
	</div>

<!-- customer address -->
	<div class="form-group">
		<label for="custAddress">Address</label>
		<input type="text" class="form-control" name="custAddress" value="<?php if($addressO) { echo $addressO; } ?>"/>
	</div>
	
	
<!--State -->
<div class="form-group">
        <label for="custStateID">State: </label>
        <?php
        // connect to the database
        if (!isset($db)) {
            $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
        }
        echo (generateDropdown($db, "states", "stateName", "id", $stateIDO));        
        ?>
    </div>
	
<!--customer zip -->
	<!-- Last Name -->
	<div class="form-group">
		<label for="custZip">Zip Code</label>
		<input type="number" class="form-control" name="custZip" value="<?php if($zipO) { echo $zipO; } ?>"/>
	</div>





    
    <button type="submit" class="btn btn-default" name="submit">Update</button>
	
</form>
                
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

