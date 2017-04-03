<?php
    session_start();

    if($_SESSION['email']==null){
        header('Location: store-login.php');
    }
    
    
?>
<html>
       <head>
<!-- Bootstrap links -->

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>        
<body>

   
    <!-- set up html table to show contents -->
<table class="table table-hover">
    <!-- headers for table -->
    <thead>
        <th>Subcategories</th>
    </thead>

<?php
    include_once('config.php');
    include_once('dbutils.php');
    $CatID=$_GET['id'];
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    $query="SELECT * from SubCats where MainCatID=$CatID;";
    $result=queryDB($query,$db);
    while($row = nextTuple($result)) {
        $subName=$row['subName'];
        echo "\n <tr>";
        echo "<td>" . $subName . "</td>";
        echo "\n <tr>";
       

        }
?>



    
</table>

    


    </body>
</html>