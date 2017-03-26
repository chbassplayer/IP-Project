<?php
//prompts if they wantto delete a particular item,
//it obtains an id variable to see if its in the table using a GET varisble in the URL
include_once('config.php');
include_once('dbutils.php');

if(!isset($_GET ['ID'])){
    //this is if the variable wasn't passed we will reroute them to another page
    header('Location: items.php');
    exit;

}
//does the id exists for the item id
//connect to the database
$db= connectDB($DBHost, $DBUser,$DBPasswd, $DBName);
//set up a query
$id=$_GET['ID'];
$query="SELECT * from items where ID=$id;";
$result=queryDB($query,$db);
//this is if there were no matches
if(nTuples($result)==0){
    header('Location: items.php');
    exit;
}
//now we know we have a valid item id through the get variable
$row=nextTuple($result);
$name=$row['Name'];
$brand=$row['Brand'];
?>
<html>
    <head>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>Delete <?php echo $brand. " ". $name;?></title>
    </head>
    <body>
    <!--Visibl Title-->
        <div class="row">
            <div class="col-xs-12">
            <h1>Are you sure you want to delete <?php echo $brand. " ". $name;?> </h1>
            </div>
        </div>

<?php
//takes them back to items page if they hit Cancel
if(isset($_POST['Cancel'])){
    header('Location: items.php');
    exit;
}
if(isset($_POST['yes'])){
$id=$_GET['ID'];

$db= connectDB($DBHost, $DBUser,$DBPasswd, $DBName);
$query="DELETE from items where ID=$id;";
queryDB($query,$db);
header('Location: items.php');
    exit;

}
?>
    <!--form to ask if they are cool-->
        <div class="row">
            <div class="col-xs-12">
            <p></p>
                <form action =<?php echo "deleteitems.php"."?ID="."$id";?> method="POST">
                <button type="submit" class="btn btn-default" name="yes">Yes</button>
                <button type="submit" class="btn btn-default" name="Cancel">Cancel</button>
            </div>
        </div>
    </body>
</html>