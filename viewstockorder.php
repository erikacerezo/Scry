<!DOCTYPE html>
<html lang="en">
<?php session_start();
if($_SESSION["login"]!="IN")
  {
		header("Location: login.php");
  }
  ?>
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
	
	if($_SESSION['admin']!=1)
		{
			header("Location: mainmenu.php");
		}
  
	$sqlconn=@mysqli_connect("localhost", "root", "", "scry") or die("There was a problem reaching the database.");
	$quer = "SELECT "
			."stock_orders_t.stock_order_id as orderID, "
			."stock_orders_t.date_ordered as dateOrdered, "
			."stock_orders_t.status as orderStat, "
			."STOCK_ORDER_HISTORIES.current_price as currPrice, "
			."STOCK_ORDER_HISTORIES.qty as quant, "
			."suppliers_t.name as supName, "
			."suppliers_t.address as supAdd, "
			."parts_t.part_name as partName "
			."FROM STOCK_ORDER_HISTORIES,stock_orders_t,suppliers_t,parts_t ";?>
 <div class="wrapper">
		<div class="container-fluid">
				<div class="row">
					<ul class="nav nav-pills">
							<li><a href="viewitem.php">View Item</a></li>
							<li><a href="viewcustomer.php">View Customer</a></li>
							<li><a href="viewsupplier.php">View Supplier</a></li>
							<?php if($_SESSION['admin'] == 1){
							echo "<li><a href=\"viewinvoice.php\">View Invoice</a></li>
							<li class=\"active\"><a href=\"viewstockorder.php\">View Stock Order</a></li>
							";}?>
							<li><a href="orderparts.php">Order Parts</a></li>
							<li ><a href="sellparts.php">Sell Parts</a></li>
							<li><a href="cancelorder.php">Cancel Order</a></li>
							
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
							</div>
							<div class="row">
									
							</div>
							<div class="row">
							<!--	<form role="form">-->
							<form method = "POST">
								<div class="form-group">
								<input type="text" name="q" class="form-control" id="search">
								</div>
							</form>
							</div>
					</div>
						<div class="col-md-10">
						<table class="table table-striped">
							<tr>
								<th>Stock Order ID</th>
								<th>Date Ordered</th>
								<th>Status</th>
								<th>Supplier</th>
								<th>Address</th>
								<th>Part Name</th>
								<th>Quantity</th>
								<th>Current Price</th>
							</tr>
							<!--samplerow-->
							<tr><?php 
								
								if(isset($_POST['q']))
								{
									$quer.="WHERE"
									." suppliers_t.supplier_id = STOCK_ORDER_HISTORIES.supplier_id "
									." AND stock_orders_t.stock_order_id = " . $_POST['q']
									." AND STOCK_ORDER_HISTORIES.stock_order_id = " . $_POST['q'] 
									." AND stock_orders_t.stock_order_id = STOCK_ORDER_HISTORIES.stock_order_id "
									." AND parts_t.part_id = STOCK_ORDER_HISTORIES.part_id "
									." AND suppliers_t.supplier_id = STOCK_ORDER_HISTORIES.supplier_id "
									.";"; 								
								}						
								else
								{
									$quer.="WHERE"
									." suppliers_t.supplier_id = STOCK_ORDER_HISTORIES.supplier_id "
									." AND stock_orders_t.stock_order_id = STOCK_ORDER_HISTORIES.stock_order_id "
									." AND parts_t.part_id = STOCK_ORDER_HISTORIES.part_id "
									." AND suppliers_t.supplier_id = STOCK_ORDER_HISTORIES.supplier_id "
									."
									ORDER BY orderID;"; 
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
								$temp.= ("<tr><td>".$row['orderID']."</td>
								<td>".$row['dateOrdered']."</td>
								<td>".$row['orderStat']."</td>
								<td>".$row['supName']."</td>
								<td>".$row['supAdd']."</td>
								<td>".$row['partName']."</td>
								<td>".$row['quant']."</td>
								<td>".$row['currPrice']."</td>
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