<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' href='style.css'/>
	<script src='script.js'></script>
	<title>Welcome!</title>
</head>
<body>

<div class="header">
<h1>Welcome.</h1>
</div>
</body>
</div class>

<div class="info">
<center><form1>
Username:<input type="text" name="Username"><br>
</form1></center>
<center>
<form2>Password:
<input type="password" name="pwd">
</form2></center>

</div class>
<div class="fire">
<input type = "submit" value="ECHOS">

<?php
	$sqlconn=@mysqli_connect("localhost", "root", "", "courierdb") or die("There was a problem reaching the database.");
	
	@mysqli_close($sqlconn);
	?>
</div>
</html>
