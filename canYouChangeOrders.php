<!-- This file enables users to login to the system -->
<!-- It also lists the contents of the table -->
<!-- It uses bootstrap for formatting -->


<?php
    include_once('config.php');
    include_once('dbutils.php');
    session_start();
    if($_SESSION['email']==null){
        header('Location:store-login.php');
        exit;
    }
    
    ?>


<html>
    <head>

<title> Orders Permissions</title>

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
                <h1>Do you have Access</h1>
            </div>
        </div>
        
<!-- Processing form input -->        
        <div class="row">
            <div class="col-xs-12">
<?php
$orderiD=($_GET['id']);
if ($_SESSION['AccessOrders']=null){
        header("Location: canYouChangeOrders.php?id=$orderiD");
        exit;

    }


// Code to handle input from form
//

if (isset($_POST['submit'])) {

    // only run if the form was submitted
    
    // get data from form
    $empID = $_POST['employeeID'];

   // connect to the database
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);    
    
    // check for required fields
    $isComplete = true;
    $errorMessage = "";
    
    if (!$empID) {
        $errorMessage .= " Please enter your ID number.";
        $isComplete = false;
    }

    if (!$isComplete) {
        punt($errorMessage);
    }
   
    
    // get the hashed password from the user with the email that got entered
    $query = "SELECT orders FROM employees WHERE id=$empID;";
    $result = queryDB($query, $db);
    if (nTuples($result) > 0) {
        // then that account number exists
		$row =nextTuple($result);
        $answer = $row['orders'];
		
		// compare entered password to the password on the database
		if ($answer=true) {
			header("Location: UpdateOrder.php?id=$orderiD");
            exit;
            
			
			} else {
			// wrong password
			punt("Access Denied. <a href='canYouChangeOrders.php'>Try again</a>.");
            }
    }
}
?>
            </div>
        </div>

<!-- form for inputting data -->
        <div class="row">
            <div class="col-xs-12">
<?php echo "canYouChangeOrders.php?id="."$orderiD";?>
<form action=<?php echo "canYouChangeOrders.php?id=".$orderiD;?> method="post">
<!-- ID -->
    <div class="form-group">
        <label for="employeeID">Enter Your Employee ID please: </label>
        <input type="text" class="form-control" name="employeeID"/>
    </div>

    <button type="submit" class="btn btn-default" name="submit">Enter</button>
</form>
                
            </div>
        </div>
            
</div>        

        
    </body>
    
</html>