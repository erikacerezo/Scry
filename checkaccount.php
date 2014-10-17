<!DOCTYPE html>
  <?php session_start()?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/topmargin.css" rel="stylesheet">
	<link href="css/checkaccount.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Raleway:800|Titillium+Web:700' rel='stylesheet' type='text/css'>
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
							<?php if($_SESSION['admin'] == 1){
							echo "<li><a href=\"viewinvoice.php\">View Invoice</a></li>
							<li><a href=\"viewstockorder.php\">View Stock Order</a></li>
							";}?>
							<li ><a href="orderparts.php">Order Parts</a></li>
							<li><a href="cancelorder.php">Cancel Order</a></li>
							<li><a href="receivepay.php">Receive Payment</a></li>
							<li><a href="pay.php">Pay Supplier</a></li>
							 <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span></a></li>
					</ul>
					</div>
					</div>
					
					  <?php
	$sqlconn=@mysqli_connect("localhost", "root", "", "scry") or die("There was a problem reaching the database.");
	if(isset($_GET['check']))
	{
		$_SESSION['check']=$_GET['check'];
	}
	else
	{
		$_SESSION['check']="pay";
	}
	?>
		
				<nav class="navbar navbar-default navbar-fixed-bottom">
				<div class="container">
						<span class="glyphicon glyphicon-star pull-right navbar-text"></span>
						<p class ="navbar-text pull-right">Powered by SCRY</p>
				</div> 
				</nav>
		<div	 class="laman">
			<div class="container-fluid">
					<div class="row">
						<div class="col-md-2">
							<div class="row">
									<div class="dropdown">
										<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
										<strong>VIEW</strong>
										<span class="caret"></span>
										</button>
													<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">

													<li role="presentation"><a role="menuitem" tabindex="-1" href="?check=receive">Accounts Receivable</a></li>
													<li role="presentation"><a role="menuitem" tabindex="-1" href="?check=pay">Accounts Payable</a></li>
													</ul>
									</div>
							</div>
							<?php 
							
							
							
							
							if($_SESSION['check'] == "receive")
							{
							$quer = "SELECT i.invoice_id as ID, c.name as name, SUM(current_price*qty)";
							
							echo "
							 
							
							<div class=\"row\">
								<form role=\"form\">
								<div class=\"form-group\">
								<input type=\"text\" class=\"form-control\" id=\"search\" placeholder=\"Enter Query\">
								</div>
							</form>
							</div>
					</div>
						<div class=\"col-md-10\">
						<table class=\"table table-striped\">
							<tr>
								<th>ID #</th>
								<th>Product Name/s</th>
								<th>Quantity</th>
								<th>Amount</th>
								<th>Supplier/Customer</th>
							</tr>
							<!--samplerow-->
							<tr>
								<td>123</td>
								<td>Papa Cologne, Nanay Mo.</td>
								<td>3, 5</td>
								<td>$10000</td>
								<td>Lance Yap</td>
						</table>
						</div>";
						
						}
						
						else
						
						{
						
						
						}
						?>
						
				</div>
			</div>
		</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
