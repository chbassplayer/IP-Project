<html>
       <head>
<?php
    include_once('config.php');
    include_once('dbutils.php')
?>


<html>
    <head>

<title>Items</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
    </head>
    
     <body>



<div class="heading">
		<h1 style="color:gray">Store Name</h1>
	</div>
	
    
            <nav class="navbar navbar-inverse">
                 <div class="container-fluid">
                   <div class="navbar-header">
                     <a class="navbar-brand" href="customerHome.html">Store Name</a>
                   </div>
                   
                   <ul class="nav navbar-nav">
                     
                     <li class="active"><a href="customerCategories.php">Categories</a></li>
                                                
                   </ul>
                     
                     
               
                   
                   
                   <ul class="nav navbar-nav navbar-right">
                        <li><a href="login-customer.php">Login <span class="glyphicon glyphicon-user"></span></a></li>
                        <li><a href="customerCart.php">Cart <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                        <li><a href="customerSettings.php">Settings <span class="glyphicon glyphicon-cog"></span></a></li>
                        <li><a href="customerHelp.php">Help <span class="glyphicon glyphicon-question-sign"></span></a></li>
                   </ul>

                 
                 
                </div>

                 
            </nav>



<div class = "row">
    <div class="col-xs-4" style="background-color:white">
	</div>
	
<div class = "row">
    <div class="col-xs-4" style="background-color:white">
    <!--Set up table-->
	<div class="panel panel-primary">
      <div class="panel-heading"><center>Items</center></div>
	  
      
    </div>


<?php
    include_once('config.php');
    include_once('dbutils.php');
    $subCategory=$_GET['ID'];
    $storeID=$_GET['storeID'];
    //print "$gettID";
    $db = connectDB($DBHost, $DBUser, $DBPasswd, $DBName);
    $query="SELECT * FROM items WHERE Categor=$subCategory AND storeID=$storeID;";
    $result=queryDB($query,$db);
    while($row = nextTuple($result)) {
        $subName=$row['id'];
        echo "\n <div class='panel panel-info'>";
        echo "<div class='panel-heading'><a href='showItems.php?id=$subName'>" . "<center>" . $row['Nam'] . "</center>" . "</a></div>"; 
    
	 echo "</div> \n ";
       
        }
?>
   




    
   </body>
</html>