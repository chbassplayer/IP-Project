<html>
<head>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <title>Delete Main Categories</title>
</head>
<body>


    
    <?php
include_once('config.php');//these are NEEDED TO access and my databases and functions involved
include_once('dbutils.php');
session_start();

    if($_SESSION['email']==null){
        header('Location: store-login.php');
    }
    $storeID=$_SESSION['storeID'];
    ?>

    <?php
    $id=$_GET['id'];
    $db=ConnectDB($DBHost, $DBUser,$DBPasswd,$DBName);
    $query1="SELECT catName from categories where id=$id and StoreID=$storeID;";
    $result1=queryDB($query1,$db);
    while($row =nextTuple($result1)){
        $catName=$row['catName'];


    }



    
    if(isset($_POST['Yes'])){
        $db=ConnectDB($DBHost, $DBUser,$DBPasswd,$DBName);
        $query="DELETE from categories where id=$id and StoreID=$storeID;";
        $result= queryDB($query,$db);
        $query2="DELETE from SubCats where MainCatID=$id and StoreID=$storeID;";
        $result2=queryDB($query2,$db);
        header('Location: categories.php');

    }
    if (isset($_POST['No'])){
    header("Location: ChangeCats.php?id=$id");
    }
?>         
    <div class ="row">
    <div class="col-xs-12">
        <h1> Are you sure you want to delete <?php echo $catName;?></h1>

    <!--form for entering SUB Category-->
    <div class="row">
    <div class="col-xs-12" style="background-color:white">
        <form action=<?php echo "deleteCats.php?id=".$id; ?> method="post">

    <button type="submit" class="btn btn-default" name="Yes">Yes</button>
    <button type="submit" class="btn btn-default" name="No">No</button>
        </form>
    </div>
    </div>
    






  
</body>

</html>