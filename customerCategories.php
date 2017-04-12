<?php
// this kicks users out if they are not logged in
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: login-customer.php');
        exit;
    }

?>


<html>
    <head>

<title>Customer Categories</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
    </head>
    
     <body>
<?php 
    include_once('config.php');//these are NEEDED TO access and my databases and functions involved
    include_once('dbutils.php');
    //session_start();
?>



<div class="heading">
		<h1 style="color:gray">Store Name</h1>
	</div>
	
    
			<nav class="navbar navbar-inverse">
                 <div class="container-fluid">
                   <div class="navbar-header">
                     <a class="navbar-brand" href="customerHome.php">Store Name</a>
                   </div>
                   
                   <ul class="nav navbar-nav">
                     
                     <li class="active"><a href="customerCategories.php">Categories</a></li>
                                                
                   </ul>
                     
                     
               
                   
                   
                   <ul class="nav navbar-nav navbar-right">
                        <li><a href="customerCart.php">Cart <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                        <li><a href="customerSettings.php">Settings <span class="glyphicon glyphicon-cog"></span></a></li>
                        <li><a href="customerHelp.php">Help <span class="glyphicon glyphicon-question-sign"></span></a></li>
						<li><a href="customer-logout.php">Logout: <?php echo $_SESSION['email']; ?><span class="glyphicon glyphicon-user"></span></a></li>
                   </ul>

                 
                 
                </div>

                 
            </nav>
    


	
<div class = "row">
    <div class="col-xs-4" style="background-color:white">
    <!--Set up table-->
	<div class="panel panel-primary">
      <div class="panel-heading"><center>Main Categories</center></div>
	  <div class="panel-body">Select your grocery category below to explore our products.</div>
      
    </div>
    

<?php
$db=ConnectDB($DBHost, $DBUser,$DBPasswd,$DBName);

//then I set up a query
$query="SELECT categories.id,catName, count(catName) from SubCats join categories on SubCats.MainCatID=categories.id group by catName order by catName;";

//run the query
$result=queryDB($query,$db);

//show it
while($row =nextTuple($result)){
    $GETID=$row['id'];// this is the main id the subcategories are linked to
    echo "\n <div class='panel panel-info'>";
    echo "<div class='panel-heading'><a href='customerViewSubCats.php?id=$GETID'>" . "<center>" . $row['catName'] . "</center>" . "</a></div>"; 
    //echo "<div class='panel-body'> " . $row['subName'] . "</div>";//this needs to lead to a link showing sub cats based on id of Maincat

    echo "</div> \n "; //must close the table row object



}
?>




    
    </div>
</div>

</div>



</body>

</html>
  








        

