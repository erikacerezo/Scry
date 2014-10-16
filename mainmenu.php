<!DOCTYPE html>
<?php session_start();?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/mainmenu.css" rel="stylesheet">
     <!--<link href="css/mainmenu.css" rel="stylesheet">-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
 <div class="wrapper">
		<div class="container-fluid">
				<div class="row">
					<ul class="nav nav-pills">
							<li><a href="viewitem.php">View Item</a></li>
							<li><a href="viewcustomer.php">View Customer</a></li>
							<li><a href="viewsupplier.php">View Supplier</a></li>
							<li><a href="viewinvoice.php">View Invoice</a></li>
							<li><a href="viewstockorder.php">View Stock Order</a></li>
							<li><a href="../orderparts">Order Parts</a></li>
							<li><a href="../updateorder">Update Order</a></li>
							<?php
if($_SESSION["admin"] == 1)
{
echo "<li><a href=\"../checkaccount\">Check Accounting</a></li>";
} ?>
							<li><a href="../receivepay">Receive Payment</a></li>
							<li><a href="../pay">Pay Supplier</a></li>
							<li><a href="../logout"><span class="glyphicon glyphicon-off"></span></a></li>
					</ul>
					</div>
					</div>
			<div class="container-fluid">
					<div class="row">
					<div class="jumbotron">
			<center><h1>Welcome!</h1>
			<p>Click on the options above to start your session.</p></center>
					</div>
					</div>
				</div>
				
				<nav class="navbar navbar-default navbar-fixed-bottom">
				<div class="container">
						<span class="glyphicon glyphicon-star pull-right navbar-text"></span>
						<p class ="navbar-text pull-right">Powered by SCRY</p>
				</div> 
				</nav>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>