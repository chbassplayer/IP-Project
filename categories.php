
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
    <?php 
    include_once('config.php');//these are NEEDED TO access and my databases and functions involved
    include_once('dbutils.php');
    session_start();

    if($_SESSION['email']==null){
        header('Location: store-login.php');
    }
    //get store Name
    $storeID=$_SESSION['storeID'];
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    $query="SELECT storeName from stores where id=$storeID;";
    $result = queryDB($query, $db);
    $row = nextTuple($result);
    $storeName=$row['storeName'];
    ?>
    <div class="heading">
		<h1 style="color:gray"><?php echo $storeName;?></h1>
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
    
//php to manange submissions of main categories-->
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
    $query="INSERT INTO categories(catName,StoreID) VALUES('$catName',$storeID);";
    $result= queryDB($query,$db);
    //I for the living life of me cannot check if these are unique. I have tried and tried and tried....
   
    }

}

?>

<?php
if (isset($_POST['submitSUB'])){
    //then we process
    //get data from the form

    $SUBName = $_POST['SUBName'];
    $MainCatID=$_POST['categories-id'];

    $isComplete = true;
    $errorMessage = "";

    if(!$SUBName){
        $errorMessage .= "Please enter a name for the subcategory .\n";
        $isComplete= false;
    }

    if(!$MainCatID){
        $errorMessage .= "Please enter the Main Category for the subcategory .\n";
        $isComplete= false;

    }

    
    if($isComplete){
    $db=ConnectDB($DBHost, $DBUser,$DBPasswd,$DBName);
    $query="INSERT INTO SubCats(subName,MainCatID,StoreID) VALUES('$SUBName',$MainCatID,$storeID);";
    $result= queryDB($query,$db);
    }
}
?>


<div class="row">
    <div class="col-xs-2">
    </div>
    <div class="col-xs-8" style="background-color:white">
<h1>Manage Categories</h1>
    <!-- Showing successfully entering Main category, if that actually happened -->
    <div class="row">
        <div class="col-xs-12">
        <?php
        if (isset($isComplete) && $isComplete==true) {
            echo '<div class="alert alert-success" role="alert">';
            echo ("Succesfully entered ". "$catName". "$SUBName");
            echo '</div>';
            unset($catName,$SUBName);
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
<?php
    if (isset($_POST['submitSUB']) && !$isComplete) {
        echo '<div class="alert alert-danger" role="alert">';
        echo ($errorMessage);
        echo '</div>';
    }
?>            
    </div>
</div>
    
    
    <!--form for entering Main Category-->
    <div class="row">
    <div class="col-xs-12" style="background-color:white">
        <form action="categories.php" method="post">

    <!--category Name-->
    <div class="form-group">
        <label for="catName">New Main Category:</label>
        <input type="text" class="form-control" name="catName" value="<?php if($catName) { echo $catName; } ?>"/>
    </div>

    <button type="submit" class="btn btn-default" name="submit">Submit</button>
        </form>
    </div>
    </div>

    <!--form for entering SUB Category-->
    <div class="row">
    <div class="col-xs-12" style="background-color:white">
        <form action="categories.php" method="post">

    <!--category SUBName-->
    <div class="form-group">
        <label for="SUBName">New Sub-Category:</label>
        <input type="text" class="form-control" name="SUBName" value="<?php if($SUBName) { echo $SUBName; } ?>"/>
    </div>

    <div class="form-inline">
    <p><b>Main Category</b><p> <label  for "MainCat"></label>

    <?php
    // connect to the database
    if (!isset($db)) {
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    }
    echo (generateDropdown2($db, "categories", "catName", "id", $MainCatID));        
    ?>
    </div>

    <button type="submit" class="btn btn-default" name="submitSUB">Submit</button>
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
            <th>Main Categories</th>
            <th>Change Main</th>
            <th>Sub-Categories</th>
        </thead>

        <?php
$db=ConnectDB($DBHost, $DBUser,$DBPasswd,$DBName);

//then I set up a query
$query="SELECT categories.id,catName,count(catName) from SubCats join categories on SubCats.MainCatID=categories.id where
categories.StoreID=$storeID group by catName order by count(catName);";

//run the query
$result=queryDB($query,$db);

//show it
while($row =nextTuple($result)){
    $GETID=$row['id'];// this is the main id the subcategories are linked to
    echo "\n <tr>";
    echo "<td>" . $row['catName'] . "</td>"; 
    echo "<td><a href='ChangeCats.php?id=$GETID'>". "Change". "</a></td>";
    echo "<td><a href='showSubCats.php?id=$GETID'> " . $row['count(catName)'] . "</a></td>";//this needs to lead to a link showing sub cats based on id of Maincat

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