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
	<link href="css/topmargin.css" rel="stylesheet">
	<link href="css/orderparts2.css" rel="stylesheet">
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
				$moneybag = array();
				$moneybag['cart'] = explode(";",$_SESSION['string']);
	$sqlconn=@mysqli_connect("localhost", "root", "", "scry") or die("There was a problem reaching the database.");
	?>
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
							<li class="active"><a href="sellparts.php">Sell Parts</a></li>
							
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
					<h3>You are selling the following:</h3>
					</div>
							<div class="row">
							<table class="table table-striped">
							<tr>
								<th>ID #</th>
								<th>Product Name</th>
								<th>Product Description</th>
								<th>Unit Price</th>
								<th style="width: 120px;">Quantity</th>
							</tr>
							<!--samplerow-->
								<?php
							$index = 0;
							$display ="";
							$totalqty = 0;
							$totalprice = 0;
							
							while(!empty($moneybag['cart'][$index]))
							{
							$quer = "SELECT * FROM parts_t WHERE part_id = ".$moneybag['cart'][$index].";";
							
							$index++;
							$result = @mysqli_query($sqlconn, $quer);
							$row = @mysqli_fetch_array($result);
							$totalprice += $row['price']*$moneybag['cart'][$index];
							$totalqty += $moneybag['cart'][$index];
							$display.=("
							<tr>
								<td>".$row['part_id']."</td>
								<td>".$row['part_name']."</td>
								<td>".$row['part_detail']."</td>
								<td>".number_format($row['price'],2)."</td>
								<td>".$moneybag['cart'][$index]."</td>
							</tr>");
						$index ++;
							}
							echo "$display <tr>
								<th>TOTAL</th>
								<th></th>
								<th></th>
								<td>".number_format($totalprice, 2)."</td>
								<td>$totalqty</td>
								</tr>"; 
								
								if($_SERVER["REQUEST_METHOD"]=="POST")
								{
									
									
									$neworder = "INSERT INTO invoices_t(customer_id,invoice_date,status)
									VALUES(".$_SESSION['custid'].",CURDATE(), \"Pending\");";
									mysqli_query($sqlconn, $neworder);
									$newerid = "SELECT MAX(invoice_id) from invoices_t;";
									$newerid1= @mysqli_query($sqlconn, $newerid);
									$newerid2= @mysqli_fetch_array($newerid1);
									$newid = $newerid2['MAX(invoice_id)'];
									$index = 0;
									$index2= 1;
									
									while(!empty($moneybag['cart'][$index]))
									{
									
										$getcurprice = "SELECT price, qty from parts_t WHERE part_id = ".$moneybag['cart'][$index].";";
										$getprice = @mysqli_query($sqlconn,$getcurprice);
										$get = @mysqli_fetch_array($getprice);
										$price = $get['price'];
									
										$insert = "INSERT INTO invoice_histories_t(invoice_id,part_id,qty, current_price) VALUES(".$newid.",".$moneybag['cart'][$index].",".$moneybag['cart'][$index2].",".$price.");";
										
								
										
										$makebawas = "UPDATE parts_t SET qty = ".($get['qty'] - $moneybag['cart'][$index2])." WHERE part_id =".$moneybag['cart'][$index].";";
										
										$index++;
										$index2++;
										mysqli_query($sqlconn, $insert);
										mysqli_query($sqlconn, $makebawas);
									}
									header("Location: sellparts3.php");
								}
								@mysqli_close($sqlconn);?>
						</table>
					</div>
					<form method="POST">
					<div class="row">
					<input type="submit"class="pull-right btn btn-primary btn-lg" role="button" id="confirm" value="Confirm Order">
					<a href="../sellparts.php"class="pull-right btn btn-primary btn-lg" role="button" id="cancel">Cancel</a>
					</div></form>
				</div>
				</div>
			</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
