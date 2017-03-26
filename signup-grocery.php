<!-- This file enables users to login to the system -->
<!-- It also lists the contents of the table -->
<!-- It uses bootstrap for formatting -->
<!-- from usernames they are recognized as store or customer-->


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
                <h1>Customer Sign-up</h1>
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
	$password = $_POST['password'];
	$password2 = $_POST['password2'];
    
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
		$query = "SELECT * FROM customers WHERE email='" . $email . "';";
		$result = queryDB($query, $db);
		if (nTuples($result) == 0) {
			// if we're here it means there's already a user with the same email
			
			// generate the hashed version of the password
			$hashedpass = crypt($password, getSalt());
			
			// put together sql code to insert tuple or record
			$insert = "INSERT INTO customers(fname,lname,address,stateID,zip,email, hashedpass) VALUES ('" . $fname . "','" . $lname . "',
            '" . $address . "','" . $stateID . "','" . $zip . "','" . $email . "', '" . $hashedpass . "');";
		
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
            <div class="col-xs-12">
                
<form action="signup-grocery.php" method="post">

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