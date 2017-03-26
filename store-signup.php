<!-- This file enables users to login to the system -->
<!-- It also lists the contents of the table -->
<!-- It uses bootstrap for formatting -->
<!-- from usernames they are recognized as store or customer eventually.....-->


<?php
    include_once('config.php');
    include_once('dbutils.php');
    
?>

<html>
    <head>

<title>Sign-Up</title>

<!-- This is the code from bootstrap -->        
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
    </head>
    
     <body>

<!-- Visible title -->
        <div class="row">
            <div class="col-xs-12">
                <h1>Store Sign-up</h1>
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
    $storeName=$_POST['storeName'];
    $address=$_POST['address'];
    $stateID=$_POST['states-id'];
    $zip=$_POST['zip'];
    $MaxDelDis=$_POST['MaxDelDis'];
    $MaxDaysInAdvance=$_POST['MaxDaysInAdvance'];
    $TimeRestrict1=$_POST['times-id'];
    $TimeRestrict2=$_POST['times-id'];
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
    
   // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);    
    
    // check for required fields
    $isComplete = true;
    $errorMessage = "";

    if(!$storeName){
        $errorMessage .= " Please enter name of store. ";
        $isComplete = false;
    }

    if(!$MaxDelDis){
        $errorMessage .= "Please enter Max Delivery Distance. ";
        $isComplete= false;
    }

    if(!$MaxDaysInAdvance){
        $errorMessage .= "Please enter the Max Number of days in advance you can take an order. ";
        $isComplete=false;
    }

    if (!$email) {
        $errorMessage .= " Please enter an email.";
        $isComplete = false;
    } else {
        $email = makeStringSafe($db, $email);
    }

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
	    
	
    if ($isComplete) {
    
		// check if there's a user with the same email
		$query = "SELECT * FROM stores WHERE email='" . $email . "';";
		$result = queryDB($query, $db);
		if (nTuples($result) == 0) {
			// if we're here it means there's already a user with the same email
			
			// generate the hashed version of the password
			$hashedpass = crypt($password, getSalt());
			
			// put together sql code to insert tuple or record
			$insert = "INSERT INTO stores (storeName,address,stateID,zip, MaxDelDis ,MaxDaysInAdvance,TimeRestricts1,TimeRestricts2,email, hashedpass) VALUES ('" . $storeName . "',
            '" . $address . "', " . $stateID . " , " . $zip . " ," . $MaxDelDis . "," . $MaxDaysInAdvance . ",
            " . $TimeRestrict1 . "," . $TimeRestrict2 . ",'" . $email . "', '" . $hashedpass . "');";
		
			// run the insert statement
			$result = queryDB($insert, $db);
		
			
		} else {
			$isComplete = false;
			$errorMessage = "Sorry. We already have a user account under email " . $email;
		}
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
        <input type="email" class="form-control" name="email" value="<?php if($email) { echo $email; } ?>"/>
    </div>

<!-- password1 -->
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password"/>
    </div>

<!-- password2 -->
    <div class="form-group">
        <label for="password2">Enter Password Again</label>
        <input type="password" class="form-control" name="password2"/>
    </div>

    <button type="submit" class="btn btn-default" name="submit">Sign Up!</button>
</form>
                
            </div>
        </div>
            
</div>        

        
    </body>
    
</html>