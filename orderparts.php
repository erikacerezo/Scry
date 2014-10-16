<!DOCTYPE html>
<html lang="en">
  <head>
	<?php session_start(); 
		$_SESSION['order']="";
	?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/orderparts.css" rel="stylesheet">
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
	$quer = "SELECT p.part_id as ID, p.part_name as name, p.price as price, p.part_detail as des from suppliers_t as s, parts_t as p, supplied_parts as sp WHERE ";?>
 <div class="wrapper">

		<div class="container-fluid">
				<div class="row">
					<ul class="nav nav-pills">
							<li><a href="viewitem.php">View Item</a></li>
							<li><a href="viewcustomer.php">View Customer</a></li>
							<li><a href="viewsupplier.php">View Supplier</a></li>
							<li><a href="viewinvoice.php">View Invoice</a></li>
							<li><a href="viewstockorder.php">View Stock Order</a></li>
							<li class="active"><a href="orderparts.php">Order Parts</a></li>
							<li><a href="updateorder.php">Update Order</a></li>
							<?php if($_SESSION['admin'] == 1){
							echo "<li><a href=\"checkaccount.php\">Check Accounting</a></li>";}?>
							<li><a href="receivepay.php">Receive Payment</a></li>
							<li><a href="pay.php">Pay Supplier</a></li>
							 <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span></a></li>
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
										<strong>SUPPLIER</strong>
										<span class="caret"></span>
										</button>
										
										
													<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
													<?php 
													$q = "SELECT name FROM suppliers_t;";
													$result = @mysqli_query($sqlconn, $q);
													while($name = @mysqli_fetch_array($result))
													{
													$n = $name['name'];
													echo
													"<li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"?supplier=$n\">$n</a></li>";
													}
													?></ul>
											</div>
									</div>
							</div>
							<?php 
							
							
							if(isset($_GET['supplier']))
							{
							$_SESSION['supp'] = $_GET['supplier']; 
							echo "<div class=\"col-md-10\">
							<div class=\"row\">
							<table class=\"table table-striped\">
							<tr>
								<th></th>
								<th>ID #</th>
								<th>Product Name</th>
								<th>Product Description</th>
								<th>Price</th>
								<th style=\"width: 120px;\">Quantity</th>
							</tr>";
					
							$quer.= "s.name LIKE \"".$_GET['supplier']."\"
										AND s.supplier_id = sp.supplier_id
										AND p.part_id = sp.part_id;";
	
							$result = @mysqli_query($sqlconn, $quer);
							$display ="";
							echo "<form role=\"form\" method=\"POST\">";
							while($row = @mysqli_fetch_array($result))
							{
							
							
							$display.=("<tr>
								<td><div class=\"input-group\">
								<input type=\"checkbox\" name=\"".$row['ID']."a\" value=1>
								</div></td>
								<td>".$row['ID']."</td>
								<td>".$row['name']."</td>
								<td>".$row['des']."</td>
								<td>".number_format($row['price'],2)."</td>
								<td>
								<div class=\"form-group\">
								<input type=\"text\" class=\"form-control\" name=\"".$row['ID']."\" id=\"quantity\">
								</div>
							</td>
							</tr>");
							
							}
				
						echo "$display
						</table>
					</div>
					<div class=\"row\">
					<input  type = \"submit\" class=\"pull-right btn btn-primary btn-lg\" role=\"button\" id=\"submit\" >
					</form>";
					
					if($_SERVER["REQUEST_METHOD"]=="POST")
							{
								
								$_SESSION['string']="";
								$index = 0;
								$results = @mysqli_query($sqlconn, $quer);
								while($rows = @mysqli_fetch_array($results))
								{
							
									$name = $rows['ID']."a";
									if(isset($_POST[$name]))
									{
										$ID = $rows['ID'];
										if(isset($_POST[$ID])&& $_POST[$ID] > 0)
										{
										
											$_SESSION['string'].= $ID.";".$_POST[$ID].";";
											
										}
										
									}
								}
							if($_SESSION['string']=="")
							{
								echo "SELECT ITEMS TO ORDER!";
							}
							else
							header("Location: orderparts2.php");
							}
							}
							
						
					
					
					
					else 
					{
						echo "Please select a supplier!";
					}
					
					
					@mysqli_close($sqlconn);?>
					</div>
				</div>
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