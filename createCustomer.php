<!-- This file provides input capabalities into a table of users -->
<!-- It also lists the contents of the table -->
<!-- It uses bootstrap for formatting -->

<!-- Author: Juan Pablo Hourcade -->

<?php
    include_once('config.php');
    include_once('dbutils.php');
    
?>

<html>
    <head>

<title>Create New Customer</title>

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
                <h1>New Customer Sign Up</h1>
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
		if (nTuples($result) == 0) {
			// if we're here it means there's already a user with the same email
			
			// generate the hashed version of the password
			$hashedpass = crypt($password, getSalt());
			
			// put together sql code to insert tuple or record
			$insert = "INSERT INTO customers(email, hashedpass, fname, lname, address, stateID, zip) VALUES ('" . $email . "', '" . $hashedpass . "', '" . $firstName . "', '" . $lastName . "','" . $custAddress . "','" . $stateID . "', '" . $custZip . "');";
		
			// run the insert statement
			$result = queryDB($insert, $db);
			
			// we have successfully inserted the record
			//echo ("Congratulations, " . $firstName . " you now have an account!");
		} else {
			$isComplete = false;
			$errorMessage = "Sorry. We already have a user account under email " . $email;
		}
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
        echo ("Congratulations, " . $firstName . " you now have an account!");
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


<!-- Button to return to login page -->
<div class="row">
        <div class="col-sm-12">
        
        <a class="btn btn-default" href="login-customer.php" role="button"><span class="glyphicon glyphicon-arrow-left"></span>Return to login Page. </a>
        </div>
    </div>



<!-- form for inputting data -->
        <div class="row">
            <div class="col-xs-12">
                
<form action="createCustomer.php" method="post">
<!-- email -->
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email"/>
    </div>

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
		<input type="text" class="form-control" name="firstName"/>
	</div>
	
<!-- Last Name -->
	<div class="form-group">
		<label for="lastName">Last Name</label>
		<input type="text" class="form-control" name="lastName"/>
	</div>

<!-- customer address -->
	<div class="form-group">
		<label for="custAddress">Address</label>
		<input type="text" class="form-control" name="custAddress"/>
	</div>
	
	
<!--State -->
<div class="form-group">
        <label for="custStateID">State: </label>
        <?php
        // connect to the database
        if (!isset($db)) {
            $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
        }
        echo (generateDropdown($db, "states", "stateName", "id", $stateID));        
        ?>
    </div>
	
<!--customer zip -->
	<!-- Last Name -->
	<div class="form-group">
		<label for="custZip">Zip Code</label>
		<input type="number" class="form-control" name="custZip"/>
	</div>





    
    <button type="submit" class="btn btn-default" name="submit">Sign Up!</button>
</form>
                
            </div>
        </div>
      

        
    </body>
    
</html>