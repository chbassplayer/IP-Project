<html>
<head>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
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
    ?>

    <?php
    $SCid=$_GET['SCid'];
    $db=ConnectDB($DBHost, $DBUser,$DBPasswd,$DBName);
    $queryGetInfo="SELECT subName,MainCatID, catName from SubCats join categories on 
    categories.id=SubCats.MainCatID  where SubCats.id=$SCid;";
    $result=queryDB($queryGetInfo,$db);
    while($row =nextTuple($result)){
        $oldName=$row['subName'];
        $oldMain=$row['MainCatID'];
        $catName=$row['catName'];
    
    }
    if(isset($_POST['Back'])){
        header("Location:showSubCats.php?id=$oldMain");
        exit;
    }
    if(isset($_POST['deleteSUB'])){
        header("Location:deleteSubCats.php?SCid=$SCid");
        exit;
    }
    if (isset($_POST['submit'])){
    //then we process
    //get data from the form

    $newName = $_POST['SUBName'];
    $newMain=$_POST['categories-id'];

    $isComplete = true;
    $errorMessage = "";

    if(!$newName){
        $errorMessage .= "Please enter a category name .\n";
        $isComplete= false;
    }
    
    if($isComplete){
    $db=ConnectDB($DBHost, $DBUser,$DBPasswd,$DBName);
    $query="UPDATE SubCats set subName='$newName', MainCatID=$newMain where id=$SCid;";
    $result= queryDB($query,$db);
    //I for the living life of me cannot check if these are unique. I have tried and tried and tried....
   
    }

}

?>
<!-- Showing successfully entering Main category, if that actually happened -->
    <div class="row">
        <div class="col-xs-12">
        <?php
        if (isset($isComplete) && $isComplete==true) {
            echo '<div class="alert alert-success" role="alert">';
            echo ("Succesfully updated ". "$newName");
            echo '</div>';
            unset($newMain,$newName);
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


    <!--form for entering SUB Category-->
    <div class="row">
    <div class="col-xs-12" style="background-color:white">
        <form action=<?php echo "ChangeSubCats.php?SCid=".$SCid; ?> method="post">

    <!--category SUBName-->
    <div class="form-group">
        <label for="SUBName">New Sub-Category:</label>
        <input type="text" class="form-control" name="SUBName" value="<?php if($oldName) { echo $oldName; } ?>"/>
    </div>

    <div class="form-inline">
    <p><b>Main Category</b><p> <label  for "MainCat"></label>

    <?php
    // connect to the database
    if (!isset($db)) {
        $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    }
    
    echo (generateDropdown2($db, "categories", "catName", "id", $oldMain));        
    ?>
    </div>

    <button type="submit" class="btn btn-default" name="submit">Submit</button>
    <button type="submit" class="btn btn-default" name="deleteSUB">Delete</button>
    <div class="row"style="padding:4">
        <div class="col-xs-12">
        <button type="submit" class="btn btn-default" name="Back">Back to <?php echo $catName;?></button>
        </div>
    </div>

    
        </form>
    </div>
    </div>




  
</body>

</html>