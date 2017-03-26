<html>
    <head>
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title> </title>
    </head>
    
    <body>
        <h1>Manage Categories</h1>
<!--check if button pressed and complete form -->
<?php
    include_once('config.php');
    include_once('dbutils.php');
    $db=ConnectDB($DBHost, $DBUser,$DBPasswd,$DBName);
    //first i need to check if the button was pressed
    if (isset($_POST['submit'])){
    //then we process
    //get data from the form
    $catName=$_POST['catName'];
    $isComplete = true;
    $errorMessage = "";

    if(!$catName){
        $errorMessage .= "Please enter a category .\n";
        $isComplete= false;
    }
    
    if($isComplete){
    $db=ConnectDB($DBHost, $DBUser,$DBPasswd,$DBName);
    $query="INSERT INTO categories (catName) VALUES('$catName');";
    $result= queryDB($query,$db);
    }
    
    
}

?>

<!-- Showing successfully entering pizza, if that actually happened -->
<div class="row">
    <div class="col-xs-12">
<?php
    if (isset($isComplete) && $isComplete==true) {
        echo '<div class="alert alert-success" role="alert">';
        echo ("Succesfully entered ". "$catName");
        echo '</div>';
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

<!--FORM FOR ENTERING-->
    <div class="row">
        <div class="col-xs-12">
        <form action="manage-categories.php" method="post">
        <!--Name-->
        <div class="form-group">
            <label for="catName">Name:</label>
            <input type="text" class="form-control" name="catName"/>
        </div>
        
        <!--now we need to be able to submit the information-->
        <button type="submit" class="btn btn-default" name="submit">Save</button>

        </form>
        </div>
    </div>
    

<!--here is html for table stuff-->
    <div class="row">
        <div class= "col-xs-12">
            <table class="table table-hover">
            <!--headers-->
            <thead>
                <th>ID</th>
                <th>Name</th>
            </thead>
             <?php
    
    //good now we need to see that data:
    //right now I just want to see Name and ID
    $query='select * from categories;';
    $result=queryDB($query,$db);
    //also need to be shown in a table format with all attributes for store
    //to show it you need to set a while loop, 
    while ($row =nextTuple($result)){
        echo "\n <tr>";//here tr is table row and we need to make new one for each result
        echo "<td>" . $row['id'] . "</td>";//td is table data 
        echo "<td>" .$row['catName'] . "</td>";
        
    }

    ?>

            </table>
        </div>
    </div>
    

    
    </body>
    </html>