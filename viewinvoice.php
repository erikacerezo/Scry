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
			."invoices_t.invoice_id as invoice, "
			."invoices_t.invoice_date as inDate, "
			."invoices_t.status as inStat, "
			."customers_t.name as custName, "
			."customers_t.address as custAdd, "
			."parts_t.part_name as partName, "
			."invoice_histories_t.qty quant, "
			."invoice_histories_t.current_price currPrice "
			."FROM invoices_t,invoice_histories_t,customers_t,parts_t";?>
 <div class="wrapper">
		<div class="container-fluid">
				<div class="row">
					<ul class="nav nav-pills">
							<li><a href="viewitem.php">View Item</a></li>
							<li><a href="viewcustomer.php">View Customer</a></li>
							<li><a href="viewsupplier.php">View Supplier</a></li>
							<?php if($_SESSION['admin'] == 1){
							echo  "<li  class=\"active\"><a href=\"viewinvoice.php\">View Invoice</a></li>
							<li><a href=\"viewstockorder.php\">View Stock Order</a></li>
							";}?>
							<li ><a href="orderparts.php">Order Parts</a></li>
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
							<form method="POST">
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
								<th>Invoice ID #</th>
								<th>Invoice Date</th>
								<th>Status</th>
								<th>Customer Name</th>
								<th>Address</th>
								<th>Part Name</th>
								<th>Quantity</th>
								<th>Current Price</th>
							</tr>
							<!--samplerow-->
							<tr><?php 
								
								if(isset($_POST['q']))
								{
									$quer.=" WHERE"
									." invoices_t.invoice_id =  ". $_POST['q'] . " "
									." AND invoice_histories_t.invoice_id = " . $_POST['q'] 
									." AND invoices_t.invoice_id = invoice_histories_t.invoice_id"
									." AND customers_t.customer_id = invoices_t.customer_id" 
									." AND invoice_histories_t.part_id = parts_t.part_id"									
									.";"; 								
								}						
					
								else
								{
									$quer.=" WHERE invoices_t.invoice_id = invoice_histories_t.invoice_id AND customers_t.customer_id = invoices_t.customer_id AND invoice_histories_t.part_id = parts_t.part_id; ";
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
								$temp.= ("<tr><td>".$row['invoice']."</td>
								<td>".$row['inDate']."</td>
								<td>".$row['inStat']."</td>
								<td>".$row['custName']."</td>
								<td>".$row['custAdd']."</td>
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