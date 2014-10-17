<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/cancelorder.css" rel="stylesheet">
	<link href="css/topmargin.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Raleway:800|Titillium+Web:700' rel='stylesheet' type='text/css'>
     <!--<link href="css/mainmenu.css" rel="stylesheet">-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<?php session_start();
	$sqlconn=@mysqli_connect("localhost", "root", "", "scry") or die("There was a problem reaching the database.");?>
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
							<li class="active"><a href="orderparts.php">Order Parts</a></li>
							<li><a href="cancelorder.php">Cancel Order</a></li>
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
					<h3>Pending Orders:</h3>
					</div>
					<div class="row">
					<form method ="POST">
							<table class="table table-striped">
							<tr>
						
								<th style="width: 100px;">Cancel</th>
								<th>ID #</th>
								<th>Supplier Name</th>
								<th>Total Price</th>
								<th>Status</th>
							</tr>
							<!--samplerow-->
							<?php 
							$quer = " SELECT SUM(current_price*qty) as 'TOTAL PRICE', s.stock_order_id as ID, h.supplier_id as sad, status
							FROM stock_orders_t as s, stock_order_histories as h
							WHERE s.stock_order_id = h.stock_order_id
							AND status like \"Pending\"
							GROUP BY s.stock_order_id; ";
							
							$results = @mysqli_query($sqlconn,$quer);
							$display = "";
							while($histo = @mysqli_fetch_array($results))
							{
							$query = "SELECT name FROM suppliers_t
									WHERE supplier_id =".$histo['sad'].";";
							$res = @mysqli_query($sqlconn, $query);
							$name = @mysqli_fetch_array($res);
							$display.=("
							<tr>
								<td><div class=\"input-group\">
								<input type=\"checkbox\" name=\"".$histo['ID']."\" value =\"1\">
								</div></td>
								<td>".$histo['ID']."</td>
								<td>".$name['name']."</td>
								<td>".number_format($histo['TOTAL PRICE'], 2)."</td>
								<td>".$histo['status']."</td>
							</tr>");
							}
							echo $display;
							if($_SERVER['REQUEST_METHOD']="POST")
							{
								$toc="";
								$querylook = @mysqli_query($sqlconn, $quer);
								while($row = @mysqli_fetch_array($querylook))
								{
									$STRID = $row['ID'];
									if(isset($_POST[$STRID]))
									{
										$toc.="maynacancel";
										$query2 = "UPDATE stock_orders_t 
													SET status = \"Cancelled\"
													WHERE stock_order_id = ".$STRID.";";
										mysqli_query($sqlconn, $query2);
									}
								}
								if($toc=="")
								{
									echo "SELECT ORDER TO CANCEL";
								}
								else
								{
									header("Location: cancelorder2.php");
								}
							}
								@mysqli_close($sqlconn);?>
						</table>
					</div>
					<div class="row">
					<input type="submit" class="pull-right btn btn-primary btn-lg" role="button" id="submit">
					</form>
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
