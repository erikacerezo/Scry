<!DOCTYPE html>
<html lang="en">
<?php session_start();?>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/topmargin.css" rel="stylesheet">
	<link href="css/viewitem.css" rel="stylesheet">
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
  <?php
	$sqlconn=@mysqli_connect("localhost", "root", "", "scry") or die("There was a problem reaching the database.");
	$quer = "SELECT * FROM suppliers_t ";?>
 <div class="wrapper">
		<div class="container-fluid">
				<div class="row">
					<ul class="nav nav-pills">
							<li><a href="viewitem.php">View Item</a></li>
							<li class="active"><a href="viewcustomer.php">View Customer</a></li>
							<li><a href="viewsupplier.php">View Supplier</a></li>
							<li><a href="viewinvoice.php">View Invoice</a></li>
							<li><a href="viewstockorder.php">View Stock Order</a></li>
							<li><a href="../orderparts">Order Parts</a></li>
							<li><a href="../updateorder">Update Order</a></li>
							<?php if($_SESSION['admin'] == 1){
							echo "<li><a href=\"../checkaccount\">Check Accounting</a></li>";}?>
							<li><a href="../receivepay">Receive Payment</a></li>
							<li><a href="../pay">Pay Supplier</a></li>
							 <li><a href="../logout"><span class="glyphicon glyphicon-off"></span></a></li>
					</ul>
					</div>
					</div>
		
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
										<strong>SORT BY</strong>
										<span class="caret"></span>
										</button>
													<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
													<li role="presentation"><a role="menuitem" tabindex="-1" href="?sort_by=supplier_id">ID #</a></li>
													<li role="presentation"><a role="menuitem" tabindex="-1" href="?sort_by=name">Name</a></li>
													</ul>
									</div>
							</div>
							<div class="row">
									<div class="dropdown">
										<!--<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown">-->
										<strong>SEARCH BY</strong>
										<span class="caret"></span>
										<form method="POST" role="form" >
										<select name="search">
													<!--<select class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">-->
													<option value="supplier_id"><a role="menuitem" tabindex="-1">ID #</a></option>
													<option value="name"><a role="menuitem" tabindex="-1" href="#">Name</a></option>
													<option value="address"><a role="menuitem" tabindex="-1" href="#">Address</a></option>
													</select>
									</div>
							</div>
							<div class="row">
							<!--	<form role="form">-->
								<div class="form-group">
								<input type="text" name="q" class="form-control" id="search">
								</div>
							</form>
							</div>
					</div>
						<div class="col-md-10">
						<table class="table table-striped">
							<tr>
								<th>ID #</th>
								<th>Supplier Name</th>
								<th>Contact Number</th>
								<th>Address</th>
							</tr>
							<!--samplerow-->
							<tr><?php 
								
								if(isset($_POST['q']))
								{
									$quer.="WHERE ".$_POST['search']." LIKE \"%".$_POST['q']."%\"";
								}						
								if(isset($_GET['sort_by']))
								{
									$quer.="ORDER BY ".$_GET['sort_by'].";";
								}
								else
								{
									$quer.=";";
								}
								
								$result = @mysqli_query($sqlconn, $quer);
								if(@mysqli_num_rows($result) == 0)
								{
									echo "<td>No items found</td>.";
								}else
								{
								$temp ="";
								while($row = @mysqli_fetch_array($result))
								{
								$temp.= ("<tr><td>".$row['supplier_id']."</td>
								<td>".$row['name']."</td>
								<td>".$row['contact_num']."</td>
								<td>".$row['address']."</td>
								</tr>");
								}
								echo $temp;
						
								}@mysqli_close($sqlconn);
	?>
						</table>
						</div>
						
				</div>
			</div>
		</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>