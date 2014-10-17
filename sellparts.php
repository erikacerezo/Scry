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
	<link href="css/sellparts.css" rel="stylesheet">
	<link href="css/topmargin.css" rel="stylesheet">
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
						<div class="col-md-3">
							 <div class="row">
										<h4>Customer Details:</h4>
									</div>
								<div class="row">
									<form role="form" method="POST">
									
									<?php 
								
									if(isset($_GET['cust']) && $_GET['cust']=="exist")
									{
										echo "<select name=\"customer\">";
										$quers = "SELECT name, customer_id from customers_t;";
										$results = @mysqli_query($sqlconn, $quers);
										$display ="";
										while($row = @mysqli_fetch_array($results))
										{
											
											$display.=(
													"<option value =".$row['customer_id']." role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\">".$row['name']."</a></li>");
										}
										echo $display;
										echo "</select>";
										echo "<a  href=\"?cust=new\" class=\"pull-right btn btn-primary btn-lg\" role=\"button\" id=\"submit\">New Customer</a>
										</div>";
									} else
									{
										echo "<div class=\"form-group\">
										
											<label for=\"firstname\">Company Name</label>
													<input type=\"text\" class=\"form-control\" id=\"first name\" name=\"name\">
											<label for=\"tel\">Contact No.</label>
													<input type=\"text\" class=\"form-control\" id=\"tel\" name=\"num\">
											<label for=\"text\">Address</label>
													<input type=\"text\" class=\"form-control\" id=\"address\" name=\"address\">
											<a  href=\"?cust=exist\" class=\"pull-right btn btn-primary btn-lg\" role=\"button\" id=\"submit\">Existing Customer</a>
										</div>";
									
									}?>
									</div>
							</div>
							
							<div class="col-md-9">
							<div class="row">
							<table class="table table-striped">
							<tr>
								<th></th>
								<th>ID #</th>
								<th>Product Name</th>
								<th>Product Description</th>
								<th>Price</th>
								<th>Stock</th>
								<th style="width: 120px;">Quantity</th>
							</tr>
							<!--samplerow-->
							<tr>
							<!--INSERT QUERRY OF PRODECTS-->
							<?php
								$quer = "SELECT * FROM parts_t WHERE parts_t.qty > 0;";
								$result = @mysqli_query($sqlconn,$quer);
								$display ="";
							while($row = @mysqli_fetch_array($result))
							{
							
							
							$display.=("<tr>
								<td><div class=\"input-group\">
								<input type=\"checkbox\" name=\"".$row['part_id']."a\" value=1>
								</div></td>
								<td>".$row['part_id']."</td>
								<td>".$row['part_name']."</td>
								<td>".$row['part_detail']."</td>
								<td>".number_format($row['price'],2)."</td>
								<td>".$row['qty']."</td>
								<td>
								<div class=\"form-group\">
								<input type=\"text\" class=\"form-control\" name=\"".$row['part_id']."\" id=\"quantity\">
								</div>
							</td>
							</tr>");
							
							}

							echo $display;
							
							?>

				
							</td>
							</tr>
						</table>
					</div>
					<div class="row">
					
					<input type="submit" class="pull-right btn btn-primary btn-lg" role="button" id="submit" value="Submit Order"></form>
					<?php 
					
					if($_SERVER["REQUEST_METHOD"]=="POST")
							{
			
							$_SESSION['custid']=0;
							if(!isset($_GET['cust']) || $_GET['cust']!="exist"){
								
							
								$_SESSION['string']="";
						
								$results = @mysqli_query($sqlconn, $quer);
								while($rows = @mysqli_fetch_array($results))
								{
					
									$name = $rows['part_id']."a";
									if(isset($_POST[$name]))
									{
										$ID = $rows['part_id'];
										if(isset($_POST[$ID])&& $_POST[$ID] <= $rows['qty'])
										{
											if($_POST[$ID]>0)
											{
										
											$_SESSION['string'].= $ID.";".$_POST[$ID].";";
											
											}
										}
										else
										{
											$_SESSION['string'] = "Not enough";
											break;
										}
										
									}
								}
								if($_SESSION['string']=="")
								{
									echo "SELECT ITEMS TO ORDER!";
								}
								else if($_SESSION['string']=="Not enough")
								{
									echo "KULANG";
									
									
								}
								else{
									if(!isset($_GET['cust']) || $_GET['cust']!="exist"){
									if(isset($_POST['name'])&&isset($_POST['num'])&&isset($_POST['address'])){
								$insertq="INSERT INTO customers_t (name, address, contact_num) VALUES(\"".$_POST['name']."\",".$_POST['num'].",".$_POST['address'].");";
								
								mysqli_query($sqlconn, $insertq);							
								$qerid ="SELECT MAX(customer_id) from customers_t;";
								$rowsults = @mysqli_query($sql_conn, $qerid);
								$rowid = @mysqli_fetch_array($rowsults);
								$_SESSION['custid']=$rowid['MAX(customer_id)'];
								header("Location: sellparts2.php");
								}
								else
								{
									echo "INVALID OR NO CUSTOMER INPUT";
								}
								}
								
								}
								} else
								
								{
								$_SESSION['string']="";
								$_SESSION['custid']= $_POST['customer'];
								
								
								echo $_SESSION['custid'];
								$results = @mysqli_query($sqlconn, $quer);
								while($rows = @mysqli_fetch_array($results))
								{
					
									$name = $rows['part_id']."a";
									if(isset($_POST[$name]))
									{
										$ID = $rows['part_id'];
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
								else{
									header("Location: sellparts2.php");
								}
								}
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
