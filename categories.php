<?php
session_start();


?>
<!DOCTYPE html>
<html>
<head>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="grocery.css">
    <title>Categories</title>
</head>
<body>
    <div class="heading">
		<h1 style="color:gray">Store Name</h1>
        <a class="btn btn-default" href="store-logout.php" style="position:absolute; top:0; right:0;">Log Out</a>
	</div>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
            <ul class="nav navbar-nav">
			    <li><a href="Manager_Home.html">Home</a></li>
			    <li class ="active"><a href="categories.php">Categories</a></li>
                <li><a href="items.php">Items</a></li>
			    <li><a href="ManageOrders.php">Orders</a></li>
                <li><a href="ManageStore.php">Store</a></li>
                <li><a href="ManageEmployees.php">Employees</a></li>
                <li><a href="ManageCustomers.php">Customers</a></li>
                <li><a href="CustomerView.php">Store Front</a></li>
		    </ul>
            </div>
        </div>
    </nav>
    <?php
include_once('config.php');//these are NEEDED TO access and my databases and functions involved
include_once('dbutils.php');
session_start();

    if($_SESSION['email']==null){
        header('Location: store-login.php');
    }
    
//php to manange submissions-->
//do we need to process data-->
if (isset($_POST['submit'])){
    //then we process
    //get data from the form

    $catName = $_POST['catName'];

    $isComplete = true;
    $errorMessage = "";

    if(!$catName){
        $errorMessage .= "Please enter a category name .\n";
        $isComplete= false;
    }
    
    if($isComplete){
    $db=ConnectDB($DBHost, $DBUser,$DBPasswd,$DBName);
    $query="INSERT INTO categories(catName) VALUES('$catName');";
    $result= queryDB($query,$db);
    //I for the living life of me cannot check if these are unique. I have tried and tried and tried....
   
    }

}

?>
<div class="row">
    <div class="col-xs-2">
    </div>
    <div class="col-xs-8" style="background-color:white">
<h1>Manage Categories</h1>
    <!-- Showing successfully entering category, if that actually happened -->
    <div class="row">
        <div class="col-xs-12">
        <?php
        if (isset($isComplete) && $isComplete==true) {
            echo '<div class="alert alert-success" role="alert">';
            echo ("Succesfully entered ". "$catName");
            echo '</div>';
            unset($catName);
            }
        ?>            
    </div>
</div>
<!-- Showing errors, if any -->
<div class="row">
    <div class="col-xs-12">
<?php
    if (isset($_POST['submit']) && !$isComplete) {
        echo '<div class="alert alert-danger" role="alert">';
        echo ($errorMessage);
        echo '</div>';
    }
?>            
    </div>
</div>
    
    
    
    <div class="row">
    <div class="col-xs-12" style="background-color:white">
        <form action="categories.php" method="post">

    <!--category Name-->
    <div class="form-group">
        <label for="catName">New Category:</label>
        <input type="text" class="form-control" name="catName" value="<?php if($catName) { echo $catName; } ?>"/>
    </div>

    <button type="submit" class="btn btn-default" name="submit">Submit</button>
    </form>
    </div>
</div>
<!--show contents of car table-->
<div class = "row">
    <div class="col-xs-12" style="background-color:white">
    <!--Set up table-->
    <table class="table table-hover">
        <!--headers in table-->
        <thead>
            <th>ID</th>
            <th>Category Name</th>
        </thead>

        <?php
$db=ConnectDB($DBHost, $DBUser,$DBPasswd,$DBName);

//then I set up a query
$query="SELECT * from categories;";

//run the query
$result=queryDB($query,$db);

//show it
while($row =nextTuple($result)){
    echo "\n <tr>";
    echo "<td>" . $row['id'] . "</td>"; 
    echo "<td>" . $row['catName'] . "</td>";

    echo "</tr> \n "; //must close the table row object
}
?>


    </table>
    </div>
</div>
</div>
</div>
</body>

</html>