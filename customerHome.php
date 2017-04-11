<?php
// this kicks users out if they are not logged in
    session_start();
    if (!isset($_SESSION['email'])) {
        header('Location: login-customer.php');
        exit;
    }

?>




<html lang="en">
<head>
    
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  

    
    <title>Customer Home</title>
    
</head>
<body>
	
	<?php
    include_once('config.php');
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
                     <li><a href="customerCategories.php">Categories</a></li>
                </ul>
                   
                   <ul class="nav navbar-nav navbar-right">
                        <li><a href="customer-logout.php"><?php echo $_SESSION['email']; ?><span class="glyphicon glyphicon-user"></span></a></li>
						<li><a href="customerCart.php">Cart <span class="glyphicon glyphicon-shopping-cart"></span></a></li>
                        <li><a href="customerSettings.php">Settings <span class="glyphicon glyphicon-cog"></span></a></li>
                        <li><a href="customerHelp.php">Help <span class="glyphicon glyphicon-question-sign"></span></a></li>
                   </ul>

                 
                 
                </div>

                 
            </nav>
    
    


</body>
</html>

